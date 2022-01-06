<x-guest-layout>
    <main class="form-signin">
        <x-jet-authentication-card>
            <x-slot name="logo">
                <x-jet-authentication-card-logo/>
            </x-slot>

            <x-jet-validation-errors class="mb-4"/>

            <form method="POST" action="{{ route('register') }}">
                @csrf

                <div class="form-floating">

                    <x-jet-input id="name" class="form-control" type="text" name="name" :value="old('name')" required
                                 autofocus autocomplete="name"/>
                    <x-jet-label for="name" value="{{ __('Name') }}"/>
                </div>

                <div class="form-floating">
                    <x-jet-input id="email" class="form-control" type="email" name="email" :value="old('email')"
                                 required/>
                    <x-jet-label for="email" value="{{ __('Email') }}"/>

                </div>

                <div class="form-floating">
                    <x-jet-input id="password" class="form-control" type="password" name="password" required
                                 autocomplete="new-password"/>
                    <x-jet-label for="password" value="{{ __('Password') }}"/>

                </div>

                <div class="form-floating">
                    <x-jet-input id="password_confirmation" class="form-control" type="password"
                                 name="password_confirmation" required autocomplete="new-password"/>
                    <x-jet-label for="password_confirmation" value="{{ __('Confirm Password') }}"/>

                </div>

                @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
                    <div class="mt-4">
                        <x-jet-label for="terms">
                            <div class="flex items-center">
                                <x-jet-checkbox name="terms" id="terms"/>

                                <div class="ml-2">
                                    {!! __('I agree to the :terms_of_service and :privacy_policy', [
                                            'terms_of_service' => '<a target="_blank" href="'.route('terms.show').'" class="underline text-sm text-gray-600 hover:text-gray-900">'.__('Terms of Service').'</a>',
                                            'privacy_policy' => '<a target="_blank" href="'.route('policy.show').'" class="underline text-sm text-gray-600 hover:text-gray-900">'.__('Privacy Policy').'</a>',
                                    ]) !!}
                                </div>
                            </div>
                        </x-jet-label>
                    </div>
                @endif

                <div class="flex items-center justify-end mt-4">
                    <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('login') }}">
                        {{ __('Already registered?') }}
                    </a>

                    <x-jet-button class="ml-4">
                        {{ __('Register') }}
                    </x-jet-button>
                </div>
            </form>
        </x-jet-authentication-card>
    </main>
</x-guest-layout>
