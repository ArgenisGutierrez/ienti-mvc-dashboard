<?php
/* ========================================================
 * ========== LIBRERIA DE MENSAJES ===============
 * ======================================================*/

namespace Lib;

class Alert
{
    public static function success(string $title, string $message = ''): void
    {
        self::set('success', $title, $message);
    }

    public static function error(string $title, string $message = ''): void
    {
        self::set('error', $title, $message);
    }

    public static function info(string $title, string $message = ''): void
    {
        self::set('info', $title, $message);
    }

    public static function warning(string $title, string $message = ''): void
    {
        self::set('warning', $title, $message);
    }

    private static function set(string $type, string $title, string $message): void
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        $_SESSION['alert'] = [
            'type' => $type,
            'title' => $title,
            'message' => $message
        ];
    }

    public static function display(): void
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if (isset($_SESSION['alert'])) {
            $alert = $_SESSION['alert'];
            unset($_SESSION['alert']);
            
            echo "
            <script>
                Swal.fire({
                    icon: '{$alert['type']}',
                    title: '{$alert['title']}',
                    text: '{$alert['message']}'
                });
            </script>
            ";
        }
    }
}
