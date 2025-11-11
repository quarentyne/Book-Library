<x-layout>
    <div class="grid grid-cols-3 gap-5">
        @foreach($authors as $author)
            <x-author.card :author="$author" />
        @endforeach
    </div>
    <x-author.edit-modal />
</x-layout>
