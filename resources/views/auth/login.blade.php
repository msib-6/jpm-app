<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="{{ asset('css/dashboard.css') }}" rel="stylesheet">
</head>
<body>
    <div class="background-login">
        <div class="wrp">
            <div class="wrapper">
                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class='logo'></div>
                    <span class='welcome'>Selamat Datang</span>

                    <!-- Email Address -->
                    <div>
                        <x-input-label for="email" :value="__('Email')" />
                        <x-text-input id="email" class="block mt-1 w-full input-box" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" style="font-size: 17px;" />
                    </div>

                    <!-- Password -->
                    <div class="mt-4">
                        <x-input-label for="password" :value="__('Password')" />
                        <x-text-input id="password" class="block mt-1 w-full input-box" type="password" name="password" required autocomplete="current-password" style="font-size: 17px;" />
                    </div>

                    <!-- Remember Me -->
                    <div class="block mt-4">
                        <label for="remember_me" class="inline-flex items-center">
                            <input id="remember_me" type="checkbox" class="rounded dark:bg-gray-900 border-gray-300 dark:border-gray-700 text-indigo-600 shadow-sm focus:ring-indigo-500 dark:focus:ring-indigo-600 dark:focus:ring-offset-gray-800" name="remember">
                            <span class="ms-2 text-sm text-gray-600 dark:text-gray-400">{{ __('Remember me') }}</span>
                        </label>
                    </div>

                    <!-- Error Message -->
                    @if ($errors->any())
                        <div class=" eror mt-2 mb-4 font-medium text-sm">
                            {{ __('These credentials do not match our records.') }}
                        </div>
                    @endif

                    <div class="flex items-center justify-end mt-4">
                        @if (Route::has('password.email'))
                            <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800" href="{{ route('password.email', ['token' => 'your_token_here']) }}">
                                {{ __('Forgot your password?') }}
                            </a>
                        @endif
                        <x-primary-button class="button1">
                            {{ __('Log in') }}
                        </x-primary-button>
                        <button type="button" onclick="window.location.href='{{ route('guest.dashboard') }}'" class="button2" id="mode-guest-link">
                        {{ __('Mode Guest') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>