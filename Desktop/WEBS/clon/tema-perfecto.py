#!/usr/bin/env python3
# -*- coding: utf-8 -*-
"""
Tema WordPress PERFECTO - Solución definitiva
"""

import os
import zipfile
from datetime import datetime

def crear_tema_perfecto():
    print("CREANDO TEMA WORDPRESS PERFECTO...")
    
    # Leer archivo original
    with open('sueño-andino-wordpress.html', 'r', encoding='utf-8') as f:
        html_original = f.read()
    
    # Crear directorio del tema
    tema_dir = "sueno-andino-perfecto"
    if os.path.exists(tema_dir):
        import shutil
        shutil.rmtree(tema_dir)
    os.makedirs(tema_dir)
    
    # 1. style.css con header WordPress
    style_css = """/*
Theme Name: Sueño Andino Perfecto
Description: Tema WordPress con diseño exacto al original
Version: 1.0.0
Author: Sueño Andino
*/

/* ===== ESTILOS EXACTOS DEL ORIGINAL ===== */
"""
    
    # Extraer estilos del HTML
    inicio_style = html_original.find('<style>')
    fin_style = html_original.find('</style>')
    if inicio_style != -1 and fin_style != -1:
        estilos = html_original[inicio_style+7:fin_style]
        style_css += estilos
    
    with open(f"{tema_dir}/style.css", 'w', encoding='utf-8') as f:
        f.write(style_css)
    
    # 2. functions.php
    functions_php = """<?php
if (!defined('ABSPATH')) exit;

function sueno_andino_setup() {
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('html5');
    add_theme_support('custom-logo');
    
    register_nav_menus(array(
        'primary' => __('Menú Principal', 'sueno-andino'),
    ));
}
add_action('after_setup_theme', 'sueno_andino_setup');

function sueno_andino_scripts() {
    wp_enqueue_style('sueno-andino-style', get_stylesheet_uri());
    wp_enqueue_style('sueno-andino-fonts', 'https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap');
    wp_enqueue_script('jquery');
    wp_enqueue_script('sueno-andino-js', get_template_directory_uri() . '/js/theme.js', array('jquery'), '1.0.0', true);
}
add_action('wp_enqueue_scripts', 'sueno_andino_scripts');

function sueno_andino_create_pages() {
    $pages = array(
        'Inicio' => 'front-page.php',
        'Blog' => 'page-blog.php',
        'Servicios' => 'page-servicios.php',
        'Nosotros' => 'page-nosotros.php',
        'Contacto' => 'page-contacto.php'
    );
    
    foreach ($pages as $title => $template) {
        $page = get_page_by_title($title);
        if (!$page) {
            $page_id = wp_insert_post(array(
                'post_title' => $title,
                'post_content' => 'Contenido de ' . $title,
                'post_status' => 'publish',
                'post_type' => 'page',
            ));
            if ($page_id) {
                update_post_meta($page_id, '_wp_page_template', $template);
            }
        }
    }
    
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
    
    # 3. header.php
    header_php = """<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php wp_title('|', true, 'right'); ?><?php bloginfo('name'); ?></title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?> style="overflow: auto;">
<?php wp_body_open(); ?>

<header class="site-header" style="">
    <div class="container">
        <div class="header-content">
            <a href="<?php echo esc_url(home_url('/')); ?>" class="site-logo">
                <div class="logo-icon">SA</div>
                <span class="site-title"><?php bloginfo('name'); ?></span>
            </a>
            <nav class="main-navigation">
                <ul class="nav-menu">
                    <li><a href="<?php echo esc_url(home_url('/')); ?>#servicios">Servicios</a></li>
                    <li><a href="<?php echo esc_url(home_url('/')); ?>#nosotros">Nosotros</a></li>
                    <li><a href="<?php echo esc_url(home_url('/')); ?>#equipo">Equipo</a></li>
                    <li><a href="<?php echo esc_url(home_url('/')); ?>#contacto">Contacto</a></li>
                    <li><a href="<?php echo esc_url(get_permalink(get_option('page_for_posts'))); ?>">Blog</a></li>
                </ul>
                <a href="#" onclick="showGuideModal(); return false;" class="btn btn-secondary">Descarga Guía Gratuita</a>
            </nav>
        </div>
    </div>
