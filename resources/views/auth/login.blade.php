<x-guest-layout>
    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100">
        <div class="flex gap-5">
            <span class="text-4xl font-bold mt-6">Login</span>
        </div>
        <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
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
