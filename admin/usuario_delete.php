<?php
require_once __DIR__ . '/../auth.php';
requireLogin();
requireRole('admin');
require_once __DIR__ . '/../models/Usuario.php';
$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
if ($id > 0 && $id !== (int)($_SESSION['usuario_id'] ?? 0)) {
    (new Usuario())->eliminar($id);
}
header('Location: usuarios.php');
exit;
