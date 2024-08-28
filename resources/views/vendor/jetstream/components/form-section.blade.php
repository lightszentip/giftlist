@props(['submit'])

<div {{ $attributes->merge(['class' => 'mb-3']) }}>
    <x-section-title>
        <x-slot name="title">
            {{ $title }}</x-slot>
        <x-slot name="description">{{ $description }}</x-slot>
    </x-section-title>

    <div class="mb-3">
        <form wire:submit="{{ $submit }}">
            <div
                class=" {{ isset($actions) ? 'sm:rounded-tl-md sm:rounded-tr-md' : 'sm:rounded-md' }}">

                {{ $form }}

            </div>

            @if (isset($actions))
                <div
                    class="">
                    {{ $actions }}
                </div>
            @endif
        </form>
    </div>
</div>
