<?php
/**
 * Front page template
 *
 * @package SueñoAndino
 */

get_header(); ?>

<!-- Hero Section -->
<div class="wp-block-group hero-section" style="background: linear-gradient(135deg, #f5f6f7 0%, #ffffff 100%); padding: 120px 0 80px; min-height: 100vh; display: flex; align-items: center; width: 100%;">
    <div class="container" style="max-width: 1200px; margin: 0 auto; padding: 0 20px; width: 100%;">
        <div class="wp-block-group hero-content" style="text-align: center; max-width: 1000px; margin: 0 auto;">
            <h1 class="hero-title" style="font-size: 3rem; font-weight: 700; color: #1c1c1e; margin-bottom: 1.5rem; line-height: 1.2;">Transformando Comunidades Sostenibles</h1>
            <p class="hero-description" style="font-size: 1.25rem; color: #1c1c1e; opacity: 0.8; margin-bottom: 2.5rem; max-width: 800px; margin-left: auto; margin-right: auto;">Desarrollamos soluciones integrales para el crecimiento territorial sostenible, conectando comunidades con oportunidades de desarrollo.</p>
            
            <div class="wp-block-buttons hero-buttons" style="display: flex; gap: 1rem; justify-content: center; margin-bottom: 3rem; flex-wrap: wrap;">
                <div class="wp-block-button is-style-primary">
                    <a class="wp-block-button__link" href="#servicios" style="display: inline-block; padding: 1rem 2rem; border-radius: 8px; text-decoration: none; font-weight: 600; transition: all 0.3s ease; border: 2px solid transparent; background: #0e5e6f; color: white;">Conoce Nuestros Servicios</a>
                </div>
                <div class="wp-block-button is-style-secondary">
                    <a class="wp-block-button__link" href="#" onclick="showGuideModal(); return false;" style="display: inline-block; padding: 1rem 2rem; border-radius: 8px; text-decoration: none; font-weight: 600; transition: all 0.3s ease; border: 2px solid #0e5e6f; background: transparent; color: #0e5e6f;">Descarga Guía Gratuita</a>
                </div>
            </div>
            
            <div class="wp-block-group hero-stats" style="display: flex; justify-content: center; align-items: center; gap: 2rem; max-width: 800px; margin: 0 auto; flex-wrap: wrap;">
                <div class="wp-block-group stat-item" style="text-align: center; flex: 1; min-width: 150px;">
                    <h3 class="stat-number" style="font-size: 2.5rem; font-weight: 700; color: #0e5e6f; margin-bottom: 0.5rem;">50+</h3>
                    <p class="stat-label" style="font-size: 0.9rem; color: #1c1c1e; opacity: 0.7; font-weight: 500;">Proyectos Completados</p>
                </div>
                <div class="wp-block-group stat-item" style="text-align: center; flex: 1; min-width: 150px;">
                    <h3 class="stat-number" style="font-size: 2.5rem; font-weight: 700; color: #0e5e6f; margin-bottom: 0.5rem;">15</h3>
                    <p class="stat-label" style="font-size: 0.9rem; color: #1c1c1e; opacity: 0.7; font-weight: 500;">Años de Experiencia</p>
                </div>
                <div class="wp-block-group stat-item" style="text-align: center; flex: 1; min-width: 150px;">
                    <h3 class="stat-number" style="font-size: 2.5rem; font-weight: 700; color: #0e5e6f; margin-bottom: 0.5rem;">200+</h3>
                    <p class="stat-label" style="font-size: 0.9rem; color: #1c1c1e; opacity: 0.7; font-weight: 500;">Comunidades Beneficiadas</p>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Timeline Section -->
