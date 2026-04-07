<?=get_header()?>

<main>

<h1><?php the_archive_title(); ?></h1>

<?php if (have_posts()) : ?>
    
    <?php while (have_posts()) : the_post(); ?>

        <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

            <h2>
                <a href="<?php the_permalink(); ?>">
                    <?php the_title(); ?>
                </a>
            </h2>

            <p><?php the_excerpt(); ?></p>

        </article>

    <?php endwhile; ?>

<?php else : ?>
    <p>Aucun article trouvé.</p>
<?php endif; ?>

</main>

<?=get_footer()?>