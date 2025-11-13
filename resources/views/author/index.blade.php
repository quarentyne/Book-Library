@php
    $direction = request('direction') === 'ASC' ? 'DESC' : 'ASC';
    $endpoint = request()->fullUrlWithQuery([
        'sort' => 'lastname',
        'direction' => $direction,
        ]);
@endphp

<x-layout>
    <x-slot:searchbar>
        <form class="flex" method="GET" action="{{ route('authors.list') }}">
            @if(request()->get('sort'))
                <input type="hidden" name="sort" value="{{ request()->get('sort') }}" />
            @endif
            @if(request()->get('direction'))
                <input type="hidden" name="direction" value="{{ request()->get('direction') }}" />
            @endif
            <input type="text"
                   name="search"
                   value="{{ request()->get('search') }}"
                   class="border border-neutral-700 focus-visible:outline-none rounded-l-md shadow-sm w-full px-2 py-1 text-sm text-neutral-100"
            />
            <button type="submit"
                    class="border border-l-0 rounded-r-md border-neutral-700 w-[30px] h-[30px] cursor-pointer"
            >
                <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                    <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                    <g id="SVGRepo_iconCarrier">
                        <path d="M14.9536 14.9458L21 21M17 10C17 13.866 13.866 17 10 17C6.13401 17 3 13.866 3 10C3 6.13401 6.13401 3 10 3C13.866 3 17 6.13401 17 10Z" stroke="#FFF" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                    </g>
                </svg>
            </button>
        </form>
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
