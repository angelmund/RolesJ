<x-app-layout>
    {{--  
    <form id="editForm" method="POST" action="{{ route('ModalidadesActualizar', $modalidad->id) }}">
        @csrf
        @method('PUT')
        <div class="mb-4">
            <label for="nombre" class="block text-gray-700 text-sm font-bold mb-2">Nombre de la Modalidad:</label>
            <input type="text" id="nombre" name="nombre" value="{{ $modalidad->nombre }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
        </div>
    
    </form>  --}}


    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white leading-tight">
            {{ __('Editar Torneo') }}
        </h2>
    </x-slot>


    <div class="max-w-2xl mx-auto bg-white p-6 rounded-lg shadow-md">
        {{--  <h2 class="text-2xl font-semibold text-gray-700 text-center mb-6">Registro</h2>  --}}

        <form id="form" action="{{ route('TorneosActualizar', $torneo->id) }}" method="POST" class="space-y-4"
            data-id="{{ $torneo->id }}">
            @csrf
            @method('PUT')
            <!-- Nombre -->
            <div>
                <label for="nombre" class="block text-sm font-medium text-gray-700">Nombre</label>
                <input type="text" id="nombre"id="nombre" name="nombre"
                    placeholder="Ingresa el nombre del Modalidad"
                    class="w-full p-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                    value="{{ $torneo->nombre }}">
                @if ($errors->has('nombre'))
                    <div class="bg-red-500 text-white font-bold mt-2 p-2 rounded w-auto inline-block" role="alert">
                        {{ $errors->first('nombre') }}
                    </div>
                @endif
            </div>
            <div>
                <label for="modalidad_id" class="block text-sm font-medium text-gray-700">Selecciona la modalidad del torneo</label>
                <select name="modalidad_id" id="modalidad_id" class="select2 w-full p-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    <option value="" disabled>Selecciona una modalidad</option>
                    @foreach ($modalidades as $modalidad)
                        <option value="{{ $modalidad->id }}" {{ $torneo->modalidad_id == $modalidad->id ? 'selected' : '' }}>{{ $modalidad->nombre }}</option>
                    @endforeach
                </select>
            </div>

            <div>
                <label for="fecha_inicio" class="block text-sm font-medium text-gray-700">Fecha de Inicio</label>
                <input type="date" id="fecha_inicio" name="fecha_inicio" placeholder="Ingresa la fecha de inicio del torneo"
                    class="w-full p-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                    value="{{ \Carbon\Carbon::parse($torneo->fecha_inicio)->format('Y-m-d') }}">
                @if ($errors->has('fecha_inicio'))
                    <div class="bg-red-500 text-white font-bold mt-2 p-2 rounded w-auto inline-block">
                        {{ $errors->first('fecha_inicio') }}
                    </div>
                @endif
            </div>

            @if ($torneo->fecha_fin)
                <div>
                    <label for="fecha_fin" class="block text-sm font-medium text-gray-700">Fecha prevista de Fin</label>
                    <input type="date" id="fecha_fin" name="fecha_fin" placeholder="Ingresa la fecha de fin del torneo"
                        class="w-full p-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                        value="{{ \Carbon\Carbon::parse($torneo->fecha_fin)->format('Y-m-d') }}">
                    @if ($errors->has('fecha_fin'))
                        <div class="bg-red-500 text-white font-bold mt-2 p-2 rounded w-auto inline-block">
                            {{ $errors->first('fecha_fin') }}
                        </div>
                    @endif
                </div>
                
            @else
                <div>
                    <label for="fecha_fin" class="block text-sm font-medium text-gray-700">Fecha prevista de Fin</label>
                    <input type="date" id="fecha_fin" name="fecha_fin" placeholder="Ingresa la fecha de fin del torneo"
                        class="w-full p-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    @if ($errors->has('fecha_fin'))
                        <div class="bg-red-500 text-white font-bold mt-2 p-2 rounded w-auto inline-block">
                            {{ $errors->first('fecha_fin') }}
                        </div>
                    @endif
                </div>
            @endif
            

            <!-- Botón de Enviar -->
            <div class="text-center">
                <x-button-save onclick="openConfirmUpdateModal()">
                    <i class="fas fa-save mr-1"></i>
                    Guardar
                </x-button-save>

                <x-button-link href="{{ route('TorneosIndex') }}">
                    <i class="fas fa-arrow-left mr-1"></i>
                    Volver
                </x-button-link>
            </div>
        </form>
    </div>

    @push('scripts')
        <script src="{{ asset('assets/admin/torneos.js') }}"></script>
        <script>
            @if (session('success'))
                toastr.success("{{ session('success') }}");
            @endif

            @if (session('error'))
                toastr.error("{{ session('error') }}");
            @endif
        </script>
    @endpush

</x-app-layout>
