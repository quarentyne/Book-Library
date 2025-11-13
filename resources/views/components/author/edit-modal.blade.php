<x-modal name="edit-author">
    <div
        x-data="{ author: { id: '', firstname: '', lastname: '', middlename: '' } }"
        x-on:open-modal.window="
            if ($event.detail.name === 'edit-author') {
                author = $event.detail.author
            }
        "
        >
        <form id="edit-author-form" :action="`/authors/${author.id}`" method="POST" class="p-6 space-y-4">
            @method('PUT')

            <h2 class="text-lg font-semibold">Edit Author</h2>

            <div>
                <span class="form-error__js" class="text-red-500"></span>
            </div>

            <div>
                <x-input-label for="edit-lastname" value="Last Name" />
                <x-text-input id="edit-lastname" name="lastname" x-model="author.lastname" class="mt-1 w-full" required />
            </div>
            <div>
                <x-input-label for="edit-firstname" value="First Name" />
                <x-text-input id="edit-firstname" name="firstname" x-model="author.firstname" class="mt-1 w-full" required />
            </div>
            <div>
                <x-input-label for="edit-middlename" value="Middle Name" />
                <x-text-input id="edit-middlename" name="middlename" x-model="author.middlename" class="mt-1 w-full" />
            </div>

            <div class="flex justify-end mt-4">
                <x-action-button type="button" x-on:click="$dispatch('close')">Cancel</x-action-button>
                <x-action-button type="submit" class="ml-3">Update</x-action-button>
            </div>
        </form>
    </div>
</x-modal>
