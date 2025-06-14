<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Cookie;

class Success extends BaseComponent
{

    public function mount()
    {
        if ($this->loadLead()) {
            return $this->redirect('/', true);
        }
    }

    public function render()
    {
        return view('livewire.success');
    }

    public function finishProcess()
    {
        Cookie::queue(Cookie::forget('guest_identifier'));
        return $this->redirect('/', true);
    }
}
