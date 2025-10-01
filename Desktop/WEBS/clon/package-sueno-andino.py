#!/usr/bin/env python3
# -*- coding: utf-8 -*-
"""
Script para empaquetar el tema WordPress Sueño Andino
Basado en el contenido específico de contenido-sueño-andino.html
"""

import os
import zipfile
import shutil
from datetime import datetime

def create_zip_package():
    """Crear paquete ZIP del tema WordPress"""
    
    # Configuración
    theme_name = "sueno-andino-theme"
    output_name = f"sueno-andino-wordpress-{datetime.now().strftime('%Y%m%d-%H%M')}.zip"
    
    # Archivos del tema
    theme_files = [
        "style.css",
        "functions.php", 
        "index.php",
        "header.php",
        "footer.php",
        "page-home.php",
        "page-blog.php",
        "page-servicios.php",
        "page-nosotros.php",
        "page-contacto.php",
        "theme.json",
        "css/blocks.css",
        "js/theme.js",
        "js/blocks.js"
    ]
    
    print("Iniciando empaquetado del tema Sueño Andino...")
    
    # Crear directorio temporal
    temp_dir = "temp_theme"
    if os.path.exists(temp_dir):
        shutil.rmtree(temp_dir)
    os.makedirs(temp_dir)
    
    # Copiar archivos del tema
    print("Copiando archivos del tema...")
    for file_path in theme_files:
        source_path = os.path.join(theme_name, file_path)
        dest_path = os.path.join(temp_dir, file_path)
        
        # Crear directorios necesarios
        os.makedirs(os.path.dirname(dest_path), exist_ok=True)
        
        if os.path.exists(source_path):
            shutil.copy2(source_path, dest_path)
            print(f"  OK: {file_path}")
        else:
            print(f"  ERROR: No encontrado: {file_path}")
    
    # Crear archivo README
    readme_content = """# Tema WordPress Sueño Andino

## Descripción
Tema WordPress optimizado para desarrollo territorial regenerativo, basado en el diseño específico de contenido-sueño-andino.html.

## Características
- ✅ Diseño responsive y moderno
- ✅ Bloques Gutenberg personalizados
- ✅ Optimizado para rendimiento
- ✅ Formularios funcionales con AJAX
- ✅ SEO optimizado
- ✅ Accesibilidad mejorada

## Instalación
1. Sube el archivo ZIP a WordPress > Apariencia > Temas
2. Activa el tema "Sueño Andino"
3. Configura el menú en Apariencia > Menús
4. Personaliza los colores en Personalizar > Colores

## Bloques Disponibles
- Hero Section
- Timeline
- Services
- Testimonials
- Team
- Contact

## Soporte
Para soporte técnico, contacta a: hola@sueñoandino.com

## Versión
1.0.0 - {date}
""".format(date=datetime.now().strftime('%d/%m/%Y'))
    
    with open(os.path.join(temp_dir, "README.md"), "w", encoding="utf-8") as f:
        f.write(readme_content)
    
    # Crear archivo de instalación
    install_content = """<?php
/**
 * Script de instalación automática del tema
 * Se ejecuta al activar el tema
 */

// Evitar acceso directo
if (!defined('ABSPATH')) {
    exit;
}

// Crear páginas necesarias
function sueno_andino_create_pages() {
    $pages = array(
        'Inicio' => array(
            'content' => '<!-- wp:sueno-andino/hero-section --><!-- /wp:sueno-andino/hero-section -->',
            'template' => 'page-home.php'
        ),
        'Blog' => array(
            'content' => 'Contenido del blog con artículos y noticias sobre desarrollo territorial regenerativo.',
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
                'post_title' => $title,
                'post_content' => $data['content'],
                'post_status' => 'publish',
                'post_type' => 'page',
                'page_template' => isset($data['template']) ? $data['template'] : ''
            ));
            
            if ($title === 'Inicio') {
                update_option('page_on_front', $page_id);
                update_option('show_on_front', 'page');
            }
        }
    }
}

// Ejecutar al activar el tema
add_action('after_switch_theme', 'sueno_andino_create_pages');
"""
    
    with open(os.path.join(temp_dir, "install-theme.php"), "w", encoding="utf-8") as f:
        f.write(install_content)
    
    # Crear ZIP
    print("Creando archivo ZIP...")
    with zipfile.ZipFile(output_name, 'w', zipfile.ZIP_DEFLATED) as zipf:
        for root, dirs, files in os.walk(temp_dir):
            for file in files:
                file_path = os.path.join(root, file)
                arc_path = os.path.relpath(file_path, temp_dir)
                zipf.write(file_path, arc_path)
                print(f"  - {arc_path}")
    
    # Limpiar directorio temporal
    shutil.rmtree(temp_dir)
    
    # Verificar archivo
    if os.path.exists(output_name):
        file_size = os.path.getsize(output_name) / (1024 * 1024)  # MB
        print(f"\nPaquete creado exitosamente: {output_name}")
        print(f"Tamaño: {file_size:.2f} MB")
        print(f"Ubicacion: {os.path.abspath(output_name)}")
        
        # Mostrar contenido del ZIP
        print("\nContenido del paquete:")
        with zipfile.ZipFile(output_name, 'r') as zipf:
            for file_info in zipf.filelist:
                print(f"  - {file_info.filename}")
        
        return True
    else:
        print("ERROR: Error al crear el paquete")
        return False

def main():
    """Función principal"""
    print("=" * 60)
    print("EMPAQUETADOR DE TEMA WORDPRESS - SUENO ANDINO")
    print("=" * 60)
    
    # Verificar que existe el directorio del tema
    if not os.path.exists("sueno-andino-theme"):
        print("ERROR: No se encuentra el directorio 'sueno-andino-theme'")
        return False
    
    # Crear paquete
    success = create_zip_package()
    
    if success:
        print("\n¡Proceso completado exitosamente!")
        print("\nInstrucciones de instalacion:")
        print("1. Ve a tu WordPress > Apariencia > Temas")
        print("2. Haz clic en 'Añadir nuevo' > 'Subir tema'")
        print("3. Selecciona el archivo ZIP generado")
        print("4. Activa el tema 'Sueño Andino'")
        print("5. Configura el menú en Apariencia > Menús")
        print("6. Personaliza en Personalizar > Colores")
    else:
        print("\nEl proceso fallo. Revisa los errores anteriores.")
    
    return success

if __name__ == "__main__":
    main()
