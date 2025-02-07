document.addEventListener("DOMContentLoaded", () => {
    const btn_save = document.getElementById("btn_save");
    const btn_update = document.getElementById("btn_update");
    const btn_delete = document.getElementById("btn_delete");
    const btn_add = document.getElementById("agregar_jugador");
    const btn_cancel = document.getElementById("cancelar");
    const btn_add_jugador = document.getElementById("agregar");
    const new_player = document.getElementById("nuevos_jugadores");
    

    if (btn_save) {
        btn_save.addEventListener("click", (event) => {
            event.preventDefault();
            //ocultar modal
            closeConfirmSaveModal();

            guardarDatos();
        });
    }

    if (btn_update) {
        btn_update.addEventListener("click", (event) => {
            event.preventDefault();
            closeConfirmUpdateModal();
            actualizarDatos();
        });
    }

    if (btn_delete) {
        btn_delete.addEventListener("click", (event) => {
            event.preventDefault();
            const id = btn_delete.getAttribute("data-id");
            closeConfirmDeleteModal();
            closeDeleteModal();
            eliminarDatos(id);
        });
    }

    if (btn_add) {
        btn_add.addEventListener("click", () => {
            mostrarFormularioJugador();
        });
    }

    if (btn_cancel) {
        btn_cancel.addEventListener("click", () => {
            cancelar();
        });
    }

    if (btn_add_jugador) {
        btn_add_jugador.addEventListener("click", () => {
            if (new_player) {
                new_player.classList.remove("hidden");
            }
            agregarJugador();
        });
    }

    // Mostrar formulario para agregar jugador
    function mostrarFormularioJugador() {
        const div = document.getElementById("jugadores");
        div.classList.remove("hidden");
        // Ocultar botón agregar jugador
        btn_add.classList.add("hidden");
    }

    // Cancelar agregar jugador
    function cancelar() {
        const div = document.getElementById("jugadores");
        div.classList.add("hidden");
        // Mostrar botón agregar jugador
        btn_add.classList.remove("hidden");
    }

    // Función para agregar los datos del jugador a la tabla con tbody jugadores_tabla
    function agregarJugador() {
        const nombre = document.getElementById("nombre_jugador").value;
        const edad = document.getElementById("edad_jugador").value;
        const numJugador = document.getElementById("num_jugador").value;
        const tbody = document.getElementById("jugadores_tabla");
        const fotografiaElement = document.getElementById("fotografia");
    
        // Generar un ID único para el jugador
        const id = Date.now();
    
        // Crear una URL de objeto para la imagen
        let fotoURL = `${window.location.origin}/assets/avatar-jugador.png`;
        let fotoFile = null;
        if (fotografiaElement && fotografiaElement.files && fotografiaElement.files[0]) {
            fotoURL = URL.createObjectURL(fotografiaElement.files[0]);
            fotoFile = fotografiaElement.files[0];
        }
    
        const tr = document.createElement("tr");
        tr.setAttribute("id", `jugador_${id}`);
        tr.classList.add("border", "hover:bg-gray-100");
        tr.innerHTML = `
        <td class="py-2 px-4 border text-center">
            <img src="${fotoURL}" alt="${nombre}" class="w-24 h-24 object-cover">
        </td>
        <td class="py-2 px-4 border text-center">${nombre}</td>
        <td class="py-2 px-4 border text-center">${edad}</td>
        <td class="py-2 px-4 border text-center">${numJugador}</td>
        <td class="py-2 px-4 border text-center">
            <button type="button" class="inline-flex items-center px-3 py-2 mt-3 bg-red-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-400 focus:bg-red-500 active:bg-red-500 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 disabled:opacity-50 transition ease-in-out duration-150" onclick="eliminarJugador(${id})">
                <i class="fas fa-trash-alt"></i> Eliminar
            </button>
        </td>
        `;
        tbody.appendChild(tr);
    
        // Guardar el archivo de imagen en el elemento tr para uso posterior
        if (fotoFile) {
            tr.dataset.fotoFile = JSON.stringify(fotoFile);
        }
    
        // Limpiar los campos de entrada después de agregar el jugador
        document.getElementById("nombre_jugador").value = "";
        document.getElementById("edad_jugador").value = "";
        document.getElementById("num_jugador").value = "";
        if (fotografiaElement) {
            fotografiaElement.value = "";
        }
    
        // Ocultar el formulario de agregar jugador y mostrar el botón agregar jugador
        cancelar();
    }

    // Función para agregar los datos de los jugadores al formulario antes de enviarlo
    function agregarJugadoresAlFormulario() {
        const tbody = document.getElementById("jugadores_tabla");
        const form = document.getElementById("form");
        const jugadores = tbody.querySelectorAll("tr");
    
        jugadores.forEach((jugador, index) => {
            const nombre = jugador.children[1].innerText;
            const edad = jugador.children[2].innerText;
            const numJugador = jugador.children[3].innerText;
            
            const inputNombre = document.createElement("input");
            inputNombre.type = "hidden";
            inputNombre.name = `jugadores[${index}][nombre]`;
            inputNombre.value = nombre;
    
            const inputEdad = document.createElement("input");
            inputEdad.type = "hidden";
            inputEdad.name = `jugadores[${index}][edad]`;
            inputEdad.value = edad;
    
            const inputNumJugador = document.createElement("input");
            inputNumJugador.type = "hidden";
            inputNumJugador.name = `jugadores[${index}][num_jugador]`;
            inputNumJugador.value = numJugador;
    
            form.appendChild(inputNombre);
            form.appendChild(inputEdad);
            form.appendChild(inputNumJugador);
    
            // Manejar la foto
            if (jugador.dataset.fotoFile) {
                const fotoFile = JSON.parse(jugador.dataset.fotoFile);
                const inputFoto = document.createElement("input");
                inputFoto.type = "file";
                inputFoto.name = `jugadores[${index}][foto]`;
                inputFoto.style.display = "none";
                
                // Crear un nuevo File object
                const file = new File([fotoFile], fotoFile.name, {
                    type: fotoFile.type,
                    lastModified: new Date()
                });
                
                // Asignar el File object al input
                const dataTransfer = new DataTransfer();
                dataTransfer.items.add(file);
                inputFoto.files = dataTransfer.files;
                
                form.appendChild(inputFoto);
                form.append(`jugadores[${index}][foto]`, jugador.fotoFile);
            }
        });
    }

    // Función para eliminar jugador de la tabla
    window.eliminarJugador = function (id) {
        const tr = document.getElementById(`jugador_${id}`);
        tr.remove();
    };

    // Enviar formulario
    async function guardarDatos() {
        const form = document.getElementById("form");
        agregarJugadoresAlFormulario();
        const formData = new FormData(form);
        fetch(`/equipos/guardar`, {
            method: "POST",
            body: formData,
            headers: {
                "X-CSRF-TOKEN": document
                    .querySelector('meta[name="csrf-token"]')
                    .getAttribute("content"),
            },
        })
            .then((response) => {
                if (!response.ok) {
                    return response.json().then((err) => {
                        throw err;
                    });
                }
                return response.json();
            })
            .then((data) => {
                if (data.success) {
                    toastr.success(data.mensaje, "Éxito");
                    setTimeout(() => {
                        window.location.href = "/equipos";
                    }, 3000);
                } else {
                    toastr.error(data.mensaje, "Error");
                }
            })
            .catch((error) => {
                if (error.errors) {
                    // Si hay errores de validación, muéstralos
                    Object.values(error.errors).forEach((mensaje) => {
                        toastr.error(mensaje[0], "Error");
                    });
                } else {
                    toastr.error(
                        error.mensaje ||
                            "Hubo un error al enviar el formulario",
                        "Error"
                    );
                }
                console.error("Error:", error);
            });
    }

   

    async function actualizarDatos() {
        const form = document.getElementById("form");
        const id = document.getElementById("id").value;
        agregarJugadoresAlFormulario();
        const formData = new FormData(form);
        

        fetch(`/equipos/actualizar/${id}`, {
            method: "POST",
            body: formData,
            headers: {
                "X-CSRF-TOKEN": document
                    .querySelector('meta[name="csrf-token"]')
                    .getAttribute("content"),
            },
        })
            .then((response) => {
                if (!response.ok) {
                    return response.json().then((err) => {
                        throw err;
                    });
                }
                return response.json();
            })
            .then((data) => {
                if (data.success) {
                    // Redirigir o realizar otras acciones después de éxito
                    toastr.success(data.mensaje, "Éxito");
                    setTimeout(() => {
                        window.location.href = "/equipos";
                    }, 3000);
                } else {
                    toastr.error(data.mensaje, "Error");
                }
            })
            .catch((error) => {
                if (error.errors) {
                    // Si hay errores de validación, muéstralos
                    Object.values(error.errors).forEach((mensaje) => {
                        toastr.error(mensaje[0], "Error");
                    });
                } else {
                    toastr.error(
                        error.mensaje ||
                            "Hubo un error al enviar el formulario",
                        "Error"
                    );
                }
                console.error("Error:", error);
            });
    }


});


 // Eliminar modalidad
 async function eliminarDatos() {
    const btn_confirm_delete =
        document.getElementById("btn_confirm_delete");
    const id = btn_confirm_delete.getAttribute("data-id");
    // console.log(id);

    fetch(`/equipos/eliminar/` + id, {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
            "X-CSRF-TOKEN": document
                .querySelector('meta[name="csrf-token"]')
                .getAttribute("content"),
        },
    })
        .then((response) => {
            if (!response.ok) {
                return response.json().then((err) => {
                    throw err;
                });
            }
            return response.json();
        })
        .then((data) => {
            if (data.success) {
                // Mostrar mensaje de éxito y recargar la página
                toastr.success(data.mensaje, "Éxito");
                setTimeout(() => {
                    window.location.reload(); // Recargar la página
                }, 2000);
            } else {
                // Mostrar mensaje de error
                toastr.error(data.mensaje, "Error");
            }
        })
        .catch((error) => {
            if (error.errors) {
                // Si hay errores de validación, muéstralos
                Object.values(error.errors).forEach((mensaje) => {
                    toastr.error(mensaje[0], "Error");
                });
            } else {
                // Mostrar mensaje de error genérico
                toastr.error(
                    error.mensaje ||
                        "Hubo un error al eliminar el registro",
                    "Error"
                );
            }
            console.error("Error:", error);
        });
}

