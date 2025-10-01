<?php
/**
 * Script de configuración automática para Sueño Andino
 */

if (!defined('ABSPATH')) {
    exit;
}

// Crear páginas necesarias
function sueno_andino_setup_pages() {
    $pages = array(
        'Inicio' => array(
            'content' => 'Contenido de la página de inicio con diseño completo.',
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

// Ejecutar cuando se active el tema
add_action('after_switch_theme', 'sueno_andino_setup_pages');

// Crear menú principal
function sueno_andino_create_menu() {
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
        if ($blog_page) {
            wp_update_nav_menu_item($menu_id, 0, array(
                'menu-item-title' => 'Blog',
                'menu-item-object-id' => $blog_page->ID,
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

        // Asignar el menú a la ubicación principal
        $locations = get_theme_mod('nav_menu_locations');
        $locations['primary'] = $menu_id;
        set_theme_mod('nav_menu_locations', $locations);
    }
}
add_action('after_switch_theme', 'sueno_andino_create_menu');
