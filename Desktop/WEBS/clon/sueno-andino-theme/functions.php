<?php
/**
 * Sueño Andino Theme Functions
 * 
 * @package SueñoAndino
 */

// Evitar acceso directo
if (!defined('ABSPATH')) {
    exit;
}

// Definir constantes del tema
define('SUENO_ANDINO_VERSION', '1.0.0');
define('SUENO_ANDINO_THEME_DIR', get_template_directory());
define('SUENO_ANDINO_THEME_URL', get_template_directory_uri());

/**
 * Configuración del tema
 */
function sueno_andino_setup() {
    // Soporte para idioma
    load_theme_textdomain('sueno-andino', get_template_directory() . '/languages');
    
    // Soporte para características del tema
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('html5', array(
        'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption',
    ));
    add_theme_support('custom-logo');
    add_theme_support('customize-selective-refresh-widgets');
    
    // Soporte para Gutenberg
    add_theme_support('wp-block-styles');
    add_theme_support('align-wide');
    add_theme_support('editor-styles');
    add_editor_style('css/editor-style.css');
    
    // Soporte para Full Site Editing
    add_theme_support('block-templates');
    add_theme_support('block-template-parts');
    
    // Registrar menús
    register_nav_menus(array(
        'primary' => __('Menú Principal', 'sueno-andino'),
        'footer' => __('Menú Footer', 'sueno-andino'),
    ));
}
add_action('after_setup_theme', 'sueno_andino_setup');

/**
 * Encolar estilos y scripts
 */
function sueno_andino_scripts() {
    // Estilos principales
    wp_enqueue_style('sueno-andino-style', get_stylesheet_uri(), array(), SUENO_ANDINO_VERSION);
    
    // Google Fonts
    wp_enqueue_style('sueno-andino-fonts', 'https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap', array(), null);
    
    // Scripts
    wp_enqueue_script('jquery');
    wp_enqueue_script('sueno-andino-theme', get_template_directory_uri() . '/js/theme.js', array('jquery'), SUENO_ANDINO_VERSION, true);
    
    // Scripts del editor de bloques (solo en admin)
    if (is_admin()) {
        wp_enqueue_script('sueno-andino-blocks', get_template_directory_uri() . '/js/blocks.js', array('wp-blocks', 'wp-element', 'wp-editor', 'wp-components', 'wp-i18n'), SUENO_ANDINO_VERSION, true);
    }
    
    // Localizar script para AJAX
    wp_localize_script('sueno-andino-theme', 'suenoAndinoAjax', array(
        'ajax_url' => admin_url('admin-ajax.php'),
        'nonce' => wp_create_nonce('sueno_andino_nonce'),
    ));
}
add_action('wp_enqueue_scripts', 'sueno_andino_scripts');

/**
 * Registrar bloques Gutenberg personalizados
 */
