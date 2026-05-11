<?php get_header(); ?>

<main>
  <!-- =========================
       ARCHIVE HEADER SEO
  ========================== -->
  <header>
    <h1>
      <?php the_archive_title(); ?>
    </h1>

    <?php if (get_theme_mod('show_archive_description', true)) : ?>
      <div>
        <?php the_archive_description(); ?>
      </div>
    <?php endif; ?>
  </header>

  <!-- =========================
       POSTS LIST
  ========================== -->
  <?php if (have_posts()) : ?>

    <section>
      <?php while (have_posts()) : the_post(); ?>

        <?php get_template_part('template-parts/content', get_post_type()); ?>

      <?php endwhile; ?>
    </section>

    <!-- =========================
         PAGINATION SEO
    ========================== -->
    <?php if (get_theme_mod('show_pagination', true)) : ?>

      <nav aria-label="Pagination des articles">
        <?php the_posts_pagination([
          'mid_size'  => 2,
          'prev_text' => '← Précédent',
          'next_text' => 'Suivant →',
        ]); ?>
      </nav>

    <?php endif; ?>

  <?php else : ?>

    <section>
      <p>
        <?php echo esc_html(get_theme_mod('no_posts_text', 'Aucun article trouvé.')); ?>
      </p>
    </section>

  <?php endif; ?>

</main>

<?php get_footer(); ?>