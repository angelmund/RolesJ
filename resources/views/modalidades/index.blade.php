<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white leading-tight"><i class="fas fa-list"></i>
            {{ __('Modalidades Disponibles') }}
        </h2>
    </x-slot>

    <div class="container mx-auto p-4">
        <!-- Contenedor del botón y el buscador -->
        <div class="mb-4 flex justify-between items-center">
            <div class="w-full flex justify-center">
                <x-button-create href="{{ route('MalidadesCrear') }}" class="ms-4">
                    <i class="fas fa-plus me-2"></i>
                    {{ __('Crear') }}
                </x-button-create>
            </div>
            <input type="text" id="searchInput" placeholder="Buscar..." class="p-2 border rounded w-1/3">
        </div>

        <!-- Contenedor de la tabla con scroll horizontal en móviles -->
        <div class="overflow-x-auto">
            <table class="min-w-full bg-white border border-gray-300 rounded-lg">
                <thead>
                    <tr class="bg-gray-200 text-gray-700">
                        <th class="py-2 px-4 border text-center">Num.</th>
                        <th class="py-2 px-4 border text-center">Nombre</th>
                        <th class="py-2 px-4 border text-center">Acciones</th>
                    </tr>
                </thead>
                <tbody id="tableBody">
                    @foreach ($modalidades as $propiedad)
                        <tr class="border hover:bg-gray-100">
                            <td class="py-2 px-4 border">{{ $loop->iteration }}</td>
                            <td class="py-2 px-4 border">{{ $propiedad->nombre }}</td>
                            <td class="py-2 px-4 border">
                                {{--  <x-button-edit class="ms-4" data-id="{{ $propiedad->id }}"
                                    onclick="openEditModalHandler(this, '/modalidades/edit/{{ $propiedad->id }}', '/modalidades/actualizar/{{ $propiedad->id }}', 'Editar Modalidad', 'text-blue-500', 'btn btn-primary')">
                                    <i class="fas fa-pencil m-2"></i> {{ __('Editar') }}
                                </x-button-edit>  --}}
                                <x-button-edit class="ms-4" href="{{ route('ModalidadesEditar', $propiedad->id) }}">
                                    <i class="fas fa-pencil m-2"></i> {{ __('Editar') }}
                                </x-button-edit>
                                <x-button-delete class="ms-4" data-id="{{ $propiedad->id }}"
                                    onclick="openConfirmDeleteModal({{ $propiedad->id }})">
                                    <i class="fas fa-trash m-2"></i> {{ __('Eliminar') }}
                                </x-button-delete>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Paginación -->
        <div class="mt-4 flex justify-center space-x-2">
            <button onclick="previousPage()"
                class="p-2 bg-white rounded hover:bg-orange-700 hover:text-white">Anterior</button>
            <span id="pageNumber" class="p-2 text-white hover:bg-orange-700">1</span>
            <button onclick="nextPage()"
                class="p-2 bg-white hover:bg-orange-700 hover:text-white rounded">Siguiente</button>
        </div>
    </div>


    @push('scripts')
        <script src="{{ asset('assets/admin/modalidades.js') }}"></script>
        <script src="{{ asset('assets/sistema/buscadorTabla.js') }}"></script>
        <script src="{{ asset('assets/sistema/paginadorTabla.js') }}"></script>
        <!-- Toastr JS -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
        <script>
            // Mostrar notificaciones Toastr si hay mensajes en la sesión
            @if (session('toastr'))
                toastr.options = {
                    closeButton: true,
                    progressBar: true,
                    positionClass: "toast-top-right",
                    preventDuplicates: true,
                    showDuration: "300",
                    hideDuration: "1000",
                    timeOut: "5000",
                    extendedTimeOut: "1000",
                };

                toastr.{{ session('toastr.type') }}("{{ session('toastr.message') }}");
            @endif

            // Mostrar errores de validación
            @if ($errors->any())
                toastr.options = {
                    closeButton: true,
                    progressBar: true,
                    positionClass: "toast-top-right",
                    preventDuplicates: true,
                    showDuration: "300",
                    hideDuration: "1000",
                    timeOut: "5000",
                    extendedTimeOut: "1000",
                };

                @foreach ($errors->all() as $error)
                    toastr.error("{{ $error }}");
                @endforeach
            @endif
        </script>
    @endpush

</x-app-layout>
