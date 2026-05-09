<?php

require_once '../auth.php';
requireLogin();

require_once '../config/Database.php';

$pageTitle = 'Formulario Usuario - Quinta Dalam';
require_once '../includes/header.php';

$db = new Database();
$conn = $db->connect();

$id = $_GET['id'] ?? null;

$nombre = '';
$email = '';
$tipo_usuario = 'admin';

if ($id && $conn) {

    $query = "SELECT * FROM usuarios WHERE id = :id LIMIT 1";

    $stmt = $conn->prepare($query);
    $stmt->bindParam(':id', $id);
    $stmt->execute();

    $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($usuario) {

        $nombre = $usuario['nombre'];
        $email = $usuario['email'];
        $tipo_usuario = $usuario['tipo_usuario'];
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && $conn) {

    $nombre = $_POST['nombre'] ?? '';
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';
    $tipo_usuario = $_POST['tipo_usuario'] ?? 'admin';

    if ($id) {

        if (!empty($password)) {

            $password_hash = password_hash($password, PASSWORD_DEFAULT);

            $query = "
                UPDATE usuarios
                SET
                    nombre = :nombre,
                    email = :email,
                    password_hash = :password_hash,
                    tipo_usuario = :tipo_usuario
                WHERE id = :id
            ";

            $stmt = $conn->prepare($query);

            $stmt->bindParam(':password_hash', $password_hash);

        } else {

            $query = "
                UPDATE usuarios
                SET
                    nombre = :nombre,
                    email = :email,
                    tipo_usuario = :tipo_usuario
                WHERE id = :id
            ";

            $stmt = $conn->prepare($query);
        }

        $stmt->bindParam(':id', $id);

    } else {

        $password_hash = password_hash($password, PASSWORD_DEFAULT);

        $query = "
            INSERT INTO usuarios
            (
                nombre,
                email,
                password_hash,
                tipo_usuario
            )
            VALUES
            (
                :nombre,
                :email,
                :password_hash,
                :tipo_usuario
            )
        ";

        $stmt = $conn->prepare($query);

        $stmt->bindParam(':password_hash', $password_hash);
    }

    $stmt->bindParam(':nombre', $nombre);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':tipo_usuario', $tipo_usuario);

    if ($stmt->execute()) {

        header('Location: usuarios.php');
        exit;
    }
}
?>

<section class="page-header">

    <div class="container">

        <h1>

            <?= $id ? 'Editar Usuario' : 'Nuevo Usuario' ?>

        </h1>

    </div>

</section>

<section class="section">

    <div class="container">

        <form class="contact-form-section" method="POST">

            <div class="form-row">

                <div class="form-group full-width">

                    <label>Nombre</label>

                    <input
                        type="text"
                        name="nombre"
                        value="<?= htmlspecialchars($nombre) ?>"
                        required
                    >

                </div>

            </div>

            <div class="form-row">

                <div class="form-group full-width">

                    <label>Email</label>

                    <input
                        type="email"
                        name="email"
                        value="<?= htmlspecialchars($email) ?>"
                        required
                    >

                </div>

            </div>

            <div class="form-row">

                <div class="form-group full-width">

                    <label>

                        <?= $id ? 'Nueva Contraseña (opcional)' : 'Contraseña' ?>

                    </label>

                    <input
                        type="password"
                        name="password"
                        <?= $id ? '' : 'required' ?>
                    >

                </div>

            </div>

            <div class="form-row">

                <div class="form-group full-width">

                    <label>Tipo Usuario</label>

                    <select name="tipo_usuario">

                        <option
                            value="admin"
                            <?= $tipo_usuario == 'admin' ? 'selected' : '' ?>
                        >
                            Admin
                        </option>

                        <option
                            value="empleado"
                            <?= $tipo_usuario == 'empleado' ? 'selected' : '' ?>
                        >
                            Empleado
                        </option>

                        <option
                            value="cliente"
                            <?= $tipo_usuario == 'cliente' ? 'selected' : '' ?>
                        >
                            Cliente
                        </option>

                    </select>

                </div>

            </div>

            <div class="form-actions">

                <button
                    type="submit"
                    class="btn-primary"
                >
                    Guardar Usuario
                </button>

                <a
                    href="usuarios.php"
                    class="btn-secondary"
                >
                    Volver
                </a>

            </div>

        </form>

    </div>

</section>

<?php require_once '../includes/footer.php'; ?>