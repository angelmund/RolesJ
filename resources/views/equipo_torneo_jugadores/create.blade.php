<x-app-layout>
  
        
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white leading-tight">
            {{ __('Crear Equipo') }}
        </h2>
    </x-slot>

    <div class="grid grid-cols-2 gap-4 px-4 py-0">
        <div class="bg-white p-6 rounded-lg shadow-md">
            {{--  <h2 class="text-2xl font-semibold text-gray-700 text-center mb-6">Registro</h2>  --}}
            
            <form id="form" action="{{ route('EquiposGuardar') }}" method="POST" class="space-y-4">
                @csrf
                <!-- Nombre -->
                <div>
                    <label for="nombre" class="block text-sm font-medium text-gray-700">Nombre</label>
                    <input type="text" id="nombre" name="nombre" placeholder="Ingresa el nombre del Equipo"
                        class="w-full p-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    @if ($errors->has('nombre'))
                        <div class="bg-red-500 text-white font-bold mt-2 p-2 rounded w-auto inline-block" role="alert">
                            {{ $errors->first('nombre') }}
                        </div>
                    @endif
                </div>
                <div>
                    <label for="torneo_id" class="block text-sm font-medium text-gray-700">Seleccion el torneo</label>
                    <select name="torneo_id" id="torneo_id" class="select2 w-full p-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        <option value="" disabled selected>Selecciona el torneo</option>
                        @foreach ($torneos as $torneo)
                            <option value="{{ $torneo->id }}">{{ $torneo->nombre }}</option>
                        @endforeach
                    </select>
                </div>
            
                <div>
                    <label for="logo" class="block text-sm font-medium text-gray-700">Logo</label>
                    <input type="file" accept="png/jpg" id="logo" name="logo" placeholder="Selecciona el logo del Equipo"
                        class="w-full p-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    @if ($errors->has('logo'))
                        <div class="bg-red-500 text-white font-bold mt-2 p-2 rounded w-auto inline-block" role="alert">
                            {{ $errors->first('logo') }}
                        </div>
                    @endif
                </div>
    
                <div>
                    <button type="button" class="inline-flex items-center px-3 py-2 bg-green-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-400 focus:bg-green-500 active:bg-green-500 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 disabled:opacity-50 transition ease-in-out duration-150" id="agregar_jugador">
                        <i class="fas fa-plus mr-1"></i> Agregar Jugador
                    </button>
                </div>
    
                {{--  <div id="jugadores">
                    <div class="grid grid-cols-1 gap-4 mt-4" id="jugador_1">
                        <div>
                            <label for="jugador_id" class="block text-sm font-medium text-gray-700">Seleccion el jugador</label>
                            <select name="jugador_id[]" id="jugador_id" class="select2 w-full p-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                <option value="" disabled selected>Selecciona el jugador</option>
                                @foreach ($jugadores as $jugador)
                                    <option value="{{ $jugador->id }}">{{ $jugador->nombre }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>  --}}
    
                <div id="jugadores" class="hidden">
                    <h2 class="text-center font-bold text-2xl">Datos del Jugador</h2>
                    <div class="grid grid-cols-1 gap-4 mt-4" id="jugador">
                        <div>
                            <label for="nombre_jugador" class="block text-sm font-medium text-gray-700">Nombre del jugador</label>    
                            <input type="text" id="nombre_jugador" name="nombre_jugador" placeholder="Ingresa el nombre del Jugador"
                                class="w-full p-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                            @if ($errors->has('nombre_jugador'))
                                <div class="bg-red-500 text-white font-bold mt-2 p-2 rounded w-auto inline-block" role="alert">
                                    {{ $errors->first('nombre_jugador') }}
                                </div>
                            @endif
                        </div>
                    </div>
    
                    <div class="grid grid-cols-1 gap-4 mt-4">
                        <div>
                            <label for="edad_jugador" class="block text-sm font-medium text-gray-700">Edad</label>    
                            <input type="text" id="edad_jugador" name="edad_jugador" placeholder="Ingresa la edad del Jugador"
                                class="w-full p-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                            @if ($errors->has('edad_jugador'))
                                <div class="bg-red-500 text-white font-bold mt-2 p-2 rounded w-auto inline-block">
                                    {{ $errors->first('edad_jugador') }}
                                </div>
                            @endif
                        </div>
                    </div>

                    
    
                    <div class="grid grid-cols-1 gap-4 mt-4">
                        <div>
                            <label for="num_jugador" class="block text-sm font-medium text-gray-700">N&uacute;mero de Camiseta</label>    
                            <input type="number" min="1" max="20" id="num_jugador" name="num_jugador" placeholder="Ingresa el número del Jugador"
                                class="w-full p-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                            @if ($errors->has('num_jugador'))
                                <div class="bg-red-500 text-white font-bold mt-2 p-2 rounded w-auto inline-block">
                                    {{ $errors->first('num_jugador') }}
                                </div>
                            @endif
                        </div>
                    </div>

                    <div class="grid grid-cols-1 gap-4 mt-4">
                        <div>
                            <label for="fotografia" class="block text-sm font-medium text-gray-700">Fotografía</label>    
                            <input type="file" accept="png/jpg" id="fotografia" name="fotografia" placeholder="Selecciona la fotografía del Jugador"
                            class="w-full p-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                            @if ($errors->has('fotografia'))
                                <div class="bg-red-500 text-white font-bold mt-2 p-2 rounded w-auto inline-block">
                                    {{ $errors->first('fotografia') }}
                                </div>
                            @endif
                        </div>
                    </div>
    
                    {{--  <div class="grid grid-cols-1 gap-4 m-4">
                        <button type="button" class="inline-flex items-center px-3 py-2 bg-red-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-400 focus:bg-red-500 active:bg-red-500 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 disabled:opacity-50 transition ease-in-out duration-150" id="quitar_jugador">
                            <i class="fas fa-minus mr-1"></i> Quitar Jugador
                        </button>
                    </div>  --}}
                    <div>
                        <button type="button" class="inline-flex items-center px-3 py-2 mt-3 bg-green-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-400 focus:bg-green-500 active:bg-green-500 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 disabled:opacity-50 transition ease-in-out duration-150" id="agregar">
                            <i class="fas fa-plus mr-1"></i> Agregar
                        </button>
    
                        <button type="button" class="inline-flex items-center px-3 py-2 mt-3 bg-red-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-400 focus:bg-red-500 active:bg-red-500 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 disabled:opacity-50 transition ease-in-out duration-150" id="cancelar">
                           <i class="fas fa-cancel mr-1"></i> Cancelar
                        </button>
                    </div>
                </div>
    
                <!-- Botón de Enviar -->
                <div class="text-center">
                    <x-button-save onclick="openConfirmSaveModal()">
                        <i class="fas fa-save mr-1"></i>
                        Guardar
                    </x-button-save>
    
                    <x-button-link href="{{ route('EquiposIndex') }}">
                        <i class="fas fa-arrow-left mr-1"></i>
                        Volver
                    </x-button-link>
                </div>
            </form>
        </div>
    
        <div class="bg-white p-6 rounded-lg shadow-md ">
            <h2 class="text-2xl font-semibold text-gray-700 text-center mb-6">Jugadores</h2>
            <div class="overflow-x-auto">
                <table class="min-w-full bg-white border border-gray-300 rounded-lg">
                    <thead>
                        <tr class="bg-gray-200 text-gray-700">
                            <th class="py-2 px-4 border text-center font-bold">Fotografía</th>
                            <th class="py-2 px-4 border text-center font-bold">Nombre.</th>
                            <th class="py-2 px-4 border text-center font-bold">Edad</th>
                            <th class="py-2 px-4 border text-center font-bold">Num. Camiseta</th>
                            <th class="py-2 px-4 border text-center font-bold">Acciones</th>
                        </tr>
                    </thead>
                    <tbody id="jugadores_tabla">
                   
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    
    
    @push('scripts')
        <script src="{{ asset('assets/admin/equipo_torneo_jugadores.js') }}"></script>
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