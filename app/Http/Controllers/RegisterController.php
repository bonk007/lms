<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;

class RegisterController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $password = Password::default()->mixedCase()->numbers()->symbols()->uncompromised();
        $data = $request->validate([
            'name' => ['required', 'max:255'],
            'email' => ['required', Rule::unique('users', 'email')],
            'password' => [$password, 'min:8', 'confirmed']
        ]);
        $user = User::query()->create($data);

        event(new Registered($user));

        return redirect()->back()
            ->with(['success' => true, 'message' => __('You are registered. Check your inbox to activate your account')]);
    }
}
