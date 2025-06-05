<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");

// Datos del POST
$data = json_decode(file_get_contents("php://input"));

// Conexión a la base de datos
$servername = "localhost";
$username = "root";
$password = ""; // cambia esto si tu MySQL tiene contraseña
$dbname = "chatbot_db";

$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    http_response_code(500);
    echo "Error de conexión a la base de datos.";
    exit;
}

$userName = $conn->real_escape_string($data->user_name ?? "Invitado");
$message = $conn->real_escape_string($data->message ?? "");
$ip = $_SERVER['REMOTE_ADDR'];

$sql = "INSERT INTO chatbot_messages (user_name, message, ip_address) VALUES ('$userName', '$message', '$ip')";

if ($conn->query($sql) === TRUE) {
    echo "Mensaje guardado.";
} else {
    http_response_code(500);
    echo "Error al guardar el mensaje.";
}

$conn->close();
?>
