<?php
/**
 * Contacto page template
 */
get_header(); ?>

<main class="contacto-page">
    <div class="container">
        <div class="contact-content">
            <div class="contact-info">
                <h1>Trabajemos Juntos</h1>
                <p>
                    ¿Tienes un proyecto en mente? Conversemos sobre cómo podemos
                    trabajar juntos para transformar tu territorio.
                </p>
                <div class="contact-details">
                    <div class="contact-item">
                        <div class="contact-icon">📍</div>
                        <div>
                            <div class="contact-label">Ubicación</div>
                            <div class="contact-value">Lima, Perú</div>
                        </div>
                    </div>
                    <div class="contact-item">
                        <div class="contact-icon">📞</div>
                        <div>
                            <div class="contact-label">Teléfono</div>
                            <div class="contact-value">+51-999-888-777</div>
                        </div>
                    </div>
                    <div class="contact-item">
                        <div class="contact-icon">✉️</div>
                        <div>
                            <div class="contact-label">Email</div>
                            <div class="contact-value">hola@sueñoandino.com</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="contact-form">
                <form id="contactForm">
                    <div class="form-group">
                        <input type="text" name="name" placeholder="Tu nombre completo" required>
                    </div>
                    <div class="form-group">
                        <input type="email" name="email" placeholder="tu@email.com" required>
                    </div>
                    <div class="form-group">
                        <textarea name="message" placeholder="Cuéntanos sobre tu proyecto..." required></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">
                        Enviar Mensaje
                    </button>
                </form>
            </div>
        </div>
    </div>
</main>

<?php get_footer(); ?>
