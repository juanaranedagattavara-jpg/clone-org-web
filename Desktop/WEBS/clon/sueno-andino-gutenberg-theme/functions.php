<?php
/**
 * Sueño Andino Theme Functions
 * Compatible with Gutenberg blocks
 */

// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

// Theme setup
function sueno_andino_setup() {
    // Add theme support
    add_theme_support('post-thumbnails');
    add_theme_support('title-tag');
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
    add_theme_support('editor-styles');
    add_editor_style('editor-style.css');
    
    // Register navigation menus
    register_nav_menus(array(
        'primary' => __('Primary Menu', 'sueno-andino'),
        'footer' => __('Footer Menu', 'sueno-andino'),
    ));
}
add_action('after_setup_theme', 'sueno_andino_setup');

// Enqueue scripts and styles
function sueno_andino_scripts() {
    // Theme stylesheet
    wp_enqueue_style('sueno-andino-style', get_stylesheet_uri(), array(), '1.0.0');
    
    // Google Fonts
    wp_enqueue_style('sueno-andino-fonts', 'https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap', array(), null);
    
    // Theme JavaScript
    wp_enqueue_script('sueno-andino-script', get_template_directory_uri() . '/js/theme.js', array(), '1.0.0', true);
    
    // Localize script for AJAX
    wp_localize_script('sueno-andino-script', 'suenoAndino', array(
        'ajaxUrl' => admin_url('admin-ajax.php'),
        'nonce' => wp_create_nonce('sueno_andino_nonce'),
    ));
}
add_action('wp_enqueue_scripts', 'sueno_andino_scripts');

// Register custom post types
function sueno_andino_custom_post_types() {
    // Testimonials
    register_post_type('testimonials', array(
        'labels' => array(
            'name' => __('Testimonials', 'sueno-andino'),
            'singular_name' => __('Testimonial', 'sueno-andino'),
        ),
        'public' => true,
        'has_archive' => true,
        'supports' => array('title', 'editor', 'thumbnail'),
        'menu_icon' => 'dashicons-format-quote',
        'show_in_rest' => true,
    ));
    
    // Team Members
    register_post_type('team_members', array(
        'labels' => array(
            'name' => __('Team Members', 'sueno-andino'),
            'singular_name' => __('Team Member', 'sueno-andino'),
        ),
        'public' => true,
        'has_archive' => true,
        'supports' => array('title', 'editor', 'thumbnail'),
        'menu_icon' => 'dashicons-groups',
        'show_in_rest' => true,
    ));
    
    // Services
    register_post_type('services', array(
        'labels' => array(
            'name' => __('Services', 'sueno-andino'),
            'singular_name' => __('Service', 'sueno-andino'),
        ),
        'public' => true,
        'has_archive' => true,
        'supports' => array('title', 'editor', 'thumbnail'),
        'menu_icon' => 'dashicons-admin-tools',
        'show_in_rest' => true,
    ));
}
add_action('init', 'sueno_andino_custom_post_types');

// Register custom blocks
function sueno_andino_register_blocks() {
    // Check if Gutenberg is available
    if (!function_exists('register_block_type')) {
        return;
    }
    
    // Hero Section Block
    register_block_type('sueno-andino/hero-section', array(
        'editor_script' => 'sueno-andino-blocks',
        'editor_style' => 'sueno-andino-blocks-editor',
        'style' => 'sueno-andino-blocks',
        'render_callback' => 'sueno_andino_render_hero_section',
        'attributes' => array(
            'title' => array('type' => 'string', 'default' => ''),
            'description' => array('type' => 'string', 'default' => ''),
            'primaryButtonText' => array('type' => 'string', 'default' => ''),
            'primaryButtonUrl' => array('type' => 'string', 'default' => ''),
            'secondaryButtonText' => array('type' => 'string', 'default' => ''),
            'secondaryButtonUrl' => array('type' => 'string', 'default' => ''),
            'stats' => array('type' => 'array', 'default' => array()),
        ),
    ));
    
    // Timeline Block
    register_block_type('sueno-andino/timeline', array(
        'editor_script' => 'sueno-andino-blocks',
        'editor_style' => 'sueno-andino-blocks-editor',
        'style' => 'sueno-andino-blocks',
        'render_callback' => 'sueno_andino_render_timeline',
        'attributes' => array(
            'timelineItems' => array('type' => 'array', 'default' => array()),
        ),
    ));
    
    // Services Block
    register_block_type('sueno-andino/services', array(
        'editor_script' => 'sueno-andino-blocks',
        'editor_style' => 'sueno-andino-blocks-editor',
        'style' => 'sueno-andino-blocks',
        'render_callback' => 'sueno_andino_render_services',
        'attributes' => array(
            'services' => array('type' => 'array', 'default' => array()),
        ),
    ));
    
    // Testimonials Block
    register_block_type('sueno-andino/testimonials', array(
        'editor_script' => 'sueno-andino-blocks',
        'editor_style' => 'sueno-andino-blocks-editor',
        'style' => 'sueno-andino-blocks',
        'render_callback' => 'sueno_andino_render_testimonials',
        'attributes' => array(
            'testimonials' => array('type' => 'array', 'default' => array()),
        ),
    ));
    
    // Team Block
    register_block_type('sueno-andino/team', array(
        'editor_script' => 'sueno-andino-blocks',
        'editor_style' => 'sueno-andino-blocks-editor',
        'style' => 'sueno-andino-blocks',
        'render_callback' => 'sueno_andino_render_team',
        'attributes' => array(
            'teamMembers' => array('type' => 'array', 'default' => array()),
        ),
    ));
}
add_action('init', 'sueno_andino_register_blocks');

