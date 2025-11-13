<header class="py-3 px-5 grid grid-cols-3 gap-5 border-b">
    <div class="flex gap-2">
        <x-sidebar-link href="{{ route('authors.list') }}">Authors</x-sidebar-link>
    </div>
    <div></div>
    <div class="justify-self-end">
        <button class="cursor-pointer flex gap-2 items-center py-1 px-2 bg-transparent hover:bg-neutral-700" type="button">
            Add
            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="15px" height="15px" viewBox="0 0 15 15" version="1.1">
                <g id="surface1">
                    <path style=" stroke:none;fill-rule:evenodd;fill:#f5f5f5;fill-opacity:1;" d="M 7.5 14.0625 C 3.875 14.0625 0.9375 11.125 0.9375 7.5 C 0.9375 3.875 3.875 0.9375 7.5 0.9375 C 11.125 0.9375 14.0625 3.875 14.0625 7.5 C 14.0625 11.125 11.125 14.0625 7.5 14.0625 Z M 7.5 0 C 3.359375 0 0 3.355469 0 7.5 C 0 11.644531 3.359375 15 7.5 15 C 11.640625 15 15 11.644531 15 7.5 C 15 3.355469 11.640625 0 7.5 0 Z M 10.3125 7.03125 L 7.96875 7.03125 L 7.96875 4.6875 C 7.96875 4.429688 7.757812 4.21875 7.5 4.21875 C 7.242188 4.21875 7.03125 4.429688 7.03125 4.6875 L 7.03125 7.03125 L 4.6875 7.03125 C 4.429688 7.03125 4.21875 7.242188 4.21875 7.5 C 4.21875 7.757812 4.429688 7.96875 4.6875 7.96875 L 7.03125 7.96875 L 7.03125 10.3125 C 7.03125 10.570312 7.242188 10.78125 7.5 10.78125 C 7.757812 10.78125 7.96875 10.570312 7.96875 10.3125 L 7.96875 7.96875 L 10.3125 7.96875 C 10.570312 7.96875 10.78125 7.757812 10.78125 7.5 C 10.78125 7.242188 10.570312 7.03125 10.3125 7.03125 Z M 10.3125 7.03125 "/>
                </g>
            </svg>
        </button>
    </div>
</header>
