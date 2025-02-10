document.addEventListener("DOMContentLoaded", function () {
    const btn_save = document.getElementById("btn_save");
    const btn_update = document.getElementById("btn_update");
    const btn_delete = document.getElementById("btn_delete");
    const btn_send = document.getElementById("btn_Aceptar");

    if (btn_save) {
        btn_save.addEventListener("click", (event) => {
            event.preventDefault();
            //ocultar modal
            closeConfirmSaveModal();
            guardarDatos();
        });
    }
    if (btn_send) {
        btn_send.addEventListener("click", (event) => {
            event.preventDefault();
            // alert("enviando formulario");

            actualizarDatos();
            closeAlertaConfirm();
        });
    }

    if (btn_delete) {
        btn_delete.addEventListener("click", function () {
            const id = btn_delete.getAttribute("data-id");
            eliminarDatos(id);
            closeConfirmDeleteModal();
        });
    }
});

//guardar categoria
// Enviar formulario
async function guardarDatos() {
    const form = document.getElementById("form");
    const formData = new FormData(form);

    fetch(`/categorias/guardar`, {
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
                    window.location.href = "/categorias";
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
                    error.mensaje || "Hubo un error al enviar el formulario",
                    "Error"
                );
            }
            console.error("Error:", error);
        });
}

// Enviar formulario
async function actualizarDatos() {
    const form = document.getElementById("modal-edit-form");

    const formData = new FormData(form);
    const id = document.getElementById("id_categoria").value;

    fetch(`/categorias/actualizar/${id}`, {
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
                closeEditModal();
                setTimeout(() => {
                    window.location.reload();
                }, 2000);
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
                    error.mensaje || "Hubo un error al enviar el formulario",
                    "Error"
                );
            }
            console.error("Error:", error);
        });
}

// Eliminar categoria
async function eliminarDatos() {
    const btn_confirm_delete = document.getElementById("btn_confirm_delete");
    const id = btn_confirm_delete.getAttribute("data-id");
    console.log(id);
 
    fetch(`/categorias/eliminar/` + id, {
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
                closeConfirmDeleteModal();
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
                    error.mensaje || "Hubo un error al eliminar el registro",
                    "Error"
                );
            }
            console.error("Error:", error);
        });
}
