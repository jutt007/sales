<?php

namespace App\Livewire;

use App\Models\Plan;

class UserInfo extends BaseComponent
{
    public float $discount;
    public string $name = '';
    public string $email = '';
    public string $phone = '';
    public array $preferredContact = [];

    public function mount()
    {
        if ($this->loadLead()) {
            return $this->redirect('/', true);
        }

        $this->discount = Plan::query()->max('discount');

        $this->name = $this->lead->name ?? '';
        $this->email = $this->lead->email ?? '';
        $this->phone = $this->lead->phone ?? '';
        $this->preferredContact = ($this->lead->preferred_contact_method)?json_decode($this->lead->preferred_contact_method, true):[];
    }

    public function render()
    {
        return view('livewire.user-info');
    }

    public function storeUserInfo()
    {
        $this->validate([
            'name' => ['required', 'regex:/^\S+\s+\S+/'], // Requires at least two words
            'email' => 'required|email|max:150',
            'phone' => 'required|string|min:7|max:20',
            'preferredContact' => 'required|array|min:1',
            'preferredContact.*' => 'in:Call,Email,Text',
        ], [
            'name.regex' => 'Please enter both first and last name.',
        ]);

        $this->lead->update([
            'name' => $this->name,
            'email' => $this->email,
            'phone' => $this->phone,
            'preferred_contact_method' => json_encode($this->preferredContact)
        ]);

        return $this->redirect('/plans', true);
    }
}
