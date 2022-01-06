<button {{ $attributes->merge(['type' => 'submit', 'class' => 'w-100 btn btn-lg btn-primary']) }}>
    {{ $slot }}
</button>
