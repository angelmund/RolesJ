// Modal Editar
function openEditModal(title, method, action, bodyContent, titleClass = '', buttonClass = '') {
    const modalTitle = document.getElementById('modal-edit-title');
    modalTitle.innerText = title;
    modalTitle.className = titleClass;
    // Agregar que se centre el título
    modalTitle.classList.add('text-center', 'text-2xl', 'font-bold', 'text-orange-800');

    document.getElementById('modal-edit-method').value = method;
    document.getElementById('modal-edit-form').action = action;
    document.getElementById('modal-edit-body').innerHTML = bodyContent;

    const submitButton = document.getElementById('modal-edit-submit-button');
    submitButton.className = buttonClass;

    document.getElementById('modal-edit').classList.remove('hidden');
}

function closeEditModal() {
    document.getElementById('modal-edit').classList.add('hidden');
}

function openEditModalHandler(button, fetchUrl, actionUrl, modalTitle, titleClass = '', buttonClass = '') {
    fetch(fetchUrl)
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.text();
        })
        .then(html => {
            openEditModal(modalTitle, 'PUT', actionUrl, html, titleClass, buttonClass);
        })
        .catch(error => {
            console.error('There was a problem with the fetch operation:', error);
        });
}
// Termina modal editar

// Modal Confirmar Guardado
function openConfirmSaveModal() {
    document.getElementById('modal-confirm-save').classList.remove('hidden');
}

function closeConfirmSaveModal() {
    document.getElementById('modal-confirm-save').classList.add('hidden');
}

// function submitEditForm() {
//     document.getElementById('modal-edit-form').submit();
// }
// Termina modal confirmar guardado


// Modal Confirmar Guardado
function openConfirmUpdateModal() {
    document.getElementById('modal-confirm-update').classList.remove('hidden');
}

function closeConfirmUpdateModal() {
    document.getElementById('modal-confirm-update').classList.add('hidden');
}

function submitEditForm() {
    document.getElementById('modal-update-form').submit();
}
// Termina modal confirmar guardado


// Modal Confirmar Eliminar
function openConfirmDeleteModal(id) {
    document.getElementById('modal-confirm-delete').classList.remove('hidden');
    document.getElementById('btn_confirm_delete').setAttribute('data-id', id);
}

function closeConfirmDeleteModal() {
    document.getElementById('modal-confirm-delete').classList.add('hidden');
}

// Modal Eliminar
function openDeleteModal(title, method, action, bodyContent, titleClass = '', buttonClass = '') {
    const modalTitle = document.getElementById('modal-delete-title');
    modalTitle.innerText = title;
    modalTitle.className = titleClass;
    modalTitle.classList.add('text-center', 'text-2xl', 'font-bold', 'text-red-800');

    document.getElementById('modal-delete-method').value = method;
    document.getElementById('modal-delete-form').action = action;
    document.getElementById('modal-delete-body').innerHTML = bodyContent;

    const submitButton = document.getElementById('modal-delete-submit-button');
    submitButton.className = buttonClass;

    document.getElementById('modal-delete').classList.remove('hidden');
}

function closeDeleteModal() {
    document.getElementById('modal-delete').classList.add('hidden');
}

function openDeleteModalHandler(button, baseUrl, titleClass = '', buttonClass = '') {
    var id = button.getAttribute('data-id');
    var action = baseUrl + '/' + id;
    var bodyContent = `
        <p class="text-blue-500 text-center">¿Estás seguro de que deseas eliminar?</p>
        <p><span class="text-gray-500 text-center">*Si elimina no se podrá recuperar*</span></p>
    `;
    openDeleteModal('Confirmar Eliminación', 'DELETE', action, bodyContent, titleClass, buttonClass);
}
// Termina modal eliminar