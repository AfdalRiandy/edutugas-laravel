@extends('layouts.app')

@section('content')
    <x-alert />
    <div class="flex items-center justify-between mb-4">
        <h1 class="text-2xl font-bold">Files for: {{ $task->title }}</h1>
        <a href="{{ route('files.create', $task->id) }}">
            <x-button>Upload File</x-button>
        </a>
    </div>
    <div class="bg-white shadow rounded p-4">
        @if($files->count())
            <table class="w-full">
                <thead>
                    <tr>
                        <th>File Name</th>
                        <th>Type</th>
                        <th>Uploaded At</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($files as $file)
                        <tr>
                            <td>{{ $file->file_name }}</td>
                            <td><x-badge>{{ $file->file_type }}</x-badge></td>
                            <td>{{ $file->created_at->format('d M Y H:i') }}</td>
                            <td>
                                <a href="{{ route('files.show', [$task->id, $file->id]) }}" class="text-blue-600 underline">Download</a>
                                <form action="{{ route('files.destroy', [$task->id, $file->id]) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <x-button type="submit" color="danger" onclick="return confirm('Delete this file?')">Delete</x-button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <p>No files uploaded for this task.</p>
        @endif
    </div>
@endsection
