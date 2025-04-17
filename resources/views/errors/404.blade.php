@extends('layouts.guest')

@section('content')
    <div class="text-center mt-24">
        <h1 class="text-5xl font-bold mb-4">404</h1>
        <p class="text-lg mb-6">Page not found.</p>
        <a href="{{ url('/') }}">
            <x-button type="button">Go Home</x-button>
        </a>
    </div>
@endsection
