<?php

namespace App\Livewire;

use App\Models\Bug;
use App\Models\Lead;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cookie;
use Livewire\Component;

class ChooseBugs extends BaseComponent
{
    public Collection $bugs;
    public array $selectedBugs = [];

    public function mount()
    {
        $this->bugs = Bug::query()->get();
        $this->loadLead(false);
        if ($this->lead) {
            $this->selectedBugs = $this->lead->selected_bugs ?? [];
        }
    }

    public function render()
    {
        return view('livewire.choose-bugs');
    }

    public function markSelected($id)
    {
        if (in_array($id, $this->selectedBugs)){
            $this->selectedBugs = array_diff($this->selectedBugs, [$id]);
        }else {
            $this->selectedBugs[] = $id;
        }
    }

    public function storeBugs()
    {
        Lead::query()->updateOrCreate(
            ['identifier' => $this->identifier],
            [
                'identifier' => $this->identifier,
                'selected_bugs' => $this->selectedBugs
            ]
        );

        Cookie::queue('guest_identifier', $this->identifier, 60 * 24 * 30);
        return $this->redirect('/address', true);
    }
}
