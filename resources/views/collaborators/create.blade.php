@extends('layouts.app')

@section('content')
    <x-alert />
    <h1 class="text-2xl font-bold mb-4">Add Collaborator to: {{ $task->title }}</h1>
    <form action="{{ route('collaborators.store', $task->id) }}" method="POST" class="bg-white shadow rounded p-4 max-w-md">
        @csrf
        <x-form-input name="name" label="Name" :value="old('name')" required />
        <x-form-input name="email" label="Email" type="email" :value="old('email')" required />
        <div class="mt-4 flex gap-2">
            <x-button type="submit">Add</x-button>
            <a href="{{ route('collaborators.index', $task->id) }}">
                <x-button type="button" color="secondary">Back</x-button>
            </a>
        </div>
    </form>
@endsection
