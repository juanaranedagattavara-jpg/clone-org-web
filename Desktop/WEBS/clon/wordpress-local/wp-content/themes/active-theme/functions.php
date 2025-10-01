<?php
/**
 * Sueño Andino Theme - Diseño Fiel
 */

// Evitar acceso directo
if (!defined('ABSPATH')) {
    exit;
}

// Configuración básica del tema
function sueno_andino_setup() {
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('html5', array(
        'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption',
    ));
}
add_action('after_setup_theme', 'sueno_andino_setup');

// Encolar estilos y scripts
function sueno_andino_scripts() {
    wp_enqueue_style('sueno-andino-style', get_stylesheet_uri());
    wp_enqueue_style('sueno-andino-fonts', 'https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap');
    wp_enqueue_script('sueno-andino-js', get_template_directory_uri() . '/js/theme.js', array('jquery'), '1.0.0', true);
}
add_action('wp_enqueue_scripts', 'sueno_andino_scripts');

// Crear páginas automáticamente
function sueno_andino_create_pages() {
    $pages = array(
        'Inicio' => array(
            'content' => '<!-- Contenido de la página de inicio -->',
            'template' => 'front-page.php'
        ),
        'Blog' => array(
            'content' => 'Contenido del blog',
            'template' => 'page-blog.php'
        ),
        'Servicios' => array(
            'content' => 'Nuestros servicios',
            'template' => 'page-servicios.php'
        ),
        'Nosotros' => array(
            'content' => 'Conoce nuestro equipo',
            'template' => 'page-nosotros.php'
        ),
        'Contacto' => array(
            'content' => 'Ponte en contacto',
            'template' => 'page-contacto.php'
        )
    );
    
    foreach ($pages as $title => $data) {
        $page = get_page_by_title($title);
        if (!$page) {
            $page_id = wp_insert_post(array(
                'post_title'    => $title,
                'post_content'  => $data['content'],
                'post_status'   => 'publish',
                'post_type'     => 'page',
                'post_author'   => 1,
            ));
            if ($page_id && !is_wp_error($page_id)) {
                update_post_meta($page_id, '_wp_page_template', $data['template']);
            }
        }
    }
    
    // Asignar página de inicio
    $home_page = get_page_by_title('Inicio');
    if ($home_page) {
        update_option('show_on_front', 'page');
        update_option('page_on_front', $home_page->ID);
    }
}
add_action('after_switch_theme', 'sueno_andino_create_pages');
?>
