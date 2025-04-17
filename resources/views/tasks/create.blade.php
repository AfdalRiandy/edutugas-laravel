@extends('layouts.app')

@section('content')
    <x-alert />
    <h1 class="text-2xl font-bold mb-4">Create Task</h1>
    <form action="{{ route('tasks.store') }}" method="POST" class="bg-white shadow rounded p-4 max-w-lg">
        @csrf
        @include('tasks._form', ['task' => null])
        <div class="mt-4 flex gap-2">
            <x-button type="submit">Save</x-button>
            <a href="{{ route('tasks.index') }}">
                <x-button type="button" color="secondary">Cancel</x-button>
            </a>
        </div>
    </form>
@endsection
