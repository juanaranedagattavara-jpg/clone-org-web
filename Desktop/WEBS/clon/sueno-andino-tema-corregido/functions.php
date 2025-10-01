<?php
/**
 * Sueño Andino Theme Functions
 */

if (!defined('ABSPATH')) {
    exit;
}

// Configuración del tema
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
    add_theme_support('custom-logo');
    
    // Registrar menús
    register_nav_menus(array(
        'primary' => __('Menú Principal', 'sueno-andino'),
        'footer' => __('Menú Footer', 'sueno-andino'),
    ));
}
add_action('after_setup_theme', 'sueno_andino_setup');

// Encolar estilos y scripts
function sueno_andino_scripts() {
    wp_enqueue_style('sueno-andino-style', get_stylesheet_uri());
    wp_enqueue_style('sueno-andino-fonts', 'https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap');
    wp_enqueue_script('jquery');
    wp_enqueue_script('sueno-andino-js', get_template_directory_uri() . '/js/theme.js', array('jquery'), '1.0.0', true);
}
add_action('wp_enqueue_scripts', 'sueno_andino_scripts');

// Crear páginas automáticamente
function sueno_andino_create_pages() {
    $pages = array(
        'Inicio' => 'front-page.php',
        'Blog' => 'page-blog.php',
        'Servicios' => 'page-servicios.php',
        'Nosotros' => 'page-nosotros.php',
        'Contacto' => 'page-contacto.php'
    );
    
    foreach ($pages as $title => $template) {
        $page = get_page_by_title($title);
        if (!$page) {
            $page_id = wp_insert_post(array(
                'post_title'    => $title,
                'post_content'  => '',
                'post_status'   => 'publish',
                'post_type'     => 'page',
                'post_author'   => 1,
            ));
            if ($page_id && !is_wp_error($page_id)) {
                update_post_meta($page_id, '_wp_page_template', $template);
            }
        }
    }
    
    // Asignar página de inicio
    $home_page = get_page_by_title('Inicio');
    if ($home_page) {
        update_option('show_on_front', 'page');
        update_option('page_on_front', $home_page->ID);
    }
    
    // Asignar página de blog
    $blog_page = get_page_by_title('Blog');
    if ($blog_page) {
        update_option('page_for_posts', $blog_page->ID);
    }
}
add_action('after_switch_theme', 'sueno_andino_create_pages');
?>
