<x-guest-layout>
    <h1 class="text-2xl font-bold mb-6">{{ __('Forgot Password') }}</h1>
    <p class="mb-4 text-sm text-gray-600 dark:text-gray-400">{{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link.') }}</p>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('password.email') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <label for="email" class="block font-semibold mb-1">{{ __('Email') }}</label>
            <input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus placeholder="{{ __('Enter your email') }}" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <button type="submit" class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-semibold py-2 px-4 rounded-lg shadow transition">
                {{ __('Email Password Reset Link') }}
            </button>
        </div>
    </form>

    <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('login') }}">{{ __('Back to login') }}</a>
</x-guest-layout>
