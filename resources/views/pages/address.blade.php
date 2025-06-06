@extends('layouts.app')

@section('title', 'Add Address')

@section('content')
    @livewire('address')
@endsection

@push('scripts')
    <script src="https://maps.googleapis.com/maps/api/js?key={{ config('services.maps.key') }}&libraries=places"></script>
    <script>
        function initAutocomplete() {
            const input = document.getElementById('address');
            const mapFrame = document.getElementById('map');
            const autocomplete = new google.maps.places.Autocomplete(input);

            autocomplete.addListener('place_changed', () => {
                const place = autocomplete.getPlace();
                if (!place.geometry) {
                    alert("No details available for input: '" + place.name + "'");
                    return;
                }

                const lat = place.geometry.location.lat();
                const lng = place.geometry.location.lng();

                window.dispatchEvent(new CustomEvent('saveAddress', {
                    detail: [place.formatted_address,lat, lng]
                }));

                // Update iframe src with new coordinates
                const mapSrc = `https://www.google.com/maps/embed/v1/view?key={{ config('services.maps.key') }}&center=${lat},${lng}&zoom=15&maptype=roadmap`;
                mapFrame.src = mapSrc;
            });
        }

        // Initialize when the page loads
        window.onload = initAutocomplete;
    </script>
@endpush
