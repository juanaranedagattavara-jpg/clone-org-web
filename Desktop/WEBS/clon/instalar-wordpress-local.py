#!/usr/bin/env python3
# -*- coding: utf-8 -*-
"""
Script para instalar WordPress localmente y probar el tema
"""

import os
import zipfile
import subprocess
import time

def instalar_wordpress_local():
    print("=" * 60)
    print("INSTALADOR DE WORDPRESS LOCAL PARA PROBAR TEMA")
    print("=" * 60)
    
    # Crear directorio de WordPress
    wp_dir = "wordpress-local"
    if os.path.exists(wp_dir):
        import shutil
        shutil.rmtree(wp_dir)
    os.makedirs(wp_dir)
    
    # Crear archivos básicos de WordPress
    print("Creando archivos básicos de WordPress...")
    
    # wp-config.php
    wp_config = """<?php
define('DB_NAME', 'wordpress');
define('DB_USER', 'root');
define('DB_PASSWORD', '');
define('DB_HOST', 'localhost');
define('DB_CHARSET', 'utf8');
define('DB_COLLATE', '');

define('AUTH_KEY', 'local-key');
define('SECURE_AUTH_KEY', 'local-secure-key');
define('LOGGED_IN_KEY', 'local-logged-in-key');
define('NONCE_KEY', 'local-nonce-key');
define('AUTH_SALT', 'local-auth-salt');
define('SECURE_AUTH_SALT', 'local-secure-auth-salt');
define('LOGGED_IN_SALT', 'local-logged-in-salt');
define('NONCE_SALT', 'local-nonce-salt');

$table_prefix = 'wp_';

define('WP_DEBUG', true);
define('WP_DEBUG_LOG', true);
define('WP_DEBUG_DISPLAY', false);

if (!defined('ABSPATH')) {
    define('ABSPATH', __DIR__ . '/');
}

require_once ABSPATH . 'wp-settings.php';
"""
    
    with open(f"{wp_dir}/wp-config.php", 'w', encoding='utf-8') as f:
        f.write(wp_config)
    
    # index.php
    index_php = """<?php
define('WP_USE_THEMES', true);
require __DIR__ . '/wp-blog-header.php';
"""
    
    with open(f"{wp_dir}/index.php", 'w', encoding='utf-8') as f:
        f.write(index_php)
    
    # wp-blog-header.php (simulado)
    wp_blog_header = """<?php
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
"""
    
    with open(f"{wp_dir}/wp-blog-header.php", 'w', encoding='utf-8') as f:
        f.write(wp_blog_header)
    
    # Crear directorios necesarios
    os.makedirs(f"{wp_dir}/wp-content/themes", exist_ok=True)
    os.makedirs(f"{wp_dir}/wp-content/plugins", exist_ok=True)
    os.makedirs(f"{wp_dir}/wp-content/uploads", exist_ok=True)
    
    # Extraer el tema fiel
    tema_zip = "sueno-andino-tema-fiel-20250930-2338.zip"
    if os.path.exists(tema_zip):
        print("Extrayendo tema fiel...")
        with zipfile.ZipFile(tema_zip, 'r') as zip_ref:
            zip_ref.extractall(f"{wp_dir}/wp-content/themes/active-theme")
        print("Tema extraído correctamente")
    else:
        print(f"ERROR: No se encontró {tema_zip}")
        return False
    
    print(f"\\nWordPress local creado en: {wp_dir}")
    print("\\nPara probar el tema:")
    print("1. Navega a http://localhost:8080/wordpress-local")
    print("2. El tema debería mostrarse con el diseño original")
    
    return True

if __name__ == "__main__":
    instalar_wordpress_local()
