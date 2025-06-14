<?php

namespace App\Livewire;

class Payment extends BaseComponent
{
    public function mount()
    {
        if ($this->loadLead()) {
            return $this->redirect('/', true);
        }
    }

    public function render()
    {
        return view('livewire.payment');
    }
}
