<?php
/**
 * Sueño Andino Theme Functions
 */

// Evitar acceso directo
if (!defined('ABSPATH')) {
    exit;
}

// Configuración del tema
function sueno_andino_setup() {
    // Soporte para título dinámico
    add_theme_support('title-tag');
    
    // Soporte para imágenes destacadas
    add_theme_support('post-thumbnails');
    
    // Soporte para HTML5
    add_theme_support('html5', array(
        'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption',
    ));
    
    // Soporte para Gutenberg
    add_theme_support('wp-block-styles');
    add_theme_support('align-wide');
    
    // Soporte para Full Site Editing
    add_theme_support('block-templates');
    add_theme_support('block-template-parts');
    
    // Registrar menús
    register_nav_menus(array(
        'primary' => __('Menú Principal', 'sueno-andino'),
    ));
}
add_action('after_setup_theme', 'sueno_andino_setup');

// Encolar estilos y scripts
function sueno_andino_scripts() {
    // Estilos
    wp_enqueue_style('sueno-andino-style', get_stylesheet_uri(), array(), '1.0.0');
    
    // Scripts
    wp_enqueue_script('sueno-andino-script', get_template_directory_uri() . '/js/theme.js', array('jquery'), '1.0.0', true);
    
    // Localizar script para AJAX
    wp_localize_script('sueno_andino_script', 'sueno_andino_ajax', array(
        'ajax_url' => admin_url('admin-ajax.php'),
        'nonce' => wp_create_nonce('sueno_andino_nonce'),
    ));
}
add_action('wp_enqueue_scripts', 'sueno_andino_scripts');

// Registrar tipos de contenido personalizados
function sueno_andino_register_post_types() {
    // Servicios
    register_post_type('services', array(
        'labels' => array(
            'name' => 'Servicios',
            'singular_name' => 'Servicio',
        ),
        'public' => true,
        'has_archive' => true,
        'supports' => array('title', 'editor', 'thumbnail'),
        'menu_icon' => 'dashicons-admin-tools',
    ));
    
    // Testimonios
    register_post_type('testimonials', array(
        'labels' => array(
            'name' => 'Testimonios',
            'singular_name' => 'Testimonio',
        ),
        'public' => true,
        'has_archive' => true,
        'supports' => array('title', 'editor', 'thumbnail'),
        'menu_icon' => 'dashicons-format-quote',
    ));
    
    // Miembros del equipo
    register_post_type('team_members', array(
        'labels' => array(
            'name' => 'Miembros del Equipo',
            'singular_name' => 'Miembro del Equipo',
        ),
        'public' => true,
        'has_archive' => true,
        'supports' => array('title', 'editor', 'thumbnail'),
        'menu_icon' => 'dashicons-groups',
    ));
}
add_action('init', 'sueno_andino_register_post_types');

// Función para obtener testimonios
function sueno_andino_get_testimonials($limit = 3) {
    $testimonials = get_posts(array(
        'post_type' => 'testimonials',
        'posts_per_page' => $limit,
        'post_status' => 'publish',
    ));
    
    return $testimonials;
}

// Función para obtener servicios
function sueno_andino_get_services($limit = 6) {
    $services = get_posts(array(
        'post_type' => 'services',
        'posts_per_page' => $limit,
        'post_status' => 'publish',
    ));
    
    return $services;
}

// Función para obtener miembros del equipo
function sueno_andino_get_team_members($limit = 6) {
    $team_members = get_posts(array(
        'post_type' => 'team_members',
        'posts_per_page' => $limit,
        'post_status' => 'publish',
    ));
    
    return $team_members;
}

// AJAX para formulario de contacto
function sueno_andino_handle_contact_form() {
    // Verificar nonce
    if (!wp_verify_nonce($_POST['nonce'], 'sueno_andino_nonce')) {
        wp_die('Error de seguridad');
    }
    
    // Obtener datos del formulario
    $name = sanitize_text_field($_POST['name']);
    $email = sanitize_email($_POST['email']);
    $message = sanitize_textarea_field($_POST['message']);
    
    // Validar datos
    if (empty($name) || empty($email) || empty($message)) {
        wp_send_json_error('Todos los campos son obligatorios');
    }
    
    if (!is_email($email)) {
        wp_send_json_error('Email inválido');
    }
    
    // Enviar email
    $to = get_option('admin_email');
    $subject = 'Nuevo mensaje de contacto - ' . get_bloginfo('name');
    $body = "Nombre: $name\nEmail: $email\nMensaje: $message";
    $headers = array('Content-Type: text/plain; charset=UTF-8');
    
    $sent = wp_mail($to, $subject, $body, $headers);
    
    if ($sent) {
        wp_send_json_success('Mensaje enviado correctamente');
    } else {
        wp_send_json_error('Error al enviar el mensaje');
    }
}
add_action('wp_ajax_contact_form', 'sueno_andino_handle_contact_form');
add_action('wp_ajax_nopriv_contact_form', 'sueno_andino_handle_contact_form');

// Función de fallback para menú
function sueno_andino_fallback_menu() {
    echo '<ul class="main-navigation">';
    echo '<li><a href="' . home_url() . '">Inicio</a></li>';
    echo '<li><a href="#servicios">Servicios</a></li>';
    echo '<li><a href="#equipo">Nosotros</a></li>';
    echo '<li><a href="#contacto">Contacto</a></li>';
    echo '</ul>';
}

// Optimizaciones de rendimiento
function sueno_andino_performance_optimizations() {
    // Remover emojis
    remove_action('wp_head', 'print_emoji_detection_script', 7);
    remove_action('wp_print_styles', 'print_emoji_styles');
    
    // Remover links innecesarios
    remove_action('wp_head', 'wp_generator');
    remove_action('wp_head', 'wlwmanifest_link');
    remove_action('wp_head', 'rsd_link');
    remove_action('wp_head', 'wp_shortlink_wp_head');
    
    // Remover REST API links
    remove_action('wp_head', 'rest_output_link_wp_head');
    remove_action('wp_head', 'wp_oembed_add_discovery_links');
}
add_action('init', 'sueno_andino_performance_optimizations');

// Headers de seguridad
function sueno_andino_security_headers() {
    if (!is_admin()) {
        header('X-Content-Type-Options: nosniff');
        header('X-Frame-Options: SAMEORIGIN');
        header('X-XSS-Protection: 1; mode=block');
    }
}
add_action('send_headers', 'sueno_andino_security_headers');
