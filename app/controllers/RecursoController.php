<?php

/**
 * Controlador para la gestión de Recursos
 * 
 * Maneja todas las operaciones CRUD para los recursos del sistema incluyendo:
 * - Listado y visualización de recursos
 * - Creación de nuevos recursos con manejo de archivos
 * - Actualización de recursos existentes
 * - Eliminación segura de recursos con limpieza de archivos
 * 
 * @package App\Controllers
 */

namespace App\Controllers;

use App\Models\Recurso;
use App\Models\Categoria;
use Exception;
use Lib\Alert;

class RecursoController extends Controller
{
    /**
     * @var Recurso Instancia del modelo de Recursos
     */
    protected $recursoModel;
    protected $categoriaModel;

    /**
     * @var string Directorio para almacenamiento de archivos subidos
     */
    protected $uploadDir;

    /**
     * Constructor - Inicializa configuración y dependencias
     */
    public function __construct()
    {
        $this->recursoModel = new Recurso();
        $this->categoriaModel = new Categoria();
        $this->uploadDir = $_SERVER['DOCUMENT_ROOT'] . '/files/'; // Configura ruta absoluta
        $this->createUploadDir(); // Asegura que exista el directorio
    }

    /**
     * Muestra el listado completo de recursos
     *
     * @return View Vista de recursos con datos
     */
    public function index()
    {
        $recursos = $this->recursoModel->getAllRecursos();
        $categorias = $this->categoriaModel->getAllCategorias();
        $subcategorias = $this->categoriaModel->getAllSubcategorias();
        return $this->view('recursos', ['recursos' => $recursos, 'categorias' => $categorias, 'subcategorias' => $subcategorias]);
    }

