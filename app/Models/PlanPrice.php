<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PlanPrice extends Model
{
    protected $fillable = ['plan_id', 'billing_type', 'amount'];

    public function plan() : BelongsTo
    {
        return $this->belongsTo(Plan::class);
    }
}
