<?php

namespace App\Livewire;

use App\Livewire\Traits\HasAlert;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Livewire\Component;

class ProfileForm extends Component
{
    use HasAlert;

    public User $user;

    public string $name;

    public function mount(): void
    {
        $this->name = $this->user->name;
    }

    public function save(): void
    {
        $this->validate([
            'name' => ['required','max:255'],
        ]);

        $this->user->update([
            'name' => $this->name,
        ]);

        $this->success(__("Profile updated successfully."));
        $this->redirectRoute('profile');
    }

    public function render(): View
    {
        return view('livewire.profile-form');
    }
}
