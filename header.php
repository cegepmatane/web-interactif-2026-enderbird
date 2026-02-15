<?php
session_start(); // Pour avoir $_SESSION

// Si pas d’utilisateur en session prendre un utilisateur par défaut
if (!isset($_SESSION['id_utilisateur'])) $_SESSION['id_utilisateur'] = 1;

// Charger l’utilisateur actif - IMPORTANT
require_once "accesseur/UtilisateurDAO.php";
$utilisateur = UtilisateurDAO::detaillerUtilisateur(new Utilisateur(['id' => $_SESSION['id_utilisateur']]));
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="images/icon.svg" type="image/x-icon">

    <!-- #1 AJAX  -->
    <script src="js/ajax-recherche.js" defer></script>
    <!-- #6 AJAx -->
    <script src="js/ajax-utilisateur.js" defer></script>

    <script src="js/general.js" defer></script>
    <link rel="stylesheet" href="css/general.css">
</head>
<body>

    <!-- Navigation du projet -->
    <nav id="navigation-projet">
         <!-- Navigation des utilisateurs -->
        <div id="navigation-utilisateur"> <?php
            $idUtilisateurActuel = $utilisateur->id;
        
            $utilisateurs = UtilisateurDAO::listerUtilisateurs();
            // Mettre au début l'utilisateur actif
            usort($utilisateurs, function($utilisateur1, $utilisateur2) use ($idUtilisateurActuel) {
                return ($utilisateur2->id === $idUtilisateurActuel) <=> ($utilisateur1->id === $idUtilisateurActuel);
            });
        
            foreach ($utilisateurs as $utilisateurTemp) {
                $actif = ($utilisateurTemp->id === $idUtilisateurActuel) ? 'actif' : '';
                echo '<a href="#" class="utilisateur ' . $actif . '" data-user-id="' . $utilisateurTemp->id . '">';
                echo '    <img src="images/utilisateurs/' . htmlspecialchars($utilisateurTemp->fichier_image) . '" alt="avatar">';
                echo '    <span>' . htmlspecialchars($utilisateurTemp->pseudo) . '</span>';
                echo '    <span>' . htmlspecialchars($utilisateurTemp->email) . '</span>';
                echo '</a>';
            } ?>
        </div>

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
