<?php

use App\Models\Conversation;
use App\Models\User;
use Illuminate\Support\Facades\Broadcast;

Broadcast::channel('App.Models.User.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
});

Broadcast::channel('conversation.{id}', static function (User $user, $id) {
    return Conversation::query()
        ->where('id', $id)
        ->whereHas('participants', function ($query) use ($user) {
            return $query->where('user_id', $user->id);
        })->exists() ? $user->only(['name', 'email', 'is_online']) : null;
});
