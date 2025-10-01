<?php
/**
 * Blog page template
 */
get_header(); ?>

<main class="blog-page">
    <div class="container">
        <div class="section-header">
            <h1>Blog</h1>
            <p>Artículos y noticias sobre desarrollo territorial regenerativo</p>
        </div>
        
        <div class="blog-posts">
            <?php if (have_posts()) : ?>
                <div class="posts-grid">
                    <?php while (have_posts()) : the_post(); ?>
                        <article class="post-card">
                            <?php if (has_post_thumbnail()) : ?>
                                <div class="post-thumbnail">
                                    <?php the_post_thumbnail('medium_large'); ?>
                                </div>
                            <?php endif; ?>
                            
                            <div class="post-content">
                                <header class="post-header">
                                    <h2 class="post-title">
                                        <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                    </h2>
                                    <div class="post-meta">
                                        <span class="post-date"><?php echo get_the_date(); ?></span>
                                        <span class="post-category"><?php the_category(', '); ?></span>
                                    </div>
                                </header>
                                
                                <div class="post-excerpt">
                                    <?php the_excerpt(); ?>
                                </div>
                                
                                <footer class="post-footer">
                                    <a href="<?php the_permalink(); ?>" class="read-more">Leer más</a>
                                </footer>
                            </div>
                        </article>
                    <?php endwhile; ?>
                </div>
                
                <?php
                // Paginación
                the_posts_pagination(array(
                    'prev_text' => __('&laquo; Anterior', 'sueno-andino'),
                    'next_text' => __('Siguiente &raquo;', 'sueno-andino'),
                ));
                ?>
                
            <?php else : ?>
                <div class="no-posts">
                    <h2><?php _e('No se encontraron entradas', 'sueno-andino'); ?></h2>
                    <p><?php _e('Lo sentimos, no hay contenido para mostrar.', 'sueno-andino'); ?></p>
                </div>
            <?php endif; ?>
        </div>
    </div>
</main>

<?php get_footer(); ?>
