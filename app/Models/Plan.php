<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Plan extends Model
{
    protected $fillable = ['name', 'description', 'initial_fee', 'discount'];

    public function prices() : HasMany
    {
        return $this->hasMany(PlanPrice::class);
    }
}
