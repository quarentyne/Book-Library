@props(['disabled' => false, 'type' => 'text', 'value' => ''])

<input
    type="{{ $type }}"
    value="{{ old($attributes->get('name'), $value) }}"
    {{ $disabled ? 'disabled' : '' }}
    {{ $attributes->merge([
        'class' => 'border border-neutral-700 focus-visible:outline-none rounded-md shadow-sm w-full px-3 py-2 text-sm text-neutral-100'
    ]) }}
/>
