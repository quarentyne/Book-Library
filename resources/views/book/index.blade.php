@php
    $direction = request('direction') === 'ASC' ? 'DESC' : 'ASC';
    $endpoint = request()->fullUrlWithQuery([
        'sort' => 'title',
        'direction' => $direction,
        ]);
    $authorsInFilter = request()->get('author') ?: [];
    $filters = request()->all();
@endphp
<x-layout>
    <x-slot:searchbar>
        <x-searchbar
            action="{{ route('books.list') }}"
            sort="{{ request()->get('sort') }}"
            direction="{{ request()->get('direction') }}"
            search="{{ request()->get('search') }}"
            :author="$authorsInFilter"
        />
    </x-slot:searchbar>
    <div
        x-data="{ positionLeft: '-350px' }"
    >
        <form action="{{ route('books.list') }}"
            class="fixed top-0 w-[300px] h-[100vh] bg-neutral-900 border-r z-50 transition-[left] px-4 py-15"
            :style="{ left: positionLeft }"
            x-cloak
        >
            @if(request()->get('sort'))
                <input type="hidden" name="sort" value="{{ request()->get('sort') }}" />
            @endif
            @if(request()->get('direction'))
                <input type="hidden" name="direction" value="{{ request()->get('direction') }}" />
            @endif
            @if(request()->get('search'))
                <input type="hidden" name="search" value="{{ request()->get('search') }}" />
            @endif

            <button
                type="button"
                @click="positionLeft = '-350px';"
                class="px-3 py-2 border-1 hover:bg-neutral-700 rounded cursor-pointer absolute top-5 right-5"
            >Hide Filters</button>

            <h6 class="text-medium text-lg mb-2">Authors</h6>
            <ul>
                @foreach($authors as $author)
                    <li class="mb-1">
                        <label>
                            <input
                                type="checkbox"
                                name="author[]"
                                id="author[{{ $author->id }}]"
                                value="{{ $author->id }}"
                                @if(in_array($author->id, $authorsInFilter)) checked @endif
                            >
                            {{ $author->lastname }}
                            {{ substr($author->firstname, 0, 1) . '.' }}
                            @if($author->middlename){{ substr($author->middlename, 0, 1) . '.' }}@endif
                        </label>
                    </li>
                @endforeach
            </ul>
            <button
                type="submit"
                class="px-3 py-2 border-1 hover:bg-neutral-700 rounded cursor-pointer absolute bottom-2"
            >
                Filter
            </button>
        </form>

        <div class="flex justify-self-end gap-5 mb-5">
            <button
                @click="positionLeft = positionLeft === '0px' ? '-350px' : '0px';"
                class="px-3 py-2 border-1 hover:bg-neutral-700 rounded cursor-pointer"
            >Show Filters</button>
            <a
                href="{{ $endpoint }}"
                class="px-3 py-2 border-1 hover:bg-neutral-700 rounded"
            >
                Sort by Title @if($direction === 'DESC')↓@else↑@endif
            </a>
        </div>


        <div class="grid grid-cols-[repeat(auto-fit,minmax(300px,1fr))] gap-5">
            @foreach($books as $book)
                <x-book.card :book="$book" />
            @endforeach
        </div>
        <div class="mt-5">
            {{ $books->appends(request()->query())->links() }}
        </div>
        <x-book.edit-modal />
    </div>
</x-layout>
