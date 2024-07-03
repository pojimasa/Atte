<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UserListController extends Controller
{
    public function index(Request $request)
    {
        $month = $request->input('month');
        $users = User::when($month, function ($query, $month) {
            return $query->whereMonth('created_at', $month);
        })->get();

        return view('userlist.index', compact('users', 'month'));
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);

        if (Auth::id() === $user->id) {
            Auth::logout();
        }

        $user->delete();

        return redirect()->route('users.index')->with('success', 'ユーザーが削除されました。');
    }
}
