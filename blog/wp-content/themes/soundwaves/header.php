<!DOCTYPE html>
<html <?php language_attributes(); ?>>
  
  <head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
  
    <!-- SEO robots -->
    <meta name="robots" content="index, follow">
  
    <!-- META DESCRIPTION SEO -->
    <meta name="description" content="<?php
      if (is_singular()) {
        echo esc_attr(wp_strip_all_tags(get_the_excerpt()));
      } else {
        echo esc_attr(get_bloginfo('description'));
      }
    ?>">
  
    <!-- WordPress Site Icon || Fallback custom favicon-->
    <?php if (function_exists('has_site_icon') && has_site_icon()) : ?>
      <?php wp_site_icon(); ?>
    <?php else : ?>
      <link rel="icon" href="<?php echo esc_url(get_template_directory_uri() . '/decoration/icon.svg'); ?>"> 
    <?php endif; ?>
  
    <!-- RSS -->
    <link rel="alternate" type="application/rss+xml" 
      title="<?php bloginfo('name'); ?> RSS Feed" 
      href="<?php bloginfo('rss2_url'); ?>"
    >
    
    <?php wp_head(); ?>
  </head>
  
  <body <?php body_class(); ?>>
    <?php wp_body_open(); ?>
    
    <!-- =========================
         NAVIGATION
    ========================= -->
    <nav id="navigation" aria-label="Menu principal">
      <?php if (has_nav_menu('primary')) : 
        wp_nav_menu([
          'theme_location' => 'primary',
          'container'      => false,
          'menu_class'     => 'menu-principal'
        ]); 
      endif; ?>
    
      <!-- LINKS SECONDAIRES SEO -->
      <a class="secondary-link" href="<?php echo esc_url(home_url('/')); ?>">🏠 Accueil</a>
      <a class="secondary-link" href="<?php echo esc_url(home_url('/blog/')); ?>">📝 Blog</a>
      <a class="secondary-link" href="<?php echo esc_url(home_url('/a-propos/')); ?>">✨ À propos</a>
      <a class="secondary-link" href="<?php echo esc_url(home_url('/proposition/')); ?>">🫟 Proposition</a>
      <a class="secondary-link" href="<?php echo esc_url(home_url('/contact/')); ?>">📞 Contact</a>
      <a class="secondary-link" href="https://web.wavesofsounds.space" rel="noopener noreferrer">🎵 SoundWave</a>
    </nav>
    
    <!-- =========================
         HEADER SITE
    ========================= -->
    <header>
      <div class="site-branding">
        <!-- LOGO -->
        <?php if (has_custom_logo()) :
          the_custom_logo();
        endif; ?>
    
        <!-- TITLE SEO -->
        <?php if (is_front_page() || is_home()) : ?>
          <h1><a href="<?php echo esc_url(home_url('/')); ?>"><?php bloginfo('name'); ?></a></h1>
        <?php else : ?>
          <p><a href="<?php echo esc_url(home_url('/')); ?>"><?php bloginfo('name'); ?></a></p>
        <?php endif; ?>
    
        <!-- TAGLINE -->
        <?php if (get_bloginfo('description')) : ?>
          <p id="slogan"><?php bloginfo('description'); ?></p>
        <?php endif; ?>
      </div>
    
      <!-- SEARCH -->
      <form id="header-search" role="search" method="get" action="<?php echo home_url('/'); ?>">
        <span class="search-icon">🔍</span>
        <input 
          type="search" 
          name="s" 
          placeholder="Rechercher un article, un mot-clé..." 
          value="<?php echo get_search_query(); ?>"
        >
      </form>
    
      <!-- AUTH -->
      <div class="header-auth">
        <?php if (is_user_logged_in()) :

          if (current_user_can('edit_posts')) : ?>
            <a href="<?php echo esc_url(admin_url()); ?>">Admin</a>
          <?php endif; ?>

          <a href="<?php echo esc_url(wp_logout_url(home_url())); ?>">Déconnexion</a>

        <?php else : ?>

          <a href="<?php echo esc_url(wp_login_url()); ?>">Connexion</a>

        <?php endif; ?>
      </div>
    </header>