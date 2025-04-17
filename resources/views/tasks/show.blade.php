@extends('layouts.app')

@section('title', $task->title)

@section('content')
    <x-alert />
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <h1 class="text-2xl font-bold">{{ $task->title }}</h1>
                <p class="text-gray-600">{{ $task->description }}</p>
                <p class="text-sm text-gray-500">Deadline: {{ $task->due_date->format('d M Y H:i') }}</p>
                <div class="mt-2">
                    <x-badge>{{ $task->status }}</x-badge>
                </div>

                @if(Auth::user()->role === 'mahasiswa')
                    <form action="{{ route('tasks.uploadSubmission', $task->id) }}" method="POST" enctype="multipart/form-data" class="mt-4">
                        @csrf
                        <label for="file" class="block text-sm font-medium text-gray-700">Upload Tugas</label>
                        <input type="file" name="file" id="file" class="mt-1 block w-full">
                        <button type="submit" class="mt-2 px-4 py-2 bg-blue-600 text-white rounded-md">Unggah</button>
                    </form>
                @endif

                @if(Auth::user()->role === 'dosen')
                    <h2 class="text-xl font-bold mt-6">Pengumpulan Tugas</h2>
                    <ul class="mt-4">
                        @forelse($submissions as $submission)
                            <li class="border-b py-2">
                                <p><strong>{{ $submission->user->name }}</strong> - {{ $submission->created_at->format('d M Y H:i') }}</p>
                                <a href="{{ asset('storage/' . $submission->file_path) }}" class="text-blue-600 hover:underline" target="_blank">Unduh Tugas</a>
                            </li>
                        @empty
                            <p class="text-gray-500">Belum ada pengumpulan tugas.</p>
                        @endforelse
                    </ul>
                @endif
            </div>
        </div>
    </div>
    <div class="flex gap-2">
        <a href="{{ route('tasks.edit', $task->id) }}">
            <x-button type="button">Edit</x-button>
        </a>
        <form action="{{ route('tasks.destroy', $task->id) }}" method="POST" onsubmit="return confirm('Delete this task?')">
            @csrf
            @method('DELETE')
            <x-button type="submit" color="danger">Delete</x-button>
        </form>
        <a href="{{ route('tasks.index') }}">
            <x-button type="button" color="secondary">Back</x-button>
        </a>
    </div>
@endsection