function sueno_andino_register_blocks() {
    // Hero Section Block
    register_block_type('sueno-andino/hero-section', array(
        'editor_script' => 'sueno-andino-blocks',
        'render_callback' => 'sueno_andino_render_hero_section',
        'attributes' => array(
            'title' => array('type' => 'string', 'default' => 'Transformando Comunidades Sostenibles'),
            'description' => array('type' => 'string', 'default' => 'Desarrollamos soluciones integrales para el crecimiento territorial sostenible, conectando comunidades con oportunidades de desarrollo.'),
            'primaryButtonText' => array('type' => 'string', 'default' => 'Conoce Nuestros Servicios'),
            'primaryButtonLink' => array('type' => 'string', 'default' => '#servicios'),
            'secondaryButtonText' => array('type' => 'string', 'default' => 'Descarga Guía Gratuita'),
            'stats' => array('type' => 'array', 'default' => array(
                array('number' => '50+', 'label' => 'Proyectos Completados'),
                array('number' => '15', 'label' => 'Años de Experiencia'),
                array('number' => '200+', 'label' => 'Comunidades Beneficiadas')
            ))
        )
    ));
    
    // Timeline Block
    register_block_type('sueno-andino/timeline', array(
        'editor_script' => 'sueno-andino-blocks',
        'render_callback' => 'sueno_andino_render_timeline',
        'attributes' => array(
            'title' => array('type' => 'string', 'default' => 'Nuestra Historia'),
            'description' => array('type' => 'string', 'default' => 'Descubre los momentos importantes que han marcado nuestro camino de transformación territorial regenerativa'),
            'items' => array('type' => 'array', 'default' => array(
                array('year' => '2010', 'title' => 'Fundación de Sueño Andino', 'description' => 'Iniciamos nuestro compromiso con el desarrollo territorial sostenible en Chile, enfocándonos en comunidades rurales y urbanas marginadas.'),
                array('year' => '2015', 'title' => 'Expansión Regional', 'description' => 'Ampliamos nuestros servicios a 5 regiones del país, impactando a más de 50 comunidades con proyectos de desarrollo sostenible.'),
                array('year' => '2020', 'title' => 'Innovación Digital', 'description' => 'Implementamos tecnologías digitales para optimizar nuestros procesos de desarrollo territorial y mejorar la participación ciudadana.'),
                array('year' => '2024', 'title' => 'Liderazgo Nacional', 'description' => 'Nos consolidamos como referentes en desarrollo territorial sostenible a nivel nacional, con reconocimiento internacional.')
            ))
        )
    ));
    
    // Services Block
    register_block_type('sueno-andino/services', array(
        'editor_script' => 'sueno-andino-blocks',
        'render_callback' => 'sueno_andino_render_services',
        'attributes' => array(
            'title' => array('type' => 'string', 'default' => 'Nuestros Servicios'),
            'subtitle' => array('type' => 'string', 'default' => 'Lo que Ofrecemos'),
            'description' => array('type' => 'string', 'default' => 'Nuestros servicios están diseñados para generar impacto real en las comunidades, combinando sabiduría ancestral con metodologías modernas.'),
            'services' => array('type' => 'array', 'default' => array(
                array('icon' => '🏗️', 'title' => 'Desarrollo Territorial', 'description' => 'Planificación y ejecución de proyectos de desarrollo territorial sostenible que transforman comunidades y generan oportunidades de crecimiento.'),
                array('icon' => '🌱', 'title' => 'Sostenibilidad Ambiental', 'description' => 'Implementación de prácticas ambientales responsables y sostenibles que protegen el medio ambiente mientras impulsan el desarrollo económico.'),
                array('icon' => '🤝', 'title' => 'Participación Comunitaria', 'description' => 'Fortalecimiento del tejido social y participación ciudadana activa para construir comunidades más cohesionadas y resilientes.')
            ))
        )
    ));
    
    // Testimonials Block
    register_block_type('sueno-andino/testimonials', array(
        'editor_script' => 'sueno-andino-blocks',
        'render_callback' => 'sueno_andino_render_testimonials',
        'attributes' => array(
            'title' => array('type' => 'string', 'default' => 'Lo que Dicen Nuestras Comunidades'),
            'subtitle' => array('type' => 'string', 'default' => 'Testimonios'),
            'description' => array('type' => 'string', 'default' => 'Testimonios reales de comunidades que han transformado su territorio a través de nuestro acompañamiento regenerativo.'),
            'testimonials' => array('type' => 'array', 'default' => array(
                array('name' => 'María González', 'position' => 'Alcaldesa de Valparaíso', 'avatar' => 'M', 'quote' => 'Sueño Andino transformó completamente nuestra visión del desarrollo territorial. Su enfoque sostenible y participativo ha sido clave para el crecimiento de nuestra comuna.'),
                array('name' => 'Carlos Mendoza', 'position' => 'Director de Desarrollo Rural', 'avatar' => 'C', 'quote' => 'La metodología de Sueño Andino es innovadora y efectiva. Han logrado resultados excepcionales en comunidades que antes parecían sin esperanza de desarrollo.'),
                array('name' => 'Ana Rodríguez', 'position' => 'Líder Comunitaria', 'avatar' => 'A', 'quote' => 'Gracias a Sueño Andino, nuestra comunidad ahora tiene un plan de desarrollo claro y sostenible. Han sido un verdadero socio en nuestro crecimiento.')
            ))
        )
    ));
    
    // Team Block
    register_block_type('sueno-andino/team', array(
        'editor_script' => 'sueno-andino-blocks',
        'render_callback' => 'sueno_andino_render_team',
        'attributes' => array(
            'title' => array('type' => 'string', 'default' => 'Conoce Nuestro Equipo'),
            'subtitle' => array('type' => 'string', 'default' => 'Nuestro Equipo'),
            'description' => array('type' => 'string', 'default' => 'Un equipo comprometido con el desarrollo territorial y la transformación de comunidades.'),
            'members' => array('type' => 'array', 'default' => array(
                array('name' => 'Juan Pérez', 'position' => 'Director Ejecutivo'),
                array('name' => 'María Silva', 'position' => 'Coordinadora de Proyectos'),
                array('name' => 'Carlos López', 'position' => 'Especialista en Sostenibilidad')
            ))
        )
    ));
    
    // Contact Block
    register_block_type('sueno-andino/contact', array(
        'editor_script' => 'sueno-andino-blocks',
        'render_callback' => 'sueno_andino_render_contact',
        'attributes' => array(
            'title' => array('type' => 'string', 'default' => '¿Listo para Transformar tu Comunidad?'),
            'description' => array('type' => 'string', 'default' => 'Contáctanos y descubre cómo podemos ayudarte a desarrollar tu territorio de manera sostenible.'),
            'primaryButtonText' => array('type' => 'string', 'default' => 'Contactar Ahora'),
            'primaryButtonLink' => array('type' => 'string', 'default' => 'mailto:info@sueñoandino.org'),
            'secondaryButtonText' => array('type' => 'string', 'default' => 'Descargar Guía')
        )
    ));
}
add_action('init', 'sueno_andino_register_blocks');

