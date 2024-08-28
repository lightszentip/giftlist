<x-guest-layout>
    <main class="form-signin">
        <x-authentication-card>
            <x-slot name="logo">
                <x-authentication-card-logo/>
            </x-slot>

            <x-validation-errors class="mb-4"/>

            <form method="POST" action="{{ route('register') }}">
                @csrf

                <div class="form-floating">

                    <x-input id="name" class="form-control" type="text" name="name" :value="old('name')" required
                                 autofocus autocomplete="name"/>
                    <x-label for="name" value="{{ __('Name') }}"/>
                </div>

                <div class="form-floating">
                    <x-input id="email" class="form-control" type="email" name="email" :value="old('email')"
                                 required/>
                    <x-label for="email" value="{{ __('Email') }}"/>

                </div>

                <div class="form-floating">
                    <x-input id="password" class="form-control" type="password" name="password" required
                                 autocomplete="new-password"/>
                    <x-label for="password" value="{{ __('Password') }}"/>

                </div>

                <div class="form-floating">
                    <x-input id="password_confirmation" class="form-control" type="password"
                                 name="password_confirmation" required autocomplete="new-password"/>
                    <x-label for="password_confirmation" value="{{ __('Confirm Password') }}"/>

                </div>

                @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
                    <div class="mt-4">
                        <x-label for="terms">
                            <div class="flex items-center">
                                <x-checkbox name="terms" id="terms"/>

                                <div class="ml-2">
                                    {!! __('I agree to the :terms_of_service and :privacy_policy', [
                                            'terms_of_service' => '<a target="_blank" href="'.route('terms.show').'" class="underline text-sm text-gray-600 hover:text-gray-900">'.__('Terms of Service').'</a>',
                                            'privacy_policy' => '<a target="_blank" href="'.route('policy.show').'" class="underline text-sm text-gray-600 hover:text-gray-900">'.__('Privacy Policy').'</a>',
                                    ]) !!}
                                </div>
                            </div>
                        </x-label>
                    </div>
                @endif

                <div class="flex items-center justify-end mt-4">
                    <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('login') }}">
                        {{ __('Already registered?') }}
                    </a>

                    <x-button class="ml-4">
                        {{ __('Register') }}
                    </x-button>
                </div>
            </form>
        </x-authentication-card>
    </main>
</x-guest-layout>
