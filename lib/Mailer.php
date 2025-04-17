<?php
namespace Lib;


require __DIR__ . '/PHPMailer/src/Exception.php';
require __DIR__ . '/PHPMailer/src/PHPMailer.php';
require __DIR__ . '/PHPMailer/src/SMTP.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

class Mailer
{
    private $mail;
    private $config;

    public function __construct($config = [])
    {
        // Configuración por defecto
        $this->config = array_merge(
            [
                'host'       => 'smtp.gmail.com',
                'username'   => 'argenis.v.ballard@gmail.com',
                'password'   => 'khwn qrml vffk nusj',
                'port'       => 587,
                'encryption' => 'tls',
                'from_email' => 'argenis.v.ballard@gmail.com',
                'from_name'  => APP_NAME,
                'debug'      => 0 // 0 = off, 1 = client messages, 2 = client and server messages
            ],
            $config
        );

        $this->mail = new PHPMailer(true);
        $this->configure();
    }

    private function configure()
    {
        // Configuración del servidor SMTP
        $this->mail->isSMTP();
        $this->mail->Host       = $this->config['host'];
        $this->mail->SMTPAuth   = true;
        $this->mail->Username   = $this->config['username'];
        $this->mail->Password   = $this->config['password'];
        $this->mail->SMTPSecure = $this->config['encryption'];
        $this->mail->Port       = $this->config['port'];

        // Configuración general
        $this->mail->setFrom($this->config['from_email'], $this->config['from_name']);
        $this->mail->CharSet = 'UTF-8';
        $this->mail->SMTPDebug = $this->config['debug'];
    }

    public function send($to, $subject, $body, $options = [])
    {
        try {
            // Destinatario
            if (is_array($to)) {
                foreach ($to as $email => $name) {
                    $this->mail->addAddress($email, $name);
                }
            } else {
                $this->mail->addAddress($to);
            }

            // Asunto
            $this->mail->Subject = $subject;

            // Cuerpo del mensaje
            $this->mail->isHTML($options['is_html'] ?? true);
            $this->mail->Body = $body;

            // Adjuntos
            if (!empty($options['attachments'])) {
                foreach ($options['attachments'] as $attachment) {
                    $this->mail->addAttachment($attachment['path'], $attachment['name'] ?? '');
                }
            }

            // Enviar correo
            $this->mail->send();
            return true;

        } catch (Exception $e) {
            // Puedes registrar el error para depuración
            // error_log("Error al enviar correo: {$this->mail->ErrorInfo}");
            return false;
        } finally {
            $this->clearRecipients();
        }
    }

    public function sendTemplate($to, $subject, $templatePath, $data = [], $options = [])
    {
        $body = $this->renderTemplate($templatePath, $data);
        return $this->send($to, $subject, $body, $options);
    }

    private function renderTemplate($templatePath, $data)
    {
        if (!file_exists($templatePath)) {
            throw new \Exception("La plantilla no existe: $templatePath");
        }

        ob_start();
        extract($data, EXTR_SKIP);
        include $templatePath;
        return ob_get_clean();
    }

    private function clearRecipients()
    {
        $this->mail->clearAddresses();
        $this->mail->clearCCs();
        $this->mail->clearBCCs();
        $this->mail->clearAttachments();
    }
}
