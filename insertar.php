
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
$nombre = isset($_POST['nombre']) ? mysqli_real_escape_string($conn, $_POST['nombre']) : '';
$descripcion = isset($_POST['descripcion']) ? mysqli_real_escape_string($conn, $_POST['descripcion']) : '';

// Verificar datos antes de la inserción (puedes agregar más validaciones según tus necesidades)
if (empty($nombre) || empty($descripcion)) {
    echo "Por favor, completa todos los campos.";
} else {
    // Insertar los datos en la tabla utilizando una consulta preparada
    $sql = "INSERT INTO inventario (nombre, descripcion) VALUES (?, ?)";
    
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $nombre, $descripcion);
    
    if ($stmt->execute()) {
        echo "Registro insertado con éxito";
    } else {
        echo "Error al insertar registro: " . $stmt->error;
    }
    
    $stmt->close();
}

// Cerrar la conexión
$conn->close();
?>