<?php get_header();?>

<main>

  <?php if (have_posts()) : while (have_posts()) : the_post(); ?>

    <!-- =========================
         MAIN CONTENT
    ========================== -->
    <?php get_template_part('template-parts/content', get_post_type()); ?>

    <!-- =========================
         CUSTOM FIELD (SEO / DATA)
    ========================== -->
    <?php
    $project_note = get_post_meta(get_the_ID(), 'project_note', true);
    if (!empty($project_note)) : ?>
      <aside class="project-note">
        <h3>Note du projet</h3>
        <p><?php echo esc_html($project_note); ?></p>
      </aside>
    <?php endif; ?>

    <!-- =========================
         POST NAVIGATION (SEO INTERNAL LINKING)
    ========================== -->
    <?php if (get_theme_mod('show_post_nav', true)) : ?>
      <nav id="pagination" aria-label="Navigation des articles">
        <div>
          <?php previous_post_link('%link', '← %title'); ?>
        </div>

        <div>
          <?php next_post_link('%link', '%title →'); ?>
        </div>
      </nav>
    <?php endif; ?>

    <!-- =========================
         COMMENTS (SEO ENGAGEMENT)
    ========================== -->
    <?php if (comments_open() || get_comments_number()) : ?>
      <?php comments_template(); ?>
    <?php endif; ?>

  <?php endwhile; endif; ?>

</main>

<?php get_footer(); ?>