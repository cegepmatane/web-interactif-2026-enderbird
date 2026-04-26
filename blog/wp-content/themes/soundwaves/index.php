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

        <?php while (have_posts()) : the_post(); ?>

          <article>

            <!-- TITRE SEO -->
            <h2>
              <a href="<?php the_permalink(); ?>">
                <?php the_title(); ?>
              </a>
            </h2>

            <!-- IMAGE SEO -->
            <?php if (has_post_thumbnail()) : ?>
              <a href="<?php the_permalink(); ?>">
                <?php the_post_thumbnail(); ?>
              </a>
            <?php endif; ?>

            <!-- EXCERPT SEO -->
            <p>
              <?php the_excerpt(); ?>
            </p>

            <!-- META SEO -->
            <p>
              <?php the_category(', '); ?>
            </p>

            <?php the_tags('<p>', ', ', '</p>'); ?>

          </article>

        <?php endwhile; ?>

        <!-- =========================
             PAGINATION SEO
        ========================== -->
        <nav aria-label="Pagination des articles">

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

  <?php get_sidebar(); ?>

</div>

<?php get_footer(); ?>