function editJugador(id) {
    const row = document.getElementById(`jugador-${id}`);
    row.querySelectorAll('.jugador-data').forEach(el => el.classList.add('hidden'));
    row.querySelectorAll('.jugador-input').forEach(el => el.classList.remove('hidden'));
    row.querySelector('.edit-btn').classList.add('hidden');
    row.querySelector('.delete-btn').classList.add('hidden');
    row.querySelector('.save-btn').classList.remove('hidden');
    row.querySelector('.cancel-btn').classList.remove('hidden');
}

function cancelEdit(id) {
    const row = document.getElementById(`jugador-${id}`);
    row.querySelectorAll('.jugador-data').forEach(el => el.classList.remove('hidden'));
    row.querySelectorAll('.jugador-input').forEach(el => el.classList.add('hidden'));
    row.querySelector('.edit-btn').classList.remove('hidden');
    row.querySelector('.delete-btn').classList.remove('hidden');
    row.querySelector('.save-btn').classList.add('hidden');
    row.querySelector('.cancel-btn').classList.add('hidden');
}

function saveJugador(id) {
    const row = document.getElementById(`jugador-${id}`);
    const nombre = row.querySelector('input[type="text"]').value;
    const edad = row.querySelector('input[type="number"]:nth-of-type(1)').value;
    const numeroCamiseta = row.querySelector('input[type="number"]:nth-of-type(2)').value;

    // Aquí deberías hacer una llamada AJAX para guardar los datos en el servidor
    // Por ejemplo, usando fetch:
    fetch(`/jugadores/${id}`, {
        method: 'PUT',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: JSON.stringify({ nombre, edad, numero_camiseta: numeroCamiseta })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            // Actualizar los datos mostrados
            row.querySelector('.jugador-data:nth-of-type(1)').textContent = nombre;
            row.querySelector('.jugador-data:nth-of-type(2)').textContent = edad;
            row.querySelector('.jugador-data:nth-of-type(3)').textContent = numeroCamiseta;
            
            // Volver al modo de visualización
            cancelEdit(id);
            
            // Mostrar un mensaje de éxito
            toastr.success('Jugador actualizado con éxito');
        } else {
            toastr.error('Error al actualizar el jugador');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        toastr.error('Error al actualizar el jugador');
    });
}