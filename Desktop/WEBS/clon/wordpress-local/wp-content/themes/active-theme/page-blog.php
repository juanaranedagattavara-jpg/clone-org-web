<?php
/**
 * Blog page template
 */
get_header(); ?>

<main class="blog-page">
    <div class="container">
        <h1>Blog</h1>
        <div class="blog-posts">
            <?php if (have_posts()) : ?>
                <?php while (have_posts()) : the_post(); ?>
                    <article class="post-card">
                        <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                        <div class="post-meta">
                            <span><?php echo get_the_date(); ?></span>
                        </div>
                        <div class="post-excerpt">
                            <?php the_excerpt(); ?>
                        </div>
                    </article>
                <?php endwhile; ?>
            <?php else : ?>
                <p>No hay entradas disponibles.</p>
            <?php endif; ?>
        </div>
    </div>
</main>

<?php get_footer(); ?>
