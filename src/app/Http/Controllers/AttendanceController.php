<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Attendance;
use App\Models\User;
use Carbon\Carbon;
use App\Models\Stamp;
use App\Models\Work;
use Illuminate\Support\Facades\Paginator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Pagination\LengthAwarePaginator;

class AttendanceController extends Controller
{
    public function index(Request $request)
    {
        $date = $request->input('date', Carbon::today()->toDateString());
        $attendances = Stamp::with('user')
            ->whereDate('timestamp', $date)
            ->get()
            ->groupBy('user_id');

        $currentPage = LengthAwarePaginator::resolveCurrentPage();
        $perPage = 5;
        $currentPageItems = $attendances->slice(($currentPage - 1) * $perPage, $perPage)->all();
        $attendances = new LengthAwarePaginator($currentPageItems, count($attendances), $perPage, $currentPage, [
            'path' => LengthAwarePaginator::resolveCurrentPath(),
            'pageName' => 'page',
        ]);

        $attendances->appends($request->query());

        return view('attendances.index', compact('attendances', 'date'));
    }


    public function create()
    {
        $users = User::all();
        return view('attendances.create', compact('users'));
    }

    public function store(AttendanceRequest $request)
    {
        $data = $request->validated();

        Attendance::create($data);

        return redirect()->route('attendance.index')->with('success', 'Attendance created successfully.');
    }

    public function edit(Attendance $attendance)
    {
        $users = User::all();
        return view('attendances.edit', compact('attendance', 'users'));
    }

    public function update(AttendanceRequest $request, Attendance $attendance)
    {
        $data = $request->validated();

        $attendance->update($data);

        return redirect()->route('attendance.index')->with('success', 'Attendance updated successfully.');
    }

    public function destroy(Request $request)
    {
        $user = Auth::user();

        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        if ($user) {
            $user->delete();
        }

        return redirect('/register');
    }

    public function userAttendance(Request $request)
    {
        $user = Auth::user();
        $selectedMonth = $request->input('month', date('m'));

        $attendances = Stamp::with('user')
            ->where('user_id', $user->id)
                ->whereMonth('timestamp', $selectedMonth)
            ->orderBy('timestamp', 'asc')
            ->get()
            ->groupBy(function($date) {

            return Carbon::parse($date->timestamp)->format('Y-m-d');
        });

        return view('user-attendance.index', compact('attendances', 'selectedMonth', 'user'));
    }

}
