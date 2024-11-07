<?php

namespace Database\Factories;

use App\Models\Message;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Conversation>
 */
class ConversationFactory extends Factory
{
    public function initiator(): self
    {
        $initiator = User::find(2);
        $recipient = User::find(1);
        return $this->hasAttached($initiator, ['is_initiator' => true], 'participants')
            ->hasAttached($recipient, ['is_initiator' => false], 'participants')
            ->has(Message::factory()->for($initiator, 'sender')->count(2), 'messages');
    }

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            //
        ];
    }
}
