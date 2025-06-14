<div>
    <div class="col-md-12">
        <div class="main-section">
            <div class="main-top-heading">
                <h2>Buy Online & Save!</h2>
                <h4>Faster service. More savings.</h4>
            </div>

            <div class="select-multi-options">

                <form action="">
                    <div class="location-form discount-plan-main">
                        @if($discount > 0)
                        <div class="get-discount-plan">
                            <h3>Get ${{ $discount }} OFF</h3>
                            <span>Discount is based on selected plan!</span>
                            <h4>Plans & pricing are next..</h4>
                        </div>
                        @endif
                        <div class="row m-0">
                            <div class="col-md-12">
                                <!-- Left Column -->
                                <div class="form-left site-form discount-form">
                                    <div class="form-floating mb-4">
                                        <input type="text" class="form-control" id="name" wire:model="name" placeholder="Full Name">
                                        <label for="name">Full Name</label>
                                    </div>

                                    <div class="form-floating mb-4">
                                        <input type="phone" class="form-control" id="phone" wire:model="phone" placeholder="Phone">
                                        <label for="phone">Phone</label>
                                    </div>

                                    <div class="form-floating mb-4">
                                        <input type="text" class="form-control" id="Email" wire:model="email" placeholder="Email">
                                        <label for="Email">Email</label>
                                    </div>

                                    <div class="commercial-question">
                                        <label class="form-label d-block commercial-head">Preferred method of contact?</label>

                                        <div class="form-check form-check-inline custom-radio me-2 me-sm-5">
                                            <input class="form-check-input" type="radio" name="commercial" wire:model="preferredContact" id="radioYes" value="Call" checked>
                                            <label class="form-check-label" for="radioYes">Call</label>
                                        </div>

                                        <div class="form-check form-check-inline custom-radio ms-2 ms-sm-5">
                                            <input class="form-check-input" type="radio" name="commercial" wire:model="preferredContact" id="radioNo" value="Email">
                                            <label class="form-check-label" for="radioNo">Email</label>
                                        </div>

                                        <div class="form-check form-check-inline custom-radio ms-2 ms-sm-5">
                                            <input class="form-check-input" type="radio" name="commercial" wire:model="preferredContact" id="radioNo" value="Text">
                                            <label class="form-check-label" for="radioNo">Text</label>
                                        </div>


                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>


                    <div class="btn-main mt-5">
                        <a type="button" class="btn-site btn-invert me-3 me-sm-5" style="text-decoration: none;"  href="/address">Back</a>
                        <button type="button" class="btn-site" wire:click="storeUserInfo">Next</button>
                    </div>
                </form>

            </div>

            <div class="slider-dot-main">
                <span></span>
                <span></span>
                <span class="active"></span>
                <span></span>
                <span></span>
                <span></span>
                <span></span>
            </div>
        </div>
    </div>
</div>
