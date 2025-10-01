<?php
/**
 * Sueño Andino Elite Theme Functions
 * Tema de élite con diseño exacto al original
 */

if (!defined('ABSPATH')) {
    exit;
}

// Configuración del tema
function sueno_andino_elite_setup() {
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
    add_theme_support('wp-block-styles');
    add_theme_support('align-wide');
    
    // Registrar menús
    register_nav_menus(array(
        'primary' => __('Menú Principal', 'sueno-andino'),
        'footer' => __('Menú Footer', 'sueno-andino'),
    ));
}
add_action('after_setup_theme', 'sueno_andino_elite_setup');

// Encolar estilos y scripts
function sueno_andino_elite_scripts() {
    wp_enqueue_style('sueno-andino-elite-style', get_stylesheet_uri());
    wp_enqueue_style('sueno-andino-elite-fonts', 'https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap');
    wp_enqueue_script('jquery');
    wp_enqueue_script('sueno-andino-elite-js', get_template_directory_uri() . '/js/theme.js', array('jquery'), '1.0.0', true);
    
    // Localizar script para AJAX
    wp_localize_script('sueno-andino-elite-js', 'suenoAndinoAjax', array(
        'ajax_url' => admin_url('admin-ajax.php'),
        'nonce' => wp_create_nonce('sueno_andino_nonce'),
    ));
}
add_action('wp_enqueue_scripts', 'sueno_andino_elite_scripts');

// Crear páginas automáticamente
function sueno_andino_elite_create_pages() {
    $pages = array(
        'Inicio' => array(
            'content' => '<!-- Contenido de la página de inicio -->',
            'template' => 'front-page.php'
        ),
        'Blog' => array(
            'content' => 'Contenido del blog con artículos sobre desarrollo territorial regenerativo.',
            'template' => 'page-blog.php'
        ),
        'Servicios' => array(
            'content' => 'Nuestros servicios de educación regenerativa, emprendimiento social y consultoría territorial.',
            'template' => 'page-servicios.php'
        ),
        'Nosotros' => array(
            'content' => 'Conoce nuestro equipo y la historia de Sueño Andino.',
            'template' => 'page-nosotros.php'
        ),
        'Contacto' => array(
            'content' => 'Ponte en contacto con nosotros para comenzar tu proyecto regenerativo.',
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
    
    // Asignar página de blog
    $blog_page = get_page_by_title('Blog');
    if ($blog_page) {
        update_option('page_for_posts', $blog_page->ID);
    }
}
add_action('after_switch_theme', 'sueno_andino_elite_create_pages');

// Crear menú principal
function sueno_andino_elite_create_main_menu() {
    $menu_name = 'Primary Menu';
    $menu_exists = wp_get_nav_menu_object($menu_name);

    if (!$menu_exists) {
        $menu_id = wp_create_nav_menu($menu_name);

        // Obtener IDs de las páginas
        $home_page = get_page_by_title('Inicio');
        $blog_page = get_page_by_title('Blog');
        $services_page = get_page_by_title('Servicios');
        $nosotros_page = get_page_by_title('Nosotros');
        $contact_page = get_page_by_title('Contacto');

        // Añadir páginas al menú
        if ($home_page) {
            wp_update_nav_menu_item($menu_id, 0, array(
                'menu-item-title' => 'Inicio',
                'menu-item-object-id' => $home_page->ID,
                'menu-item-object' => 'page',
                'menu-item-status' => 'publish',
                'menu-item-type' => 'post_type',
            ));
        }
        if ($services_page) {
            wp_update_nav_menu_item($menu_id, 0, array(
                'menu-item-title' => 'Servicios',
                'menu-item-object-id' => $services_page->ID,
                'menu-item-object' => 'page',
                'menu-item-status' => 'publish',
                'menu-item-type' => 'post_type',
            ));
        }
        if ($nosotros_page) {
            wp_update_nav_menu_item($menu_id, 0, array(
                'menu-item-title' => 'Nosotros',
                'menu-item-object-id' => $nosotros_page->ID,
                'menu-item-object' => 'page',
                'menu-item-status' => 'publish',
                'menu-item-type' => 'post_type',
            ));
        }
        if ($contact_page) {
            wp_update_nav_menu_item($menu_id, 0, array(
                'menu-item-title' => 'Contacto',
                'menu-item-object-id' => $contact_page->ID,
                'menu-item-object' => 'page',
                'menu-item-status' => 'publish',
                'menu-item-type' => 'post_type',
            ));
        }
        if ($blog_page) {
            wp_update_nav_menu_item($menu_id, 0, array(
                'menu-item-title' => 'Blog',
                'menu-item-object-id' => $blog_page->ID,
                'menu-item-object' => 'page',
                'menu-item-status' => 'publish',
                'menu-item-type' => 'post_type',
            ));
        }

        // Asignar el menú a la ubicación principal
        $locations = get_theme_mod('nav_menu_locations');
        $locations['primary'] = $menu_id;
        set_theme_mod('nav_menu_locations', $locations);
    }
}
add_action('after_switch_theme', 'sueno_andino_elite_create_main_menu');

// AJAX para formulario de contacto
function sueno_andino_elite_handle_contact_form() {
    check_ajax_referer('sueno_andino_nonce', 'nonce');
    
    $name = sanitize_text_field($_POST['name']);
    $email = sanitize_email($_POST['email']);
    $message = sanitize_textarea_field($_POST['message']);
    
    // Aquí puedes procesar el formulario
    wp_send_json_success('Mensaje enviado correctamente');
}
add_action('wp_ajax_contact_form', 'sueno_andino_elite_handle_contact_form');
add_action('wp_ajax_nopriv_contact_form', 'sueno_andino_elite_handle_contact_form');

// AJAX para lead magnet
function sueno_andino_elite_handle_lead_magnet() {
    check_ajax_referer('sueno_andino_nonce', 'nonce');
    
    $name = sanitize_text_field($_POST['name']);
    $email = sanitize_email($_POST['email']);
    
    // Aquí puedes procesar el lead magnet
    wp_send_json_success('Guía enviada a tu email');
}
add_action('wp_ajax_lead_magnet', 'sueno_andino_elite_handle_lead_magnet');
add_action('wp_ajax_nopriv_lead_magnet', 'sueno_andino_elite_handle_lead_magnet');
?>
