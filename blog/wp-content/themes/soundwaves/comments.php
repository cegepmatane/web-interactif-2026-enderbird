<section id="comments" class="comments-section" aria-label="Commentaires" role="list">
  <?php if (have_comments()) : ?>
    <div class="comments-list">
      <?php
      wp_list_comments([
        'style'       => 'div',
        'short_ping'  => true,
        'avatar_size' => 45,
        'callback'    => 'mytheme_comment_callback'
      ]);
      ?>
    </div>
  <?php endif; ?>
  
  <?php
  the_comments_navigation(); // Pagination des commentaires
  ?>
  
  <?php if (comments_open()) : ?>
    <div class="comment-form-wrapper">
      <?php
      comment_form([
        'class_form' => 'contact-form',
        'title_reply' => 'Laisser un commentaire',
        'label_submit' => 'Envoyer',
        'comment_field' => '
            <textarea name="comment" placeholder="Ton commentaire" required></textarea>
        ',
        'logged_in_as' => '',
      ]);
      ?>
    </div>
  <?php endif; ?>

  <?php if (!have_comments()) : ?>
    <p>Aucun commentaire pour le moment.</p>
  <?php endif; ?>
</section>