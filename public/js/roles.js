$(function() {
  $('#role_table').DataTable({
    columnDefs: [
      // Primera columna: habilita todo
      {
        targets: [0],
        with: "80%",
        orderable: true,
        searchable: true,
        className: "columna-descripcion" // Restaura clase por defecto
      },
      // Columnas de botones (asumiendo que es la última columna)
      {
        targets: [1, 2], // -1 representa la última columna
        width: "10%",
        orderable: false,
        searchable: false,
        className: "columna-botones",
        className: "dt-head-no-sorting" // Clase para ocultar símbolos
      }
    ],
    autoWidth: false, // Desactiva el ajuste automático
    language: {
      emptyTable: "No hay información",
      info: "Mostrando _START_ a _END_ de _TOTAL_ Roles",
      infoEmpty: "Mostrando 0 a 0 de 0 Roles",
      infoFiltered: "(Filtrado de _MAX_ total Roles)",
      infoPostFix: "",
      thousands: ",",
      lengthMenu: "Mostrar _MENU_ Roles",
      loadingRecords: "Cargando...",
      processing: "Procesando...",
      search: "Buscador:",
      zeroRecords: "Sin resultados encontrados",
      paginate: {
        first: "Primero",
        last: "Ultimo",
        next: "Siguiente",
        previous: "Anterior"
      }
    }
  });
});
