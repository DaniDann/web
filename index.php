<?php
$pageTitle = 'Inicio - Quinta Dalam';
require_once 'includes/header.php';
?>

<section class="hero">

    <div class="hero-content">

        <h2>
            Bienvenido a Quinta Dalam
        </h2>

        <p>
            Descubre una experiencia única de descanso inspirada en la belleza y cultura de Michoacán.
        </p>

        <div style="display:flex;gap:12px;justify-content:center;flex-wrap:wrap;">

            <a
                href="reservaciones.php"
                class="btn-primary"
            >
                Reservar Ahora
            </a>

            <a
                href="habitaciones.php"
                class="btn-secondary"
            >
                Ver Habitaciones
            </a>

        </div>

    </div>

</section>

<section class="mission-vision">

    <div class="container">

        <div class="mission">

            <h3>Misión</h3>

            <p>
                Brindar una estancia cómoda, segura y memorable mediante habitaciones temáticas, atención cálida y servicios de calidad.
            </p>

        </div>

        <div class="vision">

            <h3>Visión</h3>

            <p>
                Ser un hotel reconocido por ofrecer experiencias únicas inspiradas en la cultura y tradición de Michoacán.
            </p>

        </div>

    </div>

</section>

<section class="rooms-preview">

    <div class="container">

        <h2>
            Habitaciones Destacadas
        </h2>

        <p class="subtitle">
            Espacios diseñados para ofrecer confort y elegancia.
        </p>

        <div class="rooms-grid">

            <article class="room-card">

                <div class="room-image">
                    <img
                        src="fotos/hotel laguna.jpg"
                        alt="Habitación Deluxe"
                    >
                </div>

                <h4>Habitación Deluxe</h4>

                <p>
                    Espacio moderno y elegante ideal para descansar.
                </p>

                <a
                    href="habitaciones.php"
                    class="btn-secondary"
                >
                    Ver más
                </a>

            </article>

            <article class="room-card">

                <div class="room-image">
                    <img
                        src="fotos/hotel laguna.jpg"
                        alt="Suite Familiar"
                    >
                </div>

                <h4>Suite Familiar</h4>

                <p>
                    Perfecta para familias que buscan comodidad y amplitud.
                </p>

                <a
                    href="habitaciones.php"
                    class="btn-secondary"
                >
                    Ver más
                </a>

            </article>

            <article class="room-card">

                <div class="room-image">
                    <img
                        src="fotos/hotel laguna.jpg"
                        alt="Suite Premium"
                    >
                </div>

                <h4>Suite Premium</h4>

                <p>
                    Una experiencia exclusiva con diseño inspirado en Michoacán.
                </p>

                <a
                    href="habitaciones.php"
                    class="btn-secondary"
                >
                    Ver más
                </a>

            </article>

        </div>

    </div>

</section>

<section class="features">

    <div class="container">

        <h2>
            ¿Por qué elegir Quinta Dalam?
        </h2>

        <div class="features-grid">

            <div class="feature">

                <div class="feature-icon">🌿</div>

                <h4>Ambiente Natural</h4>

                <p>
                    Rodeado de tranquilidad y naturaleza.
                </p>

            </div>

            <div class="feature">

                <div class="feature-icon">🛏️</div>

                <h4>Máxima Comodidad</h4>

                <p>
                    Habitaciones cómodas y totalmente equipadas.
                </p>

            </div>

            <div class="feature">

                <div class="feature-icon">✨</div>

                <h4>Diseño Temático</h4>

                <p>
                    Inspirado en municipios y tradiciones de Michoacán.
                </p>

            </div>

            <div class="feature">

                <div class="feature-icon">📍</div>

                <h4>Excelente Ubicación</h4>

                <p>
                    Cerca de zonas turísticas y recreativas.
                </p>

            </div>

        </div>

    </div>

</section>

<section class="cta-section">

    <div class="container">

        <h2>
            Reserva tu estancia hoy mismo
        </h2>

        <p>
            Vive una experiencia inolvidable en Quinta Dalam.
        </p>

        <a
            href="reservaciones.php"
            class="btn-primary-large"
        >
            Reservar Ahora
        </a>

    </div>

</section>

<?php require_once 'includes/footer.php'; ?>