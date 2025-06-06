<?php

namespace App\Livewire;

class UserInfo extends BaseComponent
{
    public float $discount;
    public string $name;
    public string $email;
    public string $phone;
    public string $preferred_contact;

    public function mount()
    {

    }
    public function render()
    {
        return view('livewire.user-info');
    }
}
