<?php get_header(); ?>

<main>
<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

  <h1><?php the_title(); ?></h1>

  <div class="meta">
    <span>Publié le <?php echo get_the_date(); ?></span>
    <span>par <?php the_author(); ?></span>
    <span>dans <?php the_category(', '); ?></span>
  </div>

  <div class="contenu">
    <?php the_content(); ?>
  </div>

  <div class="tags">
    <?php the_tags('<strong>Tags :</strong> ', ', '); ?>
  </div>

</article>

<!-- ✅ Comments ONLY for posts -->
<?php
if (comments_open() || get_comments_number()) :
    comments_template();
endif;
?>

<?php endwhile; endif; ?>
</main>

<?php get_footer(); ?>