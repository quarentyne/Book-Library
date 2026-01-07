@php
    $authors = [];
    foreach ($book->authors as $author) {
        $authors[] = $author->lastname . ' ' . $author->firstname;
    }
@endphp

<div class="p-4 rounded border border-neutral-700">
    <img
        class="my-0 mx-auto object-cover w-full max-h-[400px]"
        src="{{ asset('storage/' . $book->image) }}"
        alt="{{ $book->title }}"
    />
    <p class="font-bold mt-4">{{ ucfirst($book->title) }}</p>
    <p class="mt-4">{{ implode(', ', $authors) }}</p>
    <div class="mt-4 flex justify-between">
        <x-action-button
            x-data
            @click="
                document.querySelector('#edit-book-form .form-error__js').innerHTML = '';
                $dispatch('open-modal', {
                name: 'edit-book',
                author: {
                    id: {{ $book->id }},
                    title: '{{ $book->title }}',
                    description: '{{ $book->description }}',
                    image: '{{ $book->image }}',
                    release_date: '{{ $book->release_date }}',
                    authors: '{{ $book->authors }}'
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
