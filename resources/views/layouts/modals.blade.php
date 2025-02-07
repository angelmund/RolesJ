<div id="modal-edit" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 hidden">
    <div class="bg-white p-6 rounded-lg shadow-lg">
        <h2 id="modal-edit-title" class="text-xl font-bold mb-4"></h2>
        <form id="modal-edit-form" method="POST" action="">
            @csrf
            <input type="hidden" name="_method" id="modal-edit-method">
            <div id="modal-edit-body" class="mb-4">
                <!-- Contenido del modal -->
            </div>
            <div class="mt-4">
                <button type="button" id="modal-edit-submit-button" class="inline-flex items-center px-3 py-2 bg-gray-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-400 focus:bg-gray-500 active:bg-gray-500 focus:outline-none focus:ring-2 focus:ring-indigo-700 focus:ring-offset-2 disabled:opacity-50 transition ease-in-out duration-150"></button>
                <button type="submit" class="inline-flex items-center px-3 py-2 bg-green-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-400 focus:bg-green-500 active:bg-green-500 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 disabled:opacity-50 transition ease-in-out duration-150" id="modal-edit-submit-button">Guardar</button>
                <button type="button" class="inline-flex items-center px-3 py-2 bg-gray-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-400 focus:bg-gray-500 active:bg-gray-500 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 disabled:opacity-50 transition ease-in-out duration-150" onclick="closeEditModal()">Cancelar</button>
            </div>
        </form>
    </div>
</div>

{{--  <div id="modal-delete" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 hidden">
    <div class="bg-white p-6 rounded-lg shadow-lg">
        <h2 id="modal-delete-title" class="text-xl font-bold mb-4"></h2>
        <form id="modal-delete-form" method="POST" action="">
            @csrf
            <input type="hidden" name="_method" id="modal-delete-method">
            <div id="modal-delete-body" class="mb-4">
                <!-- Contenido del modal -->
            </div>
            <div class="mt-4">
                <button type="submit" id="modal-delete-submit-button" class="inline-flex items-center px-3 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-800 focus:bg-gray-700 active:bg-orange-700 focus:outline-none focus:ring-2 focus:ring-indigo-700 focus:ring-offset-2 disabled:opacity-50 transition ease-in-out duration-150">Eliminar</button>
                <button type="button" class="inline-flex items-center px-3 py-2 bg-gray-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-400 focus:bg-gray-500 active:bg-gray-500 focus:outline-none focus:ring-2 focus:ring-indigo-700 focus:ring-offset-2 disabled:opacity-50 transition ease-in-out duration-150" onclick="closeDeleteModal()">Cancelar</button>
            </div>
        </form>
    </div>
</div>  --}}

<div id="modal-confirm-save" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 hidden">
    <div class="bg-white p-6 rounded-lg shadow-lg">
        <div class="text-center mb-4">
            <i class="fas fa-exclamation-circle text-4xl text-green-500"></i>
        </div>
        <h2 id="modal-confirm-save-title" class="text-xl font-bold text-center text-green-500 mb-4">Confirmar Guardado</h2>
        <p class="text-blue-500 text-center">¿Estás seguro de que deseas guardar los cambios?</p>
        <div class="mt-4 flex justify-center space-x-4">
            <button type="button" class="inline-flex items-center px-3 py-2 bg-green-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-400 focus:bg-green-500 active:bg-green-500 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 disabled:opacity-50 transition ease-in-out duration-150" id="btn_save">
                <i class="fas fa-save mr-1"></i> Si, guardar
            </button>
            <button type="button" class="inline-flex items-center px-3 py-2 bg-red-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-400 focus:bg-red-500 active:bg-red-500 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 disabled:opacity-50 transition ease-in-out duration-150" onclick="closeConfirmSaveModal()">
                <i class="fas fa-times mr-1"></i> Cancelar
            </button>
        </div>
    </div>
</div>

<div id="modal-confirm-update" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 hidden">
    <div class="bg-white p-6 rounded-lg shadow-lg">
        <div class="text-center mb-4">
            <i class="fas fa-exclamation-circle text-1xl text-orange-500"></i>
        </div>
        <h2 id="modal-confirm-update-title" class="text-xl font-bold text-center text-green-500 mb-4">Confirmar Actualizar</h2>
        <p class="text-blue-500 text-center">¿Estás seguro de que deseas guardar los cambios?</p>
        <div class="mt-4 flex justify-center space-x-4">
            <button type="button" class="inline-flex items-center px-3 py-2 bg-green-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-400 focus:bg-green-500 active:bg-green-500 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 disabled:opacity-50 transition ease-in-out duration-150" id="btn_update">
                <i class="fas fa-save mr-1"></i> Si, guardar
            </button>
            <button type="button" class="inline-flex items-center px-3 py-2 bg-red-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-400 focus:bg-red-500 active:bg-red-500 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 disabled:opacity-50 transition ease-in-out duration-150" onclick="closeConfirmUpdateModal()">
                <i class="fas fa-times mr-1"></i> Cancelar
            </button>
        </div>
    </div>
</div>


<div id="modal-confirm-delete" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 hidden">
    <div class="bg-white p-6 rounded-lg shadow-lg">
        <div class="text-center mb-4">
            <i class="fas fa-exclamation-circle text-1xl text-red-500"></i>
        </div>
        <h2 id="modal-confirm-delete-title" class="text-xl font-bold text-center text-red-500 mb-4">Confirmar Eliminaci&oacute;n</h2>
        <p class="text-blue-500 text-center">¿Estás seguro de que deseas guardar los cambios?</p>
        <div class="mt-4 flex justify-center space-x-4">
            <button type="button" class="inline-flex items-center px-3 py-2 bg-red-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-400 focus:bg-red-500 active:bg-red-500 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 disabled:opacity-50 transition ease-in-out duration-150" id="btn_confirm_delete" onclick="eliminarDatos()">Eliminar</button>
            <button type="button" class="inline-flex items-center px-3 py-2 bg-gray-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-400 focus:bg-gray-500 active:bg-gray-500 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 disabled:opacity-50 transition ease-in-out duration-150" onclick="closeConfirmDeleteModal()">
                <i class="fas fa-times mr-1"></i> Cancelar
            </button>
        </div>
    </div>
</div>