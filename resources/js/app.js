import './bootstrap';
import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

document.addEventListener('DOMContentLoaded', () => {
    const baseURL = document.querySelector('base').getAttribute('href');
    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

    const editAuthorForm = document.querySelector('#edit-author-form');
    const editAuthorFormSubmitter = editAuthorForm?.querySelector('button[type="submit"]');
    const createAuthorForm = document.querySelector('#create-author-form');
    const createAuthorFormSubmitter = createAuthorForm?.querySelector('button[type="submit"]');

    const showError = (errors, formSelector) => {
        document.querySelector(`${formSelector} .form-error__js`).innerHTML = Object.values(data.errors).flat().join('<br />');
    };

    editAuthorForm?.addEventListener('submit', e => {
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
                   showError(data.errors, '#edit-author-form');
               }

                editAuthorFormSubmitter.disabled = false;
            });
    });

    createAuthorForm?.addEventListener('submit', e => {
        e.preventDefault();
        createAuthorFormSubmitter.disabled = true;

        const formData = new FormData(createAuthorForm);
        const endpoint = createAuthorForm.getAttribute('action');

        fetch(endpoint, {
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
                    showError(data.errors, '#create-author-form');
                }

                editAuthorFormSubmitter.disabled = false;
            });
    });
});
