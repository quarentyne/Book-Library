@props(['for', 'value'])

<label for="{{ $for }}" {{ $attributes->merge(['class' => 'block text-sm font-medium text-neutral-100']) }}>
    {{ $value ?? $slot }}
</label>
