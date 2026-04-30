<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require __DIR__ . '/PHPMailer/src/PHPMailer.php';
require __DIR__ . '/PHPMailer/src/SMTP.php';
require __DIR__ . '/PHPMailer/src/Exception.php';

$config = require __DIR__ . '/private/mail-config.php';

header('Content-Type: application/json; charset=utf-8');

function configureMailer(PHPMailer $mail, array $config): void
{
    $mail->isSMTP();
    $mail->Host = $config['host'];
    $mail->SMTPAuth = true;
    $mail->Username = $config['username'];
    $mail->Password = $config['password'];
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port = $config['port'];
    $mail->CharSet = 'UTF-8';
    $mail->Encoding = 'base64';

    $mail->setFrom($config['from_email'], $config['from_name']);
}

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    http_response_code(405);
    echo json_encode([
        "success" => false,
        "message" => "Método no permitido."
    ]);
    exit;
}

session_start();

$honeypot = trim($_POST["website"] ?? "");
if ($honeypot !== "") {
    echo json_encode([
        "success" => true,
        "message" => "Gracias. Tu mensaje fue enviado correctamente."
    ]);
    exit;
}

$startedAt = (int) ($_POST["form_started_at"] ?? 0);
$elapsedSeconds = (time() * 1000 - $startedAt) / 1000;

if ($startedAt <= 0 || $elapsedSeconds < 3) {
    http_response_code(400);
    echo json_encode([
        "success" => false,
        "message" => "Espera unos segundos antes de enviar el formulario."
    ]);
    exit;
}

if (!isset($_SESSION["last_submit"])) {
    $_SESSION["last_submit"] = 0;
}

if (time() - $_SESSION["last_submit"] < 60) {
    http_response_code(429);
    echo json_encode([
        "success" => false,
        "message" => "Espera un minuto antes de enviar otro mensaje."
    ]);
    exit;
}

$nombre = trim($_POST["nombre"] ?? "");
$correo = trim($_POST["correo"] ?? "");
$telefono = trim($_POST["telefono"] ?? "");
$motivo = trim($_POST["motivo"] ?? "");

if (!$nombre || !$correo || !$telefono || !$motivo) {
    http_response_code(400);
    echo json_encode([
        "success" => false,
        "message" => "Completa todos los campos."
    ]);
    exit;
}

if (!filter_var($correo, FILTER_VALIDATE_EMAIL)) {
    http_response_code(400);
    echo json_encode([
        "success" => false,
        "message" => "Correo inválido."
    ]);
    exit;
}

if (strlen($motivo) < 10) {
    http_response_code(400);
    echo json_encode([
        "success" => false,
        "message" => "Escribe un mensaje un poco más completo."
    ]);
    exit;
}

$nombreSeguro = htmlspecialchars($nombre, ENT_QUOTES, 'UTF-8');
$correoSeguro = htmlspecialchars($correo, ENT_QUOTES, 'UTF-8');
$telefonoSeguro = htmlspecialchars($telefono, ENT_QUOTES, 'UTF-8');
$motivoSeguro = nl2br(htmlspecialchars($motivo, ENT_QUOTES, 'UTF-8'));

$plainBodyAdmin = "
Nuevo mensaje desde el sitio web:

Nombre: $nombre
Correo: $correo
Teléfono: $telefono

Mensaje:
$motivo
";

$htmlBodyAdmin = "
<!DOCTYPE html>
<html lang='es'>
<head>
  <meta charset='UTF-8'>
</head>
<body style='margin:0; padding:0; background:#f8f5f1; font-family:Arial, sans-serif; color:#2f2a26;'>
  <div style='max-width:680px; margin:0 auto; padding:32px 18px;'>
    <div style='background:#fffaf6; border:1px solid #e4d9cf; border-radius:24px; overflow:hidden;'>
      <div style='padding:28px 30px; background:#2b2521; color:#fffaf6;'>
        <p style='margin:0 0 8px; font-size:12px; letter-spacing:2px; text-transform:uppercase; color:#d9c9bb;'>
          Sitio web
        </p>
        <h1 style='margin:0; font-family:Georgia, serif; font-size:30px; font-weight:500;'>
          Nuevo mensaje de contacto
        </h1>
      </div>

      <div style='padding:30px;'>
        <p style='margin:0 0 24px; color:#7b746d; font-size:16px; line-height:1.7;'>
          Una persona envió sus datos desde el formulario del sitio web.
        </p>

        <div style='background:#f3eee8; border-radius:18px; padding:22px; margin-bottom:22px;'>
          <p style='margin:0 0 12px;'><strong>Nombre:</strong><br>$nombreSeguro</p>
          <p style='margin:0 0 12px;'><strong>Correo:</strong><br>$correoSeguro</p>
          <p style='margin:0;'><strong>Teléfono:</strong><br>$telefonoSeguro</p>
        </div>

        <div style='border-left:4px solid #8a7869; padding-left:18px;'>
          <p style='margin:0 0 8px;'><strong>Mensaje:</strong></p>
          <p style='margin:0; color:#5f5146; font-size:16px; line-height:1.75;'>$motivoSeguro</p>
        </div>

        <p style='margin:26px 0 0; color:#7b746d; font-size:14px;'>
          Puedes responder directamente a este correo para contactar a $nombreSeguro.
        </p>
      </div>
    </div>
  </div>
