import os
import shutil
import zipfile
import urllib.request
import subprocess
import time

def download_wordpress(dest_dir):
    """Descarga la última versión de WordPress."""
    print("Descargando WordPress...")
    wp_zip_url = "https://wordpress.org/latest.zip"
    wp_zip_path = os.path.join(dest_dir, "wordpress.zip")
    urllib.request.urlretrieve(wp_zip_url, wp_zip_path)
    
    with zipfile.ZipFile(wp_zip_path, 'r') as zip_ref:
        zip_ref.extractall(dest_dir)
    
    # Mover contenido de 'wordpress' a la raíz de dest_dir
    for item in os.listdir(os.path.join(dest_dir, "wordpress")):
        shutil.move(os.path.join(dest_dir, "wordpress", item), dest_dir)
    shutil.rmtree(os.path.join(dest_dir, "wordpress"))
    os.remove(wp_zip_path)
    print("WordPress descargado y extraído.")

def configure_wp_config(wp_dir):
    """Configura wp-config.php."""
    print("Configurando wp-config.php...")
    wp_config_sample = os.path.join(wp_dir, "wp-config-sample.php")
    wp_config = os.path.join(wp_dir, "wp-config.php")
    
    with open(wp_config_sample, 'r', encoding='utf-8') as f:
        content = f.read()
    
    # Configuración de base de datos SQLite
    content = content.replace("define( 'DB_NAME', 'database_name_here' );", "define( 'DB_NAME', 'wordpress_db' );")
    content = content.replace("define( 'DB_USER', 'username_here' );", "define( 'DB_USER', 'root' );")
    content = content.replace("define( 'DB_PASSWORD', 'password_here' );", "define( 'DB_PASSWORD', '' );")
    content = content.replace("define( 'DB_HOST', 'localhost' );", "define( 'DB_HOST', 'localhost' );")
    
    # Añadir configuración para SQLite
    content += "\n\n// SQLite Database Integration\n"
    content += "define('DB_ENGINE', 'sqlite');\n"
    content += "define('DB_DIR', WP_CONTENT_DIR . '/database');\n"
    
    with open(wp_config, 'w', encoding='utf-8') as f:
        f.write(content)
    
    print("wp-config.php configurado.")

def install_sqlite_plugin(wp_content_dir):
    """Instala el plugin SQLite Database Integration."""
    print("Instalando plugin SQLite Database Integration...")
    plugins_dir = os.path.join(wp_content_dir, "plugins")
    os.makedirs(plugins_dir, exist_ok=True)
    
    sqlite_zip_url = "https://downloads.wordpress.org/plugin/sqlite-database-integration.zip"
    sqlite_zip_path = os.path.join(plugins_dir, "sqlite-database-integration.zip")
    urllib.request.urlretrieve(sqlite_zip_url, sqlite_zip_path)
    
    with zipfile.ZipFile(sqlite_zip_path, 'r') as zip_ref:
        zip_ref.extractall(plugins_dir)
    os.remove(sqlite_zip_path)
    
    # Crear el archivo db.php necesario
    db_php_content = """<?php
/*
Plugin Name: SQLite Database Integration
Drop-in Name: db.php
Description: Integrates SQLite as the database for WordPress.
Version: 1.9.1
Author: Kevin T. Smith
Author URI: https://kts.ai
*/

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

if ( ! defined( 'DB_ENGINE' ) || 'sqlite' !== DB_ENGINE ) {
    return;
}

if ( ! defined( 'DB_DIR' ) ) {
    define( 'DB_DIR', WP_CONTENT_DIR . '/database' );
}

if ( ! file_exists( DB_DIR ) ) {
    wp_mkdir_p( DB_DIR );
}

require_once __DIR__ . '/sqlite-database-integration/db.php';
"""
    with open(os.path.join(wp_content_dir, "db.php"), "w", encoding="utf-8") as f:
        f.write(db_php_content)
    
    print("Plugin SQLite Database Integration instalado.")

def copy_theme(wp_content_dir, theme_source_dir):
    """Copia el tema al directorio de temas de WordPress."""
    themes_dir = os.path.join(wp_content_dir, "themes")
    os.makedirs(themes_dir, exist_ok=True)
    
    theme_dest_dir = os.path.join(themes_dir, "sueno-andino")
    if os.path.exists(theme_dest_dir):
        shutil.rmtree(theme_dest_dir)
    shutil.copytree(theme_source_dir, theme_dest_dir)
    print(f"Tema copiado: sueno-andino")

def create_pages_script(wp_content_dir):
    """Crea script para configurar páginas automáticamente."""
    mu_plugins_dir = os.path.join(wp_content_dir, "mu-plugins")
    os.makedirs(mu_plugins_dir, exist_ok=True)
    
    script_content = """<?php
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
"""
    
    with open(os.path.join(mu_plugins_dir, "sueno-andino-setup.php"), "w", encoding="utf-8") as f:
        f.write(script_content)
    
    print("Script de configuración creado.")

def main():
    print("=" * 60)
    print("INSTALADOR SIMPLE DE WORDPRESS + TEMA SUEÑO ANDINO")
    print("=" * 60)
    
    wordpress_dir = "wordpress-simple"
    theme_source_dir = "sueno-andino-theme"
    
    if os.path.exists(wordpress_dir):
        shutil.rmtree(wordpress_dir)
    os.makedirs(wordpress_dir)
    
    print("Creando instalación de WordPress...")
    download_wordpress(wordpress_dir)
    
    wp_content_dir = os.path.join(wordpress_dir, "wp-content")
    
    configure_wp_config(wordpress_dir)
    install_sqlite_plugin(wp_content_dir)
    copy_theme(wp_content_dir, theme_source_dir)
    create_pages_script(wp_content_dir)
    
    print(f"WordPress instalado en: {os.path.abspath(wordpress_dir)}")
    print("Iniciando servidor en puerto 8080...")
    
    try:
        server_process = subprocess.Popen(
            ['python', '-m', 'http.server', '8080', '-d', wordpress_dir],
            stdout=subprocess.DEVNULL,
            stderr=subprocess.DEVNULL,
            creationflags=subprocess.CREATE_NEW_PROCESS_GROUP if os.name == 'nt' else 0
        )
        print(f"Servidor iniciado en: http://localhost:8080")
        print("\nInstalación completada!")
        print("El tema Sueño Andino está disponible en:")
        print("http://localhost:8080")
        print("\nPresiona Ctrl+C para detener el servidor")
        
        # Mantener el servidor ejecutándose
        while True:
            time.sleep(1)
    except KeyboardInterrupt:
        print("\nDeteniendo servidor...")
        if server_process:
            server_process.terminate()
            server_process.wait()
        print("Servidor detenido.")

if __name__ == "__main__":
    main()
