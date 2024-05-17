<!DOCTYPE html>
<html lang="en">
<x-auth-session-status class="mb-4" :status="session('status')" />
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
            <form method="POST" action="{{ route('password.store') }}">
                @csrf

                <!-- Password Reset Token -->
                <input type="hidden" name="token" value="{{ $request->route('token') }}">
                <div class='logo'></div>
                <span class='welcome'>Selamat Datang</span>
                <!-- Email Address -->
                <div>
                    <x-input-label for="email" :value="__('Email')" />
                    <x-text-input id="email" class="block mt-1 w-full input-box" type="email" name="email" :value="old('email', $request->email)" required autofocus autocomplete="username" />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <!-- Password -->
                <div class="mt-4">
                    <x-input-label for="password" :value="__('Password')" />
                    <x-text-input id="password" class="block mt-1 w-full input-box" type="password" name="password" required autocomplete="new-password" />
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>
                <div class="mt-4">
                    <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

                    <x-text-input id="password_confirmation" class="block mt-1 w-full input-box"
                                  type="password"
                                  name="password_confirmation" required autocomplete="new-password" />
                </div>

                <div class="flex items-center justify-end mt-4">
                    <x-primary-button class="button1">
                        {{ __('Reset Password') }}
                    </x-primary-button>
                    <x-primary-button class="button2">
                        <a href="{{ route('login') }}" style="color: inherit; text-decoration: none;">{{ __('Sign In') }}</a>
                    </x-primary-button>
                </div>
            </form>
        </div>
    </div>
</div>
</body>
</html>
