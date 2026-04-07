<?php
define('WP_DEBUG', true);
define('WP_DEBUG_LOG', true);
define('WP_DEBUG_DISPLAY', true);
ini_set('display_errors', 1);

get_header();
?>

<title>SoundWave - Blog</title>

<main id="contenu-principal">
    <section id="album-vedette">

    <?php if ( have_posts() ) :
        while ( have_posts() ) :
            the_post(); ?>

            <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

                <h1><?php the_title('<a href="'.esc_url(get_permalink()).'">','</a>'); ?></h1>

                <div class="meta">
                    <span>Publié le <?php the_date(); ?></span>
                    <span>par <?php the_author(); ?></span>
                </div>

                <div class="contenu">
                    <?php the_content(); ?>
                </div>
            </article>
    <?php endwhile;
    else :
        get_template_part("content","none");
    endif; ?>

    </section>
</main>

<?=get_footer()?>