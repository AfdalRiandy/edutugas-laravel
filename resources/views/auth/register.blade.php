<x-guest-layout>
    <div class="min-h-screen bg-gradient-to-b from-blue-50 to-white dark:from-gray-900 dark:to-gray-800 flex flex-col justify-center">
        <!-- Header -->
        <div class="text-center mb-8">
            <div class="inline-flex items-center">
                <div class="text-3xl font-bold text-blue-600 dark:text-blue-400">
                    <span class="flex items-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M22 10v6M2 10v6M12 22V2M17 22V2M7 22V2M17 16H7M17 7H7"/>
                        </svg>
                        Edu<span class="text-indigo-600 dark:text-indigo-400">Tugas</span>
                    </span>
                </div>
            </div>
        </div>
        
        <div class="sm:mx-auto sm:w-full sm:max-w-md">
            <div class="bg-white dark:bg-gray-800 px-6 py-8 shadow-md rounded-lg overflow-hidden">
                <h2 class="text-2xl font-bold text-gray-900 dark:text-white mb-6 text-center">
                    {{ __('Buat Akun Baru') }}
                </h2>

                <form method="POST" action="{{ route('register') }}">
                    @csrf

                    <!-- Name -->
                    <div>
                        <x-input-label for="name" :value="__('Nama')" class="text-gray-700 dark:text-gray-300" />
                        <x-text-input id="name" class="block mt-2 w-full px-4 py-3 rounded-lg border border-gray-300 dark:border-gray-700 focus:border-blue-500 dark:focus:border-blue-500 focus:ring focus:ring-blue-200 dark:focus:ring-blue-800 dark:bg-gray-900 dark:text-white transition-colors" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                    </div>

                    <!-- Email Address -->
                    <div class="mt-6">
                        <x-input-label for="email" :value="__('Email')" class="text-gray-700 dark:text-gray-300" />
                        <x-text-input id="email" class="block mt-2 w-full px-4 py-3 rounded-lg border border-gray-300 dark:border-gray-700 focus:border-blue-500 dark:focus:border-blue-500 focus:ring focus:ring-blue-200 dark:focus:ring-blue-800 dark:bg-gray-900 dark:text-white transition-colors" type="email" name="email" :value="old('email')" required autocomplete="username" />
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>

                    <!-- Password -->
                    <div class="mt-6">
                        <x-input-label for="password" :value="__('Password')" class="text-gray-700 dark:text-gray-300" />
                        <x-text-input id="password" class="block mt-2 w-full px-4 py-3 rounded-lg border border-gray-300 dark:border-gray-700 focus:border-blue-500 dark:focus:border-blue-500 focus:ring focus:ring-blue-200 dark:focus:ring-blue-800 dark:bg-gray-900 dark:text-white transition-colors" type="password" name="password" required autocomplete="new-password" />
                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </div>

                    <!-- Confirm Password -->
                    <div class="mt-6">
                        <x-input-label for="password_confirmation" :value="__('Konfirmasi Password')" class="text-gray-700 dark:text-gray-300" />
                        <x-text-input id="password_confirmation" class="block mt-2 w-full px-4 py-3 rounded-lg border border-gray-300 dark:border-gray-700 focus:border-blue-500 dark:focus:border-blue-500 focus:ring focus:ring-blue-200 dark:focus:ring-blue-800 dark:bg-gray-900 dark:text-white transition-colors" type="password" name="password_confirmation" required autocomplete="new-password" />
                        <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                    </div>

                    <!-- Role -->
                    <div class="mt-6">
                        <x-input-label for="role" :value="__('Role')" class="text-gray-700 dark:text-gray-300" />
                        <select name="role" id="role" class="block mt-2 w-full px-4 py-3 rounded-lg border border-gray-300 dark:border-gray-700 focus:border-blue-500 dark:focus:border-blue-500 focus:ring focus:ring-blue-200 dark:focus:ring-blue-800 dark:bg-gray-900 dark:text-white transition-colors" required>
                            <option value="mahasiswa" @selected(old('role') == 'mahasiswa')>Mahasiswa</option>
                            <option value="dosen" @selected(old('role') == 'dosen')>Dosen</option>
                        </select>
                    </div>

                    <div class="mt-8">
                        <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 dark:bg-blue-700 dark:hover:bg-blue-600 text-white font-medium py-3 px-4 rounded-lg shadow-md hover:shadow-lg transition-all transform hover:-translate-y-0.5">
                            {{ __('Daftar') }}
                        </button>
                    </div>

                    <div class="mt-6 text-center">
                        <p class="text-sm text-gray-600 dark:text-gray-400">
                            {{ __('Sudah punya akun?') }} 
                            <a href="{{ route('login') }}" class="text-blue-600 dark:text-blue-400 hover:underline font-medium">
                                {{ __('Login') }}
                            </a>
                        </p>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-guest-layout>
