#!/usr/bin/env python3
# -*- coding: utf-8 -*-
"""
Script para empaquetar el tema WordPress Sueño Andino corregido
"""

import os
import zipfile
from datetime import datetime

def empaquetar_tema_corregido():
    print("=" * 60)
    print("EMPAQUETADOR DE TEMA WORDPRESS CORREGIDO - SUENO ANDINO")
    print("=" * 60)
    
    # Crear timestamp
    timestamp = datetime.now().strftime("%Y%m%d-%H%M")
    zip_filename = f"sueno-andino-wordpress-CORREGIDO-{timestamp}.zip"
    
    print(f"Iniciando empaquetado del tema corregido...")
    
    # Archivos del tema
    theme_files = [
        'style.css',
        'functions.php',
        'index.php',
        'front-page.php',
        'header.php',
        'footer.php',
        'page-home.php',
        'page-blog.php',
        'page-servicios.php',
        'page-nosotros.php',
        'page-contacto.php',
        'theme.json',
        'setup-theme.php',
        'css/blocks.css',
        'js/theme.js',
        'js/blocks.js'
    ]
    
    with zipfile.ZipFile(zip_filename, 'w', zipfile.ZIP_DEFLATED) as zipf:
        print("Copiando archivos del tema...")
        
        for file in theme_files:
            file_path = f'sueno-andino-theme/{file}'
            if os.path.exists(file_path):
                zipf.write(file_path, file)
                print(f"  OK: {file}")
            else:
                print(f"  ERROR: {file} - No encontrado")
        
        # Crear README con instrucciones
        readme_content = """# Sueño Andino - Tema WordPress Corregido

## Instalación

1. Ve a tu WordPress > Apariencia > Temas
2. Haz clic en 'Añadir nuevo' > 'Subir tema'
3. Selecciona este archivo ZIP
4. Activa el tema 'Sueño Andino'
5. El tema se configurará automáticamente

## Características

- ✅ Página de inicio completa con todas las secciones
- ✅ Diseño responsive
- ✅ Configuración automática
- ✅ Menú principal automático
- ✅ Páginas adicionales (Blog, Servicios, Nosotros, Contacto)

## Solución de Problemas

Si no se ve el diseño completo:
1. Ve a Configuración > Lectura
2. Asegúrate de que "Tu página de inicio muestra" esté en "Una página estática"
3. Selecciona "Inicio" como página de inicio
4. Guarda los cambios

## Soporte

Para soporte técnico, contacta al desarrollador.
"""
        
        zipf.writestr('README-CORREGIDO.md', readme_content)
        print("  OK: README-CORREGIDO.md")
    
    print(f"\nTema corregido creado: {zip_filename}")
    print(f"Tamaño: {os.path.getsize(zip_filename) / 1024:.2f} KB")
    
    print("\nINSTRUCCIONES DE INSTALACION:")
    print("1. Ve a tu WordPress > Apariencia > Temas")
    print("2. Haz clic en 'Añadir nuevo' > 'Subir tema'")
    print("3. Selecciona el archivo ZIP corregido")
    print("4. Activa el tema 'Sueño Andino'")
    print("5. El tema se configurará automáticamente")
    print("6. Ve a tu sitio para ver el diseño completo")
    
    print("\nSOLUCION DE PROBLEMAS:")
    print("Si no se ve el diseño completo:")
    print("1. Ve a Configuracion > Lectura")
    print("2. Asegurate de que 'Tu pagina de inicio muestra' este en 'Una pagina estatica'")
    print("3. Selecciona 'Inicio' como pagina de inicio")
    print("4. Guarda los cambios")
    
    return zip_filename

if __name__ == "__main__":
    empaquetar_tema_corregido()
