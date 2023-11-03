<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$servername = "localhost";
$username = "root";
$password = "jesus777";
$dbname = "tareas_app";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = isset($_POST['id']) ? trim($_POST['id']) : '';

    if ($id === '') {
        echo "Por favor, ingresa un ID válido.";
    } else {
        // Verificar la existencia del registro antes de eliminarlo
        $stmt = $conn->prepare("SELECT id FROM inventario WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            // El registro existe, ahora podemos eliminarlo
            $stmt = $conn->prepare("DELETE FROM inventario WHERE id = ?");
            $stmt->bind_param("i", $id);

            if ($stmt->execute()) {
                echo "Registro eliminado con éxito.";
            } else {
                echo "Error al eliminar el registro: " . $stmt->error;
            }

            $stmt->close();
        } else {
            echo "El ID proporcionado no existe en la base de datos.";
        }
    }
}

// Cerrar la conexión
$conn->close();
?>

