<x-app-layout>
  
        
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white leading-tight">
            {{ __('Crear Torneo') }}
        </h2>
    </x-slot>


    <div class="max-w-2xl mx-auto bg-white p-6 rounded-lg shadow-md">
        {{--  <h2 class="text-2xl font-semibold text-gray-700 text-center mb-6">Registro</h2>  --}}
        
        <form id="form" action="{{ route('TorneosGuardar') }}" method="POST" class="space-y-4">
            @csrf
            <!-- Nombre -->
            <div>
                <label for="nombre" class="block text-sm font-medium text-gray-700">Nombre</label>
                <input type="text" id="nombre"id="nombre" name="nombre" placeholder="Ingresa el nombre del Torneo"
                    class="w-full p-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    @if ($errors->has('nombre'))
                    <div class="bg-red-500 text-white font-bold mt-2 p-2 rounded w-auto inline-block" role="alert">
                        {{ $errors->first('nombre') }}
                    </div>
                @endif
                
            </div>
            <div>
                <label for="modalidad_id" class="block text-sm font-medium text-gray-700">Selecciona la modalidad del torneo</label>
                <select name="modalidad_id" id="modalidad_id" class="select2 w-full p-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    <option value="" disabled selected>Selecciona una modalidad</option>
                    @foreach ($modalidades as $modalidad)
                        <option value="{{ $modalidad->id }}">{{ $modalidad->nombre }}</option>
                    @endforeach
                </select>
            </div>

            <div>
                <label for="fecha_inicio" class="block text-sm font-medium text-gray-700">Fecha de Inicio</label>
                <input type="date" id="fecha_inicio" name="fecha_inicio" placeholder="Ingresa la fecha de inicio del torneo"
                    class="w-full p-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    @if ($errors->has('fecha_inicio'))
                    <div class="bg-red-500 text-white font-bold mt-2 p-2 rounded w-auto inline-block" role="alert">
                        {{ $errors->first('fecha_inicio') }}
                    </div>
                @endif
            </div>

            <div>
                <label for="fecha_fin" class="block text-sm font-medium text-gray-700">Fecha prevista de Fin</label>
                <input type="date" id="fecha_fin" name="fecha_fin" placeholder="Ingresa la fecha de inicio del torneo"
                    class="w-full p-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    @if ($errors->has('fecha_fin'))
                    <div class="bg-red-500 text-white font-bold mt-2 p-2 rounded w-auto inline-block" role="alert">
                        {{ $errors->first('fecha_fin') }}
                    </div>
                @endif
            </div>
    
            <!-- Botón de Enviar -->
            <div class="text-center">
                <x-button-save onclick="openConfirmSaveModal()">
                    <i class="fas fa-save mr-1"></i>
                    Guardar
                </x-button-save>

                <x-button-link href="{{ route('TorneosIndex') }}"
                    >
                    <i class="fas fa-arrow-left mr-1"></i>
                    Volver
                </x-button-link>
            </div>
        </form>
    </div>
    
    @push('scripts')
        <script src="{{ asset('assets/admin/torneos.js') }}"></script>
        <script>
            @if(session('success'))
                toastr.success("{{ session('success') }}");
            @endif

            @if(session('error'))
                toastr.error("{{ session('error') }}");
            @endif
        </script>
    @endpush

</x-app-layout>