<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <script src="js/general.js" defer></script>
    <link rel="stylesheet" href="css/general.css">

    <!-- #1 - Ajax -->
    <script src="js/recherche.js" defer></script>
</head>
<body>
    <!-- Navigation du projet -->
    <nav id="navigation-projet">
        <a href="index.php" class="lien-navigation accueil">🏠 Accueil</a>
        <a href="splash.php" class="lien-navigation splash">🫟 Splash</a>
        <a href="liste-albums.php" class="lien-navigation liste">🎵 Albums</a>
        <a href="journal.php" class="lien-navigation blog">📝 Blog</a>
        <a href="espace-membre.php" class="lien-navigation espace">✨ Mon Espace</a>
        <a href="admin/index.php" class="lien-navigation admin">⚙️ Admin</a>
    </nav>

    <!-- En-tête -->
    <header id="entete-principal">
        <h1 id="titre-site">SoundWave</h1>
        <p id="slogan">Ta musique, ton style</p>

        <!-- AJAX #1 : Recherche auto-complete -->
        <div id="zone-recherche">
            <span id="icone-recherche">🔍</span>
            <input type="text" id="champ-recherche" placeholder="Rechercher un artiste, un album, une piste...">
            <div id="liste-suggestions">
                <!-- <div class="suggestion">
                    <div class="suggestion-pochette"></div>
                    <div class="suggestion-info">
                        <div class="suggestion-titre">Neon Dreams</div>
                        <div class="suggestion-artiste">Synthwave Collective</div>
                    </div>
                </div> -->
            </div>
        </div>
    </header>
