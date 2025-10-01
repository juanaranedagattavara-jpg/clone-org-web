<?php
/**
 * Template Name: Página Principal
 * 
 * @package SueñoAndino
 */

get_header(); ?>

<main id="main" class="site-main">
    <!-- Hero Section -->
    <section class="hero-section">
        <div class="container">
            <div class="hero-content">
                <h1 class="hero-title">Transformando Comunidades Sostenibles</h1>
                <p class="hero-description">Desarrollamos soluciones integrales para el crecimiento territorial sostenible, conectando comunidades con oportunidades de desarrollo.</p>
                <div class="hero-buttons">
                    <div class="wp-block-button is-style-primary">
                        <a class="wp-block-button__link" href="#servicios">Conoce Nuestros Servicios</a>
                    </div>
                    <div class="wp-block-button is-style-secondary">
                        <a class="wp-block-button__link" href="#" onclick="showGuideModal(); return false;">Descarga Guía Gratuita</a>
                    </div>
                </div>
                <div class="hero-stats">
                    <div class="stat-item">
                        <h3 class="stat-number">50+</h3>
                        <p class="stat-label">Proyectos Completados</p>
                    </div>
                    <div class="stat-item">
                        <h3 class="stat-number">15</h3>
                        <p class="stat-label">Años de Experiencia</p>
                    </div>
                    <div class="stat-item">
                        <h3 class="stat-number">200+</h3>
                        <p class="stat-label">Comunidades Beneficiadas</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Timeline Section -->
    <section class="timeline-section">
        <div class="container">
            <div class="section-header">
                <h2>Nuestra Historia</h2>
                <p>Descubre los momentos importantes que han marcado nuestro camino de transformación territorial regenerativa</p>
            </div>
            <div class="anne-timeline">
                <div class="anne-timeline-item">
                    <div class="anne-timeline-image">
                        <div class="image-placeholder">
                            <div class="placeholder-content">
                                <p class="placeholder-icon">📅</p>
                            </div>
                        </div>
                    </div>
                    <div class="anne-timeline-dot"></div>
                    <div class="anne-timeline-content">
                        <p class="anne-year">2010</p>
                        <h3>Fundación de Sueño Andino</h3>
                        <p>Iniciamos nuestro compromiso con el desarrollo territorial sostenible en Chile, enfocándonos en comunidades rurales y urbanas marginadas.</p>
                    </div>
                </div>

                <div class="anne-timeline-item">
                    <div class="anne-timeline-image">
                        <div class="image-placeholder">
                            <div class="placeholder-content">
                                <p class="placeholder-icon">📅</p>
                            </div>
                        </div>
                    </div>
                    <div class="anne-timeline-dot"></div>
                    <div class="anne-timeline-content">
                        <p class="anne-year">2015</p>
                        <h3>Expansión Regional</h3>
                        <p>Ampliamos nuestros servicios a 5 regiones del país, impactando a más de 50 comunidades con proyectos de desarrollo sostenible.</p>
                    </div>
                </div>

                <div class="anne-timeline-item">
                    <div class="anne-timeline-image">
                        <div class="image-placeholder">
                            <div class="placeholder-content">
                                <p class="placeholder-icon">📅</p>
                            </div>
                        </div>
                    </div>
                    <div class="anne-timeline-dot"></div>
                    <div class="anne-timeline-content">
                        <p class="anne-year">2020</p>
                        <h3>Innovación Digital</h3>
                        <p>Implementamos tecnologías digitales para optimizar nuestros procesos de desarrollo territorial y mejorar la participación ciudadana.</p>
                    </div>
                </div>

                <div class="anne-timeline-item">
                    <div class="anne-timeline-image">
                        <div class="image-placeholder">
                            <div class="placeholder-content">
                                <p class="placeholder-icon">📅</p>
                            </div>
                        </div>
                    </div>
                    <div class="anne-timeline-dot"></div>
                    <div class="anne-timeline-content">
                        <p class="anne-year">2024</p>
                        <h3>Liderazgo Nacional</h3>
                        <p>Nos consolidamos como referentes en desarrollo territorial sostenible a nivel nacional, con reconocimiento internacional.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Services Section -->
    <section class="services-section" id="servicios">
        <div class="container">
            <div class="section-header">
                <p class="section-subtitle">Lo que Ofrecemos</p>
                <h2>Nuestros Servicios</h2>
                <p class="section-description">Nuestros servicios están diseñados para generar impacto real en las comunidades, combinando sabiduría ancestral con metodologías modernas.</p>
            </div>
            <div class="services-grid">
                <div class="service-card">
                    <div class="service-icon-wrapper">
                        <p class="service-icon">🏗️</p>
                    </div>
                    <h3>Desarrollo Territorial</h3>
                    <p>Planificación y ejecución de proyectos de desarrollo territorial sostenible que transforman comunidades y generan oportunidades de crecimiento.</p>
                </div>
                <div class="service-card">
                    <div class="service-icon-wrapper">
                        <p class="service-icon">🌱</p>
                    </div>
                    <h3>Sostenibilidad Ambiental</h3>
                    <p>Implementación de prácticas ambientales responsables y sostenibles que protegen el medio ambiente mientras impulsan el desarrollo económico.</p>
                </div>
                <div class="service-card">
                    <div class="service-icon-wrapper">
                        <p class="service-icon">🤝</p>
                    </div>
                    <h3>Participación Comunitaria</h3>
                    <p>Fortalecimiento del tejido social y participación ciudadana activa para construir comunidades más cohesionadas y resilientes.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Testimonials Section -->
    <section class="testimonials-section">
        <div class="container">
            <div class="section-header">
                <p class="section-subtitle">Testimonios</p>
                <h2>Lo que Dicen Nuestras Comunidades</h2>
                <p class="section-description">Testimonios reales de comunidades que han transformado su territorio a través de nuestro acompañamiento regenerativo.</p>
            </div>
            <div class="testimonials-grid">
                <div class="testimonial-card">
                    <div class="testimonial-header">
                        <div class="testimonial-avatar">
                            <p class="avatar-placeholder">M</p>
                        </div>
                        <div class="testimonial-info">
                            <h4>María González</h4>
                            <p>Alcaldesa de Valparaíso</p>
                        </div>
                    </div>
                    <blockquote>
                        <p>Sueño Andino transformó completamente nuestra visión del desarrollo territorial. Su enfoque sostenible y participativo ha sido clave para el crecimiento de nuestra comuna.</p>
                    </blockquote>
                </div>
                <div class="testimonial-card">
                    <div class="testimonial-header">
                        <div class="testimonial-avatar">
                            <p class="avatar-placeholder">C</p>
                        </div>
                        <div class="testimonial-info">
                            <h4>Carlos Mendoza</h4>
                            <p>Director de Desarrollo Rural</p>
                        </div>
                    </div>
                    <blockquote>
                        <p>La metodología de Sueño Andino es innovadora y efectiva. Han logrado resultados excepcionales en comunidades que antes parecían sin esperanza de desarrollo.</p>
                    </blockquote>
                </div>
                <div class="testimonial-card">
                    <div class="testimonial-header">
                        <div class="testimonial-avatar">
                            <p class="avatar-placeholder">A</p>
                        </div>
                        <div class="testimonial-info">
                            <h4>Ana Rodríguez</h4>
                            <p>Líder Comunitaria</p>
                        </div>
                    </div>
                    <blockquote>
                        <p>Gracias a Sueño Andino, nuestra comunidad ahora tiene un plan de desarrollo claro y sostenible. Han sido un verdadero socio en nuestro crecimiento.</p>
                    </blockquote>
                </div>
            </div>
        </div>
    </section>

    <!-- Team Section -->
    <section class="team-section" id="equipo">
        <div class="container">
            <div class="section-header">
                <p class="section-subtitle">Nuestro Equipo</p>
                <h2>Conoce Nuestro Equipo</h2>
                <p class="section-description">Un equipo comprometido con el desarrollo territorial y la transformación de comunidades.</p>
            </div>
            <div class="team-grid">
                <div class="team-member">
                    <div class="member-image">
                        <div class="image-placeholder">
                            <div class="placeholder-content">
                                <p class="placeholder-icon">👤</p>
                            </div>
                        </div>
                        <div class="decorative-dots"></div>
                        <div class="decorative-shape"></div>
                    </div>
                    <h4>Juan Pérez</h4>
                    <p>Director Ejecutivo</p>
                </div>
                <div class="team-member">
                    <div class="member-image">
                        <div class="image-placeholder">
                            <div class="placeholder-content">
                                <p class="placeholder-icon">👤</p>
                            </div>
                        </div>
                        <div class="decorative-dots"></div>
                        <div class="decorative-shape"></div>
                    </div>
                    <h4>María Silva</h4>
                    <p>Coordinadora de Proyectos</p>
                </div>
                <div class="team-member">
                    <div class="member-image">
                        <div class="image-placeholder">
                            <div class="placeholder-content">
                                <p class="placeholder-icon">👤</p>
                            </div>
                        </div>
                        <div class="decorative-dots"></div>
                        <div class="decorative-shape"></div>
                    </div>
                    <h4>Carlos López</h4>
                    <p>Especialista en Sostenibilidad</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Contact Section -->
    <section class="contact-section" id="contacto">
        <div class="container">
            <div class="contact-content">
                <h2>¿Listo para Transformar tu Comunidad?</h2>
                <p>Contáctanos y descubre cómo podemos ayudarte a desarrollar tu territorio de manera sostenible.</p>
                <div class="contact-buttons">
                    <div class="wp-block-button is-style-primary">
                        <a class="wp-block-button__link" href="mailto:info@sueñoandino.org">Contactar Ahora</a>
                    </div>
                    <div class="wp-block-button is-style-secondary">
                        <a class="wp-block-button__link" href="#" onclick="showGuideModal(); return false;">Descargar Guía</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>

<?php get_footer(); ?>