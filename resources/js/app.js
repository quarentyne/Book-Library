import './bootstrap';
import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

document.addEventListener('DOMContentLoaded', () => {
    const baseURL = document.querySelector('base').getAttribute('href');
    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

    const editAuthorForm = document.querySelector('#edit-author-form');
    const editAuthorFormSubmitter = editAuthorForm.querySelector('button[type="submit"]');
    const editAuthorFormError = document.querySelector('#edit-author-form__error');

    editAuthorForm.addEventListener('submit', e => {
        e.preventDefault();
        editAuthorFormSubmitter.disabled = true;

        const formData = new FormData(editAuthorForm);
        const endpoint = editAuthorForm.getAttribute('action');

        fetch(baseURL + endpoint, {
            method: 'POST',
            headers: {
                'Content-Disposition': 'form-data',
                'X-CSRF-TOKEN': csrfToken,
                'Accept': 'application/json'
            },
            body: formData,
        })
            .then(response => response.json())
            .then(data => {
               if(data.success) {
                   location.reload();
               }

               if(data.errors) {
                   editAuthorFormError.innerHTML = Object.values(data.errors).flat().join('<br />');
               }

                editAuthorFormSubmitter.disabled = false;
            });
    });
});
