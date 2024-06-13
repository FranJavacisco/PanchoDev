<?php
// Configuración para mostrar errores
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Verificar si se recibieron los datos del formulario
if (isset($_POST['conName'], $_POST['conLName'], $_POST['conEmail'], $_POST['conPhone'], $_POST['conService'], $_POST['conMessage'])) {
    // Obtener y sanitizar los datos del formulario
    $conName = trim($_POST['conName']);
    $conLName = trim($_POST['conLName']);
    $conEmail = trim($_POST['conEmail']);
    $conPhone = trim($_POST['conPhone']);
    $conService = trim($_POST['conService']);
    $conMessage = trim($_POST['conMessage']);

    // Dirección de correo del destinatario (actualizar según sea necesario)
    $recipient = "panchodev@gmail.com";

    // Validar y sanitizar el correo electrónico
    if (filter_var($conEmail, FILTER_VALIDATE_EMAIL)) {
        // Asunto del correo
        $subject = "Nuevo mensaje de {$conName}";

        // Cabeceras del correo
        $headers = "From: {$conName} <{$conEmail}>\r\n";
        $headers .= "Reply-To: {$conEmail}\r\n";
        $headers .= "MIME-Version: 1.0\r\n";
        $headers .= "Content-Type: text/plain; charset=UTF-8\r\n";
        $headers .= 'X-Mailer: PHP/' . phpversion();

        // Construir el contenido del correo
        $head = "You have a new message from your Gerold website Contact Form\n=============================";
        $form_content = "{$head}\n\n";
        $form_content .= "Full Name: {$conName} {$conLName}\n";
        $form_content .= "Email: {$conEmail}\n";
        $form_content .= "Phone: {$conPhone}\n";
        $form_content .= "Service: {$conService}\n";
        $form_content .= "Message: \n{$conMessage}\n";

        // Enviar el correo
        if (mail($recipient, $subject, $form_content, $headers)) {
            echo "Y"; // Indicar éxito
        } else {
            echo "N"; // Indicar fallo en el envío
        }
    } else {
        echo "Invalid email address."; // Indicar error en la validación del correo electrónico
    }
} else {
    echo "All fields are required."; // Indicar que faltan datos del formulario
}
?>
