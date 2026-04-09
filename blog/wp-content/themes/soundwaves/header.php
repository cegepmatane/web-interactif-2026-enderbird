<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Favicon -->
    <link rel="shortcut icon" href="<?php echo get_template_directory_uri(); ?>/decoration/icon.svg" type="image/x-icon">
    <!-- Styles -->
    <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/style.css">
    <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/decoration/css/general.css">
    <!-- Scripts -->
    <script src="<?php echo get_template_directory_uri(); ?>/decoration/js/general.js" defer></script>

    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

<!-- NAVIGATION PRINCIPALE (MENU WORDPRESS) -->
<nav id="navigation-projet">

    <?php
    wp_nav_menu([
        'theme_location' => 'primary',
        'container'      => false,
        'menu_class'     => 'menu-principal',
        'fallback_cb'    => false
    ]);
    ?>

    <!-- LIENS SECONDAIRES (exemple custom) -->
    <div class="liens-secondaires">
        <a href="<?=home_url('/')?>" class="lien-navigation accueil">🏠 Accueil</a>
        <a href="<?=home_url('/a-propos/')?>" class="lien-navigation propos">✨ À propos</a>
        <a href="<?=home_url('/proposition/')?>" class="lien-navigation proposition">🔊 Proposition</a>
        <a href="<?=home_url('/contact/')?>" class="lien-navigation contact">📝 Contact</a>
        <a href="https://web.wavesofsounds.space" class="lien-navigation accueil">🌐 SoundWave (original)</a>
    </div>
</nav>

<!-- HEADER -->
<header id="entete-principal">
        <h1 id="titre-site"><?php bloginfo("title"); ?></h1>
    <div class="bloc-logo">

        <!-- LOGO (personnalisable dans WP) -->
        <?php if (has_custom_logo()) : ?>
            <div class="logo-site"><?php the_custom_logo(); ?></div>
        <?php else : ?>
            <h1 id="titre-site"><a href="<?php echo home_url('/'); ?>"><?php bloginfo('name'); ?></a></h1>
        <?php endif; ?>

        <!-- SLOGAN -->
        <span id="slogan"><?php bloginfo('description'); ?></span>
    </div>

    <!-- BOUTON LOGIN / LOGOUT -->
    <div class="auth">
        <?php if (is_user_logged_in()) : ?>
            <a href="<?php echo admin_url(); ?>" class="bouton-header">⚙️ Admin</a>
            <a href="<?php echo wp_logout_url(home_url()); ?>" class="bouton-header">🚪 Déconnexion</a>
        <?php else : ?>
            <a href="<?php echo wp_login_url(); ?>" class="bouton-header">🔑 Connexion</a>
        <?php endif; ?>
    </div>
</header>

<?=wp_head()?>