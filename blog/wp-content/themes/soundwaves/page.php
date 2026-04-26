<?php get_header(); ?>

<main id="contenu-principal" class="container">
  <?php if (have_posts()) : while (have_posts()) : the_post(); ?>

    <article id="page-<?php the_ID(); ?>" <?php post_class('page-content'); ?>>
      <!-- =========================
           PAGE CONTENT
      ========================== -->
      <?php get_template_part('template-parts/content', 'page'); ?>
    </article>

  <?php endwhile; endif; ?>
</main>

<?php get_footer(); ?>