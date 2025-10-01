<?php
/**
 * The main template file
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 */

get_header(); ?>

<main id="main" class="site-main">
    <?php if (have_posts()) : ?>
        <?php while (have_posts()) : the_post(); ?>
            <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                <div class="entry-content">
                    <?php
                    the_content();
                    
                    wp_link_pages(array(
                        'before' => '<div class="page-links">' . esc_html__('Pages:', 'sueno-andino'),
                        'after'  => '</div>',
                    ));
                    ?>
                </div>
            </article>
        <?php endwhile; ?>
    <?php else : ?>
        <section class="no-results not-found">
            <header class="page-header">
                <h1 class="page-title"><?php esc_html_e('Nothing here', 'sueno-andino'); ?></h1>
            </header>
            <div class="page-content">
                <p><?php esc_html_e('It seems we can&rsquo;t find what you&rsquo;re looking for.', 'sueno-andino'); ?></p>
            </div>
        </section>
    <?php endif; ?>
</main>

<?php
get_footer();
