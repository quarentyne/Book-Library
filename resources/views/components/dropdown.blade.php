<div
    x-cloak
    x-show="open"
    x-transition.origin.top
    @click.outside="open = false"
    {{ $attributes->merge(['class' => "p-2 absolute right-0 mt-2 w-44 rounded-lg border-1 bg-neutral-900 shadow-lg overflow-hidden z-50"]) }}
>
    {{ $slot }}
</div>
