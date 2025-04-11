$(function() {
  $('#usuarios_table').DataTable({
    columnDefs: [
      {
        targets: [0, 1, 2, 3, 4],
        with: "19%",
        orderable: true,
        searchable: true,
        className: "columna-descripcion" // Restaura clase por defecto
      },
      {
        targets: [5, 6], // -1 representa la última columna
        width: "5%",
        orderable: false,
        searchable: false,
        className: "columna-botones",
        className: "dt-head-no-sorting" // Clase para ocultar símbolos
      }
    ],
    autoWidth: false, // Desactiva el ajuste automático
    language: {
      emptyTable: "No hay información",
      info: "Mostrando _START_ a _END_ de _TOTAL_ Usuarios",
      infoEmpty: "Mostrando 0 a 0 de 0 Usuarios",
      infoFiltered: "(Filtrado de _MAX_ total Usuarios)",
      infoPostFix: "",
      thousands: ",",
      lengthMenu: "Mostrar _MENU_ Usuarios",
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

$(function() {
  document.getElementById('usuario_form').addEventListener('submit', function(e) {
    const pass1 = document.getElementById('password_usuario').value;
    const pass2 = document.getElementById('password_usuario2').value;

    if (pass1 !== pass2) {
      e.preventDefault();
      Swal.fire({
        icon: 'error',
        title: 'Error',
        text: 'Las contraseñas no coinciden',
        confirmButtonColor: '#cc2026'
      });
      document.getElementById('password_usuario2').focus();
    }
  });

  // Validación en tiempo real
  document.getElementById('password_usuario2').addEventListener('input', function() {
    const pass1 = document.getElementById('password_usuario').value;
    const pass2 = this.value;
    const feedback = document.getElementById('password-feedback');

    if (pass1 !== pass2) {
      this.classList.add('is-invalid');
      feedback.style.display = 'block';
    } else {
      this.classList.remove('is-invalid');
      feedback.style.display = 'none';
    }
  });
})
