 <?php
header('Content-Type: application/json');

// Configurar la conexión a la base de datos
$servername = "localhost:3306";
$username = "root";
$password = "jesus777";
$dbname = "tareas_app";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Error en la conexión a la base de datos: " . $conn->connect_error);
}

// Manejar la solicitud POST para crear un item
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents('php://input'));

    $nombre = $data->nombre;
    $descripcion = $data->descripcion;

    $sql = "INSERT INTO inventario (nombre, descripcion) VALUES (?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $nombre, $descripcion);

    if ($stmt->execute()) {
        echo json_encode(['message' => 'Item creado exitosamente']);
    } else {
        echo json_encode(array('error' => 'Error al crear el item'));
    }

    $stmt->close();
}

// Manejar la solicitud GET para obtener la lista de items
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $result = $conn->query("SELECT * FROM items");
    $items = array();

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $items[] = $row;
        }
        echo json_encode($items);
    } else {
        echo json_encode(array());
    }
}

$conn->close();
?>
