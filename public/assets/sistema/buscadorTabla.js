document.addEventListener("DOMContentLoaded", function () {
    let searchInput = document.getElementById("searchInput");
    let tableBody = document.getElementById("tableBody");
    let allRows = Array.from(tableBody.querySelectorAll("tr")); // Guarda todas las filas originales
    let filteredRows = [...allRows]; // Inicialmente, todas las filas están visibles
    let rowsPerPage = 5; // Filas por página
    let currentPage = 1;
    let pageNumber = document.getElementById("pageNumber");

    // Función para mostrar solo las filas de la página actual
    function showPage(page) {
        let totalRows = filteredRows.length;
        let totalPages = Math.ceil(totalRows / rowsPerPage);
        if (page > totalPages) page = totalPages; // Evitar que pase de la última página
        if (page < 1) page = 1; // Evitar que pase antes de la primera página

        let start = (page - 1) * rowsPerPage;
        let end = start + rowsPerPage;

        // Ocultar todas las filas y mostrar solo las de la página actual
        allRows.forEach(row => (row.style.display = "none"));
        filteredRows.slice(start, end).forEach(row => (row.style.display = ""));

        // Actualizar número de página
        pageNumber.textContent = totalRows > 0 ? page : "0";
        currentPage = page;
    }

    // Función de búsqueda
    searchInput.addEventListener("keyup", function () {
        let filter = searchInput.value.toLowerCase();
        filteredRows = allRows.filter(row => {
            let cell = row.getElementsByTagName("td")[1]; // Segunda columna (Nombre)
            return cell && cell.textContent.toLowerCase().includes(filter);
        });

        // Resetear la página a la 1 después de buscar
        currentPage = 1;
        showPage(currentPage);
    });

    // Función para cambiar de página
    window.nextPage = function () {
        let totalPages = Math.ceil(filteredRows.length / rowsPerPage);
        if (currentPage < totalPages) {
            showPage(currentPage + 1);
        }
    };

    window.previousPage = function () {
        if (currentPage > 1) {
            showPage(currentPage - 1);
        }
    };

    // Mostrar la primera página al cargar
    showPage(currentPage);
});
