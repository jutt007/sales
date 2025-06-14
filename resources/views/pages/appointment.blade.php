@extends('layouts.app')

@section('title', 'Payment')

@push('styles')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
@endpush

@section('content')
    @livewire('appointment')
@endsection