/**
 * Funciones de renderizado de bloques
 */
function sueno_andino_render_hero_section($attributes) {
    $title = $attributes['title'];
    $description = $attributes['description'];
    $primaryButtonText = $attributes['primaryButtonText'];
    $primaryButtonLink = $attributes['primaryButtonLink'];
    $secondaryButtonText = $attributes['secondaryButtonText'];
    $stats = $attributes['stats'];
    
    ob_start();
    ?>
    <section class="hero-section">
        <div class="container">
            <div class="hero-content">
                <h1 class="hero-title"><?php echo esc_html($title); ?></h1>
                <p class="hero-description"><?php echo esc_html($description); ?></p>
                <div class="hero-buttons">
                    <div class="wp-block-button is-style-primary">
                        <a class="wp-block-button__link" href="<?php echo esc_url($primaryButtonLink); ?>"><?php echo esc_html($primaryButtonText); ?></a>
                    </div>
                    <div class="wp-block-button is-style-secondary">
                        <a class="wp-block-button__link" href="#" onclick="showGuideModal(); return false;"><?php echo esc_html($secondaryButtonText); ?></a>
                    </div>
                </div>
                <div class="hero-stats">
                    <?php foreach ($stats as $stat): ?>
                    <div class="stat-item">
                        <h3 class="stat-number"><?php echo esc_html($stat['number']); ?></h3>
                        <p class="stat-label"><?php echo esc_html($stat['label']); ?></p>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </section>
    <?php
    return ob_get_clean();
}

function sueno_andino_render_timeline($attributes) {
    $title = $attributes['title'];
    $description = $attributes['description'];
    $items = $attributes['items'];
    
    ob_start();
    ?>
    <section class="timeline-section">
        <div class="container">
            <div class="section-header">
                <h2><?php echo esc_html($title); ?></h2>
                <p><?php echo esc_html($description); ?></p>
            </div>
            <div class="anne-timeline">
                <?php foreach ($items as $index => $item): ?>
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
                        <p class="anne-year"><?php echo esc_html($item['year']); ?></p>
                        <h3><?php echo esc_html($item['title']); ?></h3>
                        <p><?php echo esc_html($item['description']); ?></p>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>
    <?php
    return ob_get_clean();
}

function sueno_andino_render_services($attributes) {
    $title = $attributes['title'];
    $subtitle = $attributes['subtitle'];
    $description = $attributes['description'];
    $services = $attributes['services'];
    
    ob_start();
    ?>
    <section class="services-section" id="servicios">
        <div class="container">
            <div class="section-header">
                <p class="section-subtitle"><?php echo esc_html($subtitle); ?></p>
                <h2><?php echo esc_html($title); ?></h2>
                <p class="section-description"><?php echo esc_html($description); ?></p>
            </div>
            <div class="services-grid">
                <?php foreach ($services as $service): ?>
                <div class="service-card">
                    <div class="service-icon-wrapper">
                        <p class="service-icon"><?php echo esc_html($service['icon']); ?></p>
                    </div>
                    <h3><?php echo esc_html($service['title']); ?></h3>
                    <p><?php echo esc_html($service['description']); ?></p>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>
    <?php
    return ob_get_clean();
}

function sueno_andino_render_testimonials($attributes) {
    $title = $attributes['title'];
    $subtitle = $attributes['subtitle'];
    $description = $attributes['description'];
    $testimonials = $attributes['testimonials'];
    
    ob_start();
    ?>
    <section class="testimonials-section">
        <div class="container">
            <div class="section-header">
                <p class="section-subtitle"><?php echo esc_html($subtitle); ?></p>
                <h2><?php echo esc_html($title); ?></h2>
                <p class="section-description"><?php echo esc_html($description); ?></p>
            </div>
            <div class="testimonials-grid">
                <?php foreach ($testimonials as $testimonial): ?>
                <div class="testimonial-card">
                    <div class="testimonial-header">
                        <div class="testimonial-avatar">
                            <p class="avatar-placeholder"><?php echo esc_html($testimonial['avatar']); ?></p>
                        </div>
                        <div class="testimonial-info">
                            <h4><?php echo esc_html($testimonial['name']); ?></h4>
                            <p><?php echo esc_html($testimonial['position']); ?></p>
                        </div>
                    </div>
                    <blockquote>
                        <p><?php echo esc_html($testimonial['quote']); ?></p>
                    </blockquote>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>
    <?php
    return ob_get_clean();
}

