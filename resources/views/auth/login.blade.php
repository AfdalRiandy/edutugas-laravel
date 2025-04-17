<x-guest-layout>
    <div class="min-h-screen bg-gradient-to-b from-blue-50 to-white dark:from-gray-900 dark:to-gray-800 flex flex-col justify-center">
        <!-- Header -->
        <div class="text-center mb-8">
            <div class="inline-flex items-center">
                <div class="text-3xl font-bold text-blue-600 dark:text-blue-400">
                    <span class="flex items-center gap-2">
                        Edu<span class="text-indigo-600 dark:text-indigo-400">Tugas</span>
                    </span>
                </div>
            </div>
        </div>
        
        <div class="sm:mx-auto sm:w-full sm:max-w-md">
            <!-- Session Status -->
            <x-auth-session-status class="mb-4" :status="session('status')" />
            
            <div class="bg-white dark:bg-gray-800 px-6 py-8 shadow-md rounded-lg overflow-hidden">
                <h2 class="text-2xl font-bold text-gray-900 dark:text-white mb-6 text-center">
                    {{ __('Login ke Akun Anda') }}
                </h2>

                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <!-- Email Address -->
                    <div>
                        <x-input-label for="email" :value="__('Email')" class="text-gray-700 dark:text-gray-300" />
                        <x-text-input id="email" class="block mt-2 w-full px-4 py-3 rounded-lg border border-gray-300 dark:border-gray-700 focus:border-blue-500 dark:focus:border-blue-500 focus:ring focus:ring-blue-200 dark:focus:ring-blue-800 dark:bg-gray-900 dark:text-white transition-colors" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>

                    <!-- Password -->
                    <div class="mt-6">
                        <div class="flex items-center justify-between">
                            <x-input-label for="password" :value="__('Password')" class="text-gray-700 dark:text-gray-300" />
                            @if (Route::has('password.request'))
                                <a class="text-sm text-blue-600 dark:text-blue-400 hover:underline" href="{{ route('password.request') }}">
                                    {{ __('Lupa password?') }}
                                </a>
                            @endif
                        </div>
                        <x-text-input id="password" class="block mt-2 w-full px-4 py-3 rounded-lg border border-gray-300 dark:border-gray-700 focus:border-blue-500 dark:focus:border-blue-500 focus:ring focus:ring-blue-200 dark:focus:ring-blue-800 dark:bg-gray-900 dark:text-white transition-colors" type="password" name="password" required autocomplete="current-password" />
                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </div>

                    <!-- Remember Me -->
                    <div class="mt-6 flex items-center">
                        <input id="remember_me" type="checkbox" class="w-4 h-4 rounded border-gray-300 text-blue-600 focus:ring-blue-500 dark:border-gray-700 dark:bg-gray-900" name="remember">
                        <label for="remember_me" class="ml-2 text-sm text-gray-700 dark:text-gray-300">{{ __('Ingat saya') }}</label>
                    </div>

                    <div class="mt-8">
                        <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 dark:bg-blue-700 dark:hover:bg-blue-600 text-white font-medium py-3 px-4 rounded-lg shadow-md hover:shadow-lg transition-all transform hover:-translate-y-0.5">
                            {{ __('Login') }}
                        </button>
                    </div>

                    <div class="mt-6 text-center">
                        <p class="text-sm text-gray-600 dark:text-gray-400">
                            {{ __('Belum punya akun?') }} 
                            <a href="{{ route('register') }}" class="text-blue-600 dark:text-blue-400 hover:underline font-medium">
                                {{ __('Daftar sekarang') }}
                            </a>
                        </p>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-guest-layout>
