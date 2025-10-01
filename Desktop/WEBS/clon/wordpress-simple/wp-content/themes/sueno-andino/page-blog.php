<?php
/**
 * Template Name: Blog Page
 * 
 * @package SueñoAndino
 */

get_header(); ?>

<main id="main" class="site-main">
    <!-- Blog Hero Section -->
    <section class="blog-hero-section">
        <div class="container">
            <div class="blog-hero-content">
                <h1 class="blog-hero-title">Nuestro Blog</h1>
                <p class="blog-hero-description">Explora nuestros artículos, noticias y recursos sobre desarrollo territorial regenerativo.</p>
            </div>
        </div>
    </section>

    <!-- Blog Content Section -->
    <section class="blog-content-section">
        <div class="container">
            <div class="blog-grid">
                <?php
                $args = array(
                    'post_type' => 'post',
                    'posts_per_page' => 6,
                    'paged' => get_query_var('paged') ? get_query_var('paged') : 1,
                );
                $blog_query = new WP_Query($args);

                if ($blog_query->have_posts()) :
                    while ($blog_query->have_posts()) : $blog_query->the_post();
                        ?>
                        <article id="post-<?php the_ID(); ?>" <?php post_class('blog-card'); ?>>
                            <div class="blog-card-image">
                                <?php if (has_post_thumbnail()) : ?>
                                    <?php the_post_thumbnail('medium_large'); ?>
                                <?php else : ?>
                                    <div class="blog-placeholder">
                                        <span class="placeholder-icon">📝</span>
                                    </div>
                                <?php endif; ?>
                            </div>
                            <div class="blog-card-content">
                                <div class="blog-meta">
                                    <span class="blog-date"><?php echo get_the_date(); ?></span>
                                    <span class="blog-category"><?php the_category(', '); ?></span>
                                </div>
                                <h2 class="blog-title">
                                    <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                </h2>
                                <div class="blog-excerpt">
                                    <?php the_excerpt(); ?>
                                </div>
                                <a href="<?php the_permalink(); ?>" class="blog-read-more">Leer Más &rarr;</a>
                            </div>
                        </article>
                        <?php
                    endwhile;
                    wp_reset_postdata();
                else :
                    echo '<p>No hay entradas de blog para mostrar.</p>';
                endif;
                ?>
            </div>
            
            <?php
            // Paginación
            the_posts_pagination(array(
                'prev_text' => __('&laquo; Anterior', 'sueno-andino'),
                'next_text' => __('Siguiente &raquo;', 'sueno-andino'),
                'screen_reader_text' => __('Navegación de Entradas', 'sueno-andino'),
            ));
            ?>
        </div>
    </section>

    <!-- Newsletter Section -->
    <section class="newsletter-section">
        <div class="container">
            <div class="newsletter-content">
                <h2>Suscríbete a Nuestro Newsletter</h2>
                <p>Recibe las últimas noticias, artículos y actualizaciones directamente en tu bandeja de entrada.</p>
                <form class="newsletter-form" id="newsletterForm">
                    <div class="form-group">
                        <input type="email" name="email" placeholder="Tu correo electrónico" required>
                        <button type="submit">Suscribirse</button>
                    </div>
                    <p class="privacy-note">🔒 Privacidad garantizada</p>
                </form>
            </div>
        </div>
    </section>
</main>

<?php get_footer(); ?>