function sueno_andino_render_team($attributes) {
    $title = $attributes['title'];
    $subtitle = $attributes['subtitle'];
    $description = $attributes['description'];
    $members = $attributes['members'];
    
    ob_start();
    ?>
    <section class="team-section" id="equipo">
        <div class="container">
            <div class="section-header">
                <p class="section-subtitle"><?php echo esc_html($subtitle); ?></p>
                <h2><?php echo esc_html($title); ?></h2>
                <p class="section-description"><?php echo esc_html($description); ?></p>
            </div>
            <div class="team-grid">
                <?php foreach ($members as $member): ?>
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
                    <h4><?php echo esc_html($member['name']); ?></h4>
                    <p><?php echo esc_html($member['position']); ?></p>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>
    <?php
    return ob_get_clean();
}

function sueno_andino_render_contact($attributes) {
    $title = $attributes['title'];
    $description = $attributes['description'];
    $primaryButtonText = $attributes['primaryButtonText'];
    $primaryButtonLink = $attributes['primaryButtonLink'];
    $secondaryButtonText = $attributes['secondaryButtonText'];
    
    ob_start();
    ?>
    <section class="contact-section" id="contacto">
        <div class="container">
            <div class="contact-content">
                <h2><?php echo esc_html($title); ?></h2>
                <p><?php echo esc_html($description); ?></p>
                <div class="contact-buttons">
                    <div class="wp-block-button is-style-primary">
                        <a class="wp-block-button__link" href="<?php echo esc_url($primaryButtonLink); ?>"><?php echo esc_html($primaryButtonText); ?></a>
                    </div>
                    <div class="wp-block-button is-style-secondary">
                        <a class="wp-block-button__link" href="#" onclick="showGuideModal(); return false;"><?php echo esc_html($secondaryButtonText); ?></a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <?php
    return ob_get_clean();
}

/**
 * Menú de fallback
 */
function sueno_andino_fallback_menu() {
    echo '<ul class="menu">';
    echo '<li><a href="' . home_url() . '">Inicio</a></li>';
    echo '<li><a href="#servicios">Servicios</a></li>';
    echo '<li><a href="#equipo">Equipo</a></li>';
    echo '<li><a href="#contacto">Contacto</a></li>';
    echo '</ul>';
}

/**
 * Optimizaciones de rendimiento
 */
function sueno_andino_performance_optimizations() {
    // Remover emojis de WordPress
    remove_action('wp_head', 'print_emoji_detection_script', 7);
    remove_action('wp_print_styles', 'print_emoji_styles');
    remove_action('admin_print_scripts', 'print_emoji_detection_script');
    remove_action('admin_print_styles', 'print_emoji_styles');
    
    // Remover links innecesarios
    remove_action('wp_head', 'wp_generator');
    remove_action('wp_head', 'wlwmanifest_link');
    remove_action('wp_head', 'rsd_link');
    remove_action('wp_head', 'wp_shortlink_wp_head');
    remove_action('wp_head', 'feed_links_extra', 3);
    
    // Deshabilitar XML-RPC
    add_filter('xmlrpc_enabled', '__return_false');
    
    // Remover REST API links
    remove_action('wp_head', 'rest_output_link_wp_head');
    remove_action('wp_head', 'wp_oembed_add_discovery_links');
}
add_action('init', 'sueno_andino_performance_optimizations');

/**
 * Headers de seguridad
 */
function sueno_andino_security_headers() {
    if (!is_admin()) {
        header('X-Content-Type-Options: nosniff');
        header('X-Frame-Options: SAMEORIGIN');
        header('X-XSS-Protection: 1; mode=block');
    }
}
add_action('send_headers', 'sueno_andino_security_headers');

/**
 * Optimizar consultas de base de datos
 */
function sueno_andino_optimize_queries() {
    // Limitar revisiones de posts
    if (!defined('WP_POST_REVISIONS')) {
        define('WP_POST_REVISIONS', 3);
    }
    
    // Limpiar spam automáticamente
    if (!defined('WP_POST_REVISIONS')) {
        define('WP_POST_REVISIONS', 3);
    }
}
add_action('init', 'sueno_andino_optimize_queries');

/**
 * Cache headers
 */
function sueno_andino_cache_headers() {
    if (!is_admin()) {
        header('Cache-Control: public, max-age=31536000');
    }
}
add_action('send_headers', 'sueno_andino_cache_headers');

// Incluir configuración automática del tema
require_once get_template_directory() . '/setup-theme.php';