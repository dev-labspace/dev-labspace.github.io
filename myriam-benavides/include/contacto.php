<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require __DIR__ . '/PHPMailer/src/PHPMailer.php';
require __DIR__ . '/PHPMailer/src/SMTP.php';
require __DIR__ . '/PHPMailer/src/Exception.php';

$config = require __DIR__ . '/../../private/mail-config.php';

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

$idioma = $_POST["idioma"] ?? "es";
$idioma = $idioma === "en" ? "en" : "es";

$textos = [
    "es" => [
        "method" => "Método no permitido.",
        "success" => "Gracias. Tu mensaje fue enviado correctamente.",
        "wait" => "Espera unos segundos antes de enviar el formulario.",
        "rate" => "Espera un minuto antes de enviar otro mensaje.",
        "required" => "Completa todos los campos.",
        "invalid_email" => "Correo inválido.",
        "short_message" => "Escribe un mensaje un poco más completo.",
        "error" => "No se pudo enviar el mensaje. Intenta más tarde.",

        "admin_subject" => "Contacto web",
        "admin_label" => "Sitio web",
        "admin_title" => "Nuevo mensaje de contacto",
        "admin_intro" => "Una persona envió sus datos desde el formulario del sitio web.",
        "admin_reply" => "Puedes responder directamente a este correo para contactar a",

        "user_subject" => "Hemos recibido tu mensaje",
        "user_label" => "Confirmación de contacto",
        "user_title" => "Hemos recibido tu mensaje",
        "hello" => "Hola",
        "thanks" => "Gracias por escribirnos. Tu mensaje ya fue recibido y será revisado personalmente.",
        "followup" => "En breve se dará seguimiento a tu solicitud por este mismo medio o por el número de teléfono que proporcionaste.",
        "automatic" => "Este mensaje fue generado de forma automática como confirmación de recepción. Si no realizaste esta solicitud, puedes ignorarlo.",

        "name" => "Nombre",
        "email" => "Correo",
        "phone" => "Teléfono",
        "message" => "Mensaje",
        "sent_message" => "Mensaje enviado",
        "plain_admin_title" => "Nuevo mensaje desde el sitio web:",
        "plain_user_intro" => "Gracias por contactar a Lic. Myriam Benavides.",
        "plain_user_received" => "Hemos recibido tu mensaje correctamente. Nos pondremos en contacto contigo por correo o teléfono.",
        "plain_summary" => "Resumen de tu mensaje:",
        "plain_auto" => "Este correo es una confirmación automática."
    ],
    "en" => [
        "method" => "Method not allowed.",
        "success" => "Thank you. Your message was sent successfully.",
        "wait" => "Please wait a few seconds before submitting the form.",
        "rate" => "Please wait one minute before sending another message.",
        "required" => "Please complete all fields.",
        "invalid_email" => "Invalid email address.",
        "short_message" => "Please write a slightly more complete message.",
        "error" => "The message could not be sent. Please try again later.",

        "admin_subject" => "Website contact",
        "admin_label" => "Website",
        "admin_title" => "New contact message",
        "admin_intro" => "Someone submitted their information through the website contact form.",
        "admin_reply" => "You can reply directly to this email to contact",

        "user_subject" => "We have received your message",
        "user_label" => "Contact confirmation",
        "user_title" => "We have received your message",
        "hello" => "Hello",
        "thanks" => "Thank you for reaching out. Your message has been received and will be reviewed personally.",
        "followup" => "Your request will be followed up shortly by email or through the phone number you provided.",
        "automatic" => "This message was generated automatically as a confirmation of receipt. If you did not submit this request, you may ignore it.",

        "name" => "Name",
        "email" => "Email",
        "phone" => "Phone",
        "message" => "Message",
        "sent_message" => "Message sent",
        "plain_admin_title" => "New message from the website:",
        "plain_user_intro" => "Thank you for contacting Lic. Myriam Benavides.",
        "plain_user_received" => "We have received your message successfully. We will contact you by email or phone.",
        "plain_summary" => "Summary of your message:",
        "plain_auto" => "This email is an automatic confirmation."
    ]
];