<div class="wp-block-group timeline-section" style="background: #f8f6f3; padding: 80px 0; position: relative;">
    <div class="container" style="max-width: 1200px; margin: 0 auto; padding: 0 20px; width: 100%;">
        <div class="section-header" style="text-align: center; margin-bottom: 4rem;">
            <h2 style="font-size: 2.5rem; font-weight: 700; color: #1c1c1e; margin-bottom: 1rem;">Nuestra Historia</h2>
            <p style="font-size: 1.25rem; color: #1c1c1e; opacity: 0.8; max-width: 600px; margin: 0 auto;">Descubre los momentos importantes que han marcado nuestro camino de transformación territorial regenerativa</p>
        </div>
        <div class="wp-block-group anne-timeline" style="max-width: 1200px; margin: 0 auto; position: relative; padding: 0 2rem;">
            <div class="wp-block-group anne-timeline-item" style="display: flex; align-items: center; margin-bottom: 6rem; position: relative; min-height: 200px; flex-direction: row;">
                <div class="wp-block-group anne-timeline-image" style="flex: 0 0 45%; height: 200px; margin: 0 2rem; position: relative; overflow: hidden; border-radius: 8px;">
                    <div class="wp-block-group image-placeholder" style="width: 100%; height: 100%; background: linear-gradient(135deg, #e8f0f2 0%, #d9c8b4 100%); border-radius: 8px; border: 4px solid #0e5e6f; position: relative; overflow: hidden; display: flex; align-items: center; justify-content: center;">
                        <div class="wp-block-group placeholder-content" style="text-align: center; z-index: 2; position: relative;">
                            <p class="placeholder-icon" style="font-size: 4rem; margin-bottom: 1rem; opacity: 0.7;">📅</p>
                        </div>
                    </div>
                </div>
                <div class="wp-block-group anne-timeline-dot" style="position: absolute; left: 50%; top: 50%; transform: translate(-50%, -50%); width: 20px; height: 20px; background: #0e5e6f; border-radius: 50%; z-index: 2; border: 4px solid white; box-shadow: 0 0 0 4px #0e5e6f;"></div>
                <div class="wp-block-group anne-timeline-content" style="flex: 0 0 45%; padding: 2rem; background: white; border-radius: 12px; box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1); position: relative;">
                    <p class="anne-year" style="font-size: 1.5rem; font-weight: 700; color: #0e5e6f; margin-bottom: 1rem; display: inline-block; background: #f5f6f7; padding: 0.5rem 1rem; border-radius: 20px;">2010</p>
                    <h3 style="font-size: 1.5rem; font-weight: 700; color: #1c1c1e; margin-bottom: 1rem;">Fundación de Sueño Andino</h3>
                    <p style="color: #1c1c1e; opacity: 0.8; line-height: 1.6;">Iniciamos nuestro compromiso con el desarrollo territorial sostenible en Chile, enfocándonos en comunidades rurales y urbanas marginadas.</p>
                </div>
            </div>

            <div class="wp-block-group anne-timeline-item" style="display: flex; align-items: center; margin-bottom: 6rem; position: relative; min-height: 200px; flex-direction: row-reverse;">
                <div class="wp-block-group anne-timeline-image" style="flex: 0 0 45%; height: 200px; margin: 0 2rem; position: relative; overflow: hidden; border-radius: 8px;">
                    <div class="wp-block-group image-placeholder" style="width: 100%; height: 100%; background: linear-gradient(135deg, #e8f0f2 0%, #d9c8b4 100%); border-radius: 8px; border: 4px solid #7fb069; position: relative; overflow: hidden; display: flex; align-items: center; justify-content: center;">
                        <div class="wp-block-group placeholder-content" style="text-align: center; z-index: 2; position: relative;">
                            <p class="placeholder-icon" style="font-size: 4rem; margin-bottom: 1rem; opacity: 0.7;">📅</p>
                        </div>
                    </div>
                </div>
                <div class="wp-block-group anne-timeline-dot" style="position: absolute; left: 50%; top: 50%; transform: translate(-50%, -50%); width: 20px; height: 20px; background: #0e5e6f; border-radius: 50%; z-index: 2; border: 4px solid white; box-shadow: 0 0 0 4px #0e5e6f;"></div>
                <div class="wp-block-group anne-timeline-content" style="flex: 0 0 45%; padding: 2rem; background: white; border-radius: 12px; box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1); position: relative;">
                    <p class="anne-year" style="font-size: 1.5rem; font-weight: 700; color: #0e5e6f; margin-bottom: 1rem; display: inline-block; background: #f5f6f7; padding: 0.5rem 1rem; border-radius: 20px;">2015</p>
                    <h3 style="font-size: 1.5rem; font-weight: 700; color: #1c1c1e; margin-bottom: 1rem;">Expansión Regional</h3>
                    <p style="color: #1c1c1e; opacity: 0.8; line-height: 1.6;">Ampliamos nuestros servicios a 5 regiones del país, impactando a más de 50 comunidades con proyectos de desarrollo sostenible.</p>
                </div>
            </div>

            <div class="wp-block-group anne-timeline-item" style="display: flex; align-items: center; margin-bottom: 6rem; position: relative; min-height: 200px; flex-direction: row;">
                <div class="wp-block-group anne-timeline-image" style="flex: 0 0 45%; height: 200px; margin: 0 2rem; position: relative; overflow: hidden; border-radius: 8px;">
                    <div class="wp-block-group image-placeholder" style="width: 100%; height: 100%; background: linear-gradient(135deg, #e8f0f2 0%, #d9c8b4 100%); border-radius: 8px; border: 4px solid #0e5e6f; position: relative; overflow: hidden; display: flex; align-items: center; justify-content: center;">
                        <div class="wp-block-group placeholder-content" style="text-align: center; z-index: 2; position: relative;">
                            <p class="placeholder-icon" style="font-size: 4rem; margin-bottom: 1rem; opacity: 0.7;">📅</p>
                        </div>
                    </div>
                </div>
                <div class="wp-block-group anne-timeline-dot" style="position: absolute; left: 50%; top: 50%; transform: translate(-50%, -50%); width: 20px; height: 20px; background: #0e5e6f; border-radius: 50%; z-index: 2; border: 4px solid white; box-shadow: 0 0 0 4px #0e5e6f;"></div>
                <div class="wp-block-group anne-timeline-content" style="flex: 0 0 45%; padding: 2rem; background: white; border-radius: 12px; box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1); position: relative;">
                    <p class="anne-year" style="font-size: 1.5rem; font-weight: 700; color: #0e5e6f; margin-bottom: 1rem; display: inline-block; background: #f5f6f7; padding: 0.5rem 1rem; border-radius: 20px;">2020</p>
                    <h3 style="font-size: 1.5rem; font-weight: 700; color: #1c1c1e; margin-bottom: 1rem;">Innovación Digital</h3>
                    <p style="color: #1c1c1e; opacity: 0.8; line-height: 1.6;">Implementamos tecnologías digitales para optimizar nuestros procesos de desarrollo territorial y mejorar la participación ciudadana.</p>
                </div>
            </div>

            <div class="wp-block-group anne-timeline-item" style="display: flex; align-items: center; margin-bottom: 6rem; position: relative; min-height: 200px; flex-direction: row-reverse;">
                <div class="wp-block-group anne-timeline-image" style="flex: 0 0 45%; height: 200px; margin: 0 2rem; position: relative; overflow: hidden; border-radius: 8px;">
                    <div class="wp-block-group image-placeholder" style="width: 100%; height: 100%; background: linear-gradient(135deg, #e8f0f2 0%, #d9c8b4 100%); border-radius: 8px; border: 4px solid #7fb069; position: relative; overflow: hidden; display: flex; align-items: center; justify-content: center;">
                        <div class="wp-block-group placeholder-content" style="text-align: center; z-index: 2; position: relative;">
                            <p class="placeholder-icon" style="font-size: 4rem; margin-bottom: 1rem; opacity: 0.7;">📅</p>
                        </div>
                    </div>
                </div>
                <div class="wp-block-group anne-timeline-dot" style="position: absolute; left: 50%; top: 50%; transform: translate(-50%, -50%); width: 20px; height: 20px; background: #0e5e6f; border-radius: 50%; z-index: 2; border: 4px solid white; box-shadow: 0 0 0 4px #0e5e6f;"></div>
                <div class="wp-block-group anne-timeline-content" style="flex: 0 0 45%; padding: 2rem; background: white; border-radius: 12px; box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1); position: relative;">
                    <p class="anne-year" style="font-size: 1.5rem; font-weight: 700; color: #0e5e6f; margin-bottom: 1rem; display: inline-block; background: #f5f6f7; padding: 0.5rem 1rem; border-radius: 20px;">2024</p>
                    <h3 style="font-size: 1.5rem; font-weight: 700; color: #1c1c1e; margin-bottom: 1rem;">Liderazgo Nacional</h3>
                    <p style="color: #1c1c1e; opacity: 0.8; line-height: 1.6;">Nos consolidamos como referentes en desarrollo territorial sostenible a nivel nacional, con reconocimiento internacional.</p>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Services Section -->
