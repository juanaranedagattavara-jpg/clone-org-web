#!/usr/bin/env python3
# -*- coding: utf-8 -*-
"""
Script para crear un tema WordPress FIEL al diseño original
Sin Gutenberg, sin complicaciones - solo el diseño exacto
"""

import os
import zipfile
from datetime import datetime

def crear_tema_fiel():
    print("=" * 60)
    print("CREADOR DE TEMA WORDPRESS FIEL AL DISEÑO ORIGINAL")
    print("=" * 60)
    
    # Leer el archivo original completo
    try:
        with open('sueño-andino-wordpress.html', 'r', encoding='utf-8') as f:
            contenido_original = f.read()
        print("OK: Archivo original leido correctamente")
    except FileNotFoundError:
        print("ERROR: No se encontro el archivo sueno-andino-wordpress.html")
        return False
    
    # Crear estructura del tema
    tema_dir = "sueno-andino-tema-fiel"
    if os.path.exists(tema_dir):
        import shutil
        shutil.rmtree(tema_dir)
    os.makedirs(tema_dir)
    
    # 1. style.css (información del tema)
    style_css = """/*
Theme Name: Sueño Andino - Diseño Fiel
Description: Tema fiel al diseño original HTML sin modificaciones
Version: 1.0.0
Author: Sueño Andino
Text Domain: sueno-andino
*/

/* Importar estilos del archivo original */
@import url('styles.css');
"""
    
    with open(f"{tema_dir}/style.css", 'w', encoding='utf-8') as f:
        f.write(style_css)
    
    # 2. functions.php (mínimo)
    functions_php = """<?php
/**
 * Sueño Andino Theme - Diseño Fiel
 */

// Evitar acceso directo
if (!defined('ABSPATH')) {
    exit;
}

// Configuración básica del tema
function sueno_andino_setup() {
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('html5', array(
        'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption',
    ));
}
add_action('after_setup_theme', 'sueno_andino_setup');

// Encolar estilos y scripts
function sueno_andino_scripts() {
    wp_enqueue_style('sueno-andino-style', get_stylesheet_uri());
    wp_enqueue_style('sueno-andino-fonts', 'https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap');
    wp_enqueue_script('sueno-andino-js', get_template_directory_uri() . '/js/theme.js', array('jquery'), '1.0.0', true);
}
add_action('wp_enqueue_scripts', 'sueno_andino_scripts');

// Crear páginas automáticamente
function sueno_andino_create_pages() {
    $pages = array(
        'Inicio' => array(
            'content' => '<!-- Contenido de la página de inicio -->',
            'template' => 'front-page.php'
        ),
        'Blog' => array(
            'content' => 'Contenido del blog',
            'template' => 'page-blog.php'
        ),
        'Servicios' => array(
            'content' => 'Nuestros servicios',
            'template' => 'page-servicios.php'
        ),
        'Nosotros' => array(
            'content' => 'Conoce nuestro equipo',
            'template' => 'page-nosotros.php'
        ),
        'Contacto' => array(
            'content' => 'Ponte en contacto',
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
}
add_action('after_switch_theme', 'sueno_andino_create_pages');
?>
"""
    
    with open(f"{tema_dir}/functions.php", 'w', encoding='utf-8') as f:
        f.write(functions_php)
    
    # 3. header.php (extraer del HTML original)
    header_html = extraer_header(contenido_original)
    with open(f"{tema_dir}/header.php", 'w', encoding='utf-8') as f:
        f.write(header_html)
    
    # 4. footer.php (extraer del HTML original)
    footer_html = extraer_footer(contenido_original)
    with open(f"{tema_dir}/footer.php", 'w', encoding='utf-8') as f:
        f.write(footer_html)
    
    # 5. front-page.php (página principal con contenido completo)
    front_page_php = crear_front_page(contenido_original)
    with open(f"{tema_dir}/front-page.php", 'w', encoding='utf-8') as f:
        f.write(front_page_php)
    
    # 6. index.php (básico)
    index_php = """<?php get_header(); ?>
<main>
    <div class="container">
        <h1>Página no encontrada</h1>
        <p>Esta página no existe.</p>
    </div>
</main>
<?php get_footer(); ?>
"""
    
    with open(f"{tema_dir}/index.php", 'w', encoding='utf-8') as f:
        f.write(index_php)
    
    # 7. Páginas adicionales
    crear_paginas_adicionales(tema_dir, contenido_original)
    
    # 8. Archivos CSS y JS
    extraer_css_js(tema_dir, contenido_original)
    
    # 9. Crear ZIP
    crear_zip_tema(tema_dir)
    
    print("\\nTEMA FIEL CREADO EXITOSAMENTE!")
    print("Este tema mantiene EXACTAMENTE el diseño original")
    print("Sin Gutenberg, sin complicaciones")
    
    return True

