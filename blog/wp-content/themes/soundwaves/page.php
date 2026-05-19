<?php get_header(); ?>

<main>

  <!-- PAGE CONTENT -->
  <section id="page">
    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
        <?php get_template_part('template-parts/content', 'page'); ?>
    <?php endwhile; endif; ?>
  </section>

  <!-- RECENT COMMENTS -->
  <section id="section-commentaires">
    <h2>💬 Commentaires récents</h2>

    <div class="liste-commentaires">

      <?php
      $comments = get_comments([
        'number'  => 5,
        'status'  => 'approve',
        'parent'  => 0, // no replies
      ]);

      if ($comments) :
        foreach ($comments as $comment) :
          $post = get_post($comment->comment_post_ID);
      ?>

        <div class="commentaire" id="comment-<?php echo $comment->comment_ID; ?>">

          <div class="avatar-commentaire">
            <?php echo get_avatar($comment, 45); ?>
          </div>

          <div class="contenu-commentaire">

            <div class="auteur-commentaire">
              <p class="nom"><?php echo get_comment_author_link(); ?></p>

              <div class="origine">
                Sur :
                <a href="<?php echo get_permalink($post); ?>#comment-<?php echo $comment->comment_ID; ?>">
                  <?php echo get_the_title($post); ?>
                </a>
              </div>
            </div>

            <div class="texte-commentaire">
              <?php echo wp_trim_words($comment->comment_content, 20); ?>
            </div>

          </div>

        </div>

      <?php
        endforeach;
      else :
      ?>
        <p>Aucun commentaire récent.</p>
      <?php endif; ?>

    </div>
  </section>

</main>

<?php get_footer(); ?>