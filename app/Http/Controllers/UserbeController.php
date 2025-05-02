<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserbeController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        $users = \App\Models\User::when($search, function ($query, $search) {
                return $query->where(function($q) use ($search) {
                    $q->where('name', 'like', "%{$search}%")
                      ->orWhere('email', 'like', "%{$search}%");
                });
            })
            ->get();

        return view('be.pages.users', compact('users'));
    }

    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('be.admin.users')->with('success', 'User berhasil dihapus!');
    }
}
