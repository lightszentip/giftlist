<x-app-layout>
    <div class="container">

        <x-slot name="header">
            <h1 class="mt-5">
                {{ __('Dashboard') }}
            </h1>
        </x-slot>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <x-jet-welcome/>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
