<x-guest-layout>
    <main class="form-signin">
        <x-authentication-card>
            <x-slot name="logo">
                <x-authentication-card-logo/>
            </x-slot>

            <x-validation-errors class="mb-4"/>

            @if (session('status'))
                <div class="mb-4 font-medium text-sm text-green-600">
                    {{ session('status') }}
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}">
                @csrf
                <h1 class="h3 mb-3 fw-normal">Please sign in</h1>
                <div class="form-floating">

                    <x-input id="email" class="form-control" type="email" name="email" :value="old('email')"
                                 required autofocus placeholder="name@example.com"/>
                    <x-label for="email" value="{{ __('Email') }}"/>
                </div>

                <div class="form-floating">

                    <x-input id="password" class="form-control" type="password" name="password" required
                                 autocomplete="current-password" placeholder="Password"/>
                    <x-label for="password" value="{{ __('Password') }}"/>
                </div>

                <div class="block mt-4">
                    <label for="remember_me" class="flex items-center">
                        <x-checkbox id="remember_me" name="remember"/>
                        <span class="ml-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                    </label>
                </div>

                <div class="flex items-center justify-end mt-4">
                    @if (Route::has('password.request'))
                        <a class=""
                           href="{{ route('password.request') }}">
                            {{ __('Forgot your password?') }}
                        </a>
                    @endif

                    <x-button class="ml-4">
                        {{ __('Log in') }}
                    </x-button>
                </div>
            </form>
        </x-authentication-card>
    </main>
</x-guest-layout>
