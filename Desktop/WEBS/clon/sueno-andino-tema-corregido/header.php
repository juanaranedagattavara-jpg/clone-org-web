<!DOCTYPE html>
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
