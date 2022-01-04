<x-app-layout>
    <x-slot name="header">
        <h1 class="mt-5">

        </h1>
    </x-slot>
    <div class="py-5 text-center">
        <h2>{{ __('Profile') }}</h2>
    </div>
    <div class="row">
        <div class="col-md-8 order-md-1">
            @if (Laravel\Fortify\Features::canUpdateProfileInformation())
                @livewire('profile.update-profile-information-form')

                <x-jet-section-border/>
            @endif

            @if (Laravel\Fortify\Features::enabled(Laravel\Fortify\Features::updatePasswords()))
                <div class="mb-3">
                    @livewire('profile.update-password-form')
                </div>

                <x-jet-section-border/>
            @endif

            @if (Laravel\Fortify\Features::canManageTwoFactorAuthentication())
                <div class="mb-3">
                    @livewire('profile.two-factor-authentication-form')
                </div>

                <x-jet-section-border/>
            @endif

            <div class="mb-3">
                @livewire('profile.logout-other-browser-sessions-form')
            </div>

            @if (Laravel\Jetstream\Jetstream::hasAccountDeletionFeatures())
                <x-jet-section-border/>

                <div class="mb-3">
                    @livewire('profile.delete-user-form')
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
