<?php
/**
 * Template Name: Home Page
 * 
 * Template para la página de inicio con todos los bloques personalizados
 */

get_header(); ?>

<main id="main" class="site-main">
    <!-- Hero Section -->
    <section class="wp-block-group hero-section">
        <div class="hero-content">
            <h1 class="hero-title">Transformando Comunidades Sostenibles</h1>
            <p class="hero-description">Desarrollamos soluciones integrales para el crecimiento territorial sostenible, conectando comunidades con oportunidades de desarrollo.</p>
            
            <div class="hero-buttons">
                <a href="#servicios" class="wp-block-button is-style-primary">
                    <span class="wp-block-button__link">Conoce Nuestros Servicios</span>
                </a>
                <a href="#" onclick="showGuideModal(); return false;" class="wp-block-button is-style-secondary">
                    <span class="wp-block-button__link">Descarga Guía Gratuita</span>
                </a>
            </div>
            
            <div class="hero-stats">
                <div class="stat-item">
                    <div class="stat-number">50+</div>
                    <div class="stat-label">Proyectos Completados</div>
                </div>
                <div class="stat-item">
                    <div class="stat-number">15</div>
                    <div class="stat-label">Años de Experiencia</div>
                </div>
                <div class="stat-item">
                    <div class="stat-number">200+</div>
                    <div class="stat-label">Comunidades Beneficiadas</div>
                </div>
            </div>
        </div>
    </section>

    <!-- Timeline Section -->
    <section class="wp-block-group timeline-section">
        <div class="anne-timeline">
            <div class="anne-timeline-item">
                <div class="anne-timeline-image">
                    <div class="image-placeholder">
                        <div class="placeholder-content">
                            <div class="placeholder-icon">📅</div>
                        </div>
                    </div>
                </div>
                <div class="anne-timeline-dot"></div>
                <div class="anne-timeline-content">
                    <span class="anne-year">2010</span>
                    <h3>Fundación de Sueño Andino</h3>
                    <p>Iniciamos nuestro compromiso con el desarrollo territorial sostenible en Chile, enfocándonos en comunidades rurales y urbanas marginadas.</p>
                </div>
            </div>
            
            <div class="anne-timeline-item">
                <div class="anne-timeline-image">
                    <div class="image-placeholder">
                        <div class="placeholder-content">
                            <div class="placeholder-icon">📅</div>
                        </div>
                    </div>
                </div>
                <div class="anne-timeline-dot"></div>
                <div class="anne-timeline-content">
                    <span class="anne-year">2015</span>
                    <h3>Expansión Regional</h3>
                    <p>Ampliamos nuestros servicios a 5 regiones del país, impactando a más de 50 comunidades con proyectos de desarrollo sostenible.</p>
                </div>
            </div>
            
            <div class="anne-timeline-item">
                <div class="anne-timeline-image">
                    <div class="image-placeholder">
                        <div class="placeholder-content">
                            <div class="placeholder-icon">📅</div>
                        </div>
                    </div>
                </div>
                <div class="anne-timeline-dot"></div>
                <div class="anne-timeline-content">
                    <span class="anne-year">2020</span>
                    <h3>Innovación Digital</h3>
                    <p>Implementamos tecnologías digitales para optimizar nuestros procesos de desarrollo territorial y mejorar la participación ciudadana.</p>
                </div>
            </div>
            
            <div class="anne-timeline-item">
                <div class="anne-timeline-image">
                    <div class="image-placeholder">
                        <div class="placeholder-content">
                            <div class="placeholder-icon">📅</div>
                        </div>
                    </div>
                </div>
                <div class="anne-timeline-dot"></div>
                <div class="anne-timeline-content">
                    <span class="anne-year">2024</span>
                    <h3>Liderazgo Nacional</h3>
                    <p>Nos consolidamos como referentes en desarrollo territorial sostenible a nivel nacional, con reconocimiento internacional.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Services Section -->
    <section class="wp-block-group services-section" id="servicios">
        <div class="services-grid">
            <div class="service-card">
                <div class="service-icon-wrapper">
                    <div class="service-icon">🏗️</div>
                </div>
                <h3>Desarrollo Territorial</h3>
                <p>Planificación y ejecución de proyectos de desarrollo territorial sostenible que transforman comunidades y generan oportunidades de crecimiento.</p>
            </div>
            
            <div class="service-card">
                <div class="service-icon-wrapper">
                    <div class="service-icon">🌱</div>
                </div>
                <h3>Sostenibilidad Ambiental</h3>
                <p>Implementación de prácticas ambientales responsables y sostenibles que protegen el medio ambiente mientras impulsan el desarrollo económico.</p>
            </div>
            
            <div class="service-card">
                <div class="service-icon-wrapper">
                    <div class="service-icon">🤝</div>
                </div>
                <h3>Participación Comunitaria</h3>
                <p>Fortalecimiento del tejido social y participación ciudadana activa para construir comunidades más cohesionadas y resilientes.</p>
            </div>
        </div>
    </section>

    <!-- Testimonials Section -->
    <section class="wp-block-group testimonials-section">
        <div class="testimonials-grid">
            <div class="testimonial-card">
                <div class="testimonial-header">
                    <div class="testimonial-avatar">
                        <div class="avatar-placeholder">M</div>
                    </div>
                    <div class="testimonial-info">
                        <h4>María González</h4>
                        <p>Alcaldesa de Valparaíso</p>
                    </div>
                </div>
                <blockquote>Sueño Andino transformó completamente nuestra visión del desarrollo territorial. Su enfoque sostenible y participativo ha sido clave para el crecimiento de nuestra comuna.</blockquote>
            </div>
            
            <div class="testimonial-card">
                <div class="testimonial-header">
                    <div class="testimonial-avatar">
                        <div class="avatar-placeholder">C</div>
                    </div>
                    <div class="testimonial-info">
                        <h4>Carlos Mendoza</h4>
                        <p>Director de Desarrollo Rural</p>
                    </div>
                </div>
                <blockquote>La metodología de Sueño Andino es innovadora y efectiva. Han logrado resultados excepcionales en comunidades que antes parecían sin esperanza de desarrollo.</blockquote>
            </div>
            
            <div class="testimonial-card">
                <div class="testimonial-header">
                    <div class="testimonial-avatar">
                        <div class="avatar-placeholder">A</div>
                    </div>
                    <div class="testimonial-info">
                        <h4>Ana Rodríguez</h4>
                        <p>Líder Comunitaria</p>
                    </div>
                </div>
                <blockquote>Gracias a Sueño Andino, nuestra comunidad ahora tiene un plan de desarrollo claro y sostenible. Han sido un verdadero socio en nuestro crecimiento.</blockquote>
            </div>
        </div>
    </section>

    <!-- Team Section -->
    <section class="wp-block-group team-section" id="equipo">
        <div class="team-grid">
            <div class="team-member">
                <div class="member-image">
                    <div class="image-placeholder">
                        <div class="placeholder-content">
                            <div class="placeholder-icon">👤</div>
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
                            <div class="placeholder-icon">👤</div>
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
                            <div class="placeholder-icon">👤</div>
                        </div>
                    </div>
                    <div class="decorative-dots"></div>
                    <div class="decorative-shape"></div>
                </div>
                <h4>Carlos López</h4>
                <p>Especialista en Sostenibilidad</p>
            </div>
        </div>
    </section>

    <!-- Contact Section -->
    <section class="wp-block-group contact-section" id="contacto">
        <div class="contact-content">
            <h2>¿Listo para Transformar tu Comunidad?</h2>
            <p>Contáctanos y descubre cómo podemos ayudarte a desarrollar tu territorio de manera sostenible.</p>
            <div class="contact-buttons">
                <a href="mailto:info@sueñoandino.org" class="wp-block-button is-style-primary">
                    <span class="wp-block-button__link">Contactar Ahora</span>
                </a>
                <a href="#" onclick="showGuideModal(); return false;" class="wp-block-button is-style-secondary">
                    <span class="wp-block-button__link">Descargar Guía</span>
                </a>
            </div>
        </div>
    </section>
</main>

<?php get_footer(); ?>
