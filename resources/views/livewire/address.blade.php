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
                                        <div id="map" wire:ignore style="height: 400px; width: 100%;"></div>
{{--                                        <iframe src="https://www.google.com/maps/embed/v1/view?key={{ config('services.maps.key') }}&center={{ $latitude }},{{ $longitude }}&zoom=12&maptype=roadmap" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade" id="map"></iframe>--}}
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
    <!-- Google Maps JavaScript API -->
    <script src="https://maps.googleapis.com/maps/api/js?key={{ config('services.maps.key') }}&libraries=places"></script>
    <script>
        let map;
        let marker;
        let autocomplete;

        function initMap() {
            const defaultLocation = { lat: {{ $latitude }}, lng: {{ $longitude }} };

            map = new google.maps.Map(document.getElementById("map"), {
                center: defaultLocation,
                zoom: 20,
            });

            marker = new google.maps.Marker({
                map: map,
                position: defaultLocation,
                draggable: false,
            });

            // Autocomplete
            const input = document.getElementById("address");
            autocomplete = new google.maps.places.Autocomplete(input);
            autocomplete.setFields(["geometry", "formatted_address"]);

            autocomplete.addListener("place_changed", function () {
                const place = autocomplete.getPlace();
                if (!place.geometry) {
                    alert("No details available for input: '" + place.name + "'");
                    return;
                }

                const newLocation = place.geometry.location;

                map.setCenter(newLocation);
                map.setZoom(20);
                marker.setPosition(newLocation);

                const lat = newLocation.lat();
                const lng = newLocation.lng();

                window.dispatchEvent(new CustomEvent('saveAddress', {
                    detail: [place.formatted_address,lat, lng]
                }));
            });
        }

        window.initMap = initMap;
        window.addEventListener('load', initMap);
    </script>
</div>
