@extends('layouts.app')

@section('title', 'Dashboard Mahasiswa')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
            <h2 class="text-2xl font-semibold mb-6">Selamat Datang, {{ Auth::user()->name }}!</h2>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Upcoming Tasks -->
                <div class="bg-gray-50 p-4 rounded-lg">
                    <h3 class="text-lg font-medium mb-4 flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-blue-500" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd" />
                        </svg>
                        Tugas Akan Datang
                    </h3>
                    <div class="space-y-3">
                        @forelse($upcomingTasks as $task)
                            @include('components.task-card', ['task' => $task])
                        @empty
                            <p class="text-gray-500 text-sm">Tidak ada tugas yang akan datang.</p>
                        @endforelse
                    </div>
                </div>

                <!-- Overdue Tasks -->
                <div class="bg-gray-50 p-4 rounded-lg">
                    <h3 class="text-lg font-medium mb-4 flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-red-500" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd" />
                        </svg>
                        Tugas Terlambat
                    </h3>
                    <div class="space-y-3">
                        @forelse($overdueTasks as $task)
                            @include('components.task-card', ['task' => $task])
                        @empty
                            <p class="text-gray-500 text-sm">Tidak ada tugas yang terlambat.</p>
                        @endforelse
                    </div>
                </div>
            </div>

            <!-- Recently Completed Tasks -->
            <div class="mt-8">
                <h3 class="text-lg font-medium mb-4 flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-purple-500" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                    </svg>
                    Tugas Selesai Terbaru
                </h3>
                <div class="bg-gray-50 p-4 rounded-lg">
                    <div class="space-y-3">
                        @forelse($completedTasks as $task)
                            @include('components.task-card', ['task' => $task])
                        @empty
                            <p class="text-gray-500 text-sm">Anda belum menyelesaikan tugas apapun.</p>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
