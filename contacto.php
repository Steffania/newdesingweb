<?php
/**
 * @version 1.0
 */

require("class.phpmailer.php");
require("class.smtp.php");

// Valores enviados desde el formulario
if ( !isset($_POST["nombre"]) || !isset($_POST["email"]) || !isset($_POST["mensaje"])|| !isset($_POST["celular"]) || !isset($_POST["g-recaptcha-response"])) {
    die ("Es necesario completar todos los datos del formulario");
}
$nombre = $_POST["nombre"];
$email = $_POST["email"];
$mensaje = $_POST["mensaje"];
$celular = $_POST["celular"];
$reCaptcha = $_POST["g-recaptcha-response"];

// Datos de la cuenta de correo utilizada para enviar vía SMTP
$smtpHost = "xw000498.ferozo.com";  // Dominio alternativo brindado en el email de alta 
$smtpUsuario = "info@mburucuyapoty.com.ar";  // Mi cuenta de correo
$smtpClave = "Clavemail651";  // Mi contraseña

// Email donde se enviaran los datos cargados en el formulario de contacto
$emailDestino = "cabanas@mburucuyapoty.com";

$mail = new PHPMailer();
$mail->IsSMTP();
$mail->SMTPAuth = true;
$mail->Port = 465; 
$mail->SMTPSecure = 'ssl';
$mail->IsHTML(true); 
$mail->CharSet = "utf-8";


// VALORES A MODIFICAR //
$mail->Host = $smtpHost; 
$mail->Username = $smtpUsuario; 
$mail->Password = $smtpClave;

$mail->From = $email; // Email desde donde envío el correo.
$mail->FromName = $nombre;
$mail->AddAddress($emailDestino); // Esta es la dirección a donde enviamos los datos del formulario

$mail->Subject = "CONTACTO - Sitio Cabañas Mburucuyá Poty"; // Este es el titulo del email.
$mensajeHtml = nl2br($mensaje);
$emailHtml = nl2br($email);
$celularHtml = nl2br($celular);
$nombreHtml = nl2br($nombre);

$mail->Body = "{$nombreHtml} <br />{$celularHtml}<br />{$emailHtml}<br />{$mensajeHtml} <br />"; // Texto del email en formato HTML
$mail->AltBody = "{$mensaje} \n\n Formulario de Sitio Cabañas Mburucuyá Poty"; // Texto sin formato HTML
// FIN - VALORES A MODIFICAR //


// // // VALORES A MODIFICAR //
// $mail->Host = $smtpHost; 
// $mail->Username = $smtpUsuario; 
// $mail->Password = $smtpClave;

// $mail->From = "cabanas@mburucuyapoty.com"; // Email desde donde envío el correo.
// $mail->FromName = $nombre;
// $mail->AddAddress($emailDestino); // Esta es la dirección a donde enviamos los datos del formulario

// $mail->Subject = "CONTACTO - Sitio Cabañas Mburucuyá Poty"; // Este es el titulo del email.
// $mensajeHtml = nl2br($mensaje);
// $emailHtml = nl2br($email);
// $celularHtml = nl2br($celular);
// $nombreHtml = nl2br($nombre);

// $mail->Body = "{$nombreHtml} <br />{$celularHtml}<br />{$emailHtml}<br />{$mensajeHtml} <br />"; // Texto del email en formato HTML
// $mail->AltBody = "{$mensaje} \n\n Formulario de Sitio Cabañas Mburucuyá Poty"; // Texto sin formato HTML
// // FIN - VALORES A MODIFICAR //

// $estadoEnvio = $mail->Send(); 
//  if($estadoEnvio){
//  	header("location:http://www.mburucuyapoty.com.ar/contacto.html");

//   echo '<p class="alert alert-success agileits" role="alert">El correo fue enviado correctamente!p>';

//   } else {

//   echo "Mailer Error: " . $mail->ErrorInfo;
//   header("location:http://www.mburucuyapoty.com.ar/contacto.html");


// }

 
// grab recaptcha library
require_once "recaptchalib.php";
// your secret key
$secret = "6LeZOvAUAAAAAPdOQHxrrGFv9YKmLKp9Q9WAamW6";
 
// empty response
$response = null;
 
// check secret key
$reCaptcha = new ReCaptcha($secret);
// if submitted check response
if ($_POST["g-recaptcha-response"]) {
    $response = $reCaptcha->verifyResponse(
        $_SERVER["REMOTE_ADDR"],
        $_POST["g-recaptcha-response"]
    );

}
if ($response != null && $response->success) {
    try {
      $estadoEnvio = $mail->Send(); 
      if($estadoEnvio){
        header("location:http://www.mburucuyapoty.com.ar/contacto.html");
        echo '<p class="alert alert-success agileits" role="alert">El correo fue enviado correctamente!p>';
      } else {
        echo "Mailer Error: " . $mail->ErrorInfo;
      }
      $mail->From = "cabanas@mburucuyapoty.com";
      $estadoEnvio = $mail->Send(); 
      if($estadoEnvio){
        header("location:http://www.mburucuyapoty.com.ar/contacto.html");
        echo '<p class="alert alert-success agileits" role="alert">El correo fue enviado correctamente!p>';
      } else {
        echo "Mailer Error: " . $mail->ErrorInfo;
        header("location:http://www.mburucuyapoty.com.ar/contacto.html");
      }
    } catch (Exception $e) {
      echo "Mail error:" . $e;
    }
    
     
  } else {
      echo 'error';
    }
 
?>

