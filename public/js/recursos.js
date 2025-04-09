$(function() {
  $('#material_normativo_table').DataTable({
    columnDefs: [
      // Primera columna: habilita todo
      {
        targets: [0],
        with: "85%",
        orderable: true,
        searchable: true,
        className: "columna-descripcion" // Restaura clase por defecto
      },
      // Columnas de botones (asumiendo que es la última columna)
      {
        targets: [1, 2, 3], // -1 representa la última columna
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
      info: "Mostrando _START_ a _END_ de _TOTAL_ Recursos",
      infoEmpty: "Mostrando 0 a 0 de 0 Recursos",
      infoFiltered: "(Filtrado de _MAX_ total Recursos)",
      infoPostFix: "",
      thousands: ",",
      lengthMenu: "Mostrar _MENU_ Recursos",
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
  $('#material_capacitacion_table').DataTable({
    columnDefs: [
      // Primera columna: habilita todo
      {
        targets: [0],
        with: "85%",
        orderable: true,
        searchable: true,
        className: "columna-descripcion" // Restaura clase por defecto
      },
      // Columnas de botones (asumiendo que es la última columna)
      {
        targets: [1, 2, 3], // -1 representa la última columna
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
      info: "Mostrando _START_ a _END_ de _TOTAL_ Recursos",
      infoEmpty: "Mostrando 0 a 0 de 0 Recursos",
      infoFiltered: "(Filtrado de _MAX_ total Recursos)",
      infoPostFix: "",
      thousands: ",",
      lengthMenu: "Mostrar _MENU_ Recursos",
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
  $('#material_complementario_table').DataTable({
    columnDefs: [
      // Primera columna: habilita todo
      {
        targets: [0],
        with: "85%",
        orderable: true,
        searchable: true,
        className: "columna-descripcion" // Restaura clase por defecto
      },
      // Columnas de botones (asumiendo que es la última columna)
      {
        targets: [1, 2, 3], // -1 representa la última columna
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
      info: "Mostrando _START_ a _END_ de _TOTAL_ Recursos",
      infoEmpty: "Mostrando 0 a 0 de 0 Recursos",
      infoFiltered: "(Filtrado de _MAX_ total Recursos)",
      infoPostFix: "",
      thousands: ",",
      lengthMenu: "Mostrar _MENU_ Recursos",
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

$(document).ready(function() {
  // Modal generar campo
  document
    .getElementById("tipo_recurso")
    .addEventListener("change", function() {
      const tipo = this.value;
      const materialField = document.getElementById("materialField");
      const materialLabel = document.getElementById("materialLabel");
      const materialInput = document.getElementById("contenido_recurso");

      materialField.hidden = false;

      if (tipo === "URL" || tipo === "Video") {
        materialLabel.textContent = tipo === "URL" ? "URL" : "URL";
        materialInput.type = "text";
        materialInput.setAttribute("required", "true");
      } else if (tipo === "Archivo") {
        materialLabel.textContent = "Archivo";
        materialInput.type = "file";
        materialInput.setAttribute("required", "true");
      } else {
        materialField.hidden = true;
        materialInput.removeAttribute("required");
      }
    });
});

document.addEventListener('DOMContentLoaded', function() {
  // Delegación de eventos para los selects de tipo
  document.addEventListener('change', function(e) {
    if (e.target.matches('[id^=editar_tipo]')) {
      const idRecurso = e.target.dataset.id;
      actualizarCampoEdicion(idRecurso);
    }
  });

  // Función principal de actualización
  window.actualizarCampoEdicion = function(idRecurso) {
    const tipo = document.querySelector(`#editar_tipo[data-id="${idRecurso}"]`).value;
    const tipoOriginal = document.querySelector(`#tipo_original_${idRecurso}`).value;
    const contenidoOriginal = document.querySelector(`#contenido_original_${idRecurso}`).value;
    const campoContenido = document.querySelector(`#campo-edicion-${idRecurso}`);

    let html = '';

    if (tipo === 'Archivo') {
      // Extraer nombre del archivo de manera segura
      const filename = contenidoOriginal.split('/').pop(); // Cambio clave aquí

      html = `
        <div class="mb-3">
            <label class="form-label">${tipo === tipoOriginal ? 'Archivo actual:' : 'Nuevo archivo:'}</label>
            <div class="input-group">
                ${tipo === tipoOriginal ? `
                    <a href="${contenidoOriginal}" 
                       class="form-control" 
                       target="_blank">
                        ${filename}
                    </a>
                    <button type="button" 
                            class="btn btn-outline-secondary" 
                            onclick="document.querySelector('#nuevo_archivo_${idRecurso}').click()">
                        Cambiar archivo
                    </button>
                    <input type="file" 
                           id="nuevo_archivo_${idRecurso}"
                           name="contenido_recurso" 
                           class="d-none">
                ` : `
                    <input type="file" 
                           class="form-control" 
                           name="contenido_recurso" 
                           ${tipo !== tipoOriginal ? 'required' : ''}
                           accept=".pdf,.doc,.docx,.xls,.xlsx,.ppt,.pptx">
                `}
            </div>
            ${tipo === tipoOriginal ? `
                <small class="text-muted">Archivo actual: ${contenidoOriginal}</small>
            ` : ''}
        </div>`;
    } else {
      html = `
        <div class="mb-3">
            <label class="form-label">${tipo === 'URL' ? 'Enlace' : 'URL del Video'}</label>
            <input type="url" 
                   class="form-control" 
                   name="contenido_recurso" 
                   value="${tipo === tipoOriginal ? contenidoOriginal : ''}" 
                   required>
        </div>`;
    }

    campoContenido.innerHTML = html;
  }

});
