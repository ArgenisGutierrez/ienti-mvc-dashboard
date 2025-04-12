<?php
namespace App\Controllers;

use App\Models\Recurso;
use Exception;
use Lib\Alert;

class RecursoController extends Controller
{
    protected $recursoModel;
    protected $uploadDir;

    public function __construct()
    {
        $this->recursoModel = new Recurso();
        $this->uploadDir = $_SERVER['DOCUMENT_ROOT'] . '/files/';
        $this->createUploadDir();
    }

    public function index()
    {
        $recursos = $this->recursoModel->getAllRecursos();
        return $this->view('recursos', ['recursos' => $recursos]);
    }

    public function create()
    {
        try {
            // Validación básica
            $this->validateRequiredFields($_POST, ['descripcion_recurso', 'clasificacion_recurso', 'tipo_recurso']);
            
            $data = $this->prepareData();
            
            if($this->recursoModel->create($data)) {
                Alert::success('Éxito', 'Recurso creado correctamente');
            } else {
                Alert::error('Error', 'Error al crear el recurso');
            }
        } catch (Exception $e) {
            Alert::error('Error', $e->getMessage());
        }
        $this->redirectToRecursos();
    }

    public function update($id)
    {
        try {
            $recurso = $this->getRecurso($id);
            $data = $this->prepareUpdateData($id, $recurso);
            
            if($this->recursoModel->update($data)) {
                Alert::success('Éxito', 'Recurso actualizado correctamente');
            } else {
                Alert::error('Error', 'Error al actualizar el recurso');
            }
        } catch (Exception $e) {
            Alert::error('Error', $e->getMessage());
        }
        $this->redirectToRecursos();
    }

    public function delete($id)
    {
        try {
            $this->validatePostRequest();
            $recurso = $this->getRecurso($id);
            $this->deleteFileIfNeeded($recurso);
            
            if($this->recursoModel->delete($id)) {
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
    protected function validateRequiredFields($input, $fields)
    {
        foreach ($fields as $field) {
            if (empty($input[$field])) {
                throw new Exception('Todos los campos son obligatorios');
            }
        }
    }

    protected function prepareData()
    {
        $tipo = $_POST['tipo_recurso'];
        $contenido = $this->handleContent($tipo);

        return [
            'descripcion_recurso' => $_POST['descripcion_recurso'],
            'clasificacion_recurso' => $_POST['clasificacion_recurso'],
            'tipo_recurso' => $tipo,
            'estado' => '1',
            'contenido_recurso' => $contenido,
            'fyh_creacion' => date('Y-m-d H:i:s')
        ];
    }

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

    protected function handleFileUpload()
    {
        if (!isset($_FILES['contenido_recurso']) || $_FILES['contenido_recurso']['error'] !== UPLOAD_ERR_OK) {
            throw new Exception('Debe seleccionar un archivo válido');
        }

        $nombreArchivo = uniqid() . '_' . basename($_FILES['contenido_recurso']['name']);
        $rutaDestino = $this->uploadDir . $nombreArchivo;

        if (!move_uploaded_file($_FILES['contenido_recurso']['tmp_name'], $rutaDestino)) {
            throw new Exception('Error al subir el archivo');
        }

        return $nombreArchivo;
    }

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

    protected function handleUpdateContent($recurso, $nuevoTipo)
    {
        $nuevoContenido = $recurso['contenido_recurso'];

        if ($nuevoTipo === 'Archivo' && !empty($_FILES['contenido_recurso']['name'])) {
            $this->deleteOldFile($recurso['contenido_recurso']);
            $nuevoContenido = $this->handleFileUpload();
        } elseif ($nuevoTipo !== 'Archivo') {
            $nuevoContenido = $_POST['contenido_recurso'];
            if ($recurso['tipo_recurso'] === 'Archivo') {
                $this->deleteOldFile($recurso['contenido_recurso']);
            }
        }

        return $nuevoContenido;
    }

    protected function deleteOldFile($nombreArchivo)
    {
        $rutaArchivo = $this->uploadDir . basename($nombreArchivo);
        if (file_exists($rutaArchivo)) {
            unlink($rutaArchivo);
        }
    }

    protected function getRecurso($id)
    {
        $recurso = $this->recursoModel->getRecurso($id);
        if (!$recurso) {
            throw new Exception('Recurso no encontrado');
        }
        return $recurso;
    }

    protected function validatePostRequest()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            throw new Exception('Método no permitido');
        }
    }

    protected function deleteFileIfNeeded($recurso)
    {
        if ($recurso['tipo_recurso'] === 'Archivo') {
            $this->deleteOldFile($recurso['contenido_recurso']);
        }
    }

    protected function createUploadDir()
    {
        if (!file_exists($this->uploadDir)) {
            mkdir($this->uploadDir, 0755, true);
        }
    }

    protected function redirectToRecursos()
    {
        header("Location: " . APP_URL . "recursos");
        exit;
    }
}
