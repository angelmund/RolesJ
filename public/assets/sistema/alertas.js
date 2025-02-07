function openDeleteModal(button, baseUrl) {
    var id = button.getAttribute('data-id');
    var action = baseUrl + '/' + id;
    var bodyContent = `
        <p class=" text-red-500 text-center">¿Estás seguro de que deseas eliminar?</p>
    <span class="text-purple-500">Esta acción no se puede deshacer.</span>
    `;
    openModal('Confirmar Eliminación', 'DELETE', action, bodyContent);
}