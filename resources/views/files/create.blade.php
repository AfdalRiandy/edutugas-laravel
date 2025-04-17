@extends('layouts.app')

@section('content')
    <x-alert />
    <h1 class="text-2xl font-bold mb-4">Upload File for: {{ $task->title }}</h1>
    <form action="{{ route('files.store', $task->id) }}" method="POST" enctype="multipart/form-data" class="bg-white shadow rounded p-4 max-w-md">
        @csrf
        <x-form-input type="file" name="file" label="Choose File" required />
        <div class="mt-4 flex gap-2">
            <x-button type="submit">Upload</x-button>
            <a href="{{ route('files.index', $task->id) }}">
                <x-button type="button" color="secondary">Back</x-button>
            </a>
        </div>
    </form>
@endsection
