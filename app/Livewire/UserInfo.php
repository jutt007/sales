<?php

namespace App\Livewire;

use App\Models\Plan;

class UserInfo extends BaseComponent
{
    public float $discount;
    public string $name = '';
    public string $email = '';
    public string $phone = '';
    public string $preferredContact = 'Text';

    public function mount()
    {
        if ($this->loadLead()) {
            return $this->redirect('/', true);
        }

        $this->discount = Plan::query()->max('discount');

        $this->name = $this->lead->name;
        $this->email = $this->lead->email;
        $this->phone = $this->lead->phone;
        $this->preferredContact = $this->lead->preferred_contact_method;
    }

    public function render()
    {
        return view('livewire.user-info');
    }

    public function storeUserInfo()
    {
        $this->lead->update([
            'name' => $this->name,
            'email' => $this->email,
            'phone' => $this->phone,
            'preferred_contact_method' => $this->preferredContact
        ]);

        return $this->redirect('/plans', true);
    }
}
