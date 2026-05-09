<?php

require_once '../auth.php';
requireLogin();

require_once '../config/Database.php';

$pageTitle = 'Usuarios - Quinta Dalam';
require_once '../includes/header.php';

$db = new Database();
$conn = $db->connect();

$usuarios = [];

if ($conn) {

    $query = "
        SELECT 
            usuarios.id,
            usuarios.nombre,
            usuarios.email,
            roles.nombre AS rol,
            usuarios.tipo_usuario
        FROM usuarios
        INNER JOIN roles 
            ON usuarios.rol_id = roles.id
        ORDER BY usuarios.id ASC
    ";

    $stmt = $conn->prepare($query);
    $stmt->execute();

    $usuarios = $stmt->fetchAll(PDO::FETCH_ASSOC);
}
?>

<style>

.admin-section{
    padding:60px 0;
}

.admin-header-row{
    display:flex;
    justify-content:space-between;
    align-items:center;
    margin-bottom:24px;
    flex-wrap:wrap;
    gap:12px;
}

.admin-table-wrapper{
    width:100%;
    overflow-x:auto;
    background:#ffffff;
    border-radius:18px;
    box-shadow:0 8px 24px rgba(0,0,0,.08);
    border:1px solid #e5e7eb;
}

.admin-table{
    width:100%;
    min-width:900px;
    border-collapse:collapse;
    background:#ffffff;
}

.admin-table thead{
    background:#1f5c2e;
    color:#ffffff;
}

.admin-table th,
.admin-table td{
    padding:16px;
    text-align:left;
    border-bottom:1px solid #e5e7eb;
}

.admin-table tbody tr:hover{
    background:#f9fafb;
}

.admin-actions{
    display:flex;
    gap:10px;
    flex-wrap:wrap;
}

.btn-danger{
    display:inline-flex;
    align-items:center;
    justify-content:center;
    padding:11px 18px;
    border-radius:14px;
    background:#dc2626;
    color:#ffffff;
    font-weight:800;
    text-decoration:none;
}

.btn-danger:hover{
    background:#b91c1c;
}

</style>

<section class="page-header">

    <div class="container">

        <h1>Administración de Usuarios</h1>

        <p>
            Gestiona usuarios del sistema.
        </p>

    </div>

</section>

<section class="admin-section">

    <div class="container">

        <div class="admin-header-row">

            <h2>Usuarios Registrados</h2>

            <a
                href="usuario_form.php"
                class="btn-primary"
            >
                Nuevo Usuario
            </a>

        </div>

        <div class="admin-table-wrapper">

            <table class="admin-table">

                <thead>

                    <tr>

                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Email</th>
                        <th>Rol</th>
                        <th>Tipo</th>
                        <th>Acciones</th>

                    </tr>

                </thead>

                <tbody>

                    <?php if (!empty($usuarios)): ?>

                        <?php foreach ($usuarios as $usuario): ?>

                            <tr>

                                <td>
                                    <?= $usuario['id'] ?>
                                </td>

                                <td>
                                    <?= htmlspecialchars($usuario['nombre']) ?>
                                </td>

                                <td>
                                    <?= htmlspecialchars($usuario['email']) ?>
                                </td>

                                <td>
                                    <?= htmlspecialchars($usuario['rol']) ?>
                                </td>

                                <td>
                                    <?= htmlspecialchars($usuario['tipo_usuario']) ?>
                                </td>

                                <td>

                                    <div class="admin-actions">

                                        <a
                                            href="usuario_form.php?id=<?= $usuario['id'] ?>"
                                            class="btn-secondary"
                                        >
                                            Editar
                                        </a>

                                        <a
                                            href="usuario_delete.php?id=<?= $usuario['id'] ?>"
                                            class="btn-danger"
                                            onclick="return confirm('¿Eliminar usuario?')"
                                        >
                                            Eliminar
                                        </a>

                                    </div>

                                </td>

                            </tr>

                        <?php endforeach; ?>

                    <?php else: ?>

                        <tr>

                            <td colspan="6">
                                No hay usuarios registrados.
                            </td>

                        </tr>

                    <?php endif; ?>

                </tbody>

            </table>

        </div>

    </div>

</section>

<?php require_once '../includes/footer.php'; ?>