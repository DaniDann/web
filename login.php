<?php
session_start();

require_once 'config/Database.php';

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';

    $db = new Database();
    $conn = $db->connect();

    if ($conn) {

        $query = "SELECT usuarios.*, roles.nombre AS rol
                  FROM usuarios
                  INNER JOIN roles ON usuarios.rol_id = roles.id
                  WHERE usuarios.email = :email
                  LIMIT 1";

        $stmt = $conn->prepare($query);
        $stmt->bindParam(':email', $email);
        $stmt->execute();

        $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($usuario && $password === 'Admin12345') {

            $_SESSION['usuario_id'] = $usuario['id'];
            $_SESSION['usuario_nombre'] = $usuario['nombre'];
            $_SESSION['usuario_email'] = $usuario['email'];
            $_SESSION['rol'] = $usuario['rol'];

            header('Location: index.php');
            exit;

        } else {
            $error = 'Correo o contraseña incorrectos.';
        }

    } else {
        $error = 'No se pudo conectar a la base de datos.';
    }
}

$pageTitle = 'Login - Quinta Dalam';
require_once 'includes/header.php';
?>

<section class="page-header">
    <div class="container">
        <h1>Iniciar Sesión</h1>
        <p>Accede al sistema administrativo de Quinta Dalam.</p>
    </div>
</section>

<section class="contact-section">
    <div class="container">

        <form class="contact-form-section" method="POST" action="login.php">

            <h2>Login</h2>

            <?php if (!empty($error)): ?>
                <p style="color: red; margin-bottom: 15px;">
                    <?= htmlspecialchars($error) ?>
                </p>
            <?php endif; ?>

            <div class="form-row">
                <div class="form-group full-width">
                    <label for="email">Correo electrónico</label>
                    <input
                        type="email"
                        id="email"
                        name="email"
                        required
                    >
                </div>
            </div>

            <div class="form-row">
                <div class="form-group full-width">
                    <label for="password">Contraseña</label>
                    <input
                        type="password"
                        id="password"
                        name="password"
                        required
                    >
                </div>
            </div>

            <div class="form-actions">
                <button type="submit" class="btn-primary">
                    Entrar
                </button>
            </div>

            <p style="margin-top: 15px;">
                Usuario de prueba:
                <strong>admin@quintadalam.com</strong>
                <br>
                Contraseña:
                <strong>Admin12345</strong>
            </p>

        </form>

    </div>
</section>

<?php require_once 'includes/footer.php'; ?>