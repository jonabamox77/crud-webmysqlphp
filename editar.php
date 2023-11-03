<?php
// Conectarse a la base de datos
$servername = "localhost";
$username = "root";
$password = "jesus777";
$dbname = "tareas_app";
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar la conexión
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

// Obtener los datos del formulario y validarlos
$id = isset($_POST['id']) ? $_POST['id'] : '';
$nombre_actual = "";
$descripcion_actual = "";
$error_message = "";

if (!empty($id)) {
    $stmt = $conn->prepare("SELECT nombre, descripcion FROM inventario WHERE id = ?");
    $stmt->bind_param("i", $id); // "i" indica que $id es un entero
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $nombre_actual = $row['nombre'];
        $descripcion_actual = $row['descripcion'];
    } else {
        $error_message = "No se encontró el registro con el ID especificado.";
    }

    $stmt->close(); // Cerrar la consulta preparada
} else {
    $error_message = "ID no proporcionado.";
}

// Cerrar la conexión
$conn->close();
?>