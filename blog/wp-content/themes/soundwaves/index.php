<?php get_header(); ?>

<div>

  <main id="contenu-principal">

    <!-- =========================
         TITRE ARCHIVE (SEO IMPORTANT)
    ========================== -->
    <header>
      <h1>
        <?php
        if (is_category()) {
          single_cat_title();
        } elseif (is_tag()) {
          single_tag_title();
        } elseif (is_author()) {
          the_post();
          echo 'Articles de ' . get_the_author();
          rewind_posts();
        } else {
          echo 'Archives';
        }
        ?>
      </h1>

      <?php
      if (is_category() || is_tag()) {
        the_archive_description('<p>', '</p>');
      }
      ?>
    </header>

    <!-- =========================
         POSTS LIST
    ========================== -->
    <section>
      <?php if (have_posts()) : ?>

        <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
            <?php get_template_part('template-parts/content', 'page'); ?>
        <?php endwhile; endif; ?>

        <!-- =========================
             PAGINATION SEO
        ========================== -->
        <nav id="pagination" aria-label="Pagination des articles">
          <?php the_posts_pagination([
            'mid_size'  => 2,
            'prev_text' => '← Précédent',
            'next_text' => 'Suivant →',
          ]); ?>
        </nav>

      <?php else : ?>
        <p>
          <?php echo esc_html(get_theme_mod('no_posts_text', 'Aucun article trouvé.')); ?>
        </p>
      <?php endif; ?>

    </section>
  </main>


</div>

<?php get_footer(); ?>