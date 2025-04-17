@extends('layouts.app')

@section('content')
    <x-alert />
    <div class="flex items-center justify-between mb-4">
        <h1 class="text-2xl font-bold">Collaborators for: {{ $task->title }}</h1>
        <a href="{{ route('collaborators.create', $task->id) }}">
            <x-button>Add Collaborator</x-button>
        </a>
    </div>
    <div class="bg-white shadow rounded p-4">
        @if($collaborators->count())
            <table class="w-full">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Added At</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($collaborators as $collaborator)
                        <tr>
                            <td>{{ $collaborator->name }}</td>
                            <td>{{ $collaborator->email }}</td>
                            <td>{{ $collaborator->created_at->format('d M Y H:i') }}</td>
                            <td>
                                <form action="{{ route('collaborators.destroy', [$task->id, $collaborator->id]) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <x-button type="submit" color="danger" onclick="return confirm('Remove this collaborator?')">Remove</x-button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <p>No collaborators for this task.</p>
        @endif
    </div>
@endsection