def extraer_header(contenido):
    """Extraer header del HTML original"""
    inicio = contenido.find('<header')
    fin = contenido.find('</header>') + 9
    
    if inicio != -1 and fin != -1:
        header_html = contenido[inicio:fin]
        # Convertir a PHP
        header_php = f"""<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php wp_title('|', true, 'right'); ?><?php bloginfo('name'); ?></title>
    <link rel="profile" href="https://gmpg.org/xfn/11">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

{header_html}
"""
        return header_php
    
    return """<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php wp_title('|', true, 'right'); ?><?php bloginfo('name'); ?></title>
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<header class="site-header">
    <div class="container">
        <div class="header-content">
            <div class="site-branding">
                <a href="<?php echo esc_url(home_url('/')); ?>" rel="home">
                    <h1 class="site-title"><?php bloginfo('name'); ?></h1>
                </a>
            </div>
        </div>
    </div>
</header>
"""

def extraer_footer(contenido):
    """Extraer footer del HTML original"""
    inicio = contenido.find('<footer')
    fin = contenido.find('</footer>') + 9
    
    if inicio != -1 and fin != -1:
        footer_html = contenido[inicio:fin]
        # Convertir a PHP
        footer_php = f"""{footer_html}
<?php wp_footer(); ?>
</body>
</html>
"""
        return footer_php
    
    return """<footer class="site-footer">
    <div class="container">
        <div class="footer-content">
            <div class="footer-section">
                <h3><?php bloginfo('name'); ?></h3>
                <p><?php bloginfo('description'); ?></p>
            </div>
        </div>
        <div class="footer-bottom">
            <p>&copy; <?php echo date('Y'); ?> <?php bloginfo('name'); ?>. Todos los derechos reservados.</p>
        </div>
    </div>
</footer>
<?php wp_footer(); ?>
</body>
</html>
"""

def crear_front_page(contenido):
    """Crear front-page.php con el contenido completo"""
    # Extraer el contenido principal (sin header y footer)
    inicio = contenido.find('<main') if '<main' in contenido else contenido.find('<section')
    fin = contenido.find('</main>') if '</main>' in contenido else contenido.find('</footer>')
    
    if inicio == -1:
        inicio = contenido.find('<div class="hero-section"')
    if fin == -1:
        fin = contenido.find('</body>')
    
    if inicio != -1 and fin != -1:
        contenido_principal = contenido[inicio:fin]
    else:
        contenido_principal = contenido
    
    # Crear PHP
    front_page_php = f"""<?php
/**
 * Front page template - Diseño fiel al original
 */
get_header(); ?>

{contenido_principal}

<?php get_footer(); ?>
"""
    
    return front_page_php

def crear_paginas_adicionales(tema_dir, contenido):
    """Crear páginas adicionales"""
    
    # page-blog.php
    blog_php = """<?php
/**
 * Blog page template
 */
get_header(); ?>

<main class="blog-page">
    <div class="container">
        <h1>Blog</h1>
        <div class="blog-posts">
            <?php if (have_posts()) : ?>
                <?php while (have_posts()) : the_post(); ?>
                    <article class="post-card">
                        <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                        <div class="post-meta">
                            <span><?php echo get_the_date(); ?></span>
                        </div>
                        <div class="post-excerpt">
                            <?php the_excerpt(); ?>
                        </div>
                    </article>
                <?php endwhile; ?>
            <?php else : ?>
                <p>No hay entradas disponibles.</p>
            <?php endif; ?>
        </div>
    </div>
</main>

<?php get_footer(); ?>
"""
    
    with open(f"{tema_dir}/page-blog.php", 'w', encoding='utf-8') as f:
        f.write(blog_php)
    
    # page-servicios.php
    servicios_php = """<?php
/**
 * Servicios page template
 */
get_header(); ?>

<main class="servicios-page">
    <div class="container">
        <h1>Nuestros Servicios</h1>
        <div class="services-grid">
            <div class="service-card">
                <div class="service-icon-wrapper">
                    <span class="service-icon">🎓</span>
                </div>
                <h3>Educación Regenerativa</h3>
                <p>Desarrollamos capacidades locales y fortalecemos el tejido social a través de metodologías participativas y regenerativas.</p>
            </div>
            <div class="service-card">
                <div class="service-icon-wrapper">
                    <span class="service-icon">🚀</span>
                </div>
                <h3>Emprendimiento Social</h3>
                <p>Desarrollamos capacidades locales y fortalecemos el tejido social a través de metodologías participativas y regenerativas.</p>
            </div>
            <div class="service-card">
                <div class="service-icon-wrapper">
                    <span class="service-icon">🗺️</span>
                </div>
                <h3>Consultoría Territorial</h3>
                <p>Desarrollamos capacidades locales y fortalecemos el tejido social a través de metodologías participativas y regenerativas.</p>
            </div>
        </div>
    </div>
</main>

<?php get_footer(); ?>
"""
    
    with open(f"{tema_dir}/page-servicios.php", 'w', encoding='utf-8') as f:
        f.write(servicios_php)
    
    # page-nosotros.php
    nosotros_php = """<?php
/**
 * Nosotros page template
 */
get_header(); ?>

<main class="nosotros-page">
    <div class="container">
        <h1>Conoce Nuestro Equipo</h1>
        <div class="team-grid">
            <div class="team-member">
                <div class="member-image">
                    <div class="image-placeholder">👩‍💼</div>
                </div>
                <h4>María Elena Quispe</h4>
                <p>Directora Ejecutiva</p>
            </div>
            <div class="team-member">
                <div class="member-image">
                    <div class="image-placeholder">👨‍💼</div>
                </div>
                <h4>Carlos Mamani</h4>
                <p>Director de Programas</p>
            </div>
            <div class="team-member">
                <div class="member-image">
                    <div class="image-placeholder">👩‍🏫</div>
                </div>
                <h4>Ana Condori</h4>
                <p>Coordinadora de Educación</p>
            </div>
        </div>
    </div>
</main>

<?php get_footer(); ?>
"""
    
    with open(f"{tema_dir}/page-nosotros.php", 'w', encoding='utf-8') as f:
        f.write(nosotros_php)
    
    # page-contacto.php
    contacto_php = """<?php
/**
 * Contacto page template
 */
get_header(); ?>

<main class="contacto-page">
    <div class="container">
        <h1>Trabajemos Juntos</h1>
        <p>¿Tienes un proyecto en mente? Conversemos sobre cómo podemos trabajar juntos para transformar tu territorio.</p>
        
        <div class="contact-info">
            <p>📍 Ubicación Lima, Perú</p>
            <p>📞 Teléfono +51-999-888-777</p>
            <p>✉️ Email hola@sueñoandino.com</p>
        </div>
        
        <form class="contact-form">
            <input type="text" name="nombre" placeholder="Tu nombre completo" required>
            <input type="email" name="email" placeholder="tu@email.com" required>
            <textarea name="mensaje" placeholder="Cuéntanos sobre tu proyecto..." required></textarea>
            <button type="submit">Enviar Mensaje</button>
        </form>
    </div>
</main>

<?php get_footer(); ?>
"""
    
    with open(f"{tema_dir}/page-contacto.php", 'w', encoding='utf-8') as f:
        f.write(contacto_php)

