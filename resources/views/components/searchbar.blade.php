@props([
    'action'    => '',
    'sort'      => '',
    'direction' => '',
    'search'    => '',
    'author'    => [],
])

<form class="flex" method="GET" action="{{ $action }}">
    @if($sort)
        <input type="hidden" name="sort" value="{{ $sort }}" />
    @endif
    @if($direction)
        <input type="hidden" name="direction" value="{{ $direction }}" />
    @endif
    @foreach($author as $authorId)
            <input type="hidden" name="author[]" value="{{ $authorId }}" />
    @endforeach
    <input type="text"
           name="search"
           value="{{ $search }}"
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
