<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Lead extends Model
{
    const CONTACT_METHOD = [
        'Call' => 'Call',
        'Email' => 'Email',
        'Text' => 'Text'
    ];

    protected $fillable = [
        'identifier',
        'selected_bugs',
        'address',
        'is_commercial',
        'name',
        'email',
        'phone',
        'preferred_contact_method',
        'plan_id',
        'initial_fee',
        'discount',
        'charges',
        'plan_price_id',
        'charges_type',
        'appointment_date',
        'appointment_time',
        'customer_added',
        'customer_card_added',
        'contract_sent'
    ];

    protected $casts = [
        'selected_bugs' => 'array',
    ];

    /**
     * @return BelongsTo
     */
    public function plan() : BelongsTo
    {
        return $this->belongsTo(Plan::class);
    }

    public function getSelectedBugIdsAttribute()
    {
        return json_decode($this->selected_bugs ?? '[]');
    }
}
