#!/usr/bin/env python3
# -*- coding: utf-8 -*-
"""
Instalador simple del tema Sueño Andino
"""

import os
import zipfile
import subprocess
import time
import webbrowser

def instalar_tema_simple():
    print("=" * 60)
    print("INSTALADOR SIMPLE - TEMA SUENO ANDINO")
    print("=" * 60)
    
    # Crear directorio del tema
    theme_dir = "sueno-andino-tema"
    if os.path.exists(theme_dir):
        import shutil
        shutil.rmtree(theme_dir)
    
    os.makedirs(theme_dir, exist_ok=True)
    print(f"Directorio creado: {theme_dir}")
    
    # Extraer archivos del ZIP
    zip_file = "sueno-andino-wordpress-CORREGIDO-20250930-2258.zip"
    print(f"Extrayendo archivos de: {zip_file}")
    
    with zipfile.ZipFile(zip_file, 'r') as zip_ref:
        for file_info in zip_ref.infolist():
            if file_info.filename.endswith('/'):
                continue
            
            # Crear directorios necesarios
            file_path = os.path.join(theme_dir, file_info.filename)
            os.makedirs(os.path.dirname(file_path), exist_ok=True)
            
            # Extraer archivo
            with zip_ref.open(file_info) as source, open(file_path, 'wb') as target:
                target.write(source.read())
            
            print(f"  OK: {file_info.filename}")
    
    print("Archivos extraídos correctamente")
    
    # Crear archivo HTML principal
    html_content = """<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sueño Andino - Desarrollo Territorial Regenerativo</title>
    <link rel="stylesheet" href="sueno-andino-tema/style.css">
    <link rel="stylesheet" href="sueno-andino-tema/css/blocks.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
</head>
<body>
    <!-- Header -->
    <header class="site-header">
        <div class="container">
            <div class="header-content">
                <div class="site-branding">
                    <div class="site-logo">
                        <a href="#">
                            <h1 class="site-title">Sueño Andino</h1>
                            <p class="site-description">Desarrollo Territorial Regenerativo</p>
                        </a>
                    </div>
                </div>
                <nav class="main-navigation">
                    <ul class="nav-menu">
                        <li><a href="#inicio">Inicio</a></li>
                        <li><a href="#servicios">Servicios</a></li>
                        <li><a href="#equipo">Equipo</a></li>
                        <li><a href="#contacto">Contacto</a></li>
                    </ul>
                </nav>
            </div>
        </div>
    </header>

    <!-- Hero Section -->
    <div class="hero-section" style="background: linear-gradient(135deg, #f5f6f7 0%, #ffffff 100%); padding: 120px 0 80px; min-height: 100vh; display: flex; align-items: center; width: 100%;">
        <div class="container" style="max-width: 1200px; margin: 0 auto; padding: 0 20px; width: 100%;">
            <div class="hero-content" style="text-align: center; max-width: 1000px; margin: 0 auto;">
                <h1 class="hero-title" style="font-size: 3rem; font-weight: 700; color: #1c1c1e; margin-bottom: 1.5rem; line-height: 1.2;">Transformando Comunidades Sostenibles</h1>
                <p class="hero-description" style="font-size: 1.25rem; color: #1c1c1e; opacity: 0.8; margin-bottom: 2.5rem; max-width: 800px; margin-left: auto; margin-right: auto;">Desarrollamos soluciones integrales para el crecimiento territorial sostenible, conectando comunidades con oportunidades de desarrollo.</p>
                
                <div class="hero-buttons" style="display: flex; gap: 1rem; justify-content: center; margin-bottom: 3rem; flex-wrap: wrap;">
                    <a href="#servicios" class="btn-primary" style="display: inline-block; padding: 1rem 2rem; border-radius: 8px; text-decoration: none; font-weight: 600; transition: all 0.3s ease; border: 2px solid transparent; background: #0e5e6f; color: white;">Conoce Nuestros Servicios</a>
                    <a href="#" class="btn-secondary" onclick="alert('Descarga guía gratuita'); return false;" style="display: inline-block; padding: 1rem 2rem; border-radius: 8px; text-decoration: none; font-weight: 600; transition: all 0.3s ease; border: 2px solid #0e5e6f; background: transparent; color: #0e5e6f;">Descarga Guía Gratuita</a>
                </div>
                
                <div class="hero-stats" style="display: flex; justify-content: center; align-items: center; gap: 2rem; max-width: 800px; margin: 0 auto; flex-wrap: wrap;">
                    <div class="stat-item" style="text-align: center; flex: 1; min-width: 150px;">
                        <h3 class="stat-number" style="font-size: 2.5rem; font-weight: 700; color: #0e5e6f; margin-bottom: 0.5rem;">50+</h3>
                        <p class="stat-label" style="font-size: 0.9rem; color: #1c1c1e; opacity: 0.7; font-weight: 500;">Proyectos Completados</p>
                    </div>
                    <div class="stat-item" style="text-align: center; flex: 1; min-width: 150px;">
                        <h3 class="stat-number" style="font-size: 2.5rem; font-weight: 700; color: #0e5e6f; margin-bottom: 0.5rem;">15</h3>
                        <p class="stat-label" style="font-size: 0.9rem; color: #1c1c1e; opacity: 0.7; font-weight: 500;">Años de Experiencia</p>
                    </div>
                    <div class="stat-item" style="text-align: center; flex: 1; min-width: 150px;">
                        <h3 class="stat-number" style="font-size: 2.5rem; font-weight: 700; color: #0e5e6f; margin-bottom: 0.5rem;">200+</h3>
                        <p class="stat-label" style="font-size: 0.9rem; color: #1c1c1e; opacity: 0.7; font-weight: 500;">Comunidades Beneficiadas</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Services Section -->
    <div class="services-section" id="servicios" style="background: white; padding: 80px 0;">
        <div class="container" style="max-width: 1200px; margin: 0 auto; padding: 0 20px; width: 100%;">
            <div class="section-header" style="text-align: center; margin-bottom: 4rem;">
                <p style="color: #0e5e6f; font-weight: 600; margin-bottom: 0.5rem;">Lo que Ofrecemos</p>
                <h2 style="font-size: 2.5rem; font-weight: 700; color: #1c1c1e; margin-bottom: 1rem;">Nuestros Servicios</h2>
                <p style="font-size: 1.25rem; color: #1c1c1e; opacity: 0.8; max-width: 600px; margin: 0 auto;">Nuestros servicios están diseñados para generar impacto real en las comunidades, combinando sabiduría ancestral con metodologías modernas.</p>
            </div>
            <div class="services-grid" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 2rem; margin-top: 4rem;">
                <div class="service-card" style="background: white; padding: 2.5rem; border-radius: 16px; box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1); text-align: center; transition: all 0.3s ease; border: 1px solid #f0f0f0;">
                    <div class="service-icon-wrapper" style="width: 80px; height: 80px; background: linear-gradient(135deg, #0e5e6f 0%, #7fb069 100%); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 1.5rem;">
                        <p class="service-icon" style="font-size: 2rem; color: white;">🏗️</p>
                    </div>
                    <h3 style="font-size: 1.5rem; font-weight: 700; color: #1c1c1e; margin-bottom: 1rem;">Desarrollo Territorial</h3>
                    <p style="color: #1c1c1e; opacity: 0.8; line-height: 1.6;">Planificación y ejecución de proyectos de desarrollo territorial sostenible que transforman comunidades y generan oportunidades de crecimiento.</p>
                </div>
                <div class="service-card" style="background: white; padding: 2.5rem; border-radius: 16px; box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1); text-align: center; transition: all 0.3s ease; border: 1px solid #f0f0f0;">
                    <div class="service-icon-wrapper" style="width: 80px; height: 80px; background: linear-gradient(135deg, #0e5e6f 0%, #7fb069 100%); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 1.5rem;">
                        <p class="service-icon" style="font-size: 2rem; color: white;">🌱</p>
                    </div>
                    <h3 style="font-size: 1.5rem; font-weight: 700; color: #1c1c1e; margin-bottom: 1rem;">Sostenibilidad Ambiental</h3>
                    <p style="color: #1c1c1e; opacity: 0.8; line-height: 1.6;">Implementación de prácticas ambientales responsables y sostenibles que protegen el medio ambiente mientras impulsan el desarrollo económico.</p>
                </div>
                <div class="service-card" style="background: white; padding: 2.5rem; border-radius: 16px; box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1); text-align: center; transition: all 0.3s ease; border: 1px solid #f0f0f0;">
                    <div class="service-icon-wrapper" style="width: 80px; height: 80px; background: linear-gradient(135deg, #0e5e6f 0%, #7fb069 100%); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 1.5rem;">
                        <p class="service-icon" style="font-size: 2rem; color: white;">🤝</p>
                    </div>
                    <h3 style="font-size: 1.5rem; font-weight: 700; color: #1c1c1e; margin-bottom: 1rem;">Participación Comunitaria</h3>
                    <p style="color: #1c1c1e; opacity: 0.8; line-height: 1.6;">Fortalecimiento del tejido social y participación ciudadana activa para construir comunidades más cohesionadas y resilientes.</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Contact Section -->
    <div class="contact-section" id="contacto" style="background: #0e5e6f; padding: 80px 0; color: white;">
        <div class="container" style="max-width: 1200px; margin: 0 auto; padding: 0 20px; width: 100%;">
            <div class="contact-content" style="text-align: center; max-width: 600px; margin: 0 auto;">
                <h2 style="font-size: 2.5rem; font-weight: 700; margin-bottom: 1.5rem; color: white;">¿Listo para Transformar tu Comunidad?</h2>
                <p style="font-size: 1.25rem; margin-bottom: 2.5rem; opacity: 0.9;">Contáctanos y descubre cómo podemos ayudarte a desarrollar tu territorio de manera sostenible.</p>
                <div class="contact-buttons" style="display: flex; gap: 1rem; justify-content: center; flex-wrap: wrap;">
                    <a href="mailto:info@sueñoandino.org" class="btn-primary" style="display: inline-block; padding: 1rem 2rem; border-radius: 8px; text-decoration: none; font-weight: 600; transition: all 0.3s ease; border: 2px solid transparent; background: white; color: #0e5e6f;">Contactar Ahora</a>
                    <a href="#" class="btn-secondary" onclick="alert('Descarga guía gratuita'); return false;" style="display: inline-block; padding: 1rem 2rem; border-radius: 8px; text-decoration: none; font-weight: 600; transition: all 0.3s ease; border: 2px solid white; background: transparent; color: white;">Descargar Guía</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="site-footer" style="background: #1c1c1e; color: white; padding: 60px 0 20px;">
        <div class="container" style="max-width: 1200px; margin: 0 auto; padding: 0 20px; width: 100%;">
            <div class="footer-content" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 2rem; margin-bottom: 2rem;">
                <div class="footer-section">
                    <h3 style="font-size: 1.25rem; font-weight: 700; margin-bottom: 1rem; color: white;">Sueño Andino</h3>
                    <p style="color: white; opacity: 0.8; line-height: 1.6;">Desarrollo territorial regenerativo desde y hacia Latinoamérica.</p>
                </div>
                <div class="footer-section">
                    <h3 style="font-size: 1.25rem; font-weight: 700; margin-bottom: 1rem; color: white;">Contacto</h3>
                    <p style="color: white; opacity: 0.8;">Lima, Perú</p>
                    <p style="color: white; opacity: 0.8;">+51-999-888-777</p>
                    <p style="color: white; opacity: 0.8;">info@sueñoandino.org</p>
                </div>
            </div>
            <div class="footer-bottom" style="text-align: center; padding-top: 2rem; border-top: 1px solid rgba(255, 255, 255, 0.1); opacity: 0.8;">
                <p>&copy; 2024 Sueño Andino. Todos los derechos reservados.</p>
            </div>
        </div>
    </footer>

    <script src="sueno-andino-tema/js/theme.js"></script>
    <script>
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
    </script>
</body>
</html>"""
    
    with open("sueño-andino-completo.html", 'w', encoding='utf-8') as f:
        f.write(html_content)
    
    print("Archivo HTML principal creado: sueño-andino-completo.html")
    
    # Iniciar servidor
    print("Iniciando servidor local...")
    print("El sitio estará disponible en: http://localhost:8080")
    
    try:
        # Iniciar servidor en segundo plano
        server_process = subprocess.Popen(
            ['python', '-m', 'http.server', '8080'],
            stdout=subprocess.PIPE,
            stderr=subprocess.PIPE
        )
        
        print("Servidor iniciado correctamente")
        print("Abre tu navegador en: http://localhost:8080/sueño-andino-completo.html")
        
        # Esperar un momento para que el servidor se inicie
        time.sleep(2)
        
        # Abrir navegador automáticamente
        try:
            webbrowser.open('http://localhost:8080/sueño-andino-completo.html')
            print("Navegador abierto automáticamente")
        except:
            print("No se pudo abrir el navegador automáticamente")
        
        print("\n" + "="*60)
        print("INSTALACION COMPLETADA")
        print("="*60)
        print("✅ Tema Sueño Andino instalado")
        print("✅ Servidor ejecutándose en puerto 8080")
        print("✅ Sitio disponible en: http://localhost:8080/sueño-andino-completo.html")
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
    instalar_tema_simple()
