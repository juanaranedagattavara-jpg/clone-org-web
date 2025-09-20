<?php
/**
 * Plugin Name: Aqua Site Kit
 * Plugin URI: https://aquapatterns.com
 * Description: Plugin de WordPress con patrones accesibles y child theme para crear sitios web modernos.
 * Version: 1.0.0
 * Author: Aqua Patterns Factory
 * Author URI: https://aquapatterns.com
 * License: GPL v2 or later
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain: aqua-site-kit
 * Domain Path: /languages
 * Requires at least: 6.0
 * Tested up to: 6.4
 * Requires PHP: 7.4
 * Network: false
 */

// Prevenir acceso directo
if (!defined('ABSPATH')) {
    exit;
}

// Definir constantes del plugin
define('AQUA_SITE_KIT_VERSION', '1.0.0');
define('AQUA_SITE_KIT_PLUGIN_DIR', plugin_dir_path(__FILE__));
define('AQUA_SITE_KIT_PLUGIN_URL', plugin_dir_url(__FILE__));

/**
 * Inicializar el plugin
 */
function aqua_site_kit_init() {
    // Cargar archivos de patrones
    require_once AQUA_SITE_KIT_PLUGIN_DIR . 'includes/class-patterns-loader.php';
    
    // Inicializar cargador de patrones
    new Aqua_Site_Kit_Patterns_Loader();
}
add_action('init', 'aqua_site_kit_init');

/**
 * Activar el plugin
 */
function aqua_site_kit_activate() {
    // Flush rewrite rules
    flush_rewrite_rules();
}
register_activation_hook(__FILE__, 'aqua_site_kit_activate');

/**
 * Desactivar el plugin
 */
function aqua_site_kit_deactivate() {
    // Flush rewrite rules
    flush_rewrite_rules();
}
register_deactivation_hook(__FILE__, 'aqua_site_kit_deactivate');
