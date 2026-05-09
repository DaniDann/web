<?php

session_start();

require_once '../config/Database.php';

$db = new Database();
$conn = $db->connect();

if (!$conn) {
    die("Error de conexión a la base de datos");
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: ../reservaciones.php');
    exit;
}

$usuario_id = $_SESSION['usuario_id'] ?? null;

$producto_servicio_id = $_POST['producto_servicio_id'] ?? '';
$checkin = $_POST['checkin'] ?? '';
$checkout = $_POST['checkout'] ?? '';
$huespedes = $_POST['huespedes'] ?? '';
$tipo_cama = $_POST['tipo_cama'] ?? '';
$nombre_huesped = $_POST['nombre_huesped'] ?? '';
$apellido_huesped = $_POST['apellido_huesped'] ?? '';
$correo = $_POST['correo'] ?? '';
$telefono = $_POST['telefono'] ?? '';
$direccion = $_POST['direccion'] ?? '';
$metodo_pago = $_POST['metodo_pago'] ?? '';
$referencia = $_POST['referencia'] ?? '';
$comentarios = $_POST['comentarios'] ?? '';

$query = "
    INSERT INTO reservaciones
    (
        usuario_id,
        producto_servicio_id,
        checkin,
        checkout,
        huespedes,
        tipo_cama,
        nombre_huesped,
        apellido_huesped,
        correo,
        telefono,
        direccion,
        metodo_pago,
        referencia,
        comentarios
    )
    VALUES
    (
        :usuario_id,
        :producto_servicio_id,
        :checkin,
        :checkout,
        :huespedes,
        :tipo_cama,
        :nombre_huesped,
        :apellido_huesped,
        :correo,
        :telefono,
        :direccion,
        :metodo_pago,
        :referencia,
        :comentarios
    )
";

$stmt = $conn->prepare($query);

$stmt->bindParam(':usuario_id', $usuario_id);
$stmt->bindParam(':producto_servicio_id', $producto_servicio_id);
$stmt->bindParam(':checkin', $checkin);
$stmt->bindParam(':checkout', $checkout);
$stmt->bindParam(':huespedes', $huespedes);
$stmt->bindParam(':tipo_cama', $tipo_cama);
$stmt->bindParam(':nombre_huesped', $nombre_huesped);
$stmt->bindParam(':apellido_huesped', $apellido_huesped);
$stmt->bindParam(':correo', $correo);
$stmt->bindParam(':telefono', $telefono);
$stmt->bindParam(':direccion', $direccion);
$stmt->bindParam(':metodo_pago', $metodo_pago);
$stmt->bindParam(':referencia', $referencia);
$stmt->bindParam(':comentarios', $comentarios);

if ($stmt->execute()) {
    header("Location: ../reservaciones.php?success=1");
    exit;
}

echo "Error al guardar la reservación.";