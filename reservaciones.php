<?php
$pageTitle = 'Reservaciones - Quinta Dalam';
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

        <h1>Reserva tu Habitación</h1>

        <p>
            Completa el formulario para realizar tu reservación.
        </p>

    </div>

</section>

<section class="reservation-section">

    <div class="container">

        <div class="reservation-layout">

            <form
                class="availability-panel"
                method="POST"
                action="controllers/guardar_reservacion.php"
            >

                <h2>Formulario de Reservación</h2>

                <div class="form-row">

                    <div class="form-group">

                        <label for="nombre">
                            Nombre Completo
                        </label>

                        <input
                            type="text"
                            id="nombre"
                            name="nombre"
                            required
                        >

                    </div>

                    <div class="form-group">

                        <label for="correo">
                            Correo Electrónico
                        </label>

                        <input
                            type="email"
                            id="correo"
                            name="correo"
                            required
                        >

                    </div>

                </div>

                <div class="form-row">

                    <div class="form-group">

                        <label for="telefono">
                            Teléfono
                        </label>

                        <input
                            type="text"
                            id="telefono"
                            name="telefono"
                            required
                        >

                    </div>

                    <div class="form-group">

                        <label for="habitacion">
                            Habitación
                        </label>

                        <select
    id="producto_servicio_id"
    name="producto_servicio_id"
    required
>


                            <option value="">
                                Selecciona una habitación
                            </option>

                            <?php foreach ($habitaciones as $habitacion): ?>

                                <option
                                    value="<?= $habitacion['id'] ?>"
                                >
                                    <?= htmlspecialchars($habitacion['nombre']) ?>
                                    -
                                    $<?= number_format($habitacion['precio'], 2) ?>
                                </option>

                            <?php endforeach; ?>

                        </select>
                        <div id="info-habitacion"></div>

                    </div>

                </div>

                <div class="form-row">

                    <div class="form-group">

                        <label for="checkin">
                            Fecha de Entrada
                        </label>

                        <input
                            type="date"
                            id="checkin"
                            name="checkin"
                            required
                        >

                    </div>

                    <div class="form-group">

                        <label for="checkout">
                            Fecha de Salida
                        </label>

                        <input
                            type="date"
                            id="checkout"
                            name="checkout"
                            required
                        >

                    </div>

                </div>

                <div class="form-row">

                    <div class="form-group">

                        <label for="huespedes">
                            Número de Huéspedes
                        </label>

                        <input
                            type="number"
                            id="huespedes"
                            name="huespedes"
                            min="1"
                            max="10"
                            required
                        >

                    </div>

                </div>

                <div class="form-row">

                    <div class="form-group full-width">

                        <label for="comentarios">
                            Comentarios
                        </label>

                        <textarea
                            id="comentarios"
                            name="comentarios"
                            rows="5"
                        ></textarea>

                    </div>

                </div>

                <div class="terms-wrap">

                    <input
                        type="checkbox"
                        id="terminos"
                        required
                    >

                    <label for="terminos">
                        Acepto los términos y condiciones
                    </label>

                </div>

                <div class="form-actions">

                    <button
                        type="reset"
                        class="btn-secondary"
                    >
                        Limpiar
                    </button>

                    <button
                        type="submit"
                        class="btn-primary"
                    >
                        Reservar Ahora
                    </button>

                </div>

            </form>

        </div>

    </div>

</section>
<script src="assets/js/ajax-habitacion.js"></script>

<?php require_once 'includes/footer.php'; ?>