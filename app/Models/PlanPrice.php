<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PlanPrice extends Model
{
    protected $fillable = ['plan_id', 'billing_type', 'amount'];

    const TYPE = [
        'monthly' => 'Monthly',
        'quarterly' => 'Quarterly',
        'bi_monthly' => 'Bi-Monthly',
        'per_service' => 'Service',
    ];

    public function plan() : BelongsTo
    {
        return $this->belongsTo(Plan::class);
    }
}
