<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "chatbot_db";

// Conectar
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

$sql = "SELECT * FROM chatbot_logs ORDER BY created_at DESC";
$result = $conn->query($sql);

echo "<h2>Historial del Chatbot</h2><table border='1'><tr><th>Nombre</th><th>Mensaje</th><th>IP</th><th>Fecha</th></tr>";

while ($row = $result->fetch_assoc()) {
    echo "<tr><td>{$row['user_name']}</td><td>{$row['message']}</td><td>{$row['ip_address']}</td><td>{$row['created_at']}</td></tr>";
}

echo "</table>";
$conn->close();
?>
