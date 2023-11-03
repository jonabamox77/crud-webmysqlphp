<?php
// Configura la conexión a la base de datos MySQL
$mysqli = new mysqli("localhost", "root", "jesus777", "tareas_app");

if ($mysqli->connect_error) {
    die("Error de conexión a la base de datos: " . $mysqli->connect_error);
}

// Obtiene los datos enviados desde el formulario
$data = json_decode(file_get_contents("php://input"));

$nombre = $mysqli->real_escape_string($data->nombre);
$descripcion = $mysqli->real_escape_string($data->descripcion);

// Realiza una inserción en la base de datos
$query = "INSERT INTO inventario(nombre, descripcion) VALUES ('$nombre', '$descripcion')";

if ($mysqli->query($query) === TRUE) {
    echo json_encode(array("message" => "Item creado exitosamente"));
} else {
    echo json_encode(array("error" => "Error al crear el item: " . $mysqli->error));
}

// Cierra la conexión a la base de datos
$mysqli->close();
?>
