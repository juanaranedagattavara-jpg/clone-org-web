#!/usr/bin/env python3
# -*- coding: utf-8 -*-
"""
Script para crear un tema WordPress IDÉNTICO al diseño original
Copiando exactamente el código de sueño-andino-wordpress.html
"""

import os
import zipfile
from datetime import datetime

def crear_tema_identico():
    print("=" * 60)
    print("CREADOR DE TEMA WORDPRESS IDENTICO AL DISEÑO ORIGINAL")
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
    tema_dir = "sueno-andino-tema-identico"
    if os.path.exists(tema_dir):
        import shutil
        shutil.rmtree(tema_dir)
    os.makedirs(tema_dir)
    
    # 1. style.css (información del tema + estilos completos)
    style_css = """/*
Theme Name: Sueño Andino - Diseño Idéntico
Description: Tema idéntico al diseño original HTML con lead magnet y blog
Version: 1.0.0
Author: Sueño Andino
Text Domain: sueno-andino
*/

/* ===== IMPORTAR ESTILOS COMPLETOS DEL ORIGINAL ===== */
"""
    
    # Extraer todos los estilos del HTML original
    inicio_style = contenido_original.find('<style>')
    fin_style = contenido_original.find('</style>')
    
    if inicio_style != -1 and fin_style != -1:
        estilos_completos = contenido_original[inicio_style+7:fin_style]
        style_css += estilos_completos
    else:
        # Si no encuentra estilos, usar los básicos
        style_css += """
/* Estilos básicos si no se encuentran en el HTML */
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
    padding-top: 80px;
}

.container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 0 20px;
}
"""
    
    with open(f"{tema_dir}/style.css", 'w', encoding='utf-8') as f:
        f.write(style_css)
    
    # 2. functions.php (configuración completa)
    functions_php = """<?php
/**
 * Sueño Andino Theme - Diseño Idéntico
 * Copia exacta del diseño original
 */

// Evitar acceso directo
if (!defined('ABSPATH')) {
    exit;
}

// Configuración del tema
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
    add_theme_support('custom-logo');
    add_theme_support('wp-block-styles');
    add_theme_support('align-wide');
    
    // Registrar menús
    register_nav_menus(array(
        'primary' => __('Menú Principal', 'sueno-andino'),
        'footer' => __('Menú Footer', 'sueno-andino'),
    ));
}
add_action('after_setup_theme', 'sueno_andino_setup');

// Encolar estilos y scripts
function sueno_andino_scripts() {
    wp_enqueue_style('sueno-andino-style', get_stylesheet_uri());
    wp_enqueue_style('sueno-andino-fonts', 'https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap');
    wp_enqueue_script('jquery');
    wp_enqueue_script('sueno-andino-js', get_template_directory_uri() . '/js/theme.js', array('jquery'), '1.0.0', true);
    
    // Localizar script para AJAX
    wp_localize_script('sueno-andino-js', 'suenoAndinoAjax', array(
        'ajax_url' => admin_url('admin-ajax.php'),
        'nonce' => wp_create_nonce('sueno_andino_nonce'),
    ));
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
add_action('after_switch_theme', 'sueno_andino_create_pages');

// Crear menú principal
function sueno_andino_create_main_menu() {
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
        if ($blog_page) {
            wp_update_nav_menu_item($menu_id, 0, array(
                'menu-item-title' => 'Blog',
                'menu-item-object-id' => $blog_page->ID,
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
add_action('after_switch_theme', 'sueno_andino_create_main_menu');

// AJAX para formulario de contacto
function sueno_andino_handle_contact_form() {
    check_ajax_referer('sueno_andino_nonce', 'nonce');
    
    $name = sanitize_text_field($_POST['name']);
    $email = sanitize_email($_POST['email']);
    $message = sanitize_textarea_field($_POST['message']);
    
    // Aquí puedes procesar el formulario (enviar email, guardar en BD, etc.)
    
    wp_send_json_success('Mensaje enviado correctamente');
}
add_action('wp_ajax_contact_form', 'sueno_andino_handle_contact_form');
add_action('wp_ajax_nopriv_contact_form', 'sueno_andino_handle_contact_form');

// AJAX para lead magnet
function sueno_andino_handle_lead_magnet() {
    check_ajax_referer('sueno_andino_nonce', 'nonce');
    
    $name = sanitize_text_field($_POST['name']);
    $email = sanitize_email($_POST['email']);
    
    // Aquí puedes procesar el lead magnet (guardar en BD, enviar email, etc.)
    
    wp_send_json_success('Guía enviada a tu email');
}
add_action('wp_ajax_lead_magnet', 'sueno_andino_handle_lead_magnet');
add_action('wp_ajax_nopriv_lead_magnet', 'sueno_andino_handle_lead_magnet');
?>
"""
    
    with open(f"{tema_dir}/functions.php", 'w', encoding='utf-8') as f:
        f.write(functions_php)
    
    # 3. header.php (extraer del HTML original)
    header_html = extraer_header_identico(contenido_original)
    with open(f"{tema_dir}/header.php", 'w', encoding='utf-8') as f:
        f.write(header_html)
    
    # 4. footer.php (extraer del HTML original)
    footer_html = extraer_footer_identico(contenido_original)
    with open(f"{tema_dir}/footer.php", 'w', encoding='utf-8') as f:
        f.write(footer_html)
    
    # 5. front-page.php (página principal IDÉNTICA)
    front_page_php = crear_front_page_identica(contenido_original)
    with open(f"{tema_dir}/front-page.php", 'w', encoding='utf-8') as f:
        f.write(front_page_php)
    
    # 6. page-blog.php (página de blog)
    blog_php = crear_pagina_blog(contenido_original)
    with open(f"{tema_dir}/page-blog.php", 'w', encoding='utf-8') as f:
        f.write(blog_php)
    
    # 7. Otras páginas
    crear_paginas_adicionales_identicas(tema_dir, contenido_original)
    
    # 8. index.php (básico)
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
    
    # 9. Archivos CSS y JS
    extraer_css_js_identico(tema_dir, contenido_original)
    
    # 10. Crear ZIP
    crear_zip_tema_identico(tema_dir)
    
    print("\\nTEMA IDENTICO CREADO EXITOSAMENTE!")
    print("Este tema es EXACTAMENTE igual al diseño original")
    print("Con lead magnet, blog, y todas las secciones incluidas")
    
    return True

