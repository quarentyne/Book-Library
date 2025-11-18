@php
    $direction = request('direction') === 'ASC' ? 'DESC' : 'ASC';
    $endpoint = request()->fullUrlWithQuery([
        'sort' => 'lastname',
        'direction' => $direction,
        ]);
@endphp

<x-layout>
    <x-slot:searchbar>
        <x-searchbar
            action="{{ route('authors.list') }}"
            sort="{{ request()->get('sort') }}"
            sort="{{ request()->get('direction') }}"
            sort="{{ request()->get('search') }}"
        />
    </x-slot:searchbar>
    <a
        href="{{ $endpoint }}"
        class="flex justify-self-end px-3 py-2 border-1 mb-5 hover:bg-neutral-700 rounded"
    >
        Sort by Last Name @if($direction === 'DESC')↓@else↑@endif
    </a>

    <div class="grid grid-cols-3 gap-5">
        @foreach($authors as $author)
            <x-author.card :author="$author" />
        @endforeach
    </div>
    <div class="mt-5">
        {{ $authors->appends(request()->query())->links() }}
    </div>
    <x-author.edit-modal />
</x-layout>
