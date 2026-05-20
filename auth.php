<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

function isLoggedIn(): bool {
    return isset($_SESSION['usuario_id']);
}

function requireLogin(): void {
    if (!isLoggedIn()) {
        header('Location: /web/login.php');
        exit;
    }
}

function requireRole(string $role): void {
    if (!isset($_SESSION['rol']) || $_SESSION['rol'] !== $role) {
        http_response_code(403);
        exit('Acceso denegado');
    }
}

function currentUserName(): string {
    return $_SESSION['nombre'] ?? 'Invitado';
}
