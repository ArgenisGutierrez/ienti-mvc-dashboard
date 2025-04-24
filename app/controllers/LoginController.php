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
use Exception;
use Lib\Alert;
use Lib\Mailer;

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

    public function forgetPassword()
    {
        return $this->view('forgetPassword');
    }

    public function formChangePassword($token)
    {
        return $this->view('changePassword', ['token'=>$token]);
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
        if (!$usuario) {
            Alert::error('Error', 'El usuario no existe');
            header("Location:" . APP_URL . "login");
            exit();
        }
        if($usuario['estado'] != 1) {
            Alert::error('Error', 'El usuario se encuentra inactivo');
            header("Location:" . APP_URL . "login");
            exit();
        }

        if (password_verify($password_usuario, $usuario['password_usuario'])) {
            session_start();
            $_SESSION['usuario_id'] = $usuario['id_usuario'];
            $_SESSION['email'] = $email;
            $_SESSION['nombre'] = $usuario['nombre_usuario'];
            $_SESSION['imagen'] = $usuario['imagen_usuario'];
            $_SESSION['rol'] = $usuario['id_rol'];
            header("Location:" . APP_URL);
            exit();
        } else {
            session_start();
            $_SESSION['email'] = $email;
            Alert::error('Error', 'Credenciales incorrectas');
            header("Location:" . APP_URL . "login");
            exit();
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
        $nombre = $_POST['nombre'];
        $email_usuario= filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
        $password_usuario = $_POST['password'];
        $password_confirm = $_POST['password_confirm'];
        $verification_token = bin2hex(random_bytes(50));
        $terms = $_POST['terms'];
        $fyh_creacion = date('Y-m-d H:i:s');

        try {
            if ($terms !== 'true') {
                throw new Exception("No puedes registrar un usuario si no aceptas los términos y condiciones", 1);
            } 

            if ($password_usuario !== $password_confirm) {
                throw new Exception("Las contraseñas no coinciden", 1);
            }
            $mailer = new Mailer();
            $data = [
              'nombre' => $nombre,
              'link' => APP_URL . "verify/" . $verification_token
            ];
            $mail = $mailer->sendTemplate($email_usuario, "Activación de cuenta", '../resources/templates/confirm.php', $data);
            if (!$mail) {
                Alert::error('Error', 'Error al enviar el correo');
                header("Location:" . APP_URL . "registro");
                exit();
            }

            if($this->usuarioModel->create(
                [
                'nombre_usuario' => $nombre,
                'email_usuario' => $email_usuario,
                'password_usuario' => password_hash($password_usuario, PASSWORD_DEFAULT),
                'verification_token' => $verification_token,
                'id_rol' => 2,
                'fyh_creacion' => $fyh_creacion,
                'estado' =>'0',
                ]
            )
            ) {
                Alert::success('Exito', 'Registro exitoso, revisa tu correo para activar tu cuenta');
                header("Location:" . APP_URL . "login");
                exit();
            }else {
                throw new Exception("Error al registrar el usuario en la db", 1);
            }
        } catch (Exception $e) {
            Alert::error('Error', $e->getMessage());
            header("Location:" . APP_URL . "registro");
            exit();
        }
    }

    public function verificar($token)
    {
        $usuario = $this->usuarioModel->getByToken($token);
        if($usuario['estado'] == 1) {
            Alert::info('Cuenta ya verificada', 'La cuenta ya ha sido verificada anteriormente');
            header("Location:" . APP_URL . "login");
            exit();
        }

        if($this->usuarioModel->verifyUser($usuario['id_usuario'])
        ) {
            Alert::success('Cuenta verificada', 'La cuenta ha sido verificada con exito');
            header("Location:" . APP_URL . "login");
            exit();
        }else {
            Alert::error('Error al verificar la cuenta', 'Error al verificar la cuenta en la db');
            header("Location:" . APP_URL . "login");
            exit();
        }
    }

    public function comprobacionCorreo()
    {
        $email_usuario=$_POST['email_usuario'];
        $usuario = $this->usuarioModel->getByEmail($email_usuario);
        if(!$usuario) {
            Alert::error('Error', 'El correo no existe');
            header("Location:" . APP_URL . "forgetPassword");
            exit();
        }
        $mailer = new Mailer();
        $datos=[
          'nombre' => $usuario['nombre_usuario'],
          'link' => APP_URL . "changePassword/" . $usuario['verification_token']
        ];
        $mail= $mailer->sendTemplate($email_usuario, "Cambio de contraseña", '../resources/templates/change.php', $datos);
        Alert::info('Correo enviado', 'Revisa tu correo para cambiar tu contraseña');
        header("Location:" . APP_URL . "login");
        exit();
    }

    public function changePassword()
    {
        $password = $_POST['password'];
        $password_confirm = $_POST['password_confirm'];
        if($password !== $password_confirm) {
            Alert::error('Error', 'Las contraseñas no coinciden');
            header("Location:" . APP_URL . "changePassword/" . $_POST['token']);
            exit();
        }
        $password = password_hash($password, PASSWORD_DEFAULT);
        $usuario = $this->usuarioModel->getByToken($_POST['token']);
        $token = bin2hex(random_bytes(50));
        if($this->usuarioModel->changePassword(
            [
            'password_usuario'=>$password,
            'id_usuario'=>$usuario['id_usuario'],
            'token'=>$token
            ]
        )
        ) {
            Alert::success('Exito', 'Contraseña cambiada con exito');
            header("Location:" . APP_URL . "login");
            exit();
        }else {
            Alert::error('Error', 'Error al cambiar la contraseña en la db');
            header("Location:" . APP_URL . "changePassword/" . $_POST['token']);
            exit();
        }
    }
}
