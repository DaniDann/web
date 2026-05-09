<?php

require_once '../config/Database.php';

header('Content-Type: application/json; charset=utf-8');

$db = new Database();
$conn = $db->connect();

$id = isset($_GET['id']) ? (int) $_GET['id'] : 0;

if (!$conn) {
    http_response_code(500);
    echo json_encode([
        'error' => 'Error de conexión a la base de datos'
    ]);
    exit;
}

if ($id <= 0) {
    http_response_code(400);
    echo json_encode([
        'error' => 'ID inválido'
    ]);
    exit;
}

$query = "
    SELECT 
        id,
        nombre,
        descripcion,
        precio,
        capacidad
    FROM productos_servicios
    WHERE id = :id
    AND tipo = 'habitacion'
    LIMIT 1
";

$stmt = $conn->prepare($query);
$stmt->bindParam(':id', $id, PDO::PARAM_INT);
$stmt->execute();

$habitacion = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$habitacion) {
    http_response_code(404);
    echo json_encode([
        'error' => 'Habitación no encontrada'
    ]);
    exit;
}

echo json_encode([
    'id' => (int) $habitacion['id'],
    'nombre' => $habitacion['nombre'],
    'precio' => number_format((float) $habitacion['precio'], 2),
    'capacidad' => (int) $habitacion['capacidad'],
    'descripcion' => $habitacion['descripcion']
]);