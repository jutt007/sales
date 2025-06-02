<?php

namespace App\Livewire;

use App\Models\Bug;
use Illuminate\Support\Collection;
use Livewire\Component;

class ChooseBugs extends Component
{

    public Collection $bugs;
    public array $selectedBugs = [];
    public string $identifier;

    public function render()
    {
        $this->bugs = Bug::query()->get();
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
        return $this->redirect('/address', true);
    }
}
