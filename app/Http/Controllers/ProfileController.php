<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function view(Request $request, ?User $user = null)
    {
        return view('components.pages.profile', ['user' => $user ?? $request->user()]);
    }

    public function edit()
    {
        return view('components.pages.edit-profile',['user' => auth()->user()]);
    }
}