$t = $textos[$idioma];

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    http_response_code(405);
    echo json_encode([
        "success" => false,
        "message" => $t["method"]
    ]);
    exit;
}

session_start();

$honeypot = trim($_POST["website"] ?? "");
if ($honeypot !== "") {
    echo json_encode([
        "success" => true,
        "message" => $t["success"]
    ]);
    exit;
}

$startedAt = (int) ($_POST["form_started_at"] ?? 0);
$elapsedSeconds = (time() * 1000 - $startedAt) / 1000;

if ($startedAt <= 0 || $elapsedSeconds < 3) {
    http_response_code(400);
    echo json_encode([
        "success" => false,
        "message" => $t["wait"]
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
        "message" => $t["rate"]
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
        "message" => $t["required"]
    ]);
    exit;
}

if (!filter_var($correo, FILTER_VALIDATE_EMAIL)) {
    http_response_code(400);
    echo json_encode([
        "success" => false,
        "message" => $t["invalid_email"]
    ]);
    exit;
}

if (mb_strlen($motivo, 'UTF-8') < 10) {
    http_response_code(400);
    echo json_encode([
        "success" => false,
        "message" => $t["short_message"]
    ]);
    exit;
}

$nombreSeguro = htmlspecialchars($nombre, ENT_QUOTES, 'UTF-8');
$correoSeguro = htmlspecialchars($correo, ENT_QUOTES, 'UTF-8');
$telefonoSeguro = htmlspecialchars($telefono, ENT_QUOTES, 'UTF-8');
$motivoSeguro = nl2br(htmlspecialchars($motivo, ENT_QUOTES, 'UTF-8'));

$plainBodyAdmin = "
{$t["plain_admin_title"]}

{$t["name"]}: $nombre
{$t["email"]}: $correo
{$t["phone"]}: $telefono
Idioma / Language: $idioma

{$t["message"]}:
$motivo
";

$htmlBodyAdmin = "
<!DOCTYPE html>
<html lang='$idioma'>
<head>
  <meta charset='UTF-8'>
</head>
<body style='margin:0; padding:0; background:#f8f5f1; font-family:Arial, sans-serif; color:#2f2a26;'>
  <div style='max-width:680px; margin:0 auto; padding:32px 18px;'>
    <div style='background:#fffaf6; border:1px solid #e4d9cf; border-radius:24px; overflow:hidden;'>
      <div style='padding:28px 30px; background:#2b2521; color:#fffaf6;'>
        <p style='margin:0 0 8px; font-size:12px; letter-spacing:2px; text-transform:uppercase; color:#d9c9bb;'>
          {$t["admin_label"]}
        </p>
        <h1 style='margin:0; font-family:Georgia, serif; font-size:30px; font-weight:500;'>
          {$t["admin_title"]}
        </h1>
      </div>

      <div style='padding:30px;'>
        <p style='margin:0 0 24px; color:#7b746d; font-size:16px; line-height:1.7;'>
          {$t["admin_intro"]}
        </p>

        <div style='background:#f3eee8; border-radius:18px; padding:22px; margin-bottom:22px;'>
          <p style='margin:0 0 12px;'><strong>{$t["name"]}:</strong><br>$nombreSeguro</p>
          <p style='margin:0 0 12px;'><strong>{$t["email"]}:</strong><br>$correoSeguro</p>
          <p style='margin:0 0 12px;'><strong>{$t["phone"]}:</strong><br>$telefonoSeguro</p>
          <p style='margin:0;'><strong>Idioma / Language:</strong><br>$idioma</p>
        </div>

        <div style='border-left:4px solid #8a7869; padding-left:18px;'>
          <p style='margin:0 0 8px;'><strong>{$t["message"]}:</strong></p>
          <p style='margin:0; color:#5f5146; font-size:16px; line-height:1.75;'>$motivoSeguro</p>
        </div>

        <p style='margin:26px 0 0; color:#7b746d; font-size:14px;'>
          {$t["admin_reply"]} $nombreSeguro.
        </p>
      </div>
    </div>
  </div>
