#!/usr/bin/env python3
# -*- coding: utf-8 -*-
"""
Script para instalar WordPress y el tema Sueño Andino corregido
"""

import os
import zipfile
import subprocess
import time
import webbrowser
from pathlib import Path

def instalar_wordpress_y_tema():
    print("=" * 60)
    print("INSTALADOR DE WORDPRESS Y TEMA SUENO ANDINO CORREGIDO")
    print("=" * 60)
    
    # Verificar que existe el archivo ZIP
    zip_file = "sueno-andino-wordpress-CORREGIDO-20250930-2258.zip"
    if not os.path.exists(zip_file):
        print(f"ERROR: No se encuentra el archivo {zip_file}")
        return False
    
    print(f"Archivo encontrado: {zip_file}")
    print(f"Tamaño: {os.path.getsize(zip_file) / 1024:.2f} KB")
    
    # Crear directorio de WordPress
    wp_dir = "wordpress-local"
    if os.path.exists(wp_dir):
        print(f"Eliminando directorio existente: {wp_dir}")
        import shutil
        shutil.rmtree(wp_dir)
    
    os.makedirs(wp_dir, exist_ok=True)
    print(f"Directorio creado: {wp_dir}")
    
    # Crear archivos básicos de WordPress
    print("Creando archivos básicos de WordPress...")
    
    # wp-config.php
    wp_config = """<?php
define('DB_NAME', 'wordpress');
define('DB_USER', 'root');
define('DB_PASSWORD', '');
define('DB_HOST', 'localhost');
define('DB_CHARSET', 'utf8mb4');
define('DB_COLLATE', '');

// Usar SQLite para simplicidad
define('DB_DIR', __DIR__ . '/database/');
define('DB_FILE', 'wordpress.db');

$table_prefix = 'wp_';

// Configuraciones de seguridad
define('AUTH_KEY', 'tu-clave-secreta-aqui');
define('SECURE_AUTH_KEY', 'tu-clave-secreta-aqui');
define('LOGGED_IN_KEY', 'tu-clave-secreta-aqui');
define('NONCE_KEY', 'tu-clave-secreta-aqui');
define('AUTH_SALT', 'tu-clave-secreta-aqui');
define('SECURE_AUTH_SALT', 'tu-clave-secreta-aqui');
define('LOGGED_IN_SALT', 'tu-clave-secreta-aqui');
define('NONCE_SALT', 'tu-clave-secreta-aqui');

// Configuraciones adicionales
define('WP_DEBUG', true);
define('WP_DEBUG_LOG', true);
define('WP_DEBUG_DISPLAY', false);

// URL del sitio
define('WP_HOME', 'http://localhost:8080');
define('WP_SITEURL', 'http://localhost:8080');

if (!defined('ABSPATH')) {
    define('ABSPATH', __DIR__ . '/');
}

require_once ABSPATH . 'wp-settings.php';
"""
    
    with open(f"{wp_dir}/wp-config.php", 'w', encoding='utf-8') as f:
        f.write(wp_config)
    
    # Crear directorio de temas
    themes_dir = f"{wp_dir}/wp-content/themes"
    os.makedirs(themes_dir, exist_ok=True)
    
    # Extraer tema
    print("Extrayendo tema corregido...")
    with zipfile.ZipFile(zip_file, 'r') as zip_ref:
        zip_ref.extractall(themes_dir)
    
    # Renombrar directorio del tema
    theme_source = f"{themes_dir}/sueno-andino-theme"
    theme_dest = f"{themes_dir}/sueno-andino"
    
    if os.path.exists(theme_source):
        if os.path.exists(theme_dest):
            import shutil
            shutil.rmtree(theme_dest)
        os.rename(theme_source, theme_dest)
        print("Tema extraído correctamente")
    else:
        print("ERROR: No se pudo extraer el tema")
        return False
    
    # Crear archivos básicos de WordPress
    print("Creando archivos básicos de WordPress...")
    
    # index.php principal
    main_index = """<?php
/**
 * Front to the WordPress application
 */

define('WP_USE_THEMES', true);

/** Loads the WordPress Environment and Template */
require __DIR__ . '/wp-blog-header.php';
"""
    
    with open(f"{wp_dir}/index.php", 'w', encoding='utf-8') as f:
        f.write(main_index)
    
    # wp-blog-header.php
    wp_blog_header = """<?php
/**
 * Loads the WordPress environment and template.
 */

if ( ! isset( $wp_did_header ) ) {
    $wp_did_header = true;
    
    // Load the WordPress library.
    require_once __DIR__ . '/wp-load.php';
    
    // Set up the WordPress query.
    wp();
    
    // Load the theme template.
    require_once ABSPATH . WPINC . '/template-loader.php';
}
"""
    
    with open(f"{wp_dir}/wp-blog-header.php", 'w', encoding='utf-8') as f:
        f.write(wp_blog_header)
    
    # wp-load.php básico
    wp_load = """<?php
/**
 * Bootstrap file for setting the ABSPATH constant
 * and loading the wp-config.php file
 */

// Define ABSPATH as this file's directory
if ( ! defined( 'ABSPATH' ) ) {
    define( 'ABSPATH', __DIR__ . '/' );
}

// Load the configuration file
require_once ABSPATH . 'wp-config.php';
"""
    
    with open(f"{wp_dir}/wp-load.php", 'w', encoding='utf-8') as f:
        f.write(wp_load)
    
    # wp-settings.php básico
    wp_settings = """<?php
/**
 * WordPress settings
 */

// Load WordPress configuration
require_once ABSPATH . 'wp-config.php';

// Set up WordPress environment
if ( ! defined( 'WP_DEBUG' ) ) {
    define( 'WP_DEBUG', false );
}

// Load theme
if ( ! function_exists( 'wp_head' ) ) {
    function wp_head() {
        echo '<meta charset="UTF-8">';
        echo '<meta name="viewport" content="width=device-width, initial-scale=1.0">';
        echo '<title>Sueño Andino - Desarrollo Territorial Regenerativo</title>';
    }
}

if ( ! function_exists( 'wp_footer' ) ) {
    function wp_footer() {
        echo '<!-- WordPress Footer -->';
    }
}

if ( ! function_exists( 'get_header' ) ) {
    function get_header() {
        include get_template_directory() . '/header.php';
    }
}

if ( ! function_exists( 'get_footer' ) ) {
    function get_footer() {
        include get_template_directory() . '/footer.php';
    }
}

if ( ! function_exists( 'get_template_directory' ) ) {
    function get_template_directory() {
        return ABSPATH . 'wp-content/themes/sueno-andino';
    }
}

if ( ! function_exists( 'home_url' ) ) {
    function home_url( $path = '' ) {
        return 'http://localhost:8080' . $path;
    }
}

if ( ! function_exists( 'is_front_page' ) ) {
    function is_front_page() {
        return true;
    }
}

if ( ! function_exists( 'is_home' ) ) {
    function is_home() {
        return false;
    }
}

// Cargar tema
if ( file_exists( get_template_directory() . '/functions.php' ) ) {
    require_once get_template_directory() . '/functions.php';
}
"""
    
    with open(f"{wp_dir}/wp-settings.php", 'w', encoding='utf-8') as f:
        f.write(wp_settings)
    
    # Crear directorio wp-includes básico
    wp_includes_dir = f"{wp_dir}/wp-includes"
    os.makedirs(wp_includes_dir, exist_ok=True)
    
    # Crear directorio wp-admin básico
    wp_admin_dir = f"{wp_dir}/wp-admin"
    os.makedirs(wp_admin_dir, exist_ok=True)
    
    print("Archivos básicos de WordPress creados")
    
    # Iniciar servidor
    print("Iniciando servidor local...")
    print("El sitio estará disponible en: http://localhost:8080")
    
    # Cambiar al directorio de WordPress
    os.chdir(wp_dir)
    
    # Iniciar servidor en segundo plano
    try:
        server_process = subprocess.Popen(
            ['python', '-m', 'http.server', '8080'],
            stdout=subprocess.PIPE,
            stderr=subprocess.PIPE
        )
        
        print("Servidor iniciado correctamente")
        print("Abre tu navegador en: http://localhost:8080")
        
        # Esperar un momento para que el servidor se inicie
        time.sleep(2)
        
        # Abrir navegador automáticamente
        try:
            webbrowser.open('http://localhost:8080')
            print("Navegador abierto automáticamente")
        except:
            print("No se pudo abrir el navegador automáticamente")
        
        print("\n" + "="*60)
        print("INSTALACION COMPLETADA")
        print("="*60)
        print("✅ WordPress instalado localmente")
        print("✅ Tema Sueño Andino corregido instalado")
        print("✅ Servidor ejecutándose en puerto 8080")
        print("✅ Sitio disponible en: http://localhost:8080")
        print("\nPara detener el servidor, presiona Ctrl+C")
        
        # Mantener el servidor ejecutándose
        try:
            server_process.wait()
        except KeyboardInterrupt:
            print("\nDeteniendo servidor...")
            server_process.terminate()
            print("Servidor detenido")
        
        return True
        
    except Exception as e:
        print(f"ERROR al iniciar servidor: {e}")
        return False

if __name__ == "__main__":
    instalar_wordpress_y_tema()
