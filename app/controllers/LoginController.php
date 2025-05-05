<?php

/**
 * Controlador para la gestión del Login del sistema
 * 
 * Maneja las operaciones relacionadas con la autenticación de usuarios:
 * - Login y logout de usuarios
 * - Registro y verificación de cuentas
 * - Recuperación y cambio de contraseñas
 * 
 * @package App\Controllers
 */

namespace App\Controllers;

use App\Models\Usuario;
use App\Models\Permiso;
use Exception;
use Lib\Alert;
use Lib\Mailer;

class LoginController extends Controller
{
  /**
   * @var Usuario Instancia del modelo de Usuario
   */
  protected $usuarioModel;

  /**
   * @var Permiso Instancia del modelo de Permisos
   */
  protected $permisoModel;

  /**
   * Constructor - Inicializa los modelos necesarios
   */
  public function __construct()
  {
    $this->usuarioModel = new Usuario();
    $this->permisoModel = new Permiso();
  }

  /**
   * Muestra la vista de login
   *
   * @return View Vista de inicio de sesión
   */
  public function index()
  {
    return $this->view('login');
  }

  /**
   * Muestra la vista de registro de usuarios
   *
   * @return View Vista de registro
   */
  public function registro()
  {
    return $this->view('registro');
  }

  /**
   * Muestra la vista para recuperación de contraseña
   *
   * @return View Vista de olvidó contraseña
   */
  public function forgetPassword()
  {
    return $this->view('forgetPassword');
  }

  /**
   * Muestra el formulario para cambiar contraseña con token de verificación
   *
   * @param  string $token Token de verificación para cambio de contraseña
   * @return View Vista de cambio de contraseña
   */
  public function formChangePassword($token)
  {
    return $this->view('changePassword', ['token' => $token]);
  }

  /**
   * Maneja el proceso de autenticación de usuarios
   *
   * @return void Redirecciona al home o muestra errores
   */
  public function login()
  {
    // Obtener y sanitizar credenciales
    $password_usuario = $_POST['password_usuario'];
    $email = filter_var($_POST['email_usuario'] ?? '', FILTER_SANITIZE_EMAIL);

    // Buscar usuario por email
    $usuario = $this->usuarioModel->getByEmail($email);

    // Validaciones de usuario
    if (!$usuario) {
      Alert::error('Error', 'El usuario no existe');
      header("Location:" . APP_URL . "login");
      exit();
    }

    if ($usuario['estado'] != 1) {
      Alert::error('Error', 'El usuario se encuentra inactivo');
      header("Location:" . APP_URL . "login");
      exit();
    }

    // Verificar contraseña
    if (password_verify($password_usuario, $usuario['password_usuario'])) {
      // Iniciar sesión y crear variables de sesión
      session_start();
      $_SESSION['usuario_id'] = $usuario['id_usuario'];
      $_SESSION['email'] = $email;
      $_SESSION['nombre'] = $usuario['nombre_usuario'];
      $_SESSION['imagen'] = $usuario['imagen_usuario'];
      $_SESSION['rol'] = $usuario['id_rol'];
      $_SESSION['permisos'] = $this->permisoModel->getNombrePermisoById($usuario['id_rol']);

      header("Location:" . APP_URL);
      exit();
    } else {
      // Manejar credenciales incorrectas
      session_start();
      $_SESSION['email'] = $email;
      Alert::error('Error', 'Credenciales incorrectas');
      header("Location:" . APP_URL . "login");
      exit();
    }
  }

  /**
   * Cierra la sesión del usuario
   *
   * @return void Redirecciona al login
   */
  public function logout()
  {
    session_start();
    session_destroy();
    header("Location:" . APP_URL . "login");
    exit();
  }

