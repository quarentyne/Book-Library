<textarea
    {{ $attributes->merge([
        'class' => 'border border-neutral-700 focus-visible:outline-none rounded-md shadow-sm w-full px-3 py-2 text-sm text-neutral-100'
    ]) }}
>{{ $slot }}</textarea>