</body>
</html>
";

$plainBodyUser = "
Hola $nombre,

Gracias por contactar a Lic. Myriam Benavides.

Hemos recibido tu mensaje correctamente. Nos pondremos en contacto contigo por correo o teléfono.

Resumen de tu mensaje:

Nombre: $nombre
Correo: $correo
Teléfono: $telefono

Mensaje:
$motivo

Este correo es una confirmación automática.
";

$htmlBodyUser = "
<!DOCTYPE html>
<html lang='es'>
<head>
  <meta charset='UTF-8'>
</head>
<body style='margin:0; padding:0; background:#f8f5f1; font-family:Arial, sans-serif; color:#2f2a26;'>
  <div style='max-width:680px; margin:0 auto; padding:32px 18px;'>
    <div style='background:#fffaf6; border:1px solid #e4d9cf; border-radius:24px; overflow:hidden;'>
      <div style='padding:28px 30px; background:#2b2521; color:#fffaf6;'>
        <p style='margin:0 0 8px; font-size:12px; letter-spacing:2px; text-transform:uppercase; color:#d9c9bb;'>
          Confirmación de contacto
        </p>
        <h1 style='margin:0; font-family:Georgia, serif; font-size:30px; font-weight:500;'>
          Hemos recibido tu mensaje
        </h1>
      </div>

      <div style='padding:30px;'>
        <p style='margin:0 0 18px; font-size:16px; line-height:1.75; color:#5f5146;'>
        Hola $nombreSeguro,
        </p>

        <p style='margin:0 0 22px; font-size:16px; line-height:1.75; color:#5f5146;'>
        Gracias por escribirnos.
        Tu mensaje ya fue recibido y será revisado personalmente.
        </p>

        <p style='margin:0 0 22px; font-size:16px; line-height:1.75; color:#5f5146;'>
        En breve se dará seguimiento a tu solicitud por este mismo medio o por el número de teléfono que proporcionaste.
        </p>

        <div style='background:#f3eee8; border-radius:18px; padding:22px; margin-bottom:22px;'>
          <p style='margin:0 0 12px;'><strong>Nombre:</strong><br>$nombreSeguro</p>
          <p style='margin:0 0 12px;'><strong>Correo:</strong><br>$correoSeguro</p>
          <p style='margin:0;'><strong>Teléfono:</strong><br>$telefonoSeguro</p>
        </div>

        <div style='border-left:4px solid #8a7869; padding-left:18px;'>
          <p style='margin:0 0 8px;'><strong>Mensaje enviado:</strong></p>
          <p style='margin:0; color:#5f5146; font-size:16px; line-height:1.75;'>$motivoSeguro</p>
        </div>

        <p style='margin:28px 0 0; color:#7b746d; font-size:13px; line-height:1.6;'>
            Este mensaje fue generado de forma automática como confirmación de recepción.
            Si no realizaste esta solicitud, puedes ignorarlo.
        </p>
      </div>
    </div>
  </div>
</body>
</html>
";

try {
    $mail = new PHPMailer(true);
    configureMailer($mail, $config);

    $mail->addAddress($config['to_email']);
    $mail->addReplyTo($correo, $nombre);

    $mail->isHTML(true);
    $mail->Subject = "Contacto web: $nombre";
    $mail->Body = $htmlBodyAdmin;
    $mail->AltBody = $plainBodyAdmin;

    $mail->send();

    $confirmacion = new PHPMailer(true);
    configureMailer($confirmacion, $config);

    $confirmacion->addAddress($correo, $nombre);
    $confirmacion->isHTML(true);
    $confirmacion->Subject = "Hemos recibido tu mensaje";
    $confirmacion->Body = $htmlBodyUser;
    $confirmacion->AltBody = $plainBodyUser;

    $confirmacion->send();

    $_SESSION["last_submit"] = time();

    echo json_encode([
        "success" => true,
        "message" => "Gracias. Tu mensaje fue enviado correctamente."
    ]);
} catch (Exception $e) {
    http_response_code(500);

    echo json_encode([
        "success" => false,
        "message" => "No se pudo enviar el mensaje. Intenta más tarde."
    ]);
}