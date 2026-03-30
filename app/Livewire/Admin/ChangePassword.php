<?php

namespace App\Livewire\Admin;

use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class ChangePassword extends Component
{
    public string $current_password = '';
    public string $password = '';
    public string $password_confirmation = '';

    protected function rules(): array
    {
        return [
            'current_password' => 'required|current_password',
            'password' => 'required|min:8|confirmed|different:current_password',
        ];
    }

    protected array $messages = [
        'current_password.current_password' => 'The current password is not correct.',
        'password.different' => 'The new password must be different from the current password.',
    ];

    public function updatePassword(): void
    {
        $validated = $this->validate();

        $user = auth()->user();
        $user->forceFill([
            'password' => Hash::make($validated['password']),
        ])->save();

        $this->reset(['current_password', 'password', 'password_confirmation']);

        session()->flash('status', 'Your password has been updated successfully.');
    }

    public function render()
    {
        return view('livewire.admin.change-password')
            ->layout('components.layouts.app');
    }
}
