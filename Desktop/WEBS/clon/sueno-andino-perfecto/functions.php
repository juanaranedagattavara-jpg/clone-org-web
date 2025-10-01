<?php
if (!defined('ABSPATH')) exit;

function sueno_andino_setup() {
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('html5');
    add_theme_support('custom-logo');
    
    register_nav_menus(array(
        'primary' => __('Menú Principal', 'sueno-andino'),
    ));
}
add_action('after_setup_theme', 'sueno_andino_setup');

function sueno_andino_scripts() {
    wp_enqueue_style('sueno-andino-style', get_stylesheet_uri());
    wp_enqueue_style('sueno-andino-fonts', 'https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap');
    wp_enqueue_script('jquery');
    wp_enqueue_script('sueno-andino-js', get_template_directory_uri() . '/js/theme.js', array('jquery'), '1.0.0', true);
}
add_action('wp_enqueue_scripts', 'sueno_andino_scripts');

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
                'post_title' => $title,
                'post_content' => 'Contenido de ' . $title,
                'post_status' => 'publish',
                'post_type' => 'page',
            ));
            if ($page_id) {
                update_post_meta($page_id, '_wp_page_template', $template);
            }
        }
    }
    
    $home_page = get_page_by_title('Inicio');
    if ($home_page) {
        update_option('show_on_front', 'page');
        update_option('page_on_front', $home_page->ID);
    }
}
add_action('after_switch_theme', 'sueno_andino_create_pages');
?>
