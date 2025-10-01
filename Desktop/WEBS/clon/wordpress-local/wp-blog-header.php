<?php
// Simulación de wp-blog-header.php para testing
if (!defined('ABSPATH')) {
    define('ABSPATH', __DIR__ . '/');
}

// Simular funciones de WordPress
function get_header() {
    include 'wp-content/themes/active-theme/header.php';
}

function get_footer() {
    include 'wp-content/themes/active-theme/footer.php';
}

function get_template_directory_uri() {
    return 'wp-content/themes/active-theme';
}

function get_stylesheet_uri() {
    return 'wp-content/themes/active-theme/style.css';
}

function bloginfo($show) {
    $info = array(
        'name' => 'Sueño Andino',
        'description' => 'Desarrollo Territorial Regenerativo',
        'charset' => 'UTF-8',
        'url' => 'http://localhost:8080/wordpress-local'
    );
    return isset($info[$show]) ? $info[$show] : '';
}

function wp_title($sep = '|', $display = true, $seplocation = 'right') {
    $title = 'Sueño Andino - Desarrollo Territorial Regenerativo';
    if ($display) {
        echo $title;
    }
    return $title;
}

function language_attributes() {
    echo 'lang="es"';
}

function body_class() {
    echo 'class="home"';
}

function wp_head() {
    echo '<link rel="stylesheet" href="' . get_template_directory_uri() . '/styles.css">';
    echo '<script src="' . get_template_directory_uri() . '/js/theme.js" defer></script>';
}

function wp_body_open() {
    // Hook para plugins
}

function wp_footer() {
    // Hook para plugins
}

function home_url($path = '') {
    return 'http://localhost:8080/wordpress-local' . $path;
}

function esc_url($url) {
    return htmlspecialchars($url, ENT_QUOTES, 'UTF-8');
}

// Incluir el tema activo
$theme_dir = 'wp-content/themes/active-theme';
if (file_exists($theme_dir . '/front-page.php')) {
    include $theme_dir . '/front-page.php';
} else {
    include $theme_dir . '/index.php';
}
