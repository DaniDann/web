<?php
$pageTitle = 'Contacto - Quinta Dalam';
require_once 'includes/header.php';
?>

<section class="contact-section">

    <div class="container">

        <h2>Contacto</h2>

        <p>Escríbenos y con gusto te ayudamos.</p>

        <div class="contact-info-grid">

            <div class="contact-card">
                <h3>Dirección</h3>
                <p>Dirección de ejemplo, Michoacán, MX.</p>
            </div>

            <div class="contact-card">
                <h3>Teléfono</h3>
                <p>+52 000 000 0000</p>
            </div>

            <div class="contact-card">
                <h3>Correo</h3>
                <p>contacto@quintadalam.com</p>
            </div>

        </div>

        <form class="contact-form-section" method="post">

            <div class="form-row">

                <div class="form-group">
                    <label for="nombre">Nombre</label>
                    <input type="text" id="nombre" name="nombre" required>
                </div>

                <div class="form-group">
                    <label for="correo">Correo</label>
                    <input type="email" id="correo" name="correo" required>
                </div>

            </div>

            <div class="form-row">

                <div class="form-group">
                    <label for="telefono">Teléfono</label>
                    <input type="text" id="telefono" name="telefono">
                </div>

                <div class="form-group">
                    <label for="asunto">Asunto</label>
                    <input type="text" id="asunto" name="asunto" required>
                </div>

            </div>

            <div class="form-row">

                <div class="form-group full-width">
                    <label for="mensaje">Mensaje</label>
                    <textarea id="mensaje" name="mensaje" rows="6" required></textarea>
                </div>

            </div>

            <div class="form-actions">
                <button type="reset" class="btn-secondary">Limpiar</button>
                <button type="submit" class="btn-primary">Enviar</button>
            </div>

        </form>

    </div>

</section>

<?php require_once 'includes/footer.php'; ?>