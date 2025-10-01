#!/usr/bin/env python3
# -*- coding: utf-8 -*-
"""
Script para instalar WordPress localmente y mostrar el tema Sueño Andino
"""

import os
import subprocess
import webbrowser
import time
import zipfile
import shutil
from pathlib import Path

def create_local_wordpress():
    """Crear instalación local de WordPress"""
    
    print("Creando instalación local de WordPress...")
    
    # Crear directorio para WordPress
    wp_dir = "wordpress-local"
    if os.path.exists(wp_dir):
        shutil.rmtree(wp_dir)
    os.makedirs(wp_dir)
    
    # Crear archivos básicos de WordPress
    create_wp_config(wp_dir)
    create_index_php(wp_dir)
    create_htaccess(wp_dir)
    
    # Copiar tema
    theme_dir = os.path.join(wp_dir, "wp-content", "themes", "sueno-andino")
    os.makedirs(theme_dir, exist_ok=True)
    
    # Copiar archivos del tema
    theme_files = [
        "style.css",
        "functions.php", 
        "index.php",
        "header.php",
        "footer.php",
        "page-home.php",
        "theme.json",
        "css/blocks.css",
        "js/theme.js",
        "js/blocks.js"
    ]
    
    for file_path in theme_files:
        source = os.path.join("sueno-andino-theme", file_path)
        dest = os.path.join(theme_dir, file_path)
        
        if os.path.exists(source):
            os.makedirs(os.path.dirname(dest), exist_ok=True)
            shutil.copy2(source, dest)
            print(f"Copiado: {file_path}")
    
    print(f"WordPress local creado en: {os.path.abspath(wp_dir)}")
    return wp_dir

def create_wp_config(wp_dir):
    """Crear wp-config.php básico"""
    config_content = """<?php
/**
 * Configuración básica de WordPress para demo local
 */

// Configuración de base de datos (simulada)
define('DB_NAME', 'sueno_andino_demo');
define('DB_USER', 'root');
define('DB_PASSWORD', '');
define('DB_HOST', 'localhost');

// Configuración de WordPress
define('WP_DEBUG', true);
define('WP_DEBUG_LOG', true);
define('WP_DEBUG_DISPLAY', false);

// URLs del sitio
define('WP_HOME', 'http://localhost:8080/wordpress-local');
define('WP_SITEURL', 'http://localhost:8080/wordpress-local');

// Configuración de seguridad
define('AUTH_KEY', 'demo-key-123');
define('SECURE_AUTH_KEY', 'demo-secure-key-123');
define('LOGGED_IN_KEY', 'demo-logged-key-123');
define('NONCE_KEY', 'demo-nonce-key-123');
define('AUTH_SALT', 'demo-salt-123');
define('SECURE_AUTH_SALT', 'demo-secure-salt-123');
define('LOGGED_IN_SALT', 'demo-logged-salt-123');
define('NONCE_SALT', 'demo-nonce-salt-123');

// Configuración de memoria
define('WP_MEMORY_LIMIT', '256M');

// Deshabilitar actualizaciones automáticas
define('AUTOMATIC_UPDATER_DISABLED', true);
define('WP_AUTO_UPDATE_CORE', false);

// Configuración de archivos
define('FS_METHOD', 'direct');

// Configuración de tema
define('WP_DEFAULT_THEME', 'sueno-andino');

// Incluir WordPress
require_once(ABSPATH . 'wp-settings.php');
"""
    
    with open(os.path.join(wp_dir, "wp-config.php"), "w", encoding="utf-8") as f:
        f.write(config_content)

def create_index_php(wp_dir):
    """Crear index.php básico"""
    index_content = """<?php
/**
 * WordPress Demo - Tema Sueño Andino
 */

// Simular WordPress básico
$theme_dir = get_template_directory_uri();
$theme_name = 'Sueño Andino';
$theme_version = '1.0.0';

// Incluir el tema
include_once('wp-content/themes/sueno-andino/page-home.php');
"""
    
    with open(os.path.join(wp_dir, "index.php"), "w", encoding="utf-8") as f:
        f.write(index_content)

def create_htaccess(wp_dir):
    """Crear .htaccess básico"""
    htaccess_content = """# WordPress Demo - Sueño Andino
RewriteEngine On
RewriteBase /wordpress-local/

# Redireccionar a la página principal del tema
RewriteRule ^$ wp-content/themes/sueno-andino/page-home.php [L]

# Headers de seguridad
<IfModule mod_headers.c>
    Header always set X-Content-Type-Options nosniff
    Header always set X-Frame-Options SAMEORIGIN
    Header always set X-XSS-Protection "1; mode=block"
</IfModule>

# Compresión GZIP
<IfModule mod_deflate.c>
    AddOutputFilterByType DEFLATE text/plain
    AddOutputFilterByType DEFLATE text/html
    AddOutputFilterByType DEFLATE text/xml
    AddOutputFilterByType DEFLATE text/css
    AddOutputFilterByType DEFLATE application/xml
    AddOutputFilterByType DEFLATE application/xhtml+xml
    AddOutputFilterByType DEFLATE application/rss+xml
    AddOutputFilterByType DEFLATE application/javascript
    AddOutputFilterByType DEFLATE application/x-javascript
</IfModule>

# Cache headers
<IfModule mod_expires.c>
    ExpiresActive On
    ExpiresByType text/css "access plus 1 year"
    ExpiresByType application/javascript "access plus 1 year"
    ExpiresByType image/png "access plus 1 year"
    ExpiresByType image/jpg "access plus 1 year"
    ExpiresByType image/jpeg "access plus 1 year"
    ExpiresByType image/gif "access plus 1 year"
    ExpiresByType image/svg+xml "access plus 1 year"
</IfModule>
"""
    
    with open(os.path.join(wp_dir, ".htaccess"), "w", encoding="utf-8") as f:
        f.write(htaccess_content)

def start_server():
    """Iniciar servidor local"""
    print("Iniciando servidor local en puerto 8080...")
    
    # Cambiar al directorio de WordPress
    os.chdir("wordpress-local")
    
    # Iniciar servidor
    try:
        subprocess.Popen(["python", "-m", "http.server", "8080"], 
                        stdout=subprocess.DEVNULL, 
                        stderr=subprocess.DEVNULL)
        print("Servidor iniciado en: http://localhost:8080")
        return True
    except Exception as e:
        print(f"Error al iniciar servidor: {e}")
        return False

def main():
    """Función principal"""
    print("=" * 60)
    print("INSTALADOR DE WORDPRESS LOCAL - SUEÑO ANDINO")
    print("=" * 60)
    
    # Crear WordPress local
    wp_dir = create_local_wordpress()
    
    # Iniciar servidor
    if start_server():
        print("\n¡Instalación completada!")
        print("El tema Sueño Andino está disponible en:")
        print("http://localhost:8080")
        print("\nPresiona Ctrl+C para detener el servidor")
        
        # Esperar un momento y abrir navegador
        time.sleep(2)
        try:
            webbrowser.open("http://localhost:8080")
        except:
            print("Abre manualmente: http://localhost:8080")
    else:
        print("Error al iniciar el servidor")

if __name__ == "__main__":
    main()