  /**
   * Procesa el registro de nuevos usuarios
   *
   * @return void Redirecciona con mensajes de éxito/error
   */
  public function registrarse()
  {
    // Recoger y procesar datos del formulario
    $nombre = $_POST['nombre'];
    $email_usuario = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $password_usuario = $_POST['password'];
    $password_confirm = $_POST['password_confirm'];
    $verification_token = bin2hex(random_bytes(50)); // Token seguro
    $terms = $_POST['terms'];
    $fyh_creacion = date('Y-m-d H:i:s');

    try {
      // Validaciones básicas
      if ($terms !== 'true') {
        throw new Exception("Debes aceptar los términos y condiciones");
      }

      if ($password_usuario !== $password_confirm) {
        throw new Exception("Las contraseñas no coinciden");
      }

      // Enviar correo de verificación
      $mailer = new Mailer();
      $data = [
        'nombre' => $nombre,
        'link' => APP_URL . "verify/" . $verification_token
      ];
      $mail = $mailer->sendTemplate(
        $email_usuario,
        "Activación de cuenta",
        '../resources/templates/confirm.php',
        $data
      );

      if (!$mail) {
        throw new Exception("Error al enviar el correo de verificación");
      }

      // Crear usuario en la base de datos
      $registro_exitoso = $this->usuarioModel->create(
        [
          'nombre_usuario' => $nombre,
          'email_usuario' => $email_usuario,
          'password_usuario' => password_hash($password_usuario, PASSWORD_DEFAULT),
          'verification_token' => $verification_token,
          'id_rol' => 2, // Rol por defecto (probablemente usuario normal)
          'fyh_creacion' => $fyh_creacion,
          'estado' => '0', // Cuenta inactiva hasta verificación
        ]
      );

      if ($registro_exitoso) {
        Alert::success('Éxito', 'Registro exitoso, revisa tu correo para activar tu cuenta');
        header("Location:" . APP_URL . "login");
        exit();
      } else {
        throw new Exception("Error al guardar el usuario en la base de datos");
      }
    } catch (Exception $e) {
      Alert::error('Error', $e->getMessage());
      header("Location:" . APP_URL . "registro");
      exit();
    }
  }

  /**
   * Verifica una cuenta usando el token de verificación
   *
   * @param  string $token Token de verificación
   * @return void Redirecciona con mensajes de estado
   */
  public function verificar($token)
  {
    $usuario = $this->usuarioModel->getByToken($token);

    // Verificar si la cuenta ya está activa
    if ($usuario['estado'] == 1) {
      Alert::info('Información', 'La cuenta ya está verificada');
      header("Location:" . APP_URL . "login");
      exit();
    }

    // Activar cuenta
    if ($this->usuarioModel->verifyUser($usuario['id_usuario'])) {
      Alert::success('Éxito', 'Cuenta verificada correctamente');
      header("Location:" . APP_URL . "login");
      exit();
    } else {
      Alert::error('Error', 'Falló la activación de la cuenta');
      header("Location:" . APP_URL . "login");
      exit();
    }
  }

  /**
   * Maneja la solicitud de recuperación de contraseña
   *
   * @return void Redirecciona con mensajes de estado
   */
  public function comprobacionCorreo()
  {
    $email_usuario = $_POST['email_usuario'];
    $usuario = $this->usuarioModel->getByEmail($email_usuario);

    if (!$usuario) {
      Alert::error('Error', 'El correo no está registrado');
      header("Location:" . APP_URL . "forgetPassword");
      exit();
    }

    // Enviar correo con enlace de recuperación
    $mailer = new Mailer();
    $datos = [
      'nombre' => $usuario['nombre_usuario'],
      'link' => APP_URL . "changePassword/" . $usuario['verification_token']
    ];

    $mailer->sendTemplate(
      $email_usuario,
      "Cambio de contraseña",
      '../resources/templates/change.php',
      $datos
    );

    Alert::info('Información', 'Revisa tu correo para continuar con el cambio de contraseña');
    header("Location:" . APP_URL . "login");
    exit();
  }

  /**
   * Actualiza la contraseña del usuario
   *
   * @return void Redirecciona con mensajes de estado
   */
  public function changePassword()
  {
    // Validar coincidencia de contraseñas
    if ($_POST['password'] !== $_POST['password_confirm']) {
      Alert::error('Error', 'Las contraseñas no coinciden');
      header("Location:" . APP_URL . "changePassword/" . $_POST['token']);
      exit();
    }

    // Generar nuevo hash y token
    $nuevo_hash = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $nuevo_token = bin2hex(random_bytes(50));

    // Actualizar en base de datos
    $actualizacion = $this->usuarioModel->changePassword(
      [
        'password_usuario' => $nuevo_hash,
        'id_usuario' => $this->usuarioModel->getByToken($_POST['token'])['id_usuario'],
        'token' => $nuevo_token // Invalida el token anterior
      ]
    );

    if ($actualizacion) {
      Alert::success('Éxito', 'Contraseña actualizada correctamente');
      header("Location:" . APP_URL . "login");
      exit();
    } else {
      Alert::error('Error', 'Falló la actualización de contraseña');
      header("Location:" . APP_URL . "changePassword/" . $_POST['token']);
      exit();
    }
  }
}