def extraer_css_js(tema_dir, contenido):
    """Extraer CSS y JS del HTML original"""
    
    # Crear directorio js
    os.makedirs(f"{tema_dir}/js", exist_ok=True)
    
    # Extraer CSS
    css_inicio = contenido.find('<style>')
    css_fin = contenido.find('</style>')
    
    if css_inicio != -1 and css_fin != -1:
        css_content = contenido[css_inicio+7:css_fin]
    else:
        # CSS básico si no se encuentra
        css_content = """/* Sueño Andino - Estilos Básicos */
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
}

.container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 0 20px;
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

.site-title {
    font-size: 1.5rem;
    font-weight: 700;
    color: var(--sa-primary);
    margin: 0;
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

.footer-bottom {
    text-align: center;
    padding-top: 2rem;
    border-top: 1px solid rgba(255, 255, 255, 0.1);
    opacity: 0.8;
}
"""
    
    with open(f"{tema_dir}/styles.css", 'w', encoding='utf-8') as f:
        f.write(css_content)
    
    # Extraer JS
    js_inicio = contenido.find('<script>')
    js_fin = contenido.find('</script>')
    
    if js_inicio != -1 and js_fin != -1:
        js_content = contenido[js_inicio+8:js_fin]
    else:
        # JS básico si no se encuentra
        js_content = """// Sueño Andino - JavaScript Básico
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
});
"""
    
    with open(f"{tema_dir}/js/theme.js", 'w', encoding='utf-8') as f:
        f.write(js_content)

def crear_zip_tema(tema_dir):
    """Crear ZIP del tema"""
    timestamp = datetime.now().strftime("%Y%m%d-%H%M")
    zip_filename = f"sueno-andino-tema-fiel-{timestamp}.zip"
    
    with zipfile.ZipFile(zip_filename, 'w', zipfile.ZIP_DEFLATED) as zipf:
        for root, dirs, files in os.walk(tema_dir):
            for file in files:
                file_path = os.path.join(root, file)
                arcname = os.path.relpath(file_path, tema_dir)
                zipf.write(file_path, arcname)
                print(f"  OK: {arcname}")
    
    print(f"\\nZIP creado: {zip_filename}")
    print(f"Tamaño: {os.path.getsize(zip_filename) / 1024:.2f} KB")
    
    print("\\nINSTRUCCIONES:")
    print("1. Sube el ZIP a WordPress > Apariencia > Temas")
    print("2. Activa el tema 'Sueño Andino - Diseño Fiel'")
    print("3. El diseño se mantendrá EXACTAMENTE igual al original")

if __name__ == "__main__":
    crear_tema_fiel()
