<x-modal name="edit-book">
    <div
        x-data="{
            book: {},
            imagePreview: null,
            imageName: null,
         }"
        x-on:open-modal.window="
            if ($event.detail.name === 'edit-book') {
                book = $event.detail.book;
                imagePreview = book.image_url;
                imageName = book.title;
            }
        "
    >
        <form id="edit-book-form" :action="`/books/${book.id}`" method="POST" class="p-6 space-y-4">
            @method('PUT')

            <h2 class="text-lg font-semibold">Edit Book</h2>

            <div>
                <span class="form-error__js text-red-500"></span>
            </div>

            <div>
                <x-input-label for="create-title" value="Title" />
                <x-text-input id="create-title" name="title" x-model="book.title" class="mt-1 w-full" required />
            </div>
            <div>
                <x-input-label for="create-description" value="Description" />
                <x-textarea id="create-description" name="description" x-model="book.description" class="mt-1 w-full" rows="4" required>{{ old('description', '') }}</x-textarea>
            </div>
            <div>
                <x-input-label for="create-release-date" value="Released" />
                <x-text-input type="number" id="create-release-date" name="release_date" x-model="book.release_date" class="mt-1 w-full" min="1000" max="{{ now()->year }}" />
            </div>
            <div
                x-data="{
                    open: false,
                    search: '',
                    selected: [],
                    authors: @js($authors),

                    get selectedAuthors() {
                        return this.authors.filter(a => this.selected.includes(a.id));
                    },

                    toggle(id) {
                        this.selected.includes(id)
                            ? this.selected = this.selected.filter(i => i !== id)
                            : this.selected.push(id);
                    }
                }"
                x-init="
                    $watch('book', value => {
                        if (value && Array.isArray(value.authors)) {
                            selected = [...value.authors];
                        }
                    })
                "
                class="relative"
            >
                <x-input-label value="Authors" />

                <div
                    class="mt-1 w-full border rounded px-3 py-2 cursor-pointer flex flex-wrap gap-1"
                    @click="open = !open"
                >
                    <template x-if="selected.length === 0">
                        <span class="text-gray-400">Select authors</span>
                    </template>
                    <template x-if="selected.length > 0">
                        <span
                            class="text-sm"
                            x-text="selectedAuthors
                                .map(a => a.firstname + ' ' + a.lastname)
                                .join(', ')
                            "
                        ></span>
                    </template>
                </div>


                <div
                    x-show="open"
                    @click.outside="open = false"
                    class="absolute z-10 mt-1 w-full bg-gray-800 border rounded shadow-lg"
                >
                    <input
                        type="text"
                        x-model="search"
                        placeholder="Search..."
                        class="w-full px-2 py-1 border-b bg-gray-700"
                    >

                    <div class="max-h-48 overflow-y-auto">
                        <template
                            x-for="author in authors.filter(a =>
                                `${a.firstname} ${a.lastname}`.toLowerCase().includes(search.toLowerCase())
                            )"
                            :key="author.id"
                        >
                            <label class="flex items-center px-2 py-1 hover:bg-gray-700">
                                <input
                                    type="checkbox"
                                    :value="author.id"
                                    @change="toggle(author.id)"
                                    :checked="selected.includes(author.id)"
                                >
                                <span class="ml-2" x-text="author.firstname + ' ' + author.lastname"></span>
                            </label>
                        </template>
                    </div>
                </div>

                <template x-for="id in selected" :key="id">
                    <input type="hidden" name="authors[]" :value="id">
                </template>
            </div>
            <div>
                <label for="edit-image" class="block cursor-pointer py-4 text-center bg-gray-700 rounded-md">Upload Image</label>
                <input
                    type="file"
                    id="edit-image"
                    name="image"
                    accept="image/*"
                    class="hidden"
                    @change="
                        const file = $event.target.files[0];
                        if(file) {
                            imageName = file.name;
                            imagePreview = URL.createObjectURL(file);
                        }
                    "
                />
                <template x-if="imageName">
                    <p class="text-sm text-gray-400" x-text="imageName"></p>
                </template>
                <template x-if="imagePreview">
                    <img
                        :src="imagePreview"
                        alt="Preview"
                        class="mt-2 max-h-48 rounded-md border border-gray-600"
                    />
                </template>
            </div>
            <div class="flex justify-end mt-4">
                <x-action-button type="button" x-on:click="$dispatch('close')">Cancel</x-action-button>
                <x-action-button type="submit" class="ml-3">Edit</x-action-button>
            </div>
        </form>
    </div>
</x-modal>
