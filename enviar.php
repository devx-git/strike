<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recolectar datos del formulario
    $nombre = $_POST['name'];
    $email = $_POST['email'];
    $telefono = $_POST['phone'];
    $proyecto = $_POST['project'];
    $asunto = $_POST['subject'];
    $mensaje = $_POST['message'];

    // Dirección de correo a la que quieres enviar
    $destinatario = "administracion@strikefg.com"; // <--- cámbialo por el tuyo
    $titulo = "Nuevo mensaje desde el formulario";

    // Cuerpo del mensaje
    $contenido = "Nombre: $nombre\n";
    $contenido .= "Correo: $email\n";
    $contenido .= "Teléfono: $telefono\n";
    $contenido .= "Proyecto: $proyecto\n";
    $contenido .= "Asunto: $asunto\n";
    $contenido .= "Mensaje:\n$mensaje";

    // Cabeceras
    $cabeceras = "From: $email";

    // Enviar correo
    if (mail($destinatario, $titulo, $contenido, $cabeceras)) {
        echo "Mensaje enviado correctamente.";
    } else {
        echo "Error al enviar el mensaje.";
    }
} else {
    echo "Acceso no permitido.";
}

header("Location: contact.html?enviado=1");
exit();

?>
