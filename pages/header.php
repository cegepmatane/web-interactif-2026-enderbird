<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
    <!-- Navigation du projet -->
    <nav id="navigation-projet">
        <a href="../soundwave/index.php" class="lien-navigation accueil">🏠 Accueil</a>
        <a href="../journal/index.php" class="lien-navigation blog">📝 Blog</a>
        <a href="../espace/index.php" class="lien-navigation application">✨ Mon Espace</a>
        <a href="../admin/index.php" class="lien-navigation admin">⚙️ Admin</a>
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
                <div class="suggestion">
                    <div class="suggestion-pochette"></div>
                    <div class="suggestion-info">
                        <div class="suggestion-titre">Neon Dreams</div>
                        <div class="suggestion-artiste">Synthwave Collective</div>
                    </div>
                </div>
                <div class="suggestion">
                    <div class="suggestion-pochette"></div>
                    <div class="suggestion-info">
                        <div class="suggestion-titre">Midnight City</div>
                        <div class="suggestion-artiste">Electric Pulse</div>
                    </div>
                </div>
                <div class="suggestion">
                    <div class="suggestion-pochette"></div>
                    <div class="suggestion-info">
                        <div class="suggestion-titre">Digital Love</div>
                        <div class="suggestion-artiste">Cyber Symphony</div>
                    </div>
                </div>
            </div>
        </div>
    </header>