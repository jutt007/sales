@extends('layouts.app')

@section('title', 'Add Address')

@section('content')
    @livewire('plans')
@endsection
@push('scripts')
    <script>
        /*if (window.innerWidth < 1025) {
            $('.compare-plan h5').addClass('d-none');
        }*/
        $('.tab-btn').on('click', function () {
            const target = $(this).data('tab');

            $('.tab-btn').removeClass('active');
            $(this).addClass('active');

            // Hide all contents with animation reset
            $('.compare-plan').removeClass('active').hide();

            // Show and animate the selected one
            const targetDiv = $(target);
            targetDiv.show(0, function () {
                // Trigger reflow for animation to work
                targetDiv[0].offsetHeight;
                targetDiv.addClass('active');
            });
        });
    </script>
@endpush
