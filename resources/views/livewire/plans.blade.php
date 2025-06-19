<div class="col-md-12">
    <div class="main-section">
        <div class="main-top-heading">
            <h2>Select A Plan</h2>
            <h4>Faster service. More savings.</h4>
        </div>

        <div class="select-multi-options">
            <div class="termites-main">
                <div class="termite-left">
                    <img src="{{ asset('logo.png') }}" width="80">
                    <h3>Spire Pest Control</h3>
                    <p>{{ $selectedPlan->name }} provides effective solutions for your needs!</p>
                </div>
                <div class="termite-right">
                    <h3>{{ $selectedPlan->name }}</h3>
                    <span>Include in this plan:</span>
                    <ol>
                        <li>Quarterly Exterior Services</li>
                        <li>Covers 30+ Pests</li>
                        <li>Free Re-Services</li>
                    </ol>
                </div>
            </div>
            <form action="">
                <div class="compare-plans-main">
                    <h3>Compare Additional treatment Options!</h3>

                    <div class="plans-tab-main">
                        @foreach($plans as $plan)
                            <button type="button" class="tab-btn {{ ($plan->id == $selectedPlan->id)?"active":"" }}" data-tab="#plan-{{ $plan->id }}">{{ $plan->name }}</button>
                        @endforeach
                    </div>


                    <div class="compare-plan-options">
                        @foreach($plans as $plan)
                            @php
                                $price1 = $plan->prices->get(0);
                                $price2 = $plan->prices->get(1);
                                $selectedPriceId = $selectedPriceIds[$plan->id];
                                $selectedPrice = $plan->prices->firstWhere('id', $selectedPriceId);
                                $isSecondSelected = $selectedPriceId === $price2?->id;
                            @endphp

                            <div class="compare-plan {{ $plan->id == $selectedPlan->id ? 'active' : '' }}" id="plan-{{ $plan->id }}">
                                <h5>{{ $plan->name }}</h5>
                                <div class="price-mm-yy">
                                    @if($plan->prices->count() == 1)
                                        <span class="price m-auto">
                                            ${{ (int)$selectedPrice->amount }}
                                            <small>/ {{ \App\Models\PlanPrice::PERIOD[$selectedPrice->billing_type] }}</small>
                                        </span>
                                    @else
                                        <span class="price">
                                            ${{ (int)$selectedPrice->amount }}
                                            <small>/ {{ \App\Models\PlanPrice::PERIOD[$selectedPrice->billing_type] }}</small>
                                        </span>
                                        <div class="d-inline-flex align-items-center">
                                            <span class="switch-label">{{ \App\Models\PlanPrice::TYPE[$price1->billing_type] }}</span>
                                            <label class="switch mx-2 mb-0">
                                                <input type="checkbox"
                                                       wire:click="togglePrice({{ $plan->id }}, $event.target.checked)"
                                                       @if($isSecondSelected) checked @endif>
                                                <span class="slider"></span>
                                            </label>
                                            <span class="switch-label">{{ \App\Models\PlanPrice::TYPE[$price2->billing_type] }}</span>
                                        </div>
                                    @endif
                                </div>
                                <div class="plan-perks-main">
                                    @if($plan->initial_fee > 0)
                                    <div class="plan-perks">
                                        <span><img src="{{ asset('widget/images/simple-tick.png') }}" alt="Include"></span>
                                        Initial Fee: ${{$plan->initial_fee}}
                                    </div>
                                    @endif
                                    <div class="plan-perks">
                                        <span><img src="{{ asset('widget/images/simple-tick.png') }}" alt="Include"></span>
                                        Covers 30+ Pests
                                    </div>
                                    <div class="plan-perks">
                                        <span><img src="{{ asset('widget/images/simple-tick.png') }}" alt="Include"></span>
                                        Free Re-Services
                                    </div>
                                    <div class="plan-perks">
                                        <span><img src="{{ asset('widget/images/cross.png') }}" alt="Include"></span>
                                        Seasonal Mosquito (Mar — Oct)
                                    </div>
                                    <div class="plan-perks">
                                        <span><img src="{{ asset('widget/images/cross.png') }}" alt="Include"></span>
                                        Termite Prevention & Yearly Inspection
                                    </div>
                                </div>
                                <div class="select-plan-btn">
                                    <button type="button" class="btn-site" wire:click="selectPlan({{ $plan->id }})">Select Plan</button>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </form>

        </div>

        <div class="slider-dot-main">
            <span></span>
            <span></span>
            <span></span>
            <span class="active"></span>
            <span></span>
            <span></span>
            <span></span>
        </div>
    </div>
</div>
