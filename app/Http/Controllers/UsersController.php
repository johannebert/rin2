<?php

namespace App\Http\Controllers;

use App\Models\User;

class UsersController extends Controller
{
    public function index()
    {
        return view('users.index');
    }

    public function impersonate(User $user)
    {
        auth()->user()->impersonate($user);

        return redirect()->route('dashboard');
    }

    public function leaveImpersonate()
    {
        auth()->user()->leaveImpersonation();

        return redirect()->route('users.index');
    }
}
