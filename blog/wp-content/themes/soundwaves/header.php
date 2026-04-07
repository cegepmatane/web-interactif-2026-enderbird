<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="images/icon.svg" type="image/x-icon">

    <!-- <script src="js/general.js" defer></script> -->
    <script src="<?php echo get_template_directory_uri(); ?>/decoration/js/general.js" defer></script>
    <!-- <link rel="stylesheet" href="css/general.css"> -->
    <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/style.css">
    <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/decoration/css/general.css">
</head>
<body>

    <!-- Navigation du projet -->
    <nav id="navigation-projet">
        <!-- <a href="index.php" class="lien-navigation accueil">🏠 Accueil</a>
        <a href="splash.php" class="lien-navigation splash">🫟 Splash</a>
        <a href="liste-albums.php" class="lien-navigation liste">🎵 Albums</a>
        <a href="https://web-projet-app.wavesofsounds.space" class="lien-navigation accueil">🔊 App</a>
        <a href="blog/" class="lien-navigation blog">📝 Blog</a>
        <a href="espace-membre.php" class="lien-navigation espace">✨ Mon Espace</a>
        <a href="admin/index.php" class="lien-navigation admin">⚙️ Admin</a> -->

        <a href="<?=get_home_url()?>/" class="lien-navigation blog">🏠 Accueil</a>
        <a href="<?=get_home_url()?>/liste-albums/" class="lien-navigation liste">🎵 Albums</a>
        <!-- <a href="/curriculum/">🔊 App</a> -->
    </nav>

    <!-- En-tête -->
    <header id="entete-principal">
        <h1 id="titre-site">SoundWave</h1>
        <p id="slogan">Ta musique, ton style</p>
    </header>

<?php wp_head(); ?>