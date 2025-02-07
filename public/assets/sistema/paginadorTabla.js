document.getElementById("searchInput").addEventListener("keyup", function() {
    let filter = this.value.toLowerCase();
    let rows = document.querySelectorAll("#tableBody tr");

    rows.forEach(row => {
        let text = row.innerText.toLowerCase();
        row.style.display = text.includes(filter) ? "" : "none";
    });

    // Reiniciar la paginación al filtrar
    showPage(1);
});

let currentPage = 1;
const rowsPerPage = 5; // Ajusta el número de filas por página

function showPage(page) {
    let rows = document.querySelectorAll("#tableBody tr");
    let totalPages = Math.ceil(rows.length / rowsPerPage);

    if (page < 1) page = 1;
    if (page > totalPages) page = totalPages;

    rows.forEach((row, index) => {
        row.style.display = (index >= (page - 1) * rowsPerPage && index < page * rowsPerPage) ? "" : "none";
    });

    document.getElementById("pageNumber").innerText = page;
    currentPage = page;
}

function nextPage() {
    showPage(currentPage + 1);
}

function previousPage() {
    showPage(currentPage - 1);
}

// Mostrar la primera página al cargar
showPage(1);