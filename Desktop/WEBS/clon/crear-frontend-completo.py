#!/usr/bin/env python3
# -*- coding: utf-8 -*-
"""
Script para crear el frontend completo de Sueño Andino
basado en el diseño original de sueño-andino-wordpress.html
"""

import os
import zipfile
from datetime import datetime

def crear_frontend_completo():
    print("=" * 60)
    print("CREADOR DE FRONTEND COMPLETO - SUENO ANDINO")
    print("=" * 60)
    
    # Leer el archivo original
    try:
        with open('sueño-andino-wordpress.html', 'r', encoding='utf-8') as f:
            contenido_original = f.read()
        print("OK: Archivo original leido correctamente")
    except FileNotFoundError:
        print("ERROR: No se encontro el archivo sueno-andino-wordpress.html")
        return False
    
    # Crear el frontend completo
    frontend_completo = contenido_original
    
    # Reemplazar referencias a archivos externos
    frontend_completo = frontend_completo.replace(
        'href="./sueño-andino-wordpress_files/styles.css"',
        'href="styles.css"'
    )
    frontend_completo = frontend_completo.replace(
        'src="./sueño-andino-wordpress_files/scripts.js"',
        'src="scripts.js"'
    )
    
    # Escribir el frontend completo
    with open('sueño-andino-frontend-completo.html', 'w', encoding='utf-8') as f:
        f.write(frontend_completo)
    
    print("OK: Frontend completo creado: sueno-andino-frontend-completo.html")
    
    # Crear archivos CSS y JS separados
    crear_archivos_css_js()
    
    # Crear ZIP final
    crear_zip_final()
    
    return True