    /**
     * Procesa la creación de nuevos recursos
     *
     * @return void Redirecciona con mensajes de estado
     */
    public function create()
    {
        try {
            // Validación de método HTTP
            if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
                throw new Exception('Método no permitido');
            }

            // Control de permisos
            session_start();
            if (!in_array("Crear Recursos", $_SESSION['permisos'])) {
                throw new Exception("No tiene permiso para crear recursos");
            }

            // Validación de campos requeridos
            $this->validateRequiredFields($_POST, ['descripcion_recurso', 'id_subcategoria', 'tipo_recurso']);

            // Preparar y validar datos
            $data = $this->prepareData();

            // Intentar creación en base de datos
            if ($this->recursoModel->create($data)) {
                Alert::success('Éxito', 'Recurso creado correctamente');
            } else {
                Alert::error('Error', 'Error al crear el recurso');
            }
        } catch (Exception $e) {
            Alert::error('Error', $e->getMessage());
        }
        $this->redirectToRecursos();
    }

    /**
     * Actualiza un recurso existente
     *
     * @param  int $id ID del recurso a actualizar
     * @return void Redirecciona con mensajes de estado
     */
    public function update($id)
    {
        try {
            // Validar método HTTP
            if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
                throw new Exception('Método no permitido');
            }

            // Control de permisos
            session_start();
            if (!in_array("Editar Recursos", $_SESSION['permisos'])) {
                throw new Exception("No tiene permiso para editar recursos");
            }

            // Obtener y validar recurso existente
            $recurso = $this->getRecurso($id);

            // Preparar datos para actualización
            $data = $this->prepareUpdateData($id, $recurso);

            // Intentar actualización
            if ($this->recursoModel->update($data)) {
                Alert::success('Éxito', 'Recurso actualizado correctamente');
            } else {
                Alert::error('Error', 'Error al actualizar el recurso');
            }
        } catch (Exception $e) {
            Alert::error('Error', $e->getMessage());
        }
        $this->redirectToRecursos();
    }

    /**
     * Elimina un recurso de forma segura
     *
     * @param  int $id ID del recurso a eliminar
     * @return void Redirecciona con mensajes de estado
     */
    public function delete($id)
    {
        try {
            session_start();
            // Control de permisos
            if (!in_array("Eliminar Recursos", $_SESSION['permisos'])) {
                throw new Exception("No tiene permiso para borrar recursos");
            }

            // Validar método HTTP
            $this->validatePostRequest();

            // Obtener y validar recurso
            $recurso = $this->getRecurso($id);

            // Eliminar archivo asociado si existe
            $this->deleteFileIfNeeded($recurso);

            // Intentar eliminación en base de datos
            if ($this->recursoModel->delete($id)) {
                Alert::success('Éxito', 'Recurso eliminado correctamente');
            } else {
                Alert::error('Error', 'Error al eliminar el recurso');
            }
        } catch (Exception $e) {
            Alert::error('Error', $e->getMessage());
        }
        $this->redirectToRecursos();
    }

    /************************************
     * Métodos auxiliares protegidos *
     ************************************/

    /**
     * Valida campos obligatorios en un formulario
     *
     * @param  array $input  Datos de entrada
     * @param  array $fields Campos requeridos
     * @throws Exception Si falta algún campo requerido
     */
    protected function validateRequiredFields($input, $fields)
    {
        foreach ($fields as $field) {
            if (empty($input[$field])) {
                throw new Exception('Todos los campos son obligatorios');
            }
        }
    }

    /**
     * Prepara los datos para creación de recursos
     *
     * @return array Datos formateados para inserción
     * @throws Exception Si hay error en el archivo o contenido
     */
    protected function prepareData()
    {
        $tipo = $_POST['tipo_recurso'];
        if ($tipo !== 'Archivo') {
            $url = $_POST['contenido_recurso'];
            // Corregir "https:" -> "https://"
            $url = preg_replace('/^https?:/', '$0//', $url);

            $_POST['contenido_recurso'] = $url;
        }
        $contenido = $this->handleContent($tipo);

        return [
        'descripcion_recurso' => $_POST['descripcion_recurso'],
        'id_subcategoria' => $_POST['id_subcategoria'],
        'tipo_recurso' => $tipo,
        'estado' => '1', // Estado activo por defecto
        'contenido_recurso' => $contenido,
        'fyh_creacion' => date('Y-m-d H:i:s')
        ];
    }

    /**
     * Maneja el contenido según el tipo de recurso
     *
     * @param  string $tipo Tipo de recurso (Archivo/URL/Video)
     * @return string Contenido procesado
     * @throws Exception Si hay error en validación
     */
    protected function handleContent($tipo)
    {
        if ($tipo === 'Archivo') {
            return $this->handleFileUpload();
        }

        if (empty($_POST['contenido_recurso'])) {
            throw new Exception('Debe ingresar una URL/Video');
        }

        return $_POST['contenido_recurso'];
    }

    /**
     * Maneja la subida segura de archivos
     *
     * @return string Nombre del archivo subido
     * @throws Exception Si hay error en la subida
     */
    protected function handleFileUpload()
    {
        // Validar existencia de archivo
        if (!isset($_FILES['contenido_recurso']) || $_FILES['contenido_recurso']['error'] !== UPLOAD_ERR_OK) {
            throw new Exception('Debe seleccionar un archivo válido');
        }

        // Generar nombre único para evitar colisiones
        $nombreArchivo = uniqid() . '_' . basename($_FILES['contenido_recurso']['name']);
        $rutaDestino = $this->uploadDir . $nombreArchivo;

        // Mover archivo temporal a destino final
        if (!move_uploaded_file($_FILES['contenido_recurso']['tmp_name'], $rutaDestino)) {
            throw new Exception('Error al subir el archivo');
        }

        return $nombreArchivo;
    }

    /**
     * Prepara datos para actualización de recursos
     *
     * @param  int   $id      ID del recurso
     * @param  array $recurso Datos actuales del recurso
     * @return array Datos actualizados para guardar
     */
    protected function prepareUpdateData($id, $recurso)
    {
        $tipo = $_POST['tipo_recurso'];
        $contenido = $this->handleUpdateContent($recurso, $tipo);

        return [
        'id_recurso' => $id,
        'descripcion_recurso' => $_POST['descripcion_recurso'],
        'clasificacion_recurso' => $_POST['clasificacion_recurso'],
        'tipo_recurso' => $tipo,
        'contenido_recurso' => $contenido,
        'fyh_modificacion' => date('Y-m-d H:i:s')
        ];
    }

    /**
     * Maneja el contenido durante actualizaciones
     *
     * @param  array  $recurso   Recurso existente
     * @param  string $nuevoTipo Nuevo tipo de recurso
     * @return string Nuevo contenido procesado
     */
    protected function handleUpdateContent($recurso, $nuevoTipo)
    {
        $nuevoContenido = $recurso['contenido_recurso'];

        // Manejar nuevo archivo si es necesario
        if ($nuevoTipo === 'Archivo' && !empty($_FILES['contenido_recurso']['name'])) {
            $this->deleteOldFile($recurso['contenido_recurso']);
            $nuevoContenido = $this->handleFileUpload();
        } elseif ($nuevoTipo !== 'Archivo') {
            $nuevoContenido = $_POST['contenido_recurso'];
            // Eliminar archivo anterior si cambiaba de tipo
            if ($recurso['tipo_recurso'] === 'Archivo') {
                $this->deleteOldFile($recurso['contenido_recurso']);
            }
        }

        return $nuevoContenido;
    }

    /**
     * Elimina archivos antiguos del sistema
     *
     * @param string $nombreArchivo Nombre del archivo a eliminar
     */
    protected function deleteOldFile($nombreArchivo)
    {
        $rutaArchivo = $this->uploadDir . basename($nombreArchivo);
        if (file_exists($rutaArchivo)) {
            unlink($rutaArchivo);
        }
    }

    /**
     * Obtiene y valida un recurso por ID
     *
     * @param  int $id ID del recurso
     * @return array Datos del recurso
     * @throws Exception Si no se encuentra el recurso
     */
    protected function getRecurso($id)
    {
        $recurso = $this->recursoModel->getRecurso($id);
        if (!$recurso) {
            throw new Exception('Recurso no encontrado');
        }
        return $recurso;
    }

    /**
     * Valida que la petición sea POST
     *
     * @throws Exception Si no es método POST
     */
    protected function validatePostRequest()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            throw new Exception('Método no permitido');
        }
    }

    /**
     * Elimina archivos asociados si el recurso es tipo Archivo
     *
     * @param array $recurso Datos del recurso
     */
    protected function deleteFileIfNeeded($recurso)
    {
        if ($recurso['tipo_recurso'] === 'Archivo') {
            $this->deleteOldFile($recurso['contenido_recurso']);
        }
    }

    /**
     * Crea el directorio de uploads si no existe
     */
    protected function createUploadDir()
    {
        if (!file_exists($this->uploadDir)) {
            mkdir($this->uploadDir, 0755, true);
        }
    }

    /**
     * Redirecciona al listado de recursos
     */
    protected function redirectToRecursos()
    {
        header("Location: " . APP_URL . "recursos");
        exit;
    }
}
