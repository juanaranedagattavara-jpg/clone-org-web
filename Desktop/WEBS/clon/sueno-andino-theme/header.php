<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="profile" href="https://gmpg.org/xfn/11">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<header class="site-header">
    <div class="container">
        <div class="header-content">
            <div class="site-branding">
                <?php if (has_custom_logo()) : ?>
                    <div class="site-logo">
                        <?php the_custom_logo(); ?>
                    </div>
                <?php else : ?>
                    <div class="site-logo">
                        <a href="<?php echo esc_url(home_url('/')); ?>" rel="home">
                            <h1 class="site-title"><?php bloginfo('name'); ?></h1>
                        </a>
                        <?php
                        $description = get_bloginfo('description', 'display');
                        if ($description || is_customize_preview()) :
                        ?>
                            <p class="site-description"><?php echo $description; ?></p>
                        <?php endif; ?>
                    </div>
                <?php endif; ?>
            </div>

            <nav class="main-navigation" id="site-navigation">
                <button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false">
                    <span class="menu-toggle-text">Menú</span>
                    <span class="menu-toggle-icon">
                        <span></span>
                        <span></span>
                        <span></span>
                    </span>
                </button>
                
                <?php
                wp_nav_menu(array(
                    'theme_location' => 'primary',
                    'menu_id'        => 'primary-menu',
                    'menu_class'     => 'nav-menu',
                    'container'      => false,
                    'fallback_cb'    => 'sueno_andino_fallback_menu',
                ));
                ?>
            </nav>
        </div>
    </div>
</header>

<div class="menu-overlay"></div>