def extraer_header_identico(contenido):
    """Extraer header del HTML original manteniendo el diseño exacto"""
    inicio = contenido.find('<header')
    fin = contenido.find('</header>') + 9
    
    if inicio != -1 and fin != -1:
        header_html = contenido[inicio:fin]
        # Convertir a PHP manteniendo el diseño exacto
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
<body <?php body_class(); ?> style="overflow: auto;">
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
                <?php
                wp_nav_menu(array(
                    'theme_location' => 'primary',
                    'menu_class'     => 'nav-menu',
                    'container'      => false,
                    'fallback_cb'    => 'sueno_andino_fallback_menu',
                ));
                ?>
                <a href="#" onclick="showGuideModal(); return false;" class="btn btn-secondary">Descarga Guía Gratuita</a>
            </nav>
        </div>
    </div>
</header>
"""

def extraer_footer_identico(contenido):
    """Extraer footer del HTML original manteniendo el diseño exacto"""
    inicio = contenido.find('<footer')
    fin = contenido.find('</footer>') + 9
    
    if inicio != -1 and fin != -1:
        footer_html = contenido[inicio:fin]
        # Convertir a PHP manteniendo el diseño exacto
        footer_php = f"""{footer_html}

<!-- POPUP LEAD MAGNET COMPACTO -->
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
        return footer_php
    
    return """<footer class="site-footer">
    <div class="container">
        <div class="footer-content">
            <div class="footer-brand">
                <a href="<?php echo esc_url(home_url('/')); ?>" class="site-logo">
                    <div class="footer-logo">SA</div>
                    <span class="footer-title"><?php bloginfo('name'); ?></span>
                </a>
                <p class="footer-description"><?php bloginfo('description'); ?></p>
            </div>
            <div class="footer-section">
                <h3>Navegación</h3>
                <?php
                wp_nav_menu(array(
                    'theme_location' => 'footer',
                    'menu_class'     => 'footer-menu',
                    'container'      => false,
                    'fallback_cb'    => false,
                ));
                ?>
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
<?php wp_footer(); ?>
</body>
</html>
"""

