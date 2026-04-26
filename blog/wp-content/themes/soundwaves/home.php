<?php get_header(); ?>

<main>
  <!-- =========================
       ARCHIVE HEADER (SEO)
  ========================== -->
  <header>
    <h1>
      <?php echo esc_html(get_theme_mod('blog_title', 'Blog')); ?>
    </h1>

    <?php if (get_theme_mod('blog_description')) : ?>
      <p>
        <?php echo esc_html(get_theme_mod('blog_description')); ?>
      </p>
    <?php else : ?>
      <p>
        <?php bloginfo('description'); ?>
      </p>
    <?php endif; ?>
  </header>

  <!-- =========================
       POSTS LIST
  ========================== -->
  <section>
    <?php if (have_posts()) : ?>

      <?php while (have_posts()) : the_post(); ?>
        <?php get_template_part('template-parts/content', get_post_type()); ?>
      <?php endwhile; ?>

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

      <p><?php echo esc_html(get_theme_mod('no_posts_text', 'Aucun article trouvé.')); ?></p>

    <?php endif; ?>
  </section>

</main>

<?php get_footer(); ?>