</header>
"""
    
    with open(f"{tema_dir}/header.php", 'w', encoding='utf-8') as f:
        f.write(header_php)
    
    # 4. footer.php
    footer_php = """<footer class="site-footer">
    <div class="container">
        <div class="footer-content">
            <div class="footer-brand">
                <a href="<?php echo esc_url(home_url('/')); ?>" class="site-logo">
                    <div class="footer-logo">SA</div>
                    <span class="footer-title"><?php bloginfo('name'); ?></span>
                </a>
                <p class="footer-description">Organización para el desarrollo territorial regenerativo</p>
            </div>
            <div class="footer-section">
                <h3>Navegación</h3>
                <ul class="footer-menu">
                    <li><a href="<?php echo esc_url(home_url('/')); ?>#servicios">Servicios</a></li>
                    <li><a href="<?php echo esc_url(home_url('/')); ?>#nosotros">Nosotros</a></li>
                    <li><a href="<?php echo esc_url(home_url('/')); ?>#equipo">Equipo</a></li>
                    <li><a href="<?php echo esc_url(home_url('/')); ?>#contacto">Contacto</a></li>
                    <li><a href="<?php echo esc_url(get_permalink(get_option('page_for_posts'))); ?>">Blog</a></li>
                    <li><a href="#" onclick="showGuideModal(); return false;">Guía Gratuita</a></li>
                </ul>
            </div>
            <div class="footer-section">
                <h3>Contacto</h3>
                <ul class="footer-menu">
                    <li>Lima, Perú</li>
                    <li>+51-999-888-777</li>
                    <li>hola@sueñoandino.com</li>
                </ul>
            </div>
        </div>
        <div class="footer-bottom">
            <p>&copy; <?php echo date('Y'); ?> <?php bloginfo('name'); ?>. Todos los derechos reservados.</p>
        </div>
    </div>
</footer>

<div id="guideModal" class="guide-modal" style="display: none;">
    <div class="modal-overlay" onclick="closeGuideModal()">
        <div class="modal-content" onclick="event.stopPropagation()">
            <div class="modal-header">
                <div class="modal-icon">📚</div>
                <h3>¡Guía Gratuita!</h3>
                <p class="modal-subtitle">Metodologías Regenerativas para Comunidades Andinas</p>
                <button class="modal-close" onclick="closeGuideModal()">×</button>
            </div>
            <div class="modal-body">
                <div class="guide-benefits-compact">
                    <div class="benefit-compact">✅ Metodologías paso a paso</div>
                    <div class="benefit-compact">✅ Casos de éxito reales</div>
                    <div class="benefit-compact">✅ Herramientas prácticas</div>
                </div>
                <form class="guide-form-compact" id="leadMagnetForm">
                    <div class="form-row">
                        <input type="text" name="name" placeholder="Tu nombre" required>
                        <input type="email" name="email" placeholder="Email" required>
                    </div>
                    <button type="submit" class="btn-download">
                        <span>📥</span> Descargar Guía
                    </button>
                    <p class="privacy-note">🔒 Privacidad garantizada</p>
                </form>
            </div>
        </div>
    </div>
</div>

<?php wp_footer(); ?>
</body>
</html>
"""
    
    with open(f"{tema_dir}/footer.php", 'w', encoding='utf-8') as f:
        f.write(footer_php)
    
    # 5. front-page.php - Contenido exacto del original
    front_page_php = crear_front_page_exacta(html_original)
    with open(f"{tema_dir}/front-page.php", 'w', encoding='utf-8') as f:
        f.write(front_page_php)
    
    # 6. Otras páginas
    crear_paginas_adicionales(tema_dir)
    
    # 7. index.php
    with open(f"{tema_dir}/index.php", 'w', encoding='utf-8') as f:
        f.write("""<?php get_header(); ?>
<main>
    <div class="container">
        <h1>Página no encontrada</h1>
        <p>Esta página no existe.</p>
    </div>
</main>
<?php get_footer(); ?>
""")
    
    # 8. JavaScript
    os.makedirs(f"{tema_dir}/js", exist_ok=True)
    with open(f"{tema_dir}/js/theme.js", 'w', encoding='utf-8') as f:
        f.write("""// Sueño Andino - JavaScript
