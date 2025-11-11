<div class="p-4 rounded border border-neutral-700">
    <p>{{ $author->lastname }} {{ $author->firstname }} {{ $author->middlename }}</p>
    <div class="mt-4 flex justify-between">
        <x-action-button
            x-data
            @click="
                document.querySelector('#edit-author-form__error').innerHTML = '';
                $dispatch('open-modal', {
                name: 'edit-author',
                author: {
                    id: {{ $author->id }},
                    firstname: '{{ $author->firstname }}',
                    lastname: '{{ $author->lastname }}',
                    middlename: '{{ $author->middlename }}'
                }
            })"
        >
            Edit
        </x-action-button>
        <form action="{{ route('authors.delete', $author) }}" method="POST">
            @csrf
            @method('DELETE')
            <x-action-button type="submit" class="hover:bg-red-500">Delete</x-action-button>
        </form>
    </div>
</div>
