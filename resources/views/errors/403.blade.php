@extends('layouts.guest')

@section('content')
    <div class="text-center mt-24">
        <h1 class="text-5xl font-bold mb-4">403</h1>
        <p class="text-lg mb-6">Forbidden. You do not have permission to access this page.</p>
        <a href="{{ url()->previous() }}">
            <x-button type="button">Go Back</x-button>
        </a>
    </div>
@endsection
