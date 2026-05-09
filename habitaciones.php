<?php
$pageTitle = 'Habitaciones - Quinta Dalam';
require_once 'includes/header.php';

require_once 'config/Database.php';

$db = new Database();
$conn = $db->connect();

$habitaciones = [];

if ($conn) {

    $query = "SELECT * FROM productos_servicios 
              WHERE tipo = 'habitacion' 
              AND activo = 1";

    $stmt = $conn->prepare($query);
    $stmt->execute();

    $habitaciones = $stmt->fetchAll(PDO::FETCH_ASSOC);
}
?>

<section class="page-header">

    <div class="container">

        <h1>Nuestras Habitaciones</h1>

        <p>
            Descubre habitaciones inspiradas en municipios de Michoacán.
        </p>

    </div>

</section>

<section class="rooms-preview">

    <div class="container">

        <h2>Habitaciones Disponibles</h2>

        <p class="subtitle">
            Diseños únicos para una experiencia inolvidable.
        </p>

        <div class="rooms-grid">

            <?php if (!empty($habitaciones)): ?>

                <?php foreach ($habitaciones as $habitacion): ?>

                    <article class="room-card">

                        <div class="room-image">

                            <img
                                src="fotos/hotel laguna.jpg"
                                alt="<?= htmlspecialchars($habitacion['nombre']) ?>"
                            >

                        </div>

                        <h4>
                            <?= htmlspecialchars($habitacion['nombre']) ?>
                        </h4>

                        <p>
                            <?= htmlspecialchars($habitacion['descripcion']) ?>
                        </p>

                        <p style="padding: 0 14px 14px; font-weight: bold;">

                            $<?= number_format($habitacion['precio'], 2) ?>

                        </p>

                        <p style="padding: 0 14px 14px;">

                            Capacidad:
                            <?= htmlspecialchars($habitacion['capacidad']) ?>
                            personas

                        </p>

                        <a
                            href="reservaciones.php"
                            class="btn-secondary"
                            style="margin:14px;"
                        >
                            Reservar
                        </a>

                    </article>

                <?php endforeach; ?>

            <?php else: ?>

                <p>
                    No hay habitaciones disponibles.
                </p>

            <?php endif; ?>

        </div>

    </div>

</section>

<section class="why-visit">

    <div class="container">

        <h2>¿Por qué hospedarte con nosotros?</h2>

        <p class="subtitle">
            Vive una experiencia única en Quinta Dalam.
        </p>

        <div class="why-grid">

            <div class="why-card">

                <div class="why-icon">🌿</div>

                <h4>Ambiente Natural</h4>

                <p>
                    Espacios rodeados de tranquilidad y naturaleza.
                </p>

            </div>

            <div class="why-card">

                <div class="why-icon">🛏️</div>

                <h4>Máxima Comodidad</h4>

                <p>
                    Habitaciones amplias y confortables.
                </p>

            </div>

            <div class="why-card">

                <div class="why-icon">✨</div>

                <h4>Diseño Temático</h4>

                <p>
                    Inspirado en la cultura y tradición de Michoacán.
                </p>

            </div>

            <div class="why-card">

                <div class="why-icon">📍</div>

                <h4>Excelente Ubicación</h4>

                <p>
                    Cerca de lugares turísticos y áreas recreativas.
                </p>

            </div>

        </div>

    </div>

</section>

<?php require_once 'includes/footer.php'; ?>