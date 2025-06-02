<div>
    <style>
        #map {
            height: 400px;
            width: 100%;
            margin-top: 20px;
        }

        /*
         * Optional: Makes the sample page fill the window.
         */
        html,
        body {
            height: 100%;
            margin: 0;
            padding: 0;
        }

        p {
            font-family: Roboto, sans-serif;
            font-weight: bold;
        }
    </style>
    <script>
        (g => {
            var h, a, k, p = "The Google Maps JavaScript API", c = "google", l = "importLibrary", q = "__ib__", m = document, b = window;
            b = b[c] || (b[c] = {});
            var d = b.maps || (b.maps = {}), r = new Set, e = new URLSearchParams,
                u = () => h || (h = new Promise(async (f, n) => {
                    await (a = m.createElement("script"));
                    e.set("libraries", [...r] + "");
                    for (k in g) e.set(k.replace(/[A-Z]/g, t => "_" + t[0].toLowerCase()), g[k]);
                    e.set("callback", c + ".maps." + q);
                    a.src = `https://maps.${c}apis.com/maps/api/js?` + e;
                    d[q] = f;
                    a.onerror = () => h = n(Error(p + " could not load."));
                    a.nonce = m.querySelector("script[nonce]")?.nonce || "";
                    m.head.append(a)
                }));
            d[l] ? console.warn(p + " only loads once. Ignoring:", g) : d[l] = (f, ...n) => r.add(f) && u().then(() => d[l](f, ...n))
        })({
            key: "{{ config('services.maps.key') }}", // Replace with your actual API key if testing locally
            v: "weekly"
        });
    </script>

    <div x-data x-init="initMap()">
        <div id="map" style="height: 400px;"></div>
    </div>
    <a href="/" class="btn btn-primary" wire:navigate>Back</a>
    <button type="button" class="btn btn-primary">Next</button>
    <script>
        let map, marker;

        async function initMap() {
            await google.maps.importLibrary("places");
            await google.maps.importLibrary("maps");

            // Make sure DOM is ready
            const mapContainer = document.getElementById('map');

            // Create autocomplete element
            const placeAutocomplete = new google.maps.places.PlaceAutocompleteElement();
            document.body.appendChild(placeAutocomplete);

            // Create selected place info display
            const selectedPlaceTitle = document.createElement('p');
            selectedPlaceTitle.textContent = '';
            document.body.appendChild(selectedPlaceTitle);

            const selectedPlaceInfo = document.createElement('pre');
            selectedPlaceInfo.textContent = '';
            document.body.appendChild(selectedPlaceInfo);

            // Initialize map
            const defaultLatLng = { lat: 33.6844, lng: 73.0479 }; // Example: Islamabad
            const map = new google.maps.Map(mapContainer, {
                center: defaultLatLng,
                zoom: 13,
            });

            const marker = new google.maps.Marker({
                map: map,
                draggable: false,
            });

            // Handle selection
            placeAutocomplete.addEventListener('gmp-select', async ({ placePrediction }) => {
                const place = placePrediction.toPlace();
                await place.fetchFields({ fields: ['displayName', 'formattedAddress', 'location'] });

                selectedPlaceTitle.textContent = 'Selected Place:';
                selectedPlaceInfo.textContent = JSON.stringify(place.toJSON(), null, 2);

                const location = place.location;
                if (location) {
                    map.setCenter(location);
                    marker.setPosition(location);
                }
            });
        }
    </script>
</div>
