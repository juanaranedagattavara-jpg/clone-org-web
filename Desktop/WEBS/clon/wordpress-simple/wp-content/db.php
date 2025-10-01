<?php
/*
Plugin Name: SQLite Database Integration
Drop-in Name: db.php
Description: Integrates SQLite as the database for WordPress.
Version: 1.9.1
Author: Kevin T. Smith
Author URI: https://kts.ai
*/

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

if ( ! defined( 'DB_ENGINE' ) || 'sqlite' !== DB_ENGINE ) {
    return;
}

if ( ! defined( 'DB_DIR' ) ) {
    define( 'DB_DIR', WP_CONTENT_DIR . '/database' );
}

if ( ! file_exists( DB_DIR ) ) {
    wp_mkdir_p( DB_DIR );
}

require_once __DIR__ . '/sqlite-database-integration/db.php';
