@props(['name'])

<div
    x-data="{show: false}"
    x-on:open-modal.window="
        if ($event.detail.name === '{{ $name }}') show = true
    "
    x-on:close.window="show = false"
    x-show="show"
    x-cloak
    class="fixed inset-0 z-50 flex items-center justify-center bg-black/50 backdrop-blur-sm"
    x-transition.opacity
>
    <div
        x-on:click.away="show = false"
        x-transition
        class="bg-white dark:bg-neutral-800 rounded-2xl shadow-xl w-full max-w-lg mx-4"
    >
        {{ $slot }}
    </div>
</div>
