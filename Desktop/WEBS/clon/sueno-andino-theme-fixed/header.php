<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="https://gmpg.org/xfn/11">
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<header class="site-header">
    <div class="header-container">
        <div class="site-branding">
            <a href="<?php echo esc_url(home_url('/')); ?>" class="site-title">
                SA Sueño Andino
            </a>
            <p class="site-description">Desarrollo Territorial Regenerativo</p>
        </div>
        
        <nav class="main-navigation">
            <?php
            wp_nav_menu(array(
                'theme_location' => 'primary',
                'menu_id'        => 'primary-menu',
                'fallback_cb'    => 'sueno_andino_fallback_menu',
            ));
            ?>
        </nav>
        
        <a href="#guia" class="cta-button">Descarga Guía Gratuita</a>
    </div>
</header>
