<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Stamp;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class StampController extends Controller
{
    public function index()
    {
        $userId = Auth::id();
        $userStamps = Stamp::where('user_id', $userId)->orderBy('created_at', 'desc')->get();
        $lastStamp = $userStamps->first();
        $status = null;

        if ($lastStamp) {
            $status = $lastStamp->type;
        }
        $currentTime = Carbon::now()->toDateTimeString();

        return view('stamps.index', compact('userStamps', 'lastStamp', 'status', 'currentTime'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'type' => 'required|in:check_in_time,check_out_time,break_start_time,break_end_time',
        ]);

        $userId = Auth::id();

        $lastStamp = Stamp::where('user_id', $userId)
            ->orderBy('timestamp', 'desc')
            ->first();

        $isDifferentDay = $lastStamp && !Carbon::parse($lastStamp->timestamp)->isSameDay(Carbon::today());

        $existingCheckInRecord = Stamp::where('user_id', $userId)
            ->where('type', 'check_in_time')
            ->whereDate('timestamp', Carbon::today())
            ->exists();

        if ($request->type === 'check_in_time' && $existingCheckInRecord && !$isDifferentDay) {
            return redirect()->route('stamps.index')->with('error', '今日の勤務開始はすでに記録されています');
        }

        if ($request->type === 'break_start_time') {
            if ($lastStamp && !in_array($lastStamp->type, ['check_in_time', 'break_end_time'])) {
                return redirect()->route('stamps.index')->with('error', '休憩開始はできません');
            }
        }

        if ($request->type === 'break_end_time') {

            if ($lastStamp && $lastStamp->type !== 'break_start_time') {
                return redirect()->route('stamps.index')->with('error', '休憩終了はできません');
            }
        }

        if ($request->type === 'check_out_time') {
            if ($lastStamp && !in_array($lastStamp->type, ['check_in_time', 'break_end_time'])) {
                return redirect()->route('stamps.index')->with('error', '勤務終了はできません');
            }
        }

        Stamp::create([
            'user_id' => $userId,
            'type' => $request->type,
            'timestamp' => now(),
        ]);

        return redirect()->route('stamps.index')->with('success', '打刻が記録されました');
    }

    public function destroy($id)
    {
        $stamp = Stamp::findOrFail($id);
        $stamp->delete();

        return redirect()->route('stamps.index')->with('success', '記録が削除されました');
    }
}