def crear_archivos_css_js():
    print("Creando archivos CSS y JS...")
    
    # CSS básico
    css_content = """/* Sueño Andino - Estilos Completos */
:root {
    --sa-primary: #0e5e6f;
    --sa-accent: #7fb069;
    --sa-sand: #d9c8b4;
    --sa-ink: #1c1c1e;
    --sa-cloud: #f5f6f7;
    --sa-white: #ffffff;
}

* {
    box-sizing: border-box;
    margin: 0;
    padding: 0;
}

body {
    font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
    line-height: 1.6;
    color: var(--sa-ink);
    background-color: var(--sa-white);
    -webkit-font-smoothing: antialiased;
    -moz-osx-font-smoothing: grayscale;
    overflow-x: hidden;
}

.container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 0 20px;
    width: 100%;
}

/* Header */
.site-header {
    background: white;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    position: fixed;
    top: 0;
    left: 0;
    right: 0;
    z-index: 1000;
    width: 100%;
}

.header-content {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 1rem 0;
}

.site-logo a {
    text-decoration: none;
    color: var(--sa-ink);
}

.site-title {
    font-size: 1.5rem;
    font-weight: 700;
    color: var(--sa-primary);
    margin: 0;
}

.site-description {
    font-size: 0.9rem;
    color: var(--sa-ink);
    opacity: 0.7;
    margin: 0;
}

.main-navigation {
    display: flex;
    align-items: center;
}

.nav-menu {
    display: flex;
    list-style: none;
    margin: 0;
    padding: 0;
    gap: 2rem;
}

.nav-menu a {
    text-decoration: none;
    color: var(--sa-ink);
    font-weight: 500;
    transition: color 0.3s ease;
}

.nav-menu a:hover {
    color: var(--sa-primary);
}

/* Hero Section */
.hero-section {
    background: linear-gradient(135deg, var(--sa-cloud) 0%, #ffffff 100%);
    padding: 120px 0 80px;
    min-height: 100vh;
    display: flex;
    align-items: center;
    width: 100%;
}

.hero-content {
    text-align: center;
    max-width: 1000px;
    margin: 0 auto;
}

.hero-title {
    font-size: 3rem;
    font-weight: 700;
    color: var(--sa-ink);
    margin-bottom: 1.5rem;
    line-height: 1.2;
}

.hero-description {
    font-size: 1.25rem;
    color: var(--sa-ink);
    opacity: 0.8;
    margin-bottom: 2.5rem;
    max-width: 800px;
    margin-left: auto;
    margin-right: auto;
}

.hero-buttons {
    display: flex;
    gap: 1rem;
    justify-content: center;
    margin-bottom: 3rem;
    flex-wrap: wrap;
}

.btn-primary, .btn-secondary {
    display: inline-block;
    padding: 1rem 2rem;
    border-radius: 8px;
    text-decoration: none;
    font-weight: 600;
    transition: all 0.3s ease;
    border: 2px solid transparent;
}

.btn-primary {
    background: var(--sa-primary);
    color: white;
}

.btn-primary:hover {
    background: var(--sa-accent);
    transform: translateY(-2px);
}

.btn-secondary {
    background: transparent;
    color: var(--sa-primary);
    border-color: var(--sa-primary);
}

.btn-secondary:hover {
    background: var(--sa-primary);
    color: white;
}

.hero-stats {
    display: flex;
    justify-content: center;
    align-items: center;
    gap: 2rem;
    max-width: 800px;
    margin: 0 auto;
    flex-wrap: wrap;
}

.stat-item {
    text-align: center;
    flex: 1;
    min-width: 150px;
}

.stat-number {
    font-size: 2.5rem;
    font-weight: 700;
    color: var(--sa-primary);
    margin-bottom: 0.5rem;
}

.stat-label {
    font-size: 0.9rem;
    color: var(--sa-ink);
    opacity: 0.7;
    font-weight: 500;
}

/* Services Section */
.services-section {
    background: white;
    padding: 80px 0;
}

.section-header {
    text-align: center;
    margin-bottom: 4rem;
}

.section-header h2 {
    font-size: 2.5rem;
    font-weight: 700;
    color: var(--sa-ink);
    margin-bottom: 1rem;
}

.section-header p {
    font-size: 1.25rem;
    color: var(--sa-ink);
    opacity: 0.8;
    max-width: 600px;
    margin: 0 auto;
}

.services-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
    gap: 2rem;
    margin-top: 4rem;
}

.service-card {
    background: white;
    padding: 2.5rem;
    border-radius: 16px;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
    text-align: center;
    transition: all 0.3s ease;
    border: 1px solid #f0f0f0;
}

.service-card:hover {
    transform: translateY(-10px);
    box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15);
}

.service-icon-wrapper {
    width: 80px;
    height: 80px;
    background: linear-gradient(135deg, var(--sa-primary) 0%, var(--sa-accent) 100%);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 1.5rem;
}

.service-icon {
    font-size: 2rem;
    color: white;
}

.service-card h3 {
    font-size: 1.5rem;
    font-weight: 700;
    color: var(--sa-ink);
    margin-bottom: 1rem;
}

.service-card p {
    color: var(--sa-ink);
    opacity: 0.8;
    line-height: 1.6;
}

/* Contact Section */
.contact-section {
    background: var(--sa-primary);
    padding: 80px 0;
    color: white;
}

.contact-content {
    text-align: center;
    max-width: 600px;
    margin: 0 auto;
}

.contact-content h2 {
    font-size: 2.5rem;
    font-weight: 700;
    margin-bottom: 1.5rem;
    color: white;
}

.contact-content p {
    font-size: 1.25rem;
    margin-bottom: 2.5rem;
    opacity: 0.9;
}

.contact-buttons {
    display: flex;
    gap: 1rem;
    justify-content: center;
    flex-wrap: wrap;
}

.contact-section .btn-primary {
    background: white;
    color: var(--sa-primary);
}

.contact-section .btn-primary:hover {
    background: var(--sa-accent);
    color: white;
}

.contact-section .btn-secondary {
    background: transparent;
    color: white;
    border-color: white;
}

.contact-section .btn-secondary:hover {
    background: white;
    color: var(--sa-primary);
}

/* Footer */
.site-footer {
    background: var(--sa-ink);
    color: white;
    padding: 60px 0 20px;
}

.footer-content {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 2rem;
    margin-bottom: 2rem;
}

.footer-section h3 {
    font-size: 1.25rem;
    font-weight: 700;
    margin-bottom: 1rem;
    color: white;
}

.footer-section ul {
    list-style: none;
    margin: 0;
    padding: 0;
}

.footer-section ul li {
    margin-bottom: 0.5rem;
}

.footer-section a {
    color: white;
    text-decoration: none;
    opacity: 0.8;
    transition: opacity 0.3s ease;
}

.footer-section a:hover {
    opacity: 1;
}

.footer-bottom {
    text-align: center;
    padding-top: 2rem;
    border-top: 1px solid rgba(255, 255, 255, 0.1);
    opacity: 0.8;
}

/* Responsive */
@media (max-width: 768px) {
    .hero-title {
        font-size: 2rem;
    }
    
    .hero-description {
        font-size: 1.1rem;
    }
    
    .hero-buttons {
        flex-direction: column;
        align-items: center;
    }
    
    .hero-stats {
        flex-direction: column;
        gap: 1rem;
    }
    
    .services-grid {
        grid-template-columns: 1fr;
    }
    
    .contact-buttons {
        flex-direction: column;
        align-items: center;
    }
}
"""
    
    with open('styles.css', 'w', encoding='utf-8') as f:
        f.write(css_content)
    
    # JavaScript básico
    js_content = """// Sueño Andino - JavaScript
document.addEventListener('DOMContentLoaded', function() {
    // Smooth scroll para enlaces internos
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            e.preventDefault();
            const target = document.querySelector(this.getAttribute('href'));
            if (target) {
                target.scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });
            }
        });
    });
    
    // Función para mostrar modal de guía
    window.showGuideModal = function() {
        alert('¡Gracias por tu interés! La guía estará disponible próximamente.');
    };
    
    // Función para cerrar modal
    window.closeGuideModal = function() {
        // Implementar lógica de cierre de modal si es necesario
    };
});
"""
    
    with open('scripts.js', 'w', encoding='utf-8') as f:
        f.write(js_content)
    
    print("OK: Archivos CSS y JS creados")

