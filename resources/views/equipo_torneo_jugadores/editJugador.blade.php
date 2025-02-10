<div>


        <div class="relative z-0 w-full mb-5 group">
            <input type="hidden" value="{{ $jugador->id }}" id="id_jugador" name="id_jugador">
            <input type="nombre" name="nombre" id="nombre"
                class="block py-2.5 px-0 w-full text-xl text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-black dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                placeholder=" " required value="{{ $jugador->nombre }}" />
            <label for="nombre"
                class="peer-focus:font-medium absolute text-xl text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Nombre</label>
        </div>
        <div class="relative z-0 w-full mb-5 group">
            @if ($jugador->foto)
            <img src="{{ asset('/storage/' . $jugador->foto) }}" alt="Foto"
            class="w-24 h-24">
            @else
                <img src="{{ asset('assets/avatar-jugador.png') }}" alt="Foto" width="200" height="200">
            @endif
            <label class="block mb-2 text-xl font-medium text-gray-900 dark:text-black" for="foto">Subir
                foto</label>
            <input
                class="block w-full text-xl text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-500 dark:border-gray-500 dark:placeholder-gray-400"
                aria-describedby="user_avatar_help" id="user_avatar" type="file" accept="image/*" name="foto" id="foto">
            <div class="mt-1 text-xl text-gray-500 dark:text-black" id="user_avatar_help">Selecciona la
                fotograf&iacute;a para el jugador</div>
        </div>
        {{--  <div class="relative z-0 w-full mb-5 group">
            <input type="edad" name="edad" id="edad"
                class="block py-2.5 px-0 w-full text-xl text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-black dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                placeholder=" " required  value="{{ $jugador->edad }}"/>
            <label for="edad"
                class="peer-focus:font-medium absolute text-xl text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Edad</label>
        </div>
        <div class="relative z-0 w-full mb-5 group">
            <input type="numero_camiseta" name="repeat_password" id="floating_repeat_password"
                class="block py-2.5 px-0 w-full text-xl text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-black dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                placeholder=" " required value="{{ $jugador->numero_camiseta }}"/>
            <label for="floating_repeat_password"
                class="peer-focus:font-medium absolute text-xl text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Confirm
                N&uacute;mero de camiseta</label>
        </div>  --}}
        <div class="grid md:grid-cols-2 md:gap-6">
            <div class="relative z-0 w-full mb-5 group">
                <input type="text" name="edad" id="edad"
                    class="block py-2.5 px-0 w-full text-xl text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-black dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                    placeholder=" " required value="{{ $jugador->edad }}" />
                <label for="edad"
                    class="peer-focus:font-medium absolute text-xl text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
                    Edad</label>
            </div>
            <div class="relative z-0 w-full mb-5 group">
                <input type="text" name="numero_camiseta" id="numero_camiseta"
                    class="block py-2.5 px-0 w-full text-xl text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-black dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                    placeholder=" " required value="{{ $jugador->numero_camiseta }}"/>
                <label for="numero_camiseta"
                    class="peer-focus:font-medium absolute text-xl text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
                    N&uacute;mero de camiseta</label>
            </div>
        </div>

   

</div>
