<?php
/**
 * WordPress Configuration Optimized for Sueño Andino Theme
 * Add these lines to your wp-config.php file for optimal performance
 */

// Security Keys (Generate new ones at https://api.wordpress.org/secret-key/1.1/salt/)
define('AUTH_KEY',         'your-auth-key-here');
define('SECURE_AUTH_KEY',  'your-secure-auth-key-here');
define('LOGGED_IN_KEY',    'your-logged-in-key-here');
define('NONCE_KEY',        'your-nonce-key-here');
define('AUTH_SALT',        'your-auth-salt-here');
define('SECURE_AUTH_SALT', 'your-secure-auth-salt-here');
define('LOGGED_IN_SALT',   'your-logged-in-salt-here');
define('NONCE_SALT',       'your-nonce-salt-here');

// Performance Optimizations
define('WP_MEMORY_LIMIT', '256M');
define('WP_MAX_MEMORY_LIMIT', '512M');
define('WP_CACHE', true);

// Database Optimizations
define('DB_CHARSET', 'utf8mb4');
define('DB_COLLATE', 'utf8mb4_unicode_ci');

// Security Settings
define('DISALLOW_FILE_EDIT', true);
define('DISALLOW_FILE_MODS', false);
define('FORCE_SSL_ADMIN', true);

// Cache Settings
define('WP_CACHE_KEY_SALT', 'sueno-andino-cache-');
define('WP_CACHE_HTTP_HOST', $_SERVER['HTTP_HOST']);

// Disable File Editing
define('DISALLOW_FILE_EDIT', true);

// Limit Post Revisions
define('WP_POST_REVISIONS', 3);

// Empty Trash
define('EMPTY_TRASH_DAYS', 7);

// Auto Save Interval
define('AUTOSAVE_INTERVAL', 300);

// Disable XML-RPC
add_filter('xmlrpc_enabled', '__return_false');

// Disable REST API for non-logged users
add_filter('rest_authentication_errors', function($result) {
    if (!empty($result)) {
        return $result;
    }
    if (!is_user_logged_in()) {
        return new WP_Error('rest_not_logged_in', 'You are not currently logged in.', array('status' => 401));
    }
    return $result;
});

// Optimize Database
add_action('init', function() {
    // Remove unnecessary queries
    remove_action('wp_head', 'wp_generator');
    remove_action('wp_head', 'wlwmanifest_link');
    remove_action('wp_head', 'rsd_link');
    remove_action('wp_head', 'wp_shortlink_wp_head');
    remove_action('wp_head', 'feed_links_extra', 3);
    remove_action('wp_head', 'print_emoji_detection_script', 7);
    remove_action('wp_print_styles', 'print_emoji_styles');
    remove_action('admin_print_scripts', 'print_emoji_detection_script');
    remove_action('admin_print_styles', 'print_emoji_styles');
    remove_action('wp_head', 'rest_output_link_wp_head');
    remove_action('wp_head', 'wp_oembed_add_discovery_links');
});

// Sueño Andino Theme Specific Settings
define('SUENO_ANDINO_VERSION', '1.0.0');
define('SUENO_ANDINO_DEBUG', false);

// Custom Post Types Support
add_action('init', function() {
    // Enable custom post types for Sueño Andino
    if (function_exists('sueno_andino_custom_post_types')) {
        sueno_andino_custom_post_types();
    }
});

// Performance Monitoring
if (defined('WP_DEBUG') && WP_DEBUG) {
    add_action('wp_footer', function() {
        echo '<!-- Sueño Andino Theme Loaded -->';
        echo '<!-- Memory Usage: ' . size_format(memory_get_peak_usage()) . ' -->';
        echo '<!-- Queries: ' . get_num_queries() . ' -->';
    });
}
