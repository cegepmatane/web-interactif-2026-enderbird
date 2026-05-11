<section id="section-commentaires" class="comments-section" aria-label="Commentaires" role="list">

  <ol class="liste-commentaires">

    <?php if (have_comments()) : ?>

      <?php
      wp_list_comments([
        'style'       => 'div',
        'callback'    => 'mytheme_comment_callback',
        'avatar_size' => 45,
        'max_depth'   => 5
      ]);
      ?>

    <?php else : ?>
      <p>Aucun commentaire pour le moment.</p>
    <?php endif; ?>

    </ol>

  <?php the_comments_navigation(); ?>

  <?php if (comments_open() && is_user_logged_in()) :
    comment_form([
      'class_form' => 'formulaire-commentaire',
      
      'title_reply' => '',
      
      'label_submit' => 'Envoyer',
      
      'class_submit' => 'bouton-commenter',
      
      'comment_field' => '
        <input 
          name="comment" 
          class="champ-commentaire" 
          placeholder="Écris ton commentaire..." 
          required
        ></input>
      ',
      
      'logged_in_as' => '',
    ]);
  else : ?>

  <a href="<?php echo wp_login_url(get_permalink()); ?>" class="bouton-commenter">
    Se connecter pour commenter
  </a>

<?php endif; ?>

</section>