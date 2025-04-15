<?php
/**
 * Controlador para la gestión del Login del sistema
 * 
 * Maneja las operaciones del login y logout del sistema
 * - Login
 * - Logout
 * - Registro de usuarios
 */

namespace App\Controllers;
use App\Models\Usuario;
use Lib\Alert;


class LoginController extends Controller
{
    // Instancia del modelo Recurso
    protected $usuarioModel;

    /**
     * Constructor - Inicializa dependencias y configuración
     */
    public function __construct()
    {
        $this->usuarioModel = new Usuario();
    }

    /**
     * Renderiza la vista de login
     *
     * @return View Vista de login
     */
    public function index()
    {
        return $this->view('login');
    }

    /**
     * Renderiza la vista de registro
     *
     * @return View Vista de registro
     */
    public function registro()
    {
        return $this->view('registro');
    }

    /**
     * Logica de login
     *
     * @return View Home con los datos de session
     */
    public function login()
    {
        $password_usuario = $_POST['password_usuario'];
        $email = filter_var($_POST['email_usuario'] ?? '', FILTER_SANITIZE_EMAIL);

        $usuario = $this->usuarioModel->getByEmail($email);

        if (password_verify($password_usuario, $usuario['password_usuario'])) {
            session_start();
            $_SESSION['usuario_id'] = $usuario['id_usuario'];
            $_SESSION['email'] = $email;
            $_SESSION['nombre'] = $usuario['nombre_usuario'];
            $_SESSION['rol'] = $usuario['id_rol'];
            header("Location:" . APP_URL);
        } else {
            session_start();
            $_SESSION['email'] = $email;
            Alert::error('Error', 'Credenciales incorrectas');
            header("Location:" . APP_URL . "login");
        }
    }

    /**
     * Logica de logout
     */
    public function logout()
    {
        session_start();
        session_destroy();
        header("Location:" . APP_URL . "login");
        exit();
    }
    public function registrarse()
    {
        var_dump($_POST);
        die();
    }
}
