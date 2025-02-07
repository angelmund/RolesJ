<x-app-layout>
    {{--  <x-slot name="header">
        <h2 class="font-semibold text-xl text-white leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>  --}}

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-6 gap-2 justify-items-center px-4 py-0 ">
        <div class="p-2 bg-orange-700 border border-gray-200 rounded-lg shadow-md w-full h-48 hover:bg-slate-700">
            <span class="block h-12 w-auto text-white font-bold">#76</span>
            <h1 class="mt-10 text-xl font-medium text-gray-900 text-center">
                <i class="fas fa-user text-white"></i> <a href="#" class="text-white">Usuarios</a>
            </h1>
        </div>
        <div class="p-2 bg-orange-700 border border-gray-200 rounded-lg shadow-md w-full h-48 hover:bg-slate-700">
            <span class="block h-12 w-auto text-white font-bold">#76</span>
            <h1 class="mt-10 text-xl font-medium text-gray-900 text-center">
                <i class="fas fa-users text-blue-500"></i> <a href="{{route('EquiposIndex')}}" class="text-white">Equipos</a>
            </h1>
        </div>
        <div class="p-2 bg-orange-700 border border-gray-200 rounded-lg shadow-md w-full h-48 hover:bg-slate-700">
            <span class="block h-12 w-auto text-white font-bold">#76</span>
            <h1 class="mt-10 text-xl font-medium text-gray-900 text-center">
                <i class="fas fa-trophy text-yellow-400"></i> <a href="{{route('TorneosIndex')}}" class="text-white">Torneos</a>
            </h1>
        </div>
        <div class="p-2 bg-orange-700 border border-gray-200 rounded-lg shadow-md w-full h-48 hover:bg-slate-700">
            <span class="block h-12 w-auto text-white font-bold">#76</span>
            <h1 class="mt-10 text-xl font-medium text-gray-900 text-center">
                <i class="fas fa-list-ol text-lime-600"></i> <a href="#" class="text-white">Tabla de Posiciones</a>
            </h1>
        </div>
        <div class="p-2 bg-orange-700 border border-gray-200 rounded-lg shadow-md w-full h-48 hover:bg-slate-700">
            <span class="block h-12 w-auto text-white font-bold">#76</span>
            <h1 class="mt-10 text-xl font-medium text-gray-900 text-center">
                <i class="fas fa-futbol text-black"></i> <a href="#" class="text-white">Jugadores</a>
            </h1>
        </div>
        <div class="p-2 bg-orange-700 border border-gray-200 rounded-lg shadow-md w-full h-48 hover:bg-slate-700">
            <span class="block h-12 w-auto text-white font-bold">#76</span>
            <h1 class="mt-10 text-xl font-medium text-gray-900 text-center">
                <i class="fas fa-cogs text-black"></i> <a href="{{route('ModalidadesIndex')}}" class="text-white">Modalidades</a>
            </h1>
        </div>
        
    </div>
</x-app-layout>