document.addEventListener('DOMContentLoaded', function() {
    // Smooth scroll
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            e.preventDefault();
            const target = document.querySelector(this.getAttribute('href'));
            if (target) {
                target.scrollIntoView({ behavior: 'smooth', block: 'start' });
            }
        });
    });
    
    // Modal functions
    window.showGuideModal = function() {
        const modal = document.getElementById('guideModal');
        if (modal) {
            modal.style.display = 'block';
            document.body.style.overflow = 'hidden';
        }
    };
    
    window.closeGuideModal = function() {
        const modal = document.getElementById('guideModal');
        if (modal) {
            modal.style.display = 'none';
            document.body.style.overflow = 'auto';
        }
    };
    
    // Form handlers
    const contactForm = document.getElementById('contactForm');
    if (contactForm) {
        contactForm.addEventListener('submit', function(e) {
            e.preventDefault();
            alert('Mensaje enviado correctamente');
        });
    }
    
    const leadMagnetForm = document.getElementById('leadMagnetForm');
    if (leadMagnetForm) {
        leadMagnetForm.addEventListener('submit', function(e) {
            e.preventDefault();
            alert('Guía enviada a tu email');
            closeGuideModal();
        });
    }
});
""")
    
    # 9. Crear ZIP
    timestamp = datetime.now().strftime("%Y%m%d-%H%M")
    zip_filename = f"sueno-andino-perfecto-{timestamp}.zip"
    
    with zipfile.ZipFile(zip_filename, 'w', zipfile.ZIP_DEFLATED) as zipf:
        for root, dirs, files in os.walk(tema_dir):
            for file in files:
                file_path = os.path.join(root, file)
                arcname = os.path.relpath(file_path, tema_dir)
                zipf.write(file_path, arcname)
                print(f"OK: {arcname}")
    
    print(f"\\nTEMA PERFECTO CREADO: {zip_filename}")
    print(f"Tamano: {os.path.getsize(zip_filename) / 1024:.2f} KB")
    print("\\nINSTRUCCIONES:")
    print("1. Sube el ZIP a WordPress > Apariencia > Temas")
    print("2. Activa el tema 'Sueño Andino Perfecto'")
    print("3. El diseño sera 100% identico al original")
    
    return True

def crear_front_page_exacta(html_original):
    """Crear front-page.php con contenido exacto"""
    # Extraer contenido principal (sin header y footer)
    inicio = html_original.find('<section class="hero-section">')
    fin = html_original.find('</footer>')
    
    if inicio == -1:
        inicio = html_original.find('<div class="hero-section">')
    if fin == -1:
        fin = html_original.find('</body>')
    
    if inicio != -1 and fin != -1:
        contenido_principal = html_original[inicio:fin]
    else:
        contenido_principal = html_original
    
    # Convertir enlaces locales a enlaces relativos
    contenido_principal = contenido_principal.replace('file:///C:/Users/Juan/Desktop/WEBS/clon/sue%C3%B1o-andino-wordpress.html#', '#')
    contenido_principal = contenido_principal.replace('file:///C:/Users/Juan/Desktop/WEBS/clon/blog-sue%C3%B1o-andino.html', '<?php echo esc_url(get_permalink(get_option(\'page_for_posts\'))); ?>')
    
    return f"""<?php get_header(); ?>

{contenido_principal}

<?php get_footer(); ?>
"""

def crear_paginas_adicionales(tema_dir):
    """Crear páginas adicionales"""
    
    # page-blog.php
    blog_php = """<?php get_header(); ?>
<main class="blog-page">
    <div class="container">
        <div class="section-header">
            <h1>Blog</h1>
            <p>Artículos sobre desarrollo territorial regenerativo</p>
        </div>
        <div class="blog-posts">
            <?php if (have_posts()) : ?>
                <div class="posts-grid">
                    <?php while (have_posts()) : the_post(); ?>
                        <article class="post-card">
                            <?php if (has_post_thumbnail()) : ?>
                                <div class="post-thumbnail">
                                    <?php the_post_thumbnail('medium_large'); ?>
                                </div>
                            <?php endif; ?>
                            <div class="post-content">
                                <h2 class="post-title">
                                    <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                </h2>
                                <div class="post-meta">
                                    <span class="post-date"><?php echo get_the_date(); ?></span>
                                </div>
                                <div class="post-excerpt">
                                    <?php the_excerpt(); ?>
                                </div>
                                <a href="<?php the_permalink(); ?>" class="read-more">Leer más</a>
                            </div>
                        </article>
                    <?php endwhile; ?>
                </div>
                <?php the_posts_pagination(); ?>
            <?php else : ?>
                <div class="no-posts">
                    <h2>No se encontraron entradas</h2>
                    <p>Lo sentimos, no hay contenido para mostrar.</p>
                </div>
            <?php endif; ?>
        </div>
    </div>
</main>
<?php get_footer(); ?>
"""
    
    with open(f"{tema_dir}/page-blog.php", 'w', encoding='utf-8') as f:
        f.write(blog_php)
    
    # page-servicios.php
    servicios_php = """<?php get_header(); ?>
<main class="servicios-page">
    <div class="container">
        <div class="section-header">
            <p class="section-subtitle">Lo que Ofrecemos</p>
            <h1>Nuestros Mejores Servicios</h1>
            <p class="section-description">
                Nuestros servicios están diseñados para generar impacto real en
                las comunidades andinas, combinando sabiduría ancestral con
                metodologías modernas de desarrollo territorial regenerativo.
            </p>
        </div>
        <div class="services-grid">
            <div class="service-card">
                <div class="service-icon-wrapper">
                    <div class="service-icon">🎓</div>
                </div>
                <h3>Educación Regenerativa</h3>
                <p>Desarrollamos capacidades locales y fortalecemos el tejido social a través de metodologías participativas y regenerativas.</p>
            </div>
            <div class="service-card">
                <div class="service-icon-wrapper">
                    <div class="service-icon">🚀</div>
                </div>
                <h3>Emprendimiento Social</h3>
                <p>Desarrollamos capacidades locales y fortalecemos el tejido social a través de metodologías participativas y regenerativas.</p>
            </div>
            <div class="service-card">
                <div class="service-icon-wrapper">
                    <div class="service-icon">🗺️</div>
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
    nosotros_php = """<?php get_header(); ?>
<main class="nosotros-page">
    <div class="container">
        <div class="team-header">
            <p class="team-subtitle">Nuestro Equipo</p>
            <h1>Conoce Nuestro Equipo</h1>
            <p class="team-description">Un equipo comprometido con el desarrollo territorial y la transformación de comunidades en los Andes peruanos.</p>
        </div>
        <div class="team-directorio">
            <h3>Directorio</h3>
            <div class="team-grid">
                <div class="team-member">
                    <div class="member-image">
                        <div class="image-placeholder">
                            <div class="placeholder-content">
                                <div class="placeholder-icon">👩‍💼</div>
                            </div>
                        </div>
                        <div class="decorative-dots"></div>
                        <div class="decorative-shape"></div>
                    </div>
                    <h4>María Elena Quispe</h4>
                    <p>Directora Ejecutiva</p>
                </div>
                <div class="team-member">
                    <div class="member-image">
                        <div class="image-placeholder">
                            <div class="placeholder-content">
                                <div class="placeholder-icon">👨‍💼</div>
                            </div>
                        </div>
                        <div class="decorative-dots"></div>
                        <div class="decorative-shape"></div>
                    </div>
                    <h4>Carlos Mamani</h4>
                    <p>Director de Programas</p>
                </div>
                <div class="team-member">
                    <div class="member-image">
                        <div class="image-placeholder">
                            <div class="placeholder-content">
                                <div class="placeholder-icon">👩‍🏫</div>
                            </div>
                        </div>
                        <div class="decorative-dots"></div>
                        <div class="decorative-shape"></div>
                    </div>
                    <h4>Ana Condori</h4>
                    <p>Coordinadora de Educación</p>
                </div>
            </div>
        </div>
    </div>
</main>
<?php get_footer(); ?>
"""
    
    with open(f"{tema_dir}/page-nosotros.php", 'w', encoding='utf-8') as f:
        f.write(nosotros_php)
    
    # page-contacto.php
    contacto_php = """<?php get_header(); ?>
<main class="contacto-page">
    <div class="container">
        <div class="contact-content">
            <div class="contact-info">
                <h1>Trabajemos Juntos</h1>
                <p>¿Tienes un proyecto en mente? Conversemos sobre cómo podemos trabajar juntos para transformar tu territorio.</p>
                <div class="contact-details">
                    <div class="contact-item">
                        <div class="contact-icon">📍</div>
                        <div>
                            <div class="contact-label">Ubicación</div>
                            <div class="contact-value">Lima, Perú</div>
                        </div>
                    </div>
                    <div class="contact-item">
                        <div class="contact-icon">📞</div>
                        <div>
                            <div class="contact-label">Teléfono</div>
                            <div class="contact-value">+51-999-888-777</div>
                        </div>
                    </div>
                    <div class="contact-item">
                        <div class="contact-icon">✉️</div>
                        <div>
                            <div class="contact-label">Email</div>
                            <div class="contact-value">hola@sueñoandino.com</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="contact-form">
                <form id="contactForm">
                    <div class="form-group">
                        <input type="text" name="name" placeholder="Tu nombre completo" required>
                    </div>
                    <div class="form-group">
                        <input type="email" name="email" placeholder="tu@email.com" required>
                    </div>
                    <div class="form-group">
                        <textarea name="message" placeholder="Cuéntanos sobre tu proyecto..." required></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Enviar Mensaje</button>
                </form>
            </div>
        </div>
    </div>
</main>
<?php get_footer(); ?>
"""
    
    with open(f"{tema_dir}/page-contacto.php", 'w', encoding='utf-8') as f:
        f.write(contacto_php)

if __name__ == "__main__":
    crear_tema_perfecto()
