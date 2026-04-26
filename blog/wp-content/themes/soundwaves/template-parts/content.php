<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

  <!-- =========================
       TITLE SEO
  ========================== -->
  <?php if (!is_singular()) : ?>
    <h2>
      <a href="<?php the_permalink(); ?>">
        <?php the_title(); ?>
      </a>
    </h2>
  <?php else : ?>
    <h1><?php the_title(); ?></h1>
  <?php endif; ?>

  <!-- =========================
       FEATURED IMAGE SEO
  ========================== -->
  <?php if (has_post_thumbnail() && !is_singular()) : ?>
    <a href="<?php the_permalink(); ?>">
      <?php the_post_thumbnail('large', [
        'alt' => get_the_title()
      ]); ?>
    </a>
  <?php endif; ?>

  <!-- =========================
       META SEO
  ========================== -->
  <p>
    <?php echo get_the_date(); ?>
    <?php the_author_posts_link(); ?>
    <?php the_category(', '); ?>
  </p>

  <!-- =========================
       CONTENT SEO
  ========================== -->
  <?php if (is_singular()) : ?>
    <?php the_content();?>

  <?php else : ?>
    <?php the_excerpt(); ?>
  <?php endif; ?>

  <!-- =========================
       TAGS SEO LINKING
  ========================== -->
  <?php if (has_tag()) : ?>
    <p>
      <?php the_tags('Tags : ', ', '); ?>
    </p>
  <?php endif; ?>

  <!-- =========================
       CUSTOM FIELD (SEO DATA)
  ========================== -->
  <?php
  $seo_field = get_post_meta(get_the_ID(), 'seo_custom_field', true);
  if (!empty($seo_field)) : ?>
    <p>
      <?php echo esc_html($seo_field); ?>
    </p>
  <?php endif; ?>

</article>