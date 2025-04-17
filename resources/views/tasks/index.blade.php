@extends('layouts.app')

@section('title', 'Daftar Tugas')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-2xl font-semibold">Daftar Tugas</h2>
                @if(Auth::user()->role === 'dosen')
                    <a href="{{ route('tasks.create') }}" class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 active:bg-blue-800 focus:outline-none focus:border-blue-900 focus:ring ring-blue-300 disabled:opacity-25 transition ease-in-out duration-150">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd" />
                        </svg>
                        Tambah Tugas
                    </a>
                @endif
            </div>

            <!-- Filter Form -->
            <div class="mb-6 bg-gray-50 p-4 rounded-lg">
                <form action="{{ route('tasks.index') }}" method="GET" class="flex flex-wrap gap-4">
                    <div class="flex-1 min-w-[200px]">
                        <label for="category" class="block text-sm font-medium text-gray-700 mb-1">Kategori</label>
                        <select id="category" name="category" class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm rounded-md">
                            <option value="">Semua Kategori</option>
                            @foreach($categories as $category)
                                <option value="{{ $category }}" {{ request('category') == $category ? 'selected' : '' }}>
                                    {{ $category }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    
                    <div class="flex-1 min-w-[200px]">
                        <label for="status" class="block text-sm font-medium text-gray-700 mb-1">Status</label>
                        <select id="status" name="status" class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm rounded-md">
                            <option value="">Semua Status</option>
                            <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                            <option value="in_progress" {{ request('status') == 'in_progress' ? 'selected' : '' }}>In Progress</option>
                            <option value="completed" {{ request('status') == 'completed' ? 'selected' : '' }}>Completed</option>
                        </select>
                    </div>
                    
                    <div class="flex items-end">
                        <button type="submit" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150">
                            Filter
                        </button>
                    </div>
                </form>
            </div>

            <!-- Tasks List -->
            <div class="space-y-4">
                @forelse($tasks as $task)
                    <div class="border border-gray-200 rounded-lg overflow-hidden">
                        <div class="flex flex-col md:flex-row md:items-center justify-between p-4 {{ $task->is_completed ? 'bg-green-50' : ($task->due_date->isPast() ? 'bg-red-50' : 'bg-white') }}">
                            <div class="flex-1">
                                <div class="flex items-center">
                                    <h3 class="text-lg font-medium {{ $task->is_completed ? 'line-through text-gray-500' : '' }}">
                                        {{ $task->title }}
                                    </h3>
                                    @if($task->category)
                                        <span class="ml-2 px-2 py-1 text-xs rounded-full bg-blue-100 text-blue-800">
                                            {{ $task->category }}
                                        </span>
                                    @endif
                                </div>
                                <p class="text-sm text-gray-500 mt-1">
                                    Deadline: {{ $task->due_date->format('d M Y H:i') }}
                                    @if($task->due_date->isPast() && !$task->is_completed)
                                        <span class="text-red-500 font-medium">(Terlambat)</span>
                                    @endif
                                </p>
                            </div>
                            <div class="flex items-center space-x-2 mt-3 md:mt-0">
                                @if(Auth::user()->role === 'dosen')
                                    <form action="{{ route('tasks.toggle-complete', $task->id) }}" method="POST">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" class="px-3 py-1 text-xs {{ $task->is_completed ? 'bg-orange-100 text-orange-800 hover:bg-orange-200' : 'bg-green-100 text-green-800 hover:bg-green-200' }} rounded-md">
                                            {{ $task->is_completed ? 'Tandai Belum Selesai' : 'Tandai Selesai' }}
                                        </button>
                                    </form>
                                    <a href="{{ route('tasks.edit', $task->id) }}" class="px-3 py-1 text-xs bg-yellow-100 text-yellow-800 hover:bg-yellow-200 rounded-md">
                                        Edit
                                    </a>
                                    <form action="{{ route('tasks.destroy', $task->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus tugas ini?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="px-3 py-1 text-xs bg-red-100 text-red-800 hover:bg-red-200 rounded-md">
                                            Hapus
                                        </button>
                                    </form>
                                @endif
                                <a href="{{ route('tasks.show', $task->id) }}" class="px-3 py-1 text-xs bg-blue-100 text-blue-800 hover:bg-blue-200 rounded-md">
                                    Detail
                                </a>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="bg-gray-50 p-4 rounded-lg text-center">
                        <p class="text-gray-500">Tidak ada tugas yang ditemukan.</p>
                        @if(Auth::user()->role === 'dosen')
                            <a href="{{ route('tasks.create') }}" class="mt-2 inline-block text-blue-600 hover:text-blue-800">
                                Buat tugas baru
                            </a>
                        @endif
                    </div>
                @endforelse
            </div>

            <!-- Pagination -->
            <div class="mt-6">
                {{ $tasks->links() }}
            </div>
        </div>
    </div>
</div>
@endsection