<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserbeController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('be.pages.users', compact('users'));
    }

    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('be.admin.users')->with('success', 'User berhasil dihapus!');
    }
}
