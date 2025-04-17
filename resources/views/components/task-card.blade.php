@props(['task'])

<div class="bg-white shadow rounded p-4 flex flex-col gap-2">
    <div class="flex items-center justify-between">
        <h2 class="font-semibold text-lg">
            <a href="{{ route('tasks.show', $task->id) }}" class="hover:underline">{{ $task->title }}</a>
        </h2>
        <x-badge>{{ ucfirst(str_replace('_', ' ', $task->status)) }}</x-badge>
    </div>
    <p class="text-gray-600">{{ $task->description }}</p>
    <div class="flex gap-2 mt-2">
        <a href="{{ route('tasks.edit', $task->id) }}">
            <x-button type="button" color="secondary">Edit</x-button>
        </a>
        <form action="{{ route('tasks.destroy', $task->id) }}" method="POST" onsubmit="return confirm('Delete this task?')">
            @csrf
            @method('DELETE')
            <x-button type="submit" color="danger">Delete</x-button>
        </form>
    </div>
</div>