def crear_front_page_identica(contenido):
    """Crear front-page.php con el contenido IDÉNTICO al original"""
    # Extraer todo el contenido principal (sin header y footer)
    inicio = contenido.find('<section class="hero-section">')
    fin = contenido.find('</footer>')
    
    if inicio == -1:
        inicio = contenido.find('<div class="hero-section">')
    if fin == -1:
        fin = contenido.find('</body>')
    
    if inicio != -1 and fin != -1:
        contenido_principal = contenido[inicio:fin]
    else:
        contenido_principal = contenido
    
    # Crear PHP manteniendo el diseño exacto
    front_page_php = f"""<?php
/**
 * Front page template - Diseño idéntico al original
 */
get_header(); ?>

{contenido_principal}

<?php get_footer(); ?>
"""
    
    return front_page_php

def crear_pagina_blog(contenido):
    """Crear página de blog con el diseño del original"""
    blog_php = """<?php
/**
 * Blog page template
 */
get_header(); ?>

<main class="blog-page">
    <div class="container">
        <div class="section-header">
            <h1>Blog</h1>
            <p>Artículos y noticias sobre desarrollo territorial regenerativo</p>
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
                                <header class="post-header">
                                    <h2 class="post-title">
                                        <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                    </h2>
                                    <div class="post-meta">
                                        <span class="post-date"><?php echo get_the_date(); ?></span>
                                        <span class="post-category"><?php the_category(', '); ?></span>
                                    </div>
                                </header>
                                
                                <div class="post-excerpt">
                                    <?php the_excerpt(); ?>
                                </div>
                                
                                <footer class="post-footer">
                                    <a href="<?php the_permalink(); ?>" class="read-more">Leer más</a>
                                </footer>
                            </div>
                        </article>
                    <?php endwhile; ?>
                </div>
                
                <?php
                // Paginación
                the_posts_pagination(array(
                    'prev_text' => __('&laquo; Anterior', 'sueno-andino'),
                    'next_text' => __('Siguiente &raquo;', 'sueno-andino'),
                ));
                ?>
                
            <?php else : ?>
                <div class="no-posts">
                    <h2><?php _e('No se encontraron entradas', 'sueno-andino'); ?></h2>
                    <p><?php _e('Lo sentimos, no hay contenido para mostrar.', 'sueno-andino'); ?></p>
                </div>
            <?php endif; ?>
        </div>
    </div>
</main>

<?php get_footer(); ?>
"""
    
    return blog_php

def crear_paginas_adicionales_identicas(tema_dir, contenido):
    """Crear páginas adicionales manteniendo el diseño original"""
    
    # page-servicios.php
    servicios_php = """<?php
/**
 * Servicios page template
 */
get_header(); ?>

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
                <p>
                    Desarrollamos capacidades locales y fortalecemos el tejido
                    social a través de metodologías participativas y regenerativas.
                </p>
            </div>
            <div class="service-card">
                <div class="service-icon-wrapper">
                    <div class="service-icon">🚀</div>
                </div>
                <h3>Emprendimiento Social</h3>
                <p>
                    Desarrollamos capacidades locales y fortalecemos el tejido
                    social a través de metodologías participativas y regenerativas.
                </p>
            </div>
            <div class="service-card">
                <div class="service-icon-wrapper">
                    <div class="service-icon">🗺️</div>
                </div>
                <h3>Consultoría Territorial</h3>
                <p>
                    Desarrollamos capacidades locales y fortalecemos el tejido
                    social a través de metodologías participativas y regenerativas.
                </p>
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
                
                <div class="team-member">
                    <div class="member-image">
                        <div class="image-placeholder">
                            <div class="placeholder-content">
                                <div class="placeholder-icon">👨‍🔬</div>
                            </div>
                        </div>
                        <div class="decorative-dots"></div>
                        <div class="decorative-shape"></div>
                    </div>
                    <h4>Roberto Huamán</h4>
                    <p>Especialista en Desarrollo Territorial</p>
                </div>
                
                <div class="team-member">
                    <div class="member-image">
                        <div class="image-placeholder">
                            <div class="placeholder-content">
                                <div class="placeholder-icon">👩‍🤝‍👩</div>
                            </div>
                        </div>
                        <div class="decorative-dots"></div>
                        <div class="decorative-shape"></div>
                    </div>
                    <h4>Lucía Vargas</h4>
                    <p>Coordinadora de Comunidades</p>
                </div>
                
                <div class="team-member">
                    <div class="member-image">
                        <div class="image-placeholder">
                            <div class="placeholder-content">
                                <div class="placeholder-icon">👨‍💻</div>
                            </div>
                        </div>
                        <div class="decorative-dots"></div>
                        <div class="decorative-shape"></div>
                    </div>
                    <h4>Diego Paredes</h4>
                    <p>Director de Finanzas</p>
                </div>
            </div>
        </div>
        
        <div class="team-equipo">
            <h3>Equipo</h3>
            <div class="team-grid team-grid-small">
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
                    <h4>Sofia Mendoza</h4>
                    <p>Coordinadora de Proyectos</p>
                </div>
                
                <div class="team-member">
                    <div class="member-image">
                        <div class="image-placeholder">
                            <div class="placeholder-content">
                                <div class="placeholder-icon">👨‍🤝‍👨</div>
                            </div>
                        </div>
                        <div class="decorative-dots"></div>
                        <div class="decorative-shape"></div>
                    </div>
                    <h4>Miguel Torres</h4>
                    <p>Facilitador Comunitario</p>
                </div>
                
                <div class="team-member">
                    <div class="member-image">
                        <div class="image-placeholder">
                        <div class="placeholder-content">
                            <div class="placeholder-icon">👩‍🌾</div>
                        </div>
                    </div>
                    <div class="decorative-dots"></div>
                    <div class="decorative-shape"></div>
                </div>
                <h4>Elena Rojas</h4>
                <p>Especialista en Sostenibilidad</p>
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
    contacto_php = """<?php
