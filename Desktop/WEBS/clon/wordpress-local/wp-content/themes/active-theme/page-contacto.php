<?php
/**
 * Contacto page template
 */
get_header(); ?>

<main class="contacto-page">
    <div class="container">
        <h1>Trabajemos Juntos</h1>
        <p>¿Tienes un proyecto en mente? Conversemos sobre cómo podemos trabajar juntos para transformar tu territorio.</p>
        
        <div class="contact-info">
            <p>📍 Ubicación Lima, Perú</p>
            <p>📞 Teléfono +51-999-888-777</p>
            <p>✉️ Email hola@sueñoandino.com</p>
        </div>
        
        <form class="contact-form">
            <input type="text" name="nombre" placeholder="Tu nombre completo" required>
            <input type="email" name="email" placeholder="tu@email.com" required>
            <textarea name="mensaje" placeholder="Cuéntanos sobre tu proyecto..." required></textarea>
            <button type="submit">Enviar Mensaje</button>
        </form>
    </div>
</main>

<?php get_footer(); ?>
