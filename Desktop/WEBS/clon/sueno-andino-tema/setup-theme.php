<?php
/**
 * Configuración automática del tema Sueño Andino
 */

// Evitar acceso directo
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Configurar página de inicio estática automáticamente
 */
function sueno_andino_setup_homepage() {
    // Crear página de inicio si no existe
    $homepage = get_page_by_title('Inicio');
    if (!$homepage) {
        $homepage_id = wp_insert_post(array(
            'post_title' => 'Inicio',
            'post_content' => '',
            'post_status' => 'publish',
            'post_type' => 'page'
        ));
    } else {
        $homepage_id = $homepage->ID;
    }
    
    // Configurar como página de inicio
    update_option('show_on_front', 'page');
    update_option('page_on_front', $homepage_id);
    
    // Crear menú principal
    $menu_id = wp_create_nav_menu('Menú Principal');
    if ($menu_id) {
        wp_update_nav_menu_item($menu_id, 0, array(
            'menu-item-title' => 'Inicio',
            'menu-item-url' => home_url('/'),
            'menu-item-status' => 'publish'
        ));
        wp_update_nav_menu_item($menu_id, 0, array(
            'menu-item-title' => 'Servicios',
            'menu-item-url' => home_url('/#servicios'),
            'menu-item-status' => 'publish'
        ));
        wp_update_nav_menu_item($menu_id, 0, array(
            'menu-item-title' => 'Equipo',
            'menu-item-url' => home_url('/#equipo'),
            'menu-item-status' => 'publish'
        ));
        wp_update_nav_menu_item($menu_id, 0, array(
            'menu-item-title' => 'Contacto',
            'menu-item-url' => home_url('/#contacto'),
            'menu-item-status' => 'publish'
        ));
        
        // Asignar menú a la ubicación
        $locations = get_theme_mod('nav_menu_locations');
        $locations['primary'] = $menu_id;
        set_theme_mod('nav_menu_locations', $locations);
    }
    
    // Configurar colores del tema
    set_theme_mod('primary_color', '#0e5e6f');
    set_theme_mod('accent_color', '#7fb069');
    set_theme_mod('sand_color', '#d9c8b4');
}
add_action('after_switch_theme', 'sueno_andino_setup_homepage');

/**
 * Forzar el uso de front-page.php
 */
function sueno_andino_template_redirect() {
    if (is_front_page() && !is_home()) {
        // Asegurar que se use front-page.php
        add_filter('template_include', function($template) {
            $front_page_template = get_template_directory() . '/front-page.php';
            if (file_exists($front_page_template)) {
                return $front_page_template;
            }
            return $template;
        });
    }
}
add_action('template_redirect', 'sueno_andino_template_redirect');