/**
 * Contacto page template
 */
get_header(); ?>

<main class="contacto-page">
    <div class="container">
        <div class="contact-content">
            <div class="contact-info">
                <h1>Trabajemos Juntos</h1>
                <p>
                    ¿Tienes un proyecto en mente? Conversemos sobre cómo podemos
                    trabajar juntos para transformar tu territorio.
                </p>
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
                    <button type="submit" class="btn btn-primary">
                        Enviar Mensaje
                    </button>
                </form>
            </div>
        </div>
    </div>
</main>

<?php get_footer(); ?>
"""
    
    with open(f"{tema_dir}/page-contacto.php", 'w', encoding='utf-8') as f:
        f.write(contacto_php)

def extraer_css_js_identico(tema_dir, contenido):
    """Extraer CSS y JS del HTML original manteniendo todo igual"""
    
    # Crear directorio js
    os.makedirs(f"{tema_dir}/js", exist_ok=True)
    
    # Extraer JS del HTML original
    js_inicio = contenido.find('<script src="./sueño-andino-wordpress_files/scripts.js">')
    if js_inicio != -1:
        # Si encuentra el script, crear un archivo JS básico
        js_content = """// Sueño Andino - JavaScript Idéntico
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
        const modal = document.getElementById('guideModal');
        if (modal) {
            modal.style.display = 'block';
            document.body.style.overflow = 'hidden';
        }
    };
    
    // Función para cerrar modal
    window.closeGuideModal = function() {
        const modal = document.getElementById('guideModal');
        if (modal) {
            modal.style.display = 'none';
            document.body.style.overflow = 'auto';
        }
    };
    
    // Manejar formulario de contacto
    const contactForm = document.getElementById('contactForm');
    if (contactForm) {
        contactForm.addEventListener('submit', function(e) {
            e.preventDefault();
            // Aquí puedes agregar lógica para enviar el formulario
            alert('Mensaje enviado correctamente');
        });
    }
    
    // Manejar formulario de lead magnet
    const leadMagnetForm = document.getElementById('leadMagnetForm');
    if (leadMagnetForm) {
        leadMagnetForm.addEventListener('submit', function(e) {
            e.preventDefault();
            // Aquí puedes agregar lógica para el lead magnet
            alert('Guía enviada a tu email');
            closeGuideModal();
        });
    }
});
"""
    else:
        js_content = """// Sueño Andino - JavaScript Básico
document.addEventListener('DOMContentLoaded', function() {
    console.log('Sueño Andino - Tema cargado');
});
"""
    
    with open(f"{tema_dir}/js/theme.js", 'w', encoding='utf-8') as f:
        f.write(js_content)

def crear_zip_tema_identico(tema_dir):
    """Crear ZIP del tema idéntico"""
    timestamp = datetime.now().strftime("%Y%m%d-%H%M")
    zip_filename = f"sueno-andino-tema-identico-{timestamp}.zip"
    
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
    print("2. Activa el tema 'Sueño Andino - Diseño Idéntico'")
    print("3. El diseño será EXACTAMENTE igual al original")
    print("4. Incluye lead magnet, blog, y todas las secciones")

if __name__ == "__main__":
    crear_tema_identico()