<section class="services-section" id="servicios">
    <div class="container">
        <div class="section-header">
            <p style="color: var(--sa-primary); font-weight: 600; margin-bottom: 0.5rem;">Lo que Ofrecemos</p>
            <h2>Nuestros Servicios</h2>
            <p>Nuestros servicios están diseñados para generar impacto real en las comunidades, combinando sabiduría ancestral con metodologías modernas.</p>
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
            <p style="color: var(--sa-primary); font-weight: 600; margin-bottom: 0.5rem;">Testimonios</p>
            <h2>Lo que Dicen Nuestras Comunidades</h2>
            <p>Testimonios reales de comunidades que han transformado su territorio a través de nuestro acompañamiento regenerativo.</p>
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
                    <p>"Sueño Andino transformó completamente nuestra visión del desarrollo territorial. Su enfoque sostenible y participativo ha sido clave para el crecimiento de nuestra comuna."</p>
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
                    <p>"La metodología de Sueño Andino es innovadora y efectiva. Han logrado resultados excepcionales en comunidades que antes parecían sin esperanza de desarrollo."</p>
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
                    <p>"Gracias a Sueño Andino, nuestra comunidad ahora tiene un plan de desarrollo claro y sostenible. Han sido un verdadero socio en nuestro crecimiento."</p>
                </blockquote>
            </div>
        </div>
    </div>
</section>

<!-- Team Section -->
<section class="team-section" id="equipo">
    <div class="container">
        <div class="section-header">
            <p style="color: var(--sa-primary); font-weight: 600; margin-bottom: 0.5rem;">Nuestro Equipo</p>
            <h2>Conoce Nuestro Equipo</h2>
            <p>Un equipo comprometido con el desarrollo territorial y la transformación de comunidades.</p>
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
                <a href="mailto:info@sueñoandino.org" class="wp-block-button__link is-style-primary">Contactar Ahora</a>
                <a href="#" class="wp-block-button__link is-style-secondary" onclick="showGuideModal(); return false;">Descargar Guía</a>
            </div>
        </div>
    </div>
</section>

<?php get_footer(); ?>
