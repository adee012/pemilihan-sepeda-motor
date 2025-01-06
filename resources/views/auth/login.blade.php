<x-guest-layout>
    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100">
        <div class="flex gap-5">
            <span class="text-4xl font-bold mt-6">Login</span>
        </div>
        <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
            @if (session('success'))
                <div id="flash-message"
                    class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-3"
                    role="alert">
                    <strong class="font-bold">{{ session('success') }}</strong>
                    <span class="absolute top-0 bottom-0 right-0 px-4 py-3" onclick="closeFlashMessage()">
                        <svg class="fill-current h-6 w-6
                            text-green-500" role="button"
                            xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                            <title>Close</title>
                            <path
                                d="M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.819l-2.651 3.029a1.2 1.2 0 1 1-1.697-1.697l2.758-3.15-2.759-3.152a1.2 1.2 0 1 1 1.697-1.697L10 8.183l2.651-3.031a1.2 1.2 0 1 1 1.697 1.697l-2.758 3.152 2.758 3.15a1.2 1.2 0 0 1 0 1.698z" />
                        </svg>
                    </span>
                </div>
            @endif
            <!-- Session Status -->
            <x-auth-session-status class="mb-4" :status="session('status')" />
            <form method="POST" action="{{ route('login') }}">
                @csrf

                <!-- Email Address -->
                <div>
                    <x-input-label for="email" :value="__('Email')" />
                    <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')"
                        required autofocus autocomplete="username" />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <!-- Password -->
                <div class="mt-4">
                    <x-input-label for="password" :value="__('Password')" />

                    <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required
                        autocomplete="current-password" />

                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <!-- Register -->
                @if (Route::has('register'))
                    <div class="block mt-4">
                        <label for="register" class="inline-flex items-center">
                            <span class="ms-2 text-sm text-gray-600">{{ __('Belum punya akun?') }} <a
                                    href="{{ route('register') }}" class="text-blue-600 font-bold">Klik disini</a>
                            </span>
                        </label>
                    </div>
                @endif

                <div class="flex items-center justify-between mt-4">
                    <a class="ps-2 text-sm text-gray-600 hover:text-gray-900" href="{{ route('/') }}">
                        {{ __('Back to home') }}
                    </a>

                    <x-primary-button class="ms-3">
                        {{ __('Log in') }}
                    </x-primary-button>
                </div>
            </form>
        </div>
    </div>
</x-guest-layout>
