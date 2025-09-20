<?php
/**
 * Hero Pattern
 * 
 * @package Aqua Site Kit
 * @version 1.0.0
 * @author Aqua Patterns Factory
 */

// Prevenir acceso directo
if (!defined('ABSPATH')) {
    exit;
}

// Registrar el patrón
register_block_pattern(
    'aqua-site-kit/hero',
    array(
        'title'       => __('Hero Section', 'aqua-site-kit'),
        'description' => __('Una sección hero accesible y responsive con título, subtítulo y botón de llamada a la acción.', 'aqua-site-kit'),
        'content'     => '<!-- wp:group {"className":"aqua-hero","align":"full","style":{"spacing":{"padding":{"top":"var(--wp--preset--spacing--x-large)","bottom":"var(--wp--preset--spacing--x-large)"}},"color":{"background":"var(--wp--preset--color--neutral-100)"}}} -->
<div class="wp-block-group alignfull aqua-hero" style="background-color:var(--wp--preset--color--neutral-100);padding-top:var(--wp--preset--spacing--x-large);padding-bottom:var(--wp--preset--spacing--x-large)"><!-- wp:heading {"textAlign":"center","level":1,"className":"aqua-hero__title","style":{"typography":{"fontSize":"var(--wp--preset--font-size--xx-large)","fontWeight":"700","lineHeight":"1.2"},"spacing":{"margin":{"bottom":"var(--wp--preset--spacing--medium)"}}}} -->
<h1 class="wp-block-heading has-text-align-center aqua-hero__title" style="margin-bottom:var(--wp--preset--spacing--medium);font-size:var(--wp--preset--font-size--xx-large);font-weight:700;line-height:1.2">Título Principal</h1>
<!-- /wp:heading -->

<!-- wp:paragraph {"align":"center","className":"aqua-hero__subtitle","style":{"typography":{"fontSize":"var(--wp--preset--font-size--large)"},"spacing":{"margin":{"bottom":"var(--wp--preset--spacing--large)"}},"color":{"text":"var(--wp--preset--color--neutral-900)"}}} -->
<p class="has-text-align-center aqua-hero__subtitle" style="color:var(--wp--preset--color--neutral-900);margin-bottom:var(--wp--preset--spacing--large);font-size:var(--wp--preset--font-size--large)">Subtítulo descriptivo que explica el valor de tu producto o servicio.</p>
<!-- /wp:paragraph -->

<!-- wp:buttons {"layout":{"type":"flex","justifyContent":"center"}} -->
<div class="wp-block-buttons"><!-- wp:button {"className":"aqua-hero__button","style":{"color":{"background":"var(--wp--preset--color--brand-500)","text":"#ffffff"},"typography":{"fontSize":"var(--wp--preset--font-size--medium)"},"spacing":{"padding":{"top":"var(--wp--preset--spacing--small)","right":"var(--wp--preset--spacing--medium)","bottom":"var(--wp--preset--spacing--small)","left":"var(--wp--preset--spacing--medium)"}}}} -->
<div class="wp-block-button aqua-hero__button"><a class="wp-block-button__link wp-element-button" style="color:#ffffff;background-color:var(--wp--preset--color--brand-500);font-size:var(--wp--preset--font-size--medium);padding-top:var(--wp--preset--spacing--small);padding-right:var(--wp--preset--spacing--medium);padding-bottom:var(--wp--preset--spacing--small);padding-left:var(--wp--preset--spacing--medium)">Llamada a la Acción</a></div>
<!-- /wp:button --></div>
<!-- /wp:buttons --></div>
<!-- /wp:group -->',
        'categories'  => array('featured', 'header'),
        'keywords'    => array('hero', 'header', 'banner', 'call-to-action'),
        'viewportWidth' => 1200,
    )
);
