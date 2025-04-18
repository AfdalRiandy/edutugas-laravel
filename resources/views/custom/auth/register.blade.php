<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="EduTugas - Platform manajemen tugas pendidikan yang memudahkan proses belajar mengajar">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>Register - EduTugas</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700|outfit:400,500,600,700&display=swap" rel="stylesheet" />

        <!-- Styles / Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="bg-gradient-to-b from-blue-50 to-white dark:from-gray-900 dark:to-gray-800 text-gray-800 dark:text-white min-h-screen flex flex-col">
        <div class="flex flex-col min-h-screen items-center justify-center p-6">
            <!-- Logo Header -->
            <div class="mb-10">
                <a href="{{ url('/') }}" class="text-3xl font-bold text-blue-600 dark:text-blue-400">
                    <span class="flex items-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M22 10v6M2 10v6M12 22V2M17 22V2M7 22V2M17 16H7M17 7H7"/>
                        </svg>
                        Edu<span class="text-indigo-600 dark:text-indigo-400">Tugas</span>
                    </span>
                </a>
            </div>

            <!-- Register Form Card -->
            <div class="w-full max-w-md bg-white dark:bg-gray-800 rounded-xl shadow-lg overflow-hidden">
                <div class="p-8">
                    <h2 class="text-2xl font-bold text-gray-900 dark:text-white mb-6 text-center">Buat Akun Baru</h2>

                    @if(session('status'))
                        <div class="bg-green-100 dark:bg-green-900 text-green-700 dark:text-green-300 p-3 rounded-lg mb-6">
                            {{ session('status') }}
                        </div>
                    @endif

                    <!-- Registration Form -->
                    <form method="POST" action="{{ route('custom.register') }}" class="space-y-6">
                        @csrf

                        <!-- Role Field -->
                        <div>
                            <label for="role" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Peran Anda</label>
                            <select name="role" id="role" required
                                class="w-full px-4 py-3 rounded-lg border border-gray-300 dark:border-gray-700 focus:border-blue-500 dark:focus:border-blue-500 focus:ring focus:ring-blue-200 dark:focus:ring-blue-800 dark:bg-gray-900 dark:text-white transition-colors">
                                <option value="mahasiswa" @selected(old('role') == 'mahasiswa')>Mahasiswa</option>
                                <option value="dosen" @selected(old('role') == 'dosen')>Dosen</option>
                            </select>
                            
                            @error('role')
                                <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Name Field -->
                        <div>
                            <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Nama Lengkap</label>
                            <input type="text" name="name" id="name" value="{{ old('name') }}" required autofocus
                                class="w-full px-4 py-3 rounded-lg border border-gray-300 dark:border-gray-700 focus:border-blue-500 dark:focus:border-blue-500 focus:ring focus:ring-blue-200 dark:focus:ring-blue-800 dark:bg-gray-900 dark:text-white transition-colors" />
                            
                            @error('name')
                                <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Email Field -->
                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Email</label>
                            <input type="email" name="email" id="email" value="{{ old('email') }}" required
                                class="w-full px-4 py-3 rounded-lg border border-gray-300 dark:border-gray-700 focus:border-blue-500 dark:focus:border-blue-500 focus:ring focus:ring-blue-200 dark:focus:ring-blue-800 dark:bg-gray-900 dark:text-white transition-colors" />
                            
                            @error('email')
                                <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Password Field -->
                        <div>
                            <label for="password" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Password</label>
                            <input type="password" name="password" id="password" required
                                class="w-full px-4 py-3 rounded-lg border border-gray-300 dark:border-gray-700 focus:border-blue-500 dark:focus:border-blue-500 focus:ring focus:ring-blue-200 dark:focus:ring-blue-800 dark:bg-gray-900 dark:text-white transition-colors" />
                            
                            @error('password')
                                <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Confirm Password Field -->
                        <div>
                            <label for="password_confirmation" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Konfirmasi Password</label>
                            <input type="password" name="password_confirmation" id="password_confirmation" required
                                class="w-full px-4 py-3 rounded-lg border border-gray-300 dark:border-gray-700 focus:border-blue-500 dark:focus:border-blue-500 focus:ring focus:ring-blue-200 dark:focus:ring-blue-800 dark:bg-gray-900 dark:text-white transition-colors" />
                        </div>

                        <!-- Register Button -->
                        <div>
                            <button type="submit" 
                                class="w-full bg-blue-600 hover:bg-blue-700 dark:bg-blue-700 dark:hover:bg-blue-600 text-white font-medium py-3 px-4 rounded-lg shadow-md hover:shadow-lg transition-all transform hover:-translate-y-0.5">
                                Daftar Sekarang
                            </button>
                        </div>
                    </form>

                    <!-- Login Link -->
                    <div class="mt-6 text-center">
                        <p class="text-sm text-gray-600 dark:text-gray-400">
                            Sudah punya akun? 
                            <a href="{{ route('custom.login') }}" class="text-blue-600 dark:text-blue-400 hover:underline font-medium">
                                Masuk
                            </a>
                        </p>
                    </div>
                </div>
            </div>

            <!-- Footer -->
            <div class="mt-8 text-center text-sm text-gray-600 dark:text-gray-400">
                &copy; {{ date('Y') }} EduTugas. All rights reserved.
            </div>
        </div>
    </body>
</html>
