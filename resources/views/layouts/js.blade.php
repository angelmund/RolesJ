<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
{{--  <script src="https://cdn.datatables.net/2.2.1/js/dataTables.min.js"></script>  --}}
{{--  <script src="{{asset('assets/bootstrap-5.3.3-dist/js/bootstrap.bundle.min.js')}}"></script>  --}}
{{--  <script>
    $(document).ready(function() {
        let table = new DataTable('#Table', {
            responsive: true,
            language: {
                decimal: "",
                emptyTable: "No hay datos disponibles en la tabla",
                info: "", // Elimina la información de registros mostrados
                infoEmpty: "",
                infoFiltered: "",
                infoPostFix: "",
                thousands: ",",
                lengthMenu: "", // Elimina el texto del menú de longitud
                loadingRecords: "Cargando...",
                processing: "Procesando...",
                search: "Buscar:",
                zeroRecords: "No se encontraron registrados coincidentes",
                paginate: {
                    first: "Primero",
                    last: "Último",
                    next: "Siguiente",
                    previous: "Anterior"
                },
                aria: {
                    sortAscending: ": activar para ordenar la columna de manera ascendente",
                    sortDescending: ": activar para ordenar la columna de manera descendente"
                }
            },
            paging: false, // Desactiva la paginación
            lengthChange: false, // Oculta la opción de cambiar la longitud
            searching: true,
            ordering: true,
            info: false, // Oculta la información de registros mostrados
            autoWidth: false,
            pageLength: -1, // Muestra todos los registros en una página
            columnDefs: [
                { targets: 'no-sort', orderable: false }
            ]
        });
    });
</script>  --}}
 <script src="{{ asset('assets/sistema/modales.js') }}"></script>
 <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
 <script>
    $(document).ready(function() {
        $('.select2').select2();

        // Asegurarse de que la opción "Selecciona una opción" esté deshabilitada y seleccionada por defecto
        $('.select2').each(function() {
            if (!$(this).val()) {
                $(this).val('').trigger('change');
            }
        });
    });
</script>

