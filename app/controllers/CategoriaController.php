<?php

namespace App\Controllers;

use App\Models\Categoria;
use Exception;
use Lib\Alert;

class CategoriaController extends Controller
{
    private $categoriaModel;

    public function __construct()
    {
        $this->categoriaModel = new Categoria();
    }

    public function index()
    {
        return $this->view(
            'categorias',
            [
            'categorias' => $this->categoriaModel->getAllCategorias(),
            'subcategorias' => $this->categoriaModel->getAllSubcategorias()
            ]
        );
    }

    public function createCategoria()
    {
        try {
            // Validación de método HTTP
            if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
                throw new Exception('Método no permitido');
            }

            // Control de permisos
            session_start();
            if (!in_array("Crear Categorias", $_SESSION['permisos'])) {
                throw new Exception("No tiene permiso para crear categorias");
            }
            //Validación de campos
            $nombre_categoria = $_POST['nombre_categoria'];
            if (empty($nombre_categoria)) {
                throw new Exception('Todos los campos son obligatorios');
            }
            if (!$this->categoriaModel->createCategoria($nombre_categoria)) {
                Alert::error('Error', 'Error al crear la categoria');
            }
            Alert::success('Éxito', 'Categoria creada correctamente');
        } catch (Exception $e) {
            Alert::error('Error', $e->getMessage());
        }
        $this->redirectToCategorias();
    }

    public function createSubcategoria()
    {
        try {
            // Validación de método HTTP
            if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
                throw new Exception('Método no permitido');
            }

            // Control de permisos
            session_start();
            if (!in_array("Crear Categorias", $_SESSION['permisos'])) {
                throw new Exception("No tiene permiso para crear categorias");
            }
            //Validación de campos
            $id_categoria = $_POST['id_categoria'];
            $nombre_subcategoria = $_POST['nombre_subcategoria'];
            if (empty($id_categoria) || empty($id_categoria)) {
                throw new Exception('Todos los campos son obligatorios');
            }
            if (!$this->categoriaModel->createSubcategoria(['nombre_subcategoria' => $nombre_subcategoria, 'id_categoria' => $id_categoria])) {
                Alert::error('Error', 'Error al crear la subcategoria');
            }
            Alert::success('Éxito', 'Subcategoria creada correctamente');
        } catch (Exception $e) {
            Alert::error('Error', $e->getMessage());
        }
        $this->redirectToCategorias();
    }

    public function updateCategoria($id_categoria)
    {
        try {
            // validar metodo
            if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
                throw new Exception('Metodo no permitido');
            }
            //validar permisos
            session_start();
            if (!in_array("Editar Categorias", $_SESSION['permisos'])) {
                throw new Exception("No tiene permiso para editar categorias");
            }
            // validar datos
            if (empty($id_categoria) || empty($_POST['nombre_categoria'])) {
                throw new Exception('Todos los campos son obligatorios');
            }
            //Editar en la BD
            if (!$this->categoriaModel->updateCategoria(
                [
                'id_categoria' => $id_categoria,
                'nombre_categoria' => $_POST['nombre_categoria']
                ]
            )
            ) {
                throw new Exception('Error al editar la categoria en la base de datos');
            }
            Alert::success('Éxito', 'Categoria editada correctamente');
        } catch (Exception $e) {
            Alert::error('Error', $e->getMessage());
        }
        $this->redirectToCategorias();
    }

    public function updateSubcategoria($id_subcategoria)
    {
        try {
            // validar metodo
            if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
                throw new Exception('Metodo no permitido');
            }
            //validar permisos
            session_start();
            if (!in_array("Editar Categorias", $_SESSION['permisos'])) {
                throw new Exception("No tiene permiso para editar categorias");
            }
            // validar datos
            if (empty($id_subcategoria) || empty($_POST['nombre_subcategoria']) || empty($_POST['id_categoria'])) {
                throw new Exception('Todos los campos son obligatorios');
            }
            //Editar en la BD
            if (!$this->categoriaModel->updateSubcategoria(
                [
                'id_categoria' => $_POST['id_categoria'],
                'nombre_subcategoria' => $_POST['nombre_subcategoria'],
                'id_subcategoria' => $id_subcategoria
                ]
            )
            ) {
                throw new Exception('Error al editar la categoria en la base de datos');
            }
            Alert::success('Éxito', 'Categoria editada correctamente');
        } catch (Exception $e) {
            Alert::error('Error', $e->getMessage());
        }
        $this->redirectToCategorias();
    }

    public function deleteCategoria($id_categoria)
    {
        try {
            //validar metodo
            if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
                throw new Exception('Metodo no permitido');
            }
            //validar permiso
            session_start();
            if (!in_array("Eliminar Categorias", $_SESSION['permisos'])) {
                throw new Exception("No tiene permiso para eliminar categorias");
            }
            //validar datos
            if (empty($id_categoria)) {
                throw new Exception('Todos los campos son obligatorios');
            }
            //validar si tiene subcategorias
            if ($this->categoriaModel->getSubcategoriasByCategoria($id_categoria)) {
                throw new Exception('No se puede eliminar una categoria con subcategorias');
            }
            // eliminar en la BD
            if (!$this->categoriaModel->deleteCategoria($id_categoria)) {
                throw new Exception('Error al eliminar la categoria en la base de datos');
            }
            Alert::success('Éxito', 'Categoria eliminada correctamente');
        } catch (Exception $e) {
            Alert::error('Error', $e->getMessage());
        }
        $this->redirectToCategorias();
    }

    public function deleteSubcategoria($id_subcategoria)
    {
        try {
            //validar metodo
            if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
                throw new Exception('Metodo no permitido');
            }
            //validar permiso
            session_start();
            if (!in_array("Eliminar Categorias", $_SESSION['permisos'])) {
                throw new Exception("No tiene permiso para eliminar categorias");
            }
            //validar datos
            if (empty($id_subcategoria)) {
                throw new Exception('Todos los campos son obligatorios');
            }
            //validar si tiene recursos
            if ($this->categoriaModel->getRecursosBySubcategoria($id_subcategoria)) {
                throw new Exception('No se puede eliminar una subcategoria con recursos');
            }
            // eliminar en la BD
            if (!$this->categoriaModel->deleteSubcategoria($id_subcategoria)) {
                throw new Exception('Error al eliminar la subcategoria en la base de datos');
            }
            Alert::success('Éxito', 'Categoria eliminada correctamente');
        } catch (Exception $e) {
            Alert::error('Error', $e->getMessage());
        }
        $this->redirectToCategorias();
    }
    protected function redirectToCategorias()
    {
        header("Location: " . APP_URL . "categorias");
        exit;
    }
}
