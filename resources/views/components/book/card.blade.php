@php
    $authors = [];
    foreach ($book->authors as $author) {
        $authors[] = $author->lastname . ' ' . $author->firstname;
    }
@endphp

<div class="p-4 rounded border border-neutral-700">
    <img
        class="my-0 mx-auto object-cover w-full max-h-[400px]"
        src="{{ $book->image }}"
        alt="{{ $book->title }}"
    />
    <p class="font-bold mt-4">{{ $book->title }}</p>
    <p class="mt-4">{{ implode(', ', $authors) }}</p>
    <div class="mt-4 flex justify-between">
        <x-action-button
            @click="$dispatch('open-modal', {
                name: 'edit-book',
                book: {
                    id: {{ $book->id }},
                    title: '{{ $book->title }}',
                    description: '{{ $book->description }}',
                    image_url: '{{ $book->image }}',
                    release_date: {{ $book->release_date }},
                    authors: {{ $book->authors->pluck('id') }}
                }
            })"
        >
            Edit
        </x-action-button>
        <form action="{{ route('books.delete', $book) }}" method="POST">
            @csrf
            @method('DELETE')
            <x-action-button type="submit" class="hover:bg-red-500">Delete</x-action-button>
        </form>
    </div>
</div>
