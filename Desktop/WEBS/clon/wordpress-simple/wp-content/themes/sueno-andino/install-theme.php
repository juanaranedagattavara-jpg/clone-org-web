<?php
/**
 * Sueño Andino Theme - Installation Script
 * Run this script after uploading the theme to WordPress
 */

// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

// Theme installation and setup
function sueno_andino_install_theme() {
    // Create necessary database tables
    sueno_andino_create_tables();
    
    // Set default theme options
    sueno_andino_set_default_options();
    
    // Create sample content
    sueno_andino_create_sample_content();
    
    // Flush rewrite rules
    flush_rewrite_rules();
    
    return true;
}

// Create database tables
function sueno_andino_create_tables() {
    global $wpdb;
    
    $charset_collate = $wpdb->get_charset_collate();
    
    // Leads table
    $table_name = $wpdb->prefix . 'sueno_andino_leads';
    $sql = "CREATE TABLE IF NOT EXISTS $table_name (
        id mediumint(9) NOT NULL AUTO_INCREMENT,
        name varchar(100) NOT NULL,
        email varchar(100) NOT NULL,
        phone varchar(20),
        company varchar(100),
        date datetime DEFAULT CURRENT_TIMESTAMP,
        status varchar(20) DEFAULT 'new',
        PRIMARY KEY (id),
        KEY email (email),
        KEY date (date)
    ) $charset_collate;";
    
    require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
    dbDelta($sql);
    
    // Contact messages table
    $table_name = $wpdb->prefix . 'sueno_andino_contacts';
    $sql = "CREATE TABLE IF NOT EXISTS $table_name (
        id mediumint(9) NOT NULL AUTO_INCREMENT,
        name varchar(100) NOT NULL,
        email varchar(100) NOT NULL,
        phone varchar(20),
        subject varchar(200) NOT NULL,
        message text NOT NULL,
        date datetime DEFAULT CURRENT_TIMESTAMP,
        status varchar(20) DEFAULT 'new',
        PRIMARY KEY (id),
        KEY email (email),
        KEY date (date),
        KEY status (status)
    ) $charset_collate;";
    
    dbDelta($sql);
}

// Set default theme options
function sueno_andino_set_default_options() {
    // Set default colors
    if (!get_theme_mod('primary_color')) {
        set_theme_mod('primary_color', '#0e5e6f');
    }
    if (!get_theme_mod('accent_color')) {
        set_theme_mod('accent_color', '#7fb069');
    }
    
    // Set default customizer options
    $defaults = array(
        'sueno_andino_company_name' => 'Sueño Andino',
        'sueno_andino_company_description' => 'Desarrollo Territorial Regenerativo',
        'sueno_andino_contact_email' => get_option('admin_email'),
        'sueno_andino_contact_phone' => '+51-999-888-777',
        'sueno_andino_contact_address' => 'Lima, Perú',
    );
    
    foreach ($defaults as $option => $value) {
        if (!get_option($option)) {
            add_option($option, $value);
        }
    }
}

// Create sample content
function sueno_andino_create_sample_content() {
    // Create sample testimonials
    $testimonials = array(
        array(
            'name' => 'María González',
            'position' => 'Directora de Desarrollo Rural',
            'content' => 'El trabajo de Sueño Andino ha transformado completamente nuestra comunidad. Su enfoque regenerativo es realmente inspirador.',
            'rating' => 5
        ),
        array(
            'name' => 'Carlos Mendoza',
            'position' => 'Alcalde de Huancavelica',
            'content' => 'Gracias a Sueño Andino, hemos logrado un desarrollo sostenible que beneficia a todas las familias de nuestro distrito.',
            'rating' => 5
        ),
        array(
            'name' => 'Ana Quispe',
            'position' => 'Líder Comunitaria',
            'content' => 'Su metodología participativa nos ha permitido tomar decisiones informadas sobre el futuro de nuestra tierra.',
            'rating' => 5
        )
    );
    
    foreach ($testimonials as $testimonial) {
        $post_id = wp_insert_post(array(
            'post_title' => $testimonial['name'],
            'post_content' => $testimonial['content'],
            'post_status' => 'publish',
            'post_type' => 'testimonials',
            'meta_input' => array(
                'testimonial_position' => $testimonial['position'],
                'testimonial_rating' => $testimonial['rating']
            )
        ));
    }
    
    // Create sample services
    $services = array(
        array(
            'title' => 'Planificación Territorial',
            'description' => 'Desarrollamos planes integrales de desarrollo territorial basados en principios regenerativos.',
            'icon' => '🗺️'
        ),
        array(
            'title' => 'Fortalecimiento Comunitario',
            'description' => 'Capacitamos y empoderamos a las comunidades para que lideren su propio desarrollo.',
            'icon' => '🤝'
        ),
        array(
            'title' => 'Sostenibilidad Ambiental',
            'description' => 'Implementamos prácticas que protegen y regeneran el medio ambiente local.',
            'icon' => '🌱'
        ),
        array(
            'title' => 'Desarrollo Económico',
            'description' => 'Creamos oportunidades económicas sostenibles para las comunidades rurales.',
            'icon' => '💼'
        ),
        array(
            'title' => 'Gestión de Proyectos',
            'description' => 'Acompañamos la ejecución de proyectos de desarrollo territorial.',
            'icon' => '📋'
        ),
        array(
            'title' => 'Evaluación de Impacto',
            'description' => 'Medimos y evaluamos el impacto de las intervenciones de desarrollo.',
            'icon' => '📊'
        )
    );
    
    foreach ($services as $service) {
        $post_id = wp_insert_post(array(
            'post_title' => $service['title'],
            'post_content' => $service['description'],
            'post_status' => 'publish',
            'post_type' => 'services',
            'meta_input' => array(
                'service_icon' => $service['icon']
            )
        ));
    }
}

// Run installation on theme activation
add_action('after_switch_theme', 'sueno_andino_install_theme');

// Add admin notice for successful installation
add_action('admin_notices', function() {
    if (get_transient('sueno_andino_installed')) {
        echo '<div class="notice notice-success is-dismissible">';
        echo '<p><strong>Sueño Andino Theme:</strong> Instalación completada exitosamente. El tema está listo para usar.</p>';
        echo '</div>';
        delete_transient('sueno_andino_installed');
    }
});

// Set installation flag
add_action('after_switch_theme', function() {
    set_transient('sueno_andino_installed', true, 30);
});
