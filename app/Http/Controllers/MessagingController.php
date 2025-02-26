<?php

namespace App\Http\Controllers;

use App\Models\Conversation;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MessagingController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $conversation = $request->has('create') && $request->get('user')
            ? $this->createConversation($request->get('user'))
            : null;

        return view('components.pages.messaging', [
            'conversation' => $conversation,
        ]);
    }

    protected function createConversation(int $userId): Conversation
    {
        $user = User::query()->findOrFail($userId);

        $conversation = Conversation::query()->whereHas('participants', function ($query) use ($userId) {
           return $query->whereIn('user_id', [$userId, auth()->user()->id]);
        })->first();

        return $conversation ?? DB::transaction(static function () use ($user) {
            $conversation = Conversation::create([]);
            $conversation->participants()
                ->attach([$user->getKey(), auth()->user()->getKey()]);
            return $conversation;
        });
    }
}
