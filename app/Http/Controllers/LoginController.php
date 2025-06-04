<?php

namespace App\Http\Controllers;

use App\Models\Sessions\CourseSession;
use App\Models\User;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class LoginController extends Controller
{
    /**
     * Handle the incoming request.
     * @throws \Throwable
     */
    public function __invoke(Request $request)
    {
        $credential = $request->validate([
            'email' => ['required', Rule::exists('users', 'email')],
            'password' => ['required']
        ]);

        $user = $this->validateCredential($credential);

        throw_unless($user instanceof User, AuthenticationException::class);

        auth()->login($user, true);

        $user->activity()->touch($request->url(), [
            'action' => 'logged in',
        ]);

        return redirect()->route('home');

    }

    public function logout(Request $request): RedirectResponse
    {
        $this->randomizedAuiSchema($request->user());
        auth()->logout();
        return redirect()->route('home');
    }

    protected function validateCredential(array $validatedRequest): ?User
    {
        $user = User::query()->where('email', $validatedRequest['email'])->first();

        if ($user instanceof User && Hash::check($validatedRequest['password'], $user->password)) {
            return $user;
        }

        return null;
    }

    protected function randomizedAuiSchema(User $user): void
    {
        $schema = ($user->getKey() % 2 === 0) ? 'stepper' : 'tabs';
        CourseSession::query()->whereBelongsTo($user, 'user')
            ->update([
                'aui_schema' => $schema,
                'cl_status' => $schema === 'stepper' ? 'high' : 'medium'
            ]);
    }
}
