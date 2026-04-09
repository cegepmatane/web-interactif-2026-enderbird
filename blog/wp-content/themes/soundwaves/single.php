<?php get_header(); ?>

<main id="contenu-principal">
    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
    
    <section id="post-<?php the_ID(); ?>" class="article <?php echo implode(' ', get_post_class()); ?>">
      <h1><?php the_title(); ?></h1>
    
      <div class="meta">
        <span>Publié le <?php echo get_the_date(); ?></span>
        <span>par <?php the_author(); ?></span>
        <span>dans <?php the_category(', '); ?></span>
      </div>
    
      <div class="contenu"><?=the_content()?></div>
      <div class="tags"><?=the_tags('<strong>Tags :</strong> ', ', ')?></div>
    </section>
    
    <!-- COMMENTAIRES -->
    <section id="section-commentaires">
        <?=$comments = get_comments([
            'post_id' => get_the_ID(),
            'status' => 'approve'
        ])?>
    
        <div id="comments">
            <?php if ($comments) : ?>
                <div class="liste-commentaires">
                    <?php foreach ($comments as $comment) : ?>
                        <div class="commentaire visible">
                            <div class="avatar-commentaire"><?=get_avatar($comment, 45)?></div>
                    
                            <div class="contenu-commentaire">
                                <div class="auteur-commentaire"><?=esc_html($comment->comment_author)?></div>
                                <div class="texte-commentaire"><?=esc_html($comment->comment_content)?></div>
                                <div class="meta"><?=esc_html(get_comment_date('', $comment))?></div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
                    
            <!-- FORMULAIRE COMPLET -->
            <form class="formulaire-commentaire" method="post" action="<?=site_url('/wp-comments-post.php')?>">
                <input type="text" name="author" class="champ-commentaire" placeholder="Nom" required>
                <input type="email" name="email" class="champ-commentaire" placeholder="Email" required>
                <input type="url" name="url" class="champ-commentaire" placeholder="Site web (optionnel)">
                <textarea name="comment" class="champ-commentaire" placeholder="Ton commentaire" required></textarea>
                    
                <!-- Champs obligatoires WordPress -->
                <input type="hidden" name="comment_post_ID" value="<?=get_the_ID()?>">
                <input type="hidden" name="comment_parent" value="0">
                    
                <button type="submit" class="bouton-commenter">Envoyer</button>
            </form>
        </div>    
    </section>
                    
    <?php endwhile; endif; ?>
</main>

<?php get_footer(); ?>