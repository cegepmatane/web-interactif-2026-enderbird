<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="<?=get_template_directory_uri()?>/decoration/icon.svg" type="image/x-icon">

    <!-- <script src="js/general.js" defer></script> -->
    <script src="<?=get_template_directory_uri()?>/decoration/js/general.js" defer></script>
    <!-- <link rel="stylesheet" href="css/general.css"> -->
    <link rel="stylesheet" href="<?=get_template_directory_uri()?>/style.css">
    <link rel="stylesheet" href="<?=get_template_directory_uri()?>/decoration/css/general.css">
</head>
<body>

    <!-- Navigation du projet -->
    <nav id="navigation-projet">
        <?php $root_url = 'https://web.wavesofsounds.space'; ?>

        <a href="<?= $root_url ?>" class="lien-navigation accueil">🏠 Accueil</a>
        <a href="<?= $root_url ?>/splash.php" class="lien-navigation splash">🫟 Splash</a>
        <a href="<?= $root_url ?>/liste-albums.php" class="lien-navigation liste">🎵 Albums</a>
        <a href="https://web-projet-app.wavesofsounds.space" class="lien-navigation accueil">🔊 App</a>
        <a href="<?=get_home_url()?>/" class="lien-navigation blog">📝 Blog</a>
        <a href="<?= $root_url ?>/espace-membre.php" class="lien-navigation espace">✨ Mon Espace</a>
        <a href="<?= $root_url ?>/admin/index.php" class="lien-navigation admin">⚙️ Admin</a>
    </nav>

    <nav id="navigation-blog">
        <a href="<?=get_home_url()?>/" class="lien-navigation accueil">🏠 Accueil</a>
        <a href="<?=get_home_url()?>/a-propos/" class="lien-navigation propos">✨ À propos</a>
        <a href="<?=get_home_url()?>/proposition/" class="lien-navigation proposition">🔊 Proposition</a>
        <a href="<?=get_home_url()?>/curriculum/" class="lien-navigation curriculum">🫟 Curriculum</a>
        <a href="<?=get_home_url()?>/contact/" class="lien-navigation contact">📝 Contact</a>
    </nav>

    <!-- En-tête -->
    <header id="entete-principal">
        <h1 id="titre-site"><?php bloginfo("title"); ?></h1>
        <span id="slogan"><?php bloginfo("description"); ?></span>
    </header>

<?=wp_head()?>