// Enqueue block assets
function sueno_andino_block_assets() {
    wp_enqueue_script(
        'sueno-andino-blocks',
        get_template_directory_uri() . '/js/blocks.js',
        array('wp-blocks', 'wp-element', 'wp-editor', 'wp-components', 'wp-i18n'),
        '1.0.0',
        true
    );
    
    wp_enqueue_style(
        'sueno-andino-blocks-editor',
        get_template_directory_uri() . '/css/blocks-editor.css',
        array('wp-edit-blocks'),
        '1.0.0'
    );
    
    wp_enqueue_style(
        'sueno-andino-blocks',
        get_template_directory_uri() . '/css/blocks.css',
        array(),
        '1.0.0'
    );
}
add_action('enqueue_block_assets', 'sueno_andino_block_assets');

// Block render callbacks
function sueno_andino_render_hero_section($attributes) {
    $title = $attributes['title'] ?? '';
    $description = $attributes['description'] ?? '';
    $primaryButtonText = $attributes['primaryButtonText'] ?? '';
    $primaryButtonUrl = $attributes['primaryButtonUrl'] ?? '';
    $secondaryButtonText = $attributes['secondaryButtonText'] ?? '';
    $secondaryButtonUrl = $attributes['secondaryButtonUrl'] ?? '';
    $stats = $attributes['stats'] ?? array();
    
    ob_start();
    ?>
    <section class="wp-block-group hero-section">
        <div class="hero-content">
            <?php if ($title): ?>
                <h1 class="hero-title"><?php echo esc_html($title); ?></h1>
            <?php endif; ?>
            
            <?php if ($description): ?>
                <p class="hero-description"><?php echo esc_html($description); ?></p>
            <?php endif; ?>
            
            <?php if ($primaryButtonText || $secondaryButtonText): ?>
                <div class="hero-buttons">
                    <?php if ($primaryButtonText): ?>
                        <a href="<?php echo esc_url($primaryButtonUrl); ?>" class="wp-block-button is-style-primary">
                            <span class="wp-block-button__link"><?php echo esc_html($primaryButtonText); ?></span>
                        </a>
                    <?php endif; ?>
                    
                    <?php if ($secondaryButtonText): ?>
                        <a href="<?php echo esc_url($secondaryButtonUrl); ?>" class="wp-block-button is-style-secondary">
                            <span class="wp-block-button__link"><?php echo esc_html($secondaryButtonText); ?></span>
                        </a>
                    <?php endif; ?>
                </div>
            <?php endif; ?>
            
            <?php if (!empty($stats)): ?>
                <div class="hero-stats">
                    <?php foreach ($stats as $stat): ?>
                        <div class="stat-item">
                            <div class="stat-number"><?php echo esc_html($stat['number'] ?? ''); ?></div>
                            <div class="stat-label"><?php echo esc_html($stat['label'] ?? ''); ?></div>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </div>
    </section>
    <?php
    return ob_get_clean();
}

function sueno_andino_render_timeline($attributes) {
    $timelineItems = $attributes['timelineItems'] ?? array();
    
    ob_start();
    ?>
    <section class="wp-block-group timeline-section">
        <div class="anne-timeline">
            <?php foreach ($timelineItems as $index => $item): ?>
                <div class="anne-timeline-item">
                    <div class="anne-timeline-image">
                        <div class="image-placeholder">
                            <div class="placeholder-content">
                                <div class="placeholder-icon">📅</div>
                            </div>
                        </div>
                    </div>
                    <div class="anne-timeline-dot"></div>
                    <div class="anne-timeline-content">
                        <span class="anne-year"><?php echo esc_html($item['year'] ?? ''); ?></span>
                        <h3><?php echo esc_html($item['title'] ?? ''); ?></h3>
                        <p><?php echo esc_html($item['description'] ?? ''); ?></p>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </section>
    <?php
    return ob_get_clean();
}

function sueno_andino_render_services($attributes) {
    $services = $attributes['services'] ?? array();
    
    ob_start();
    ?>
    <section class="wp-block-group services-section">
        <div class="services-grid">
            <?php foreach ($services as $service): ?>
                <div class="service-card">
                    <div class="service-icon-wrapper">
                        <div class="service-icon"><?php echo esc_html($service['icon'] ?? '🔧'); ?></div>
                    </div>
                    <h3><?php echo esc_html($service['title'] ?? ''); ?></h3>
                    <p><?php echo esc_html($service['description'] ?? ''); ?></p>
                </div>
            <?php endforeach; ?>
        </div>
    </section>
    <?php
    return ob_get_clean();
}

function sueno_andino_render_testimonials($attributes) {
    $testimonials = $attributes['testimonials'] ?? array();
    
    ob_start();
    ?>
    <section class="wp-block-group testimonials-section">
        <div class="testimonials-grid">
            <?php foreach ($testimonials as $testimonial): ?>
                <div class="testimonial-card">
                    <div class="testimonial-header">
                        <div class="testimonial-avatar">
                            <div class="avatar-placeholder"><?php echo esc_html(substr($testimonial['name'] ?? 'A', 0, 1)); ?></div>
                        </div>
                        <div class="testimonial-info">
                            <h4><?php echo esc_html($testimonial['name'] ?? ''); ?></h4>
                            <p><?php echo esc_html($testimonial['position'] ?? ''); ?></p>
                        </div>
                    </div>
                    <blockquote><?php echo esc_html($testimonial['content'] ?? ''); ?></blockquote>
                </div>
            <?php endforeach; ?>
        </div>
    </section>
    <?php
    return ob_get_clean();
}

function sueno_andino_render_team($attributes) {
    $teamMembers = $attributes['teamMembers'] ?? array();
    
    ob_start();
    ?>
    <section class="wp-block-group team-section">
        <div class="team-grid">
            <?php foreach ($teamMembers as $member): ?>
                <div class="team-member">
                    <div class="member-image">
                        <div class="image-placeholder">
                            <div class="placeholder-content">
                                <div class="placeholder-icon">👤</div>
                            </div>
                        </div>
                        <div class="decorative-dots"></div>
                        <div class="decorative-shape"></div>
                    </div>
                    <h4><?php echo esc_html($member['name'] ?? ''); ?></h4>
                    <p><?php echo esc_html($member['position'] ?? ''); ?></p>
                </div>
            <?php endforeach; ?>
        </div>
    </section>
    <?php
    return ob_get_clean();
}

// AJAX handler for lead magnet form
function sueno_andino_handle_lead_magnet() {
    // Verify nonce
    if (!wp_verify_nonce($_POST['nonce'], 'sueno_andino_nonce')) {
        wp_die('Security check failed');
    }
    
    $email = sanitize_email($_POST['email']);
    $name = sanitize_text_field($_POST['name']);
    
    if (!is_email($email)) {
        wp_send_json_error('Invalid email address');
    }
    
    // Here you would typically save to database or send to email service
    // For now, we'll just return success
    
    wp_send_json_success('Thank you for subscribing!');
}
add_action('wp_ajax_sueno_andino_lead_magnet', 'sueno_andino_handle_lead_magnet');
add_action('wp_ajax_nopriv_sueno_andino_lead_magnet', 'sueno_andino_handle_lead_magnet');

// Add customizer options
function sueno_andino_customize_register($wp_customize) {
    // Add color scheme section
    $wp_customize->add_section('sueno_andino_colors', array(
        'title' => __('Color Scheme', 'sueno-andino'),
        'priority' => 30,
    ));
    
    // Primary color
    $wp_customize->add_setting('primary_color', array(
        'default' => '#0e5e6f',
        'sanitize_callback' => 'sanitize_hex_color',
    ));
    
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'primary_color', array(
        'label' => __('Primary Color', 'sueno-andino'),
        'section' => 'sueno_andino_colors',
    )));
    
    // Accent color
    $wp_customize->add_setting('accent_color', array(
        'default' => '#7fb069',
        'sanitize_callback' => 'sanitize_hex_color',
    ));
    
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'accent_color', array(
        'label' => __('Accent Color', 'sueno-andino'),
        'section' => 'sueno_andino_colors',
    )));
}
add_action('customize_register', 'sueno_andino_customize_register');

// Add custom CSS from customizer
function sueno_andino_customize_css() {
    $primary_color = get_theme_mod('primary_color', '#0e5e6f');
    $accent_color = get_theme_mod('accent_color', '#7fb069');
    
    if ($primary_color !== '#0e5e6f' || $accent_color !== '#7fb069') {
        ?>
        <style type="text/css">
            :root {
                --sa-primary: <?php echo esc_attr($primary_color); ?>;
                --sa-accent: <?php echo esc_attr($accent_color); ?>;
            }
        </style>
        <?php
    }
}
add_action('wp_head', 'sueno_andino_customize_css');
