<x-app>
    <x-header>
        @isset($searchbar)
            {{ $searchbar }}
        @endisset
    </x-header>
    <x-author.create-modal />
    <div class="mt-10 px-5">{{ $slot }}</div>
</x-app>
