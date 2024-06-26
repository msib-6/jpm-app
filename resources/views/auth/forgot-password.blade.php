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
            <div class="wrapper mb-4">
            <div class='logo'></div>
    <div class="mb-4 text-sm text-gray-600 dark:text-gray-400">
        {{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}
    </div>
    <div style="margin-bottom: 20px;"></div>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('password.email') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" style="font-weight: bold;" />
            <x-text-input id="email" class="block mt-1 w-full input-box" type="email" name="email" :value="old('email')" required autofocus style="font-size: 17px;" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <x-primary-button class="button1">
                {{ __('Email Password Reset Link') }}
            </x-primary-button>
        </div>
    </form>
    </body>
</html>
