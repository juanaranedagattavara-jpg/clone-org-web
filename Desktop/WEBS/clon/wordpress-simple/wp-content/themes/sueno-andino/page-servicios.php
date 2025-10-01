<?php
/**
 * Template Name: Servicios Page
 * 
 * @package SueñoAndino
 */

get_header(); ?>

<main id="main" class="site-main">
    <!-- Servicios Hero Section -->
    <section class="servicios-hero-section">
        <div class="container">
            <div class="servicios-hero-content">
                <h1>Nuestros Servicios</h1>
                <p>Ofrecemos soluciones integrales para el desarrollo territorial regenerativo.</p>
            </div>
        </div>
    </section>

    <!-- Servicios Detallados Section -->
    <section class="servicios-detallados-section">
        <div class="container">
            <div class="servicios-container">
                <div class="servicio-detallado">
                    <div class="servicio-imagen">
                        <div class="servicio-placeholder">
                            <span class="placeholder-icon">🎓</span>
                        </div>
                    </div>
                    <div class="servicio-contenido">
                        <h2>Educación Regenerativa</h2>
                        <p class="servicio-descripcion">Desarrollamos capacidades locales y fortalecemos el tejido social a través de metodologías participativas y regenerativas. Nuestros programas están diseñados para empoderar a las comunidades y fomentar un cambio sostenible.</p>
                        <div class="servicio-beneficios">
                            <h3>Beneficios Clave:</h3>
                            <ul>
                                <li>Formación en principios de sostenibilidad</li>
                                <li>Desarrollo de habilidades prácticas</li>
                                <li>Fortalecimiento de la identidad cultural</li>
                                <li>Creación de redes de colaboración</li>
                            </ul>
                        </div>
                        <a href="#contacto" class="btn btn-primary">Más Información</a>
                    </div>
                </div>

                <div class="servicio-detallado">
                    <div class="servicio-imagen">
                        <div class="servicio-placeholder">
                            <span class="placeholder-icon">🚀</span>
                        </div>
                    </div>
                    <div class="servicio-contenido">
                        <h2>Emprendimiento Social</h2>
                        <p class="servicio-descripcion">Impulsamos iniciativas económicas que generan valor social y ambiental. Apoyamos a emprendedores locales en la creación y escalamiento de negocios con propósito, promoviendo la economía circular y el comercio justo.</p>
                        <div class="servicio-beneficios">
                            <h3>Beneficios Clave:</h3>
                            <ul>
                                <li>Asesoría en planes de negocio</li>
                                <li>Acceso a mercados sostenibles</li>
                                <li>Capacitación en gestión empresarial</li>
                                <li>Fomento de la innovación social</li>
                            </ul>
                        </div>
                        <a href="#contacto" class="btn btn-primary">Más Información</a>
                    </div>
                </div>

                <div class="servicio-detallado">
                    <div class="servicio-imagen">
                        <div class="servicio-placeholder">
                            <span class="placeholder-icon">🗺️</span>
                        </div>
                    </div>
                    <div class="servicio-contenido">
                        <h2>Consultoría Territorial</h2>
                        <p class="servicio-descripcion">Ofrecemos acompañamiento estratégico a gobiernos locales, organizaciones y empresas para diseñar e implementar proyectos de desarrollo territorial con enfoque regenerativo. Nuestra experiencia garantiza soluciones adaptadas a cada contexto.</p>
                        <div class="servicio-beneficios">
                            <h3>Beneficios Clave:</h3>
                            <ul>
                                <li>Diagnóstico y planificación estratégica</li>
                                <li>Diseño de proyectos sostenibles</li>
                                <li>Evaluación de impacto social y ambiental</li>
                                <li>Facilitación de procesos participativos</li>
                            </ul>
                        </div>
                        <a href="#contacto" class="btn btn-primary">Más Información</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Proceso de Trabajo Section -->
    <section class="proceso-trabajo-section">
        <div class="container">
            <div class="proceso-container">
                <h2>Nuestro Proceso de Trabajo</h2>
                <div class="proceso-steps">
                    <div class="proceso-step">
                        <div class="step-number">1</div>
                        <h3>Diagnóstico</h3>
                        <p>Análisis profundo de las necesidades y potencialidades del territorio.</p>
                    </div>
                    <div class="proceso-step">
                        <div class="step-number">2</div>
                        <h3>Diseño</h3>
                        <p>Co-creación de soluciones innovadoras y sostenibles con la comunidad.</p>
                    </div>
                    <div class="proceso-step">
                        <div class="step-number">3</div>
                        <h3>Implementación</h3>
                        <p>Ejecución de proyectos con metodologías participativas y eficientes.</p>
                    </div>
                    <div class="proceso-step">
                        <div class="step-number">4</div>
                        <h3>Monitoreo y Evaluación</h3>
                        <p>Seguimiento constante para asegurar el impacto y la sostenibilidad a largo plazo.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Servicios Section -->
    <section class="cta-servicios-section" id="contacto">
        <div class="container">
            <div class="cta-container">
                <h2>¿Listo para transformar tu territorio?</h2>
                <p>Contáctanos hoy mismo y descubre cómo podemos ayudarte a construir un futuro más próspero y sostenible.</p>
                <a href="#contacto" class="btn btn-secondary">Conversemos</a>
            </div>
        </div>
    </section>
</main>

<?php get_footer(); ?>