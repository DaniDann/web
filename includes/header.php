<?php
require_once __DIR__ . '/../auth.php';
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($pageTitle ?? 'Quinta Dalam') ?></title>

    <link rel="stylesheet" href="/web-version-3.0/styles.css">
</head>

<body>

<a class="skip-link" href="#contenido">Saltar al contenido</a>

<header>
    <nav class="navbar">
        <div class="container">

            <div class="logo">
                <h1>Quinta Dalam</h1>
                <p class="tagline">Tu hogar lejos de casa</p>
            </div>

            <ul class="nav-menu">
                <li><a href="/web-version-3.0/index.php">Inicio</a></li>
                <li><a href="/web-version-3.0/habitaciones.php">Habitaciones</a></li>
                <li><a href="/web-version-3.0/contacto.php">Contacto</a></li>
                <li><a href="/web-version-3.0/reservaciones.php">Reservar Ahora</a></li>

                <?php if (isLoggedIn()): ?>
                    <li><a href="/web-version-3.0/admin/usuarios.php">Usuarios</a></li>
                    <li><a href="/web-version-3.0/logout.php">Salir</a></li>
                <?php else: ?>
                    <li><a href="/web-version-3.0/login.php">Login</a></li>
                <?php endif; ?>
            </ul>

        </div>
    </nav>
</header>

<main id="contenido">
