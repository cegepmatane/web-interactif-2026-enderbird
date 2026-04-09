<?php
define('WP_DEBUG', true);
define('WP_DEBUG_LOG', true);
define('WP_DEBUG_DISPLAY', true);
ini_set('display_errors', 1);

get_header();
?>

<title>SoundWave - Blog</title>

<main id="contenu-principal">
    <section class="liste-articles">
        <?php if ( have_posts() ) : ?>
            <?php while ( have_posts() ) : the_post(); ?>
                <article id="post-<?php the_ID(); ?>" <?php post_class('article'); ?>>
                    <div class="article-header">
                        <h1 class="titre-article"><a href="<?=esc_url(get_permalink())?>"><?=the_title()?></a></h1>
                        <div class="meta-article">
                            <span class="meta-date">Publié le <?=get_the_date()?></span>
                            <span class="meta-auteur">par <?=the_author()?></span>
                            <span class="meta-categories">dans <?=the_category(', ')?></span>
                        </div>
                    </div>

                    <div class="contenu-article"><?=the_content()?></div>
                    <div class="tags-article"><?=the_tags('<strong>Tags :</strong> ', ', ')?></div>
                </article>
            <?php endwhile; ?>
        <?php else : ?>
            <div class="article vide">
                <p>Aucun article disponible.</p>
            </div>
        <?php endif; ?>
    </section>
</main>

<?php get_footer(); ?>