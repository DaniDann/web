<?php
require_once __DIR__ . '/../auth.php';
require_once __DIR__ . '/../config/Database.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: ../reservaciones.php');
    exit;
}

$conn = (new Database())->connect();
$sql = 'INSERT INTO reservaciones(usuario_id, producto_servicio_id, checkin, checkout, huespedes, tipo_cama, nombre_huesped, apellido_huesped, correo, telefono, direccion, metodo_pago, referencia, comentarios)
        VALUES(:usuario_id, :producto_servicio_id, :checkin, :checkout, :huespedes, :tipo_cama, :nombre_huesped, :apellido_huesped, :correo, :telefono, :direccion, :metodo_pago, :referencia, :comentarios)';
$stmt = $conn->prepare($sql);
$stmt->execute([
    'usuario_id' => $_SESSION['usuario_id'] ?? null,
    'producto_servicio_id' => (int)$_POST['producto_servicio_id'],
    'checkin' => $_POST['checkin'],
    'checkout' => $_POST['checkout'],
    'huespedes' => (int)$_POST['huespedes'],
    'tipo_cama' => $_POST['tipo_cama'],
    'nombre_huesped' => trim($_POST['nombre_huesped']),
    'apellido_huesped' => trim($_POST['apellido_huesped']),
    'correo' => trim($_POST['correo']),
    'telefono' => trim($_POST['telefono']),
    'direccion' => trim($_POST['direccion'] ?? ''),
    'metodo_pago' => $_POST['metodo_pago'],
    'referencia' => trim($_POST['referencia'] ?? ''),
    'comentarios' => trim($_POST['comentarios'] ?? '')
]);
header('Location: ../reservaciones.php?ok=1');
exit;
