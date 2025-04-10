<?php
/* ========================================================
 * ============ Home Controller ======================
 * ======================================================*/

namespace App\Controllers;
use App\Models\Recurso;
use Exception;

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

    public function update($id)
    {
        $recursoModel = new Recurso();
        try {
            // Obtener datos actuales
            $recurso_actual = $recursoModel->getRecurso($id);

            if (!$recurso_actual) {
                throw new Exception("Recurso no encontrado");
            }

            $nuevo_contenido = $recurso_actual['contenido_recurso'];
            $eliminar_archivo = false;

            // Procesar nuevo archivo
            if ($_POST['tipo_recurso'] === 'Archivo' && !empty($_FILES['contenido_recurso']['name'])) {
                $directorio = $_SERVER['DOCUMENT_ROOT'] . '/files/';
                $nombre_archivo = uniqid() . '_' . basename($_FILES['contenido_recurso']['name']);
                $ruta_destino = $directorio . $nombre_archivo;

                // Validar y subir archivo
                if (!move_uploaded_file($_FILES['contenido_recurso']['tmp_name'], $ruta_destino)) {
                    throw new Exception("Error al subir el archivo");
                }
        
                $nuevo_contenido = $nombre_archivo;
                $eliminar_archivo = true;
            } 
            elseif ($_POST['tipo_recurso'] !== 'Archivo') {
                $nuevo_contenido = $_POST['contenido_recurso'];
                $eliminar_archivo = ($recurso_actual['tipo_recurso'] === 'Archivo');
            }

            // Eliminar archivo anterior si es necesario
            if ($eliminar_archivo && $recurso_actual['tipo_recurso'] === 'Archivo') {
                $ruta_anterior = $_SERVER['DOCUMENT_ROOT'] . '/files/' . $recurso_actual['contenido_recurso'];
        
                if (file_exists($ruta_anterior)) {
                    if (!unlink($ruta_anterior)) {
                        throw new Exception("No se pudo eliminar: $ruta_anterior");
                    }
                } else {
                    throw new Exception("Archivo anterior no encontrado: $ruta_anterior");
                }
            }

            // Actualizar BD
            if($recursoModel->update(
                [
                'id_recurso'=>$id,
                'descripcion_recurso'=>$_POST['descripcion_recurso'],
                'tipo_recurso'=>$_POST['tipo_recurso'],
                'clasificacion_recurso'=>$_POST['clasificacion_recurso'],
                'contenido_recurso'=>$nuevo_contenido,
                'fyh_modificacion'=>date('Y-m-d H:i:s'),
                ]
            )
            ) {
                \Lib\Alert::success('Éxito', 'Recurso modificado correctamente');
            }else{
                \Lib\Alert::error('Error', 'Error al modificar el recurso en la base de datos');
            }
        } catch (Exception $e) {
            \Lib\Alert::error('Error', $e->getMessage());
        }finally{
            header("Location: " . APP_URL . "recursos");
            exit;
        }
    }

    public function delete($id)
    {
        $recursoModel = new Recurso();
        // Verificar método POST y parámetros
        if ($_SERVER['REQUEST_METHOD'] !== 'POST' || !isset($id)) {
            \Lib\Alert::error('Error', 'El recurso no existe');
            header("Location:" . APP_URL . "recursos");
            exit;
        }

        try {
            // Obtener datos del recurso ANTES de eliminar
            $recurso = $recursoModel->getRecurso($id);

            if (!$recurso) {
                throw new Exception("Recurso no encontrado");
            }

            // Si el recurso es de tipo 'Archivo', proceder a eliminar el archivo físico
            if ($recurso['tipo_recurso'] === 'Archivo') {
                $url_contenido = $recurso['contenido_recurso'];

                // Definir la ruta base y asegurarse de que termina en "/"
                $ruta_base = rtrim($_SERVER['DOCUMENT_ROOT'], '/') . "/files/";
        
                // Obtener el nombre del archivo a partir de la URL
                $ruta_url = parse_url($url_contenido, PHP_URL_PATH);
                $nombre_archivo = basename($ruta_url);
                $ruta_completa = $ruta_base . $nombre_archivo;

                // Verificar que las rutas sean válidas
                $ruta_real = realpath($ruta_completa);
                $ruta_base_real = realpath($ruta_base);
                if (!$ruta_real || strpos($ruta_real, $ruta_base_real) !== 0) {
                    throw new Exception("Ruta de archivo inválida: " . $ruta_completa);
                }

                // Comprobar que el archivo existe y se intenta eliminar
                if (file_exists($ruta_completa)) {
                    if (!unlink($ruta_completa)) {
                        throw new Exception("Error al eliminar el archivo: " . $ruta_completa);
                    }
                } else {
                    // Si el archivo no existe, se registra una advertencia y se continúa
                    error_log("Advertencia: El archivo no existe en la ruta: " . $ruta_completa);
                }
            }

            // Eliminar el registro de la base de datos
            if($recursoModel->delete($id)) {
                \Lib\Alert::success('Éxito', 'Recurso eliminado correctamente');
                header("Location:" . APP_URL . "recursos");
                exit;
            }else {
                \Lib\Alert::error('Error', 'Error al eliminar el recurso de la base de datos');
                header("Location:" . APP_URL . "recursos");
                exit;
            }
        } catch (Exception $e) {
            \Lib\Alert::error('Error', $e->getMessage());
        } catch (Exception $e) {
            \Lib\Alert::error('Error', $e->getMessage());
        }

        header("Location:" . APP_URL . "recursos");
        exit;
    }
}
