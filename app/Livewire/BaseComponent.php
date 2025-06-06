<?php

namespace App\Livewire;

use App\Models\Lead;
use Illuminate\Support\Str;
use Livewire\Component;

abstract class BaseComponent extends Component
{
    public string $identifier;
    public ?Lead $lead = null;

    /**
     * @param bool $redirectIfMissing
     * @return bool
     */
    public function loadLead(bool $redirectIfMissing = true): bool
    {
        $this->identifier = request()->cookie('guest_identifier') ?? Str::uuid()->toString();
        $this->lead = Lead::query()->where('identifier', $this->identifier)->first();

        if (!$this->lead && $redirectIfMissing) {
            return true;
        }

        return false;
    }
}
