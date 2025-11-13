<x-modal name="create-author">
    <div
        x-on:open-modal.window="
            const inputs = document.querySelectorAll('#edit-author-form input');
            inputs.forEach(input => input.value = '');
        "
    >
        <form id="create-author-form" action="{{ route('authors.store') }}" method="POST" class="p-6 space-y-4">
            <h2 class="text-lg font-semibold">Create Author</h2>

            <div>
                <span class="form-error__js" class="text-red-500"></span>
            </div>

            <div>
                <x-input-label for="create-lastname" value="Last Name" />
                <x-text-input id="create-lastname" name="lastname" class="mt-1 w-full" required />
            </div>
            <div>
                <x-input-label for="create-firstname" value="First Name" />
                <x-text-input id="create-firstname" name="firstname" class="mt-1 w-full" required />
            </div>
            <div>
                <x-input-label for="create-middlename" value="Middle Name" />
                <x-text-input id="create-middlename" name="middlename" class="mt-1 w-full" />
            </div>

            <div class="flex justify-end mt-4">
                <x-action-button type="button" x-on:click="$dispatch('close')">Cancel</x-action-button>
                <x-action-button type="submit" class="ml-3">Create</x-action-button>
            </div>
        </form>
    </div>
</x-modal>