</body>
</html>
";

$plainBodyUser = "
{$t["hello"]} $nombre,

{$t["plain_user_intro"]}

{$t["plain_user_received"]}

{$t["plain_summary"]}

{$t["name"]}: $nombre
{$t["email"]}: $correo
{$t["phone"]}: $telefono

{$t["message"]}:
$motivo

{$t["plain_auto"]}
";

$htmlBodyUser = "
<!DOCTYPE html>
<html lang='$idioma'>
<head>
  <meta charset='UTF-8'>
</head>
<body style='margin:0; padding:0; background:#f8f5f1; font-family:Arial, sans-serif; color:#2f2a26;'>
  <div style='max-width:680px; margin:0 auto; padding:32px 18px;'>
    <div style='background:#fffaf6; border:1px solid #e4d9cf; border-radius:24px; overflow:hidden;'>
      <div style='padding:28px 30px; background:#2b2521; color:#fffaf6;'>
        <p style='margin:0 0 8px; font-size:12px; letter-spacing:2px; text-transform:uppercase; color:#d9c9bb;'>
          {$t["user_label"]}
        </p>
        <h1 style='margin:0; font-family:Georgia, serif; font-size:30px; font-weight:500;'>
          {$t["user_title"]}
        </h1>
      </div>

      <div style='padding:30px;'>
        <p style='margin:0 0 18px; font-size:16px; line-height:1.75; color:#5f5146;'>
          {$t["hello"]} $nombreSeguro,
        </p>

        <p style='margin:0 0 22px; font-size:16px; line-height:1.75; color:#5f5146;'>
          {$t["thanks"]}
        </p>

        <p style='margin:0 0 22px; font-size:16px; line-height:1.75; color:#5f5146;'>
          {$t["followup"]}
        </p>

        <div style='background:#f3eee8; border-radius:18px; padding:22px; margin-bottom:22px;'>
          <p style='margin:0 0 12px;'><strong>{$t["name"]}:</strong><br>$nombreSeguro</p>
          <p style='margin:0 0 12px;'><strong>{$t["email"]}:</strong><br>$correoSeguro</p>
          <p style='margin:0;'><strong>{$t["phone"]}:</strong><br>$telefonoSeguro</p>
        </div>

        <div style='border-left:4px solid #8a7869; padding-left:18px;'>
          <p style='margin:0 0 8px;'><strong>{$t["sent_message"]}:</strong></p>
          <p style='margin:0; color:#5f5146; font-size:16px; line-height:1.75;'>$motivoSeguro</p>
        </div>

        <p style='margin:28px 0 0; color:#7b746d; font-size:13px; line-height:1.6;'>
          {$t["automatic"]}
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
    $mail->Subject = "{$t["admin_subject"]}: $nombre";
    $mail->Body = $htmlBodyAdmin;
    $mail->AltBody = $plainBodyAdmin;

    $mail->send();

    $confirmacion = new PHPMailer(true);
    configureMailer($confirmacion, $config);

    $confirmacion->addAddress($correo, $nombre);
    $confirmacion->isHTML(true);
    $confirmacion->Subject = $t["user_subject"];
    $confirmacion->Body = $htmlBodyUser;
    $confirmacion->AltBody = $plainBodyUser;

    $confirmacion->send();

    $_SESSION["last_submit"] = time();

    echo json_encode([
        "success" => true,
        "message" => $t["success"]
    ]);
} catch (Exception $e) {
    http_response_code(500);

    echo json_encode([
        "success" => false,
        "message" => $t["error"]
    ]);
}