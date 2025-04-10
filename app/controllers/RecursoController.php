<?php
/* ========================================================
 * ============ Home Controller ======================
 * ======================================================*/

namespace App\Controllers;
use App\Models\Recurso;

class RecursoController extends Controller
{
    public function index()
    {
        $recursoModel = new Recurso();
        return $this->view(
            'recursos', ['recursos'=>$recursoModel->getAllRecursos()]
        );
    }

    public function create()
    {
        $recursoModel = new Recurso();
        // Validar campos obligatorios
        if (empty($_POST['descripcion_recurso']) 
            || empty($_POST['clasificacion_recurso']) 
            || empty($_POST['tipo_recurso'])
        ) {
            \Lib\Alert::error('Error', 'Todos los campos son obligatorios');
            header("Location:" . APP_URL . "recursos");
        }

        // Obtener datos del formulario
        $descripcion = $_POST['descripcion_recurso'];
        $clasificacion = $_POST['clasificacion_recurso'];
        $tipo = $_POST['tipo_recurso'];
        $estado = '1';
        $contenido = '';
        $fyh_creacion = date('Y-m-d H:i:s');

        // Manejar contenido según el tipo
        if ($tipo === 'Archivo') {
            // Validar archivo subido
            if (!isset($_FILES['contenido_recurso']) 
                || $_FILES['contenido_recurso']['error'] !== UPLOAD_ERR_OK
            ) {
                \Lib\Alert::error('Error', 'Debe seleccionar un archivo');
                header("Location:" . APP_URL . "recursos");
                exit;
            }

            // Configurar directorio y nombre del archivo
            $directorioDestino = $_SERVER['DOCUMENT_ROOT'] . '/files/';
            $nombreArchivo = uniqid() . '_' . basename($_FILES['contenido_recurso']['name']);
            $rutaCompleta = $directorioDestino . $nombreArchivo;

            // Crear directorio si no existe
            if (!file_exists($directorioDestino)) {
                mkdir($directorioDestino, 0755, true);
            }
            // Verificar si puedes subir archivos
            if (!is_writable($directorioDestino)) {
                \Lib\Alert::error('Error', 'No tienes permiso para subir archivos a la carpeta');
                header("Location:" . APP_URL . "recursos");
            }
            // Mover el archivo
            if (move_uploaded_file($_FILES['contenido_recurso']['tmp_name'], $rutaCompleta)) {
                $contenido = $nombreArchivo;
            } else {
                echo $_FILES['contenido_recurso']['error'];
                die();
                \Lib\Alert::error('Error', 'Error al subir el archivo');
                header("Location:" . APP_URL . "recursos");
                exit;
            }
        } else {
            // Validar URL/Video
            $contenido = $_POST['contenido_recurso'] ?? '';
            if (empty($contenido)) {
                \Lib\Alert::error('Error', 'Debe ingresar una URL/Video');
                header("Location:" . APP_URL . "recursos");
                exit;
            }
        }

        // Insertar en la base de datos
        if($recursoModel->create(
            [
              'descripcion_recurso'=>$descripcion,
              'clasificacion_recurso'=>$clasificacion,
              'tipo_recurso'=>$tipo,
              'estado'=>$estado,
              'contenido_recurso'=>$contenido,
              'fyh_creacion'=>$fyh_creacion
            ]
        )
        ) {
            \Lib\Alert::success('Éxito', 'Recurso creado correctamente');
            header("Location:" . APP_URL . "recursos");
        }else{
            \Lib\Alert::error('Error', 'Error al crear el recurso');
            header("Location:" . APP_URL . "recursos");
        }
    }
}
