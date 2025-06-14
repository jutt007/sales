<?php

namespace App\Livewire;

use App\Models\Bug;
use App\Models\Lead;
use App\Models\Plan;
use App\Models\PlanPrice;
use Illuminate\Support\Collection;

class Plans extends BaseComponent
{
    public Collection $plans;
    public Plan $selectedPlan;
    public array $selectedPriceIds = [];

    public function mount()
    {
        if ($this->loadLead()) {
            return $this->redirect('/', true);
        }

        if ($this->lead->plan_id){
            $this->selectedPlan = $this->lead->plan;
        }else{
            $planType = $this->getPlanType();
            $this->selectedPlan = Plan::query()->where('type', $planType)->first();
        }
        $this->plans = Plan::with('prices')->get();

        foreach ($this->plans as $plan) {
            if ($this->lead->plan_price_id){
                $this->selectedPriceIds[$this->lead->plan_id] = $this->lead->plan_price_id;
            }
            $this->selectedPriceIds[$plan->id] = $plan->prices->get(0)?->id;
        }
    }

    public function render()
    {
        return view('livewire.plans');
    }

    public function togglePrice($planId, $isSecond)
    {
        $plan = $this->plans->firstWhere('id', $planId);
        $this->selectedPlan = $plan;
        $price = $plan->prices->get($isSecond ? 1 : 0);
        if ($price) {
            $this->selectedPriceIds[$planId] = $price->id;
        }
    }

    public function getPlanType(): string
    {
        $bugIds = optional($this->lead)->selected_bugs;
        $statuses = Bug::query()->whereIn('id', $bugIds)->pluck('status');

        $outdoor = $statuses->filter(fn($s) => $s == 1)->count();
        $nonOutdoor = $statuses->count() - $outdoor;

        if ($outdoor && !$nonOutdoor) return 'Outdoor';
        if (!$outdoor && $nonOutdoor) return 'General';

        return 'Hybrid';
    }

    public function selectPlan($planId)
    {
        $plan = Plan::query()->where('id',$planId)->first();
        $planPrice = $plan->prices()->where('id', $this->selectedPriceIds[$planId])->first();
        $this->lead->update([
            'plan_id' => $plan->id,
            'initial_fee' => $plan->initial_fee,
            'discount' => $plan->discount,
            'charges' => $planPrice->amount,
            'plan_price_id' => $planPrice->id,
            'charges_type' => PlanPrice::TYPE[$planPrice->billing_type]
        ]);

        return $this->redirect('/payment-info', true);
    }
}
