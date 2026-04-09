<?php get_header(); ?>

<main id="contenu-principal" class="archive-main">
    <header class="archive-header">
        <h1 class="archive-titre"><?php the_archive_title(); ?></h1>
        <div class="archive-description"><?php the_archive_description(); ?></div>
    </header>

    <?php if (have_posts()) : ?>
        <div class="liste-articles archive-liste">
            <?php while (have_posts()) : the_post(); ?>
                <article id="post-<?=the_ID()?>" <?=post_class('carte-article archive-article')?>>
                    <h2 class="article-titre"><a href="<?=the_permalink()?>" class="article-lien"><?=the_title()?></a></h2>

                    <div class="meta article-meta">
                        <span class="meta-date"><?=get_the_date()?></span>
                        <span class="meta-auteur"><?=the_author()?></span>
                        <span class="meta-categories"><?=the_category(', ')?></span>
                    </div>

                    <div class="article-extrait"><?=the_excerpt()?></div>

                    <div class="article-tags"><?=the_tags('<strong>Tags :</strong> ', ', ')?></div>

                    <a href="<?php the_permalink(); ?>" class="bouton-lire-suite">Lire la suite</a>
                </article>
            <?php endwhile; ?>
        </div>

        <!-- Pagination -->
        <nav class="pagination archive-pagination">
            <?php the_posts_pagination([
                'mid_size' => 2,
                'prev_text' => '← Précédent',
                'next_text' => 'Suivant →',
                'class' => 'pagination-liens'
            ]); ?>
        </nav>

    <?php else : ?>
        <div class="aucun-article">
            <p>Aucun article trouvé.</p>
        </div>
    <?php endif; ?>
</main>

<?php get_footer(); ?>