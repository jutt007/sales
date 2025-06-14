<div class="col-md-12">
    <div class="main-section">
        <div class="main-top-heading">
            <h2>Buy Online & Save!</h2>
            <h4>Faster service. More savings.</h4>
        </div>

        <div class="select-multi-options">

            <form action="">
                <div class="location-form">
                    <div class="row m-0">
                        <div class="col-md-12">
                            <div class="checkout-main">
                                <h4>You Selected {{ $lead->plan->name }}</h4>
                                <div class="checkout-details-main">
                                    <div class="checkout-detail">
                                        <span>Initial Price</span>
                                        <span>{{ '$'. number_format($lead->initial_fee, 2) }}</span>
                                    </div>
                                    <div class="checkout-detail">
                                        <span>Initial Discount</span>
                                        <span style="color: #01BDA5;"><strong>-{{ '$'. number_format($lead->discount, 2) }}</strong></span>
                                    </div>
                                    <div class="checkout-detail">
                                        <span>Contract</span>
                                        <span>{{ $lead->charges_type }}</span>
                                    </div>
                                    <div class="checkout-detail">
                                        <span>Service Charges</span>
                                        <span>{{ '$'. number_format($lead->charges, 2) }}</span>
                                    </div>
                                    <div class="checkout-detail">
                                        <span>Initial Due Today</span>
                                        <span style="color: #01BDA5;">${{ number_format((($lead->charges + $lead->initial_fee) - $lead->discount), 2) }}</span>
                                    </div>
                                </div>
                            </div>

                            <div class="billing-info-main">
                                <h4>Billing Information</h4>
                                <div class="form-left site-form">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-floating mb-4">
                                                <input type="text" class="form-control" id="cno" placeholder="Card Number:">
                                                <label for="cno">Card Number: **** **** **** ****</label>
                                            </div>
                                        </div>

                                        <div class="col-6">
                                            <div class="form-floating mb-4">
                                                <input type="text" class="form-control" id="CVV" placeholder="CVV">
                                                <label for="CVV">CVV: ***</label>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-floating mb-4">
                                                <input type="text" class="form-control" id="my" placeholder="my">
                                                <label for="my">Exp. (MM/YY): </label>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-floating mb-4">
                                                <input type="text" class="form-control" id="name" placeholder="name">
                                                <label for="name">Card Holder: Your Name</label>
                                            </div>
                                        </div>

                                        {{--<div class="col-md-12">
                                            <div class="d-flex align-items-center mb-4">
                                                <span class="switch-label text-dark">Billing address same as service address?</span>
                                                <label class="switch ms-3 mb-0">
                                                    <input type="checkbox">
                                                    <span class="slider"></span>
                                                </label>
                                            </div>
                                        </div>--}}
                                    </div>


                                </div>
                            </div>
                        </div>
                    </div>

                </div>


                <div class="btn-main">
                    <button type="button" class="btn-site btn-invert me-3 me-sm-5" href="/plans" wire:navigate>Back</button>
                    <button type="button" class="btn-site" href="/appointment" wire:navigate>Next</button>
                </div>
            </form>

        </div>

        <div class="slider-dot-main">
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span class="active"></span>
            <span></span>
            <span></span>
        </div>
    </div>
</div>