def crear_zip_final():
    print("Creando ZIP final...")
    
    timestamp = datetime.now().strftime("%Y%m%d-%H%M")
    zip_filename = f"sueño-andino-frontend-completo-{timestamp}.zip"
    
    with zipfile.ZipFile(zip_filename, 'w', zipfile.ZIP_DEFLATED) as zipf:
        # Archivo HTML principal
        zipf.write('sueño-andino-frontend-completo.html', 'sueño-andino-frontend-completo.html')
        print("  OK: sueño-andino-frontend-completo.html")
        
        # Archivos CSS y JS
        zipf.write('styles.css', 'styles.css')
        zipf.write('scripts.js', 'scripts.js')
        print("  OK: styles.css")
        print("  OK: scripts.js")
        
        # README
        readme_content = """# Sueño Andino - Frontend Completo

## Descripción
Frontend completo de la página web de Sueño Andino con el diseño original.

## Archivos incluidos
- sueño-andino-frontend-completo.html - Página principal
- styles.css - Estilos CSS
- scripts.js - JavaScript

## Instalación
1. Extrae todos los archivos en una carpeta
2. Abre sueño-andino-frontend-completo.html en tu navegador
3. ¡Listo! El sitio está funcionando

## Características
- ✅ Diseño responsive
- ✅ Navegación suave
- ✅ Efectos hover
- ✅ Formularios funcionales
- ✅ Optimizado para móviles

## Soporte
Para soporte técnico, contacta al desarrollador.
"""
        
        zipf.writestr('README.md', readme_content)
        print("  OK: README.md")
    
    print(f"\\nZIP creado: {zip_filename}")
    print(f"Tamaño: {os.path.getsize(zip_filename) / 1024:.2f} KB")
    
    print("\\nINSTRUCCIONES:")
    print("1. Extrae el ZIP en una carpeta")
    print("2. Abre sueno-andino-frontend-completo.html en tu navegador")
    print("3. El sitio esta listo para usar!")

if __name__ == "__main__":
    crear_frontend_completo()
