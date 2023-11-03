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
$nombre = isset($_POST['nombre']) ? mysqli_real_escape_string($conn, $_POST['nombre']) : '';
$descripcion = isset($_POST['descripcion']) ? mysqli_real_escape_string($conn, $_POST['descripcion']) : '';

// Verificar datos antes de la actualización (puedes agregar más validaciones según tus necesidades)
if (empty($id) || empty($nombre) || empty($descripcion)) {
    echo "Por favor, completa todos los campos.";
} else {
    // Actualizar los datos en la tabla utilizando una consulta UPDATE
    $sql = "UPDATE inventario SET nombre = '$nombre', descripcion = '$descripcion' WHERE id = $id";
    
    if ($conn->query($sql) === TRUE) {
        echo "Registro actualizado con éxito";
    } else {
        echo "Error al actualizar registro: " . $conn->error;
    }
}

// Cerrar la conexión
$conn->close();
?>