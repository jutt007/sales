<div>
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
                                <!-- Right Column -->
                                <div class="form-right">
                                    <div class="map">
                                        <!-- Replace with actual map embed or image -->
                                        <iframe src="https://www.google.com/maps/embed/v1/view?key={{ config('services.maps.key') }}&center={{ $latitude }},{{ $longitude }}&zoom=12&maptype=roadmap" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade" id="map"></iframe>
                                    </div>
{{--                                    <p class="sqft">3,447 sqft</p>--}}
                                </div>
                            </div>
                            <div class="col-md-12">
                                <!-- Left Column -->
                                <div class="form-left site-form mt-4">
                                    <div class="form-floating mb-4">
                                        <input type="text" class="form-control" wire:model="address" id="address" placeholder="Please Enter Your Full Address">
                                        <label for="address">Please Enter Your Full Address</label>
                                    </div>
                                    <input type="hidden" wire:model="latitude">
                                    <input type="hidden" wire:model="longitude">

                                    <div class="commercial-question">
                                        <label class="form-label d-block commercial-head">Is this location a commercial problem?</label>

                                        <div class="form-check form-check-inline custom-radio me-5">
                                            <input class="form-check-input" type="radio" wire:model="isCommercial" value="1" id="radioYes">
                                            <label class="form-check-label" for="radioYes">Yes</label>
                                        </div>

                                        <div class="form-check form-check-inline custom-radio ms-sm-5">
                                            <input class="form-check-input" type="radio" wire:model="isCommercial" value="0" id="radioNo">
                                            <label class="form-check-label" for="radioNo">No</label>
                                        </div>
                                    </div>
                                </div>
                            </div>


                        </div>

                    </div>


                    <div class="btn-main">
                        <button type="button" class="btn-site btn-invert me-3 me-sm-5"  wire:navigate href="/">Back</button>
                        <button type="button" class="btn-site" wire:click="saveIsCommercial">Next</button>
                    </div>
                </form>

            </div>

            <div class="slider-dot-main">
                <span></span>
                <span class="active"></span>
                <span></span>
                <span></span>
                <span></span>
                <span></span>
                <span></span>
            </div>
        </div>
    </div>
</div>
