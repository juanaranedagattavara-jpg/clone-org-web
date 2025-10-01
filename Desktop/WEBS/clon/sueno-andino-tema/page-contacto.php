<?php
/**
 * Template Name: Contacto Page
 * 
 * @package SueñoAndino
 */

get_header(); ?>

<main id="main" class="site-main">
    <!-- Contacto Hero Section -->
    <section class="contacto-hero-section">
        <div class="container">
            <div class="contacto-hero-content">
                <h1>Contáctanos</h1>
                <p>Estamos aquí para ayudarte a transformar tu territorio. ¡Conversemos sobre tu proyecto!</p>
            </div>
        </div>
    </section>

    <!-- Contacto Content Section -->
    <section class="contacto-content-section">
        <div class="container">
            <div class="contacto-grid">
                <!-- Información de Contacto -->
                <div class="contacto-info">
                    <h2>Información de Contacto</h2>
                    <div class="contacto-details">
                        <div class="contacto-item">
                            <div class="contacto-icon">📍</div>
                            <div class="contacto-text">
                                <h3>Ubicación</h3>
                                <p>Lima, Perú<br>Av. Principal 123, Miraflores</p>
                            </div>
                        </div>
                        <div class="contacto-item">
                            <div class="contacto-icon">📞</div>
                            <div class="contacto-text">
                                <h3>Teléfono</h3>
                                <p>+51-999-888-777<br>+51-1-234-5678</p>
                            </div>
                        </div>
                        <div class="contacto-item">
                            <div class="contacto-icon">✉️</div>
                            <div class="contacto-text">
                                <h3>Email</h3>
                                <p>hola@sueñoandino.com<br>info@sueñoandino.com</p>
                            </div>
                        </div>
                        <div class="contacto-item">
                            <div class="contacto-icon">🕒</div>
                            <div class="contacto-text">
                                <h3>Horarios</h3>
                                <p>Lunes - Viernes: 9:00 - 18:00<br>Sábados: 9:00 - 14:00</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Formulario de Contacto -->
                <div class="contacto-form-container">
                    <h2>Envíanos un Mensaje</h2>
                    <form class="contacto-form" id="contactoForm">
                        <div class="form-row">
                            <div class="form-group">
                                <label for="nombre">Nombre *</label>
                                <input type="text" id="nombre" name="nombre" required>
                            </div>
                            <div class="form-group">
                                <label for="apellido">Apellido *</label>
                                <input type="text" id="apellido" name="apellido" required>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group">
                                <label for="email">Email *</label>
                                <input type="email" id="email" name="email" required>
                            </div>
                            <div class="form-group">
                                <label for="telefono">Teléfono</label>
                                <input type="tel" id="telefono" name="telefono">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="empresa">Empresa/Organización</label>
                            <input type="text" id="empresa" name="empresa">
                        </div>
                        <div class="form-group">
                            <label for="servicio">Servicio de Interés</label>
                            <select id="servicio" name="servicio">
                                <option value="">Selecciona un servicio</option>
                                <option value="educacion">Educación Regenerativa</option>
                                <option value="emprendimiento">Emprendimiento Social</option>
                                <option value="consultoria">Consultoría Territorial</option>
                                <option value="otro">Otro</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="mensaje">Mensaje *</label>
                            <textarea id="mensaje" name="mensaje" rows="5" required placeholder="Cuéntanos sobre tu proyecto y cómo podemos ayudarte..."></textarea>
                        </div>
                        <div class="form-group checkbox-group">
                            <label class="checkbox-label">
                                <input type="checkbox" name="privacidad" required>
                                <span class="checkmark"></span>
                                Acepto la <a href="#" target="_blank">política de privacidad</a> y el tratamiento de mis datos personales.
                            </label>
                        </div>
                        <div class="form-group checkbox-group">
                            <label class="checkbox-label">
                                <input type="checkbox" name="newsletter">
                                <span class="checkmark"></span>
                                Quiero recibir información sobre proyectos y novedades.
                            </label>
                        </div>
                        <button type="submit" class="btn btn-primary btn-full">Enviar Mensaje</button>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <!-- Mapa Section -->
    <section class="mapa-section">
        <div class="container">
            <h2>Nuestra Ubicación</h2>
            <div class="mapa-container">
                <div class="mapa-placeholder">
                    <span class="placeholder-icon">🗺️</span>
                    <p>Mapa interactivo de nuestra ubicación</p>
                    <p><small>Lima, Perú - Av. Principal 123, Miraflores</small></p>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Final Section -->
    <section class="cta-final-section">
        <div class="container">
            <div class="cta-final-content">
                <h2>¿Listo para comenzar tu proyecto regenerativo?</h2>
                <p>Únete a las comunidades que ya están transformando sus territorios con nosotros.</p>
                <div class="cta-buttons">
                    <a href="mailto:hola@sueñoandino.com" class="btn btn-primary">Contactar Ahora</a>
                    <a href="#" onclick="showGuideModal(); return false;" class="btn btn-secondary">Descargar Guía</a>
                </div>
            </div>
        </div>
    </section>
</main>

<?php get_footer(); ?>
