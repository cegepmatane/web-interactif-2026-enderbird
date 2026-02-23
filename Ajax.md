# PAGE SPLASH DHTML

**URL de la page:** https://web.wavesofsounds.space/splash.php

- - -

### Type de splash choisi...

- [ ] **Page vignette-détail**  
      Quand on clique sur une vignette, une section détail apparaît ou se remplit
      
- [X] **Liste d'items avec révélation**  
      Boutons "en savoir plus" ou interactions qui dévoilent du contenu
      
- [ ] **Site déroulant interactif**  
      À mesure qu'on scrolle, des objets s'animent, apparaissent, disparaissent
      
- [ ] **Animation HTML5 complexe**  
      Orchestration de plusieurs animations CSS et effets d'apparition/disparition

- - -

### Description de ma page splash...


**Données affichées:** Pistes, durée, date sortie, type, morceaux de l'album
<!-- (ex: équipe, personnages, galerie photos, FAQ, etc.) -->

**Interactions prévues:** Découvrir des informations sur les albums avec un click.
<!-- (décrire comment l'utilisateur va interagir avec la page) -->

**Effets visuels:** Apparition d'éléments après click sur la couverture de l'album avec transition visuels.
<!-- (décrire les animations, transitions, apparitions prévues) -->


<!-- - - - - - - - - - - - - - - - - - - - - - - - - -->
<!-- - - - - - - - - - - - - - - - - - - - - - - - - -->
<!-- - - - - - - - - - - - - - - - - - - - - - - - - -->
---
<!-- - - - - - - - - - - - - - - - - - - - - - - - - -->
<!-- - - - - - - - - - - - - - - - - - - - - - - - - -->
<!-- - - - - - - - - - - - - - - - - - - - - - - - - -->

# AUTOCOMPLETE

### Champ de recherche...

**Placeholder du champ:** Rechercher un album/chanson à partir de la chanson/album
<!-- (ex: "Rechercher un produit...", "Trouver une formation...", etc.) -->

**Données recherchées:** Album et musiques, date sortie, artiste
<!-- (ex: noms de produits, titres de films, noms de personnages, etc.) -->

- - -

### Suggestions...

**Nombre de suggestions affichées:** `10` 
<!-- (ex: 5, 10, etc.) -->

**Format d'affichage des suggestions:** Type (album/single/ep) + nom/titre + année de sortie + artiste
<!-- (ex: nom seulement, nom + image, nom + catégorie, etc.) -->

**ID de la liste de suggestions:** `liste-suggestions`

**Classe CSS d'une suggestion:** `suggestion`

**Classe CSS d'une suggestion survolée:** `suggestion:hover`

- - -

### Structure de données...

**Nom de la table:** `morceau` et `album` (2 tables parce que album et morceau c'est different)

**Champs recherchés:**
- `album.nom` / `morceau.titre`
- `album.artiste` / `morceau.artiste`
- `album.date_sortie` / `morceau.date_sortie`

- - -

### Comportement après clic sur suggestion...

- [X] **Suggestion directe:** mène directement à la page détail de l'item  
      URL de la page détail: https://web.wavesofsounds.space/liste-morceaux.php?id-album=1
  
- [ ] **Suggestion vers recherche:**

<!-- - - - - - - - - - - - - - - - - - - - - - - - - -->
<!-- - - - - - - - - - - - - - - - - - - - - - - - - -->
<!-- - - - - - - - - - - - - - - - - - - - - - - - - -->
---
<!-- - - - - - - - - - - - - - - - - - - - - - - - - -->
<!-- - - - - - - - - - - - - - - - - - - - - - - - - -->
<!-- - - - - - - - - - - - - - - - - - - - - - - - - -->

# MARQUE-PAGE / LIKE

**URL de la page affichant la liste des favoris:** https://web.wavesofsounds.space/espace-membre.php  

**URL de la page avec les items likables:**  
- https://web.wavesofsounds.space/index.php
- ET
- https://web.wavesofsounds.space/liste-albums.php et clicker sur un des albums pour voir la liste des morceaux qui peuvent être liké individuellement.

- - -

### Choix visuels...

**Symbole choisi:** coeur
<!-- (ex: cœur, étoile, signet, pouce levé, etc.) -->

**État NON-CHOISI:**
- Classe CSS: `bouton-piste` (techiquement `bouton-piste favori`, mais y'a pas de difference dans le css)
- Apparence: cœur vide <!-- (ex: cœur vide gris, étoile contour noir, etc.) -->

**État CHOISI:**
- Classe CSS: `bouton-piste favori actif`
- Apparence: cœur plein (rouge) <!-- (ex: cœur plein rouge, étoile jaune, etc.) -->

- - -

### Structure de données...

**Nom de la table:** `favori`

**Champs de la table:**
- `id`
- `id_utilisateur`
- `id_morceau`
- `date`

<!-- - - - - - - - - - - - - - - - - - - - - - - - - -->
<!-- - - - - - - - - - - - - - - - - - - - - - - - - -->
<!-- - - - - - - - - - - - - - - - - - - - - - - - - -->
---
<!-- - - - - - - - - - - - - - - - - - - - - - - - - -->
<!-- - - - - - - - - - - - - - - - - - - - - - - - - -->
<!-- - - - - - - - - - - - - - - - - - - - - - - - - -->

# NOTATION PAR ÉTOILES

**URL de la page:** https://web.wavesofsounds.space/index.php

- - - 

### Affichage visuel...

**Classe CSS étoile VIDE:** `etoile`

**Classe CSS étoile PLEINE:** `etoile active`

### Stratégie d'enregistrement

- [X] **Enregistrer chaque vote individuellement**  
      (permet de recalculer la moyenne, de voir l'historique, de modifier son vote)
      
- [ ] **Enregistrer seulement le total et la moyenne**  
      (plus simple, mais impossible de modifier un vote ou voir l'historique)

- - -

### Structure de données...

**Nom de la table:** `vote`

**Champs de la table:**
- `id_album` (ex: id_item) 
- `id_utilisateur` (ex: id_utilisateur) 
- `note` (ex: note)
- `date` (ex: date_vote)
  

<!-- - - - - - - - - - - - - - - - - - - - - - - - - -->
<!-- - - - - - - - - - - - - - - - - - - - - - - - - -->
<!-- - - - - - - - - - - - - - - - - - - - - - - - - -->
---
<!-- - - - - - - - - - - - - - - - - - - - - - - - - -->
<!-- - - - - - - - - - - - - - - - - - - - - - - - - -->
<!-- - - - - - - - - - - - - - - - - - - - - - - - - -->

# COMMENTAIRES

**URL de la page:** https://web.wavesofsounds.space/index.php

- - -

### Formulaire de commentaire...

**Classe de l'input:** `champ-commentaire`

**Classe du bouton d'envoi:** `bouton-commenter`

- - -

### Affichage des commentaires...

**Ordre d'affichage:**
- [X] Nouveaux commentaires en HAUT (ordre chronologique inversé)
- [ ] Nouveaux commentaires en BAS (ordre chronologique)

**ID de la zone d'affichage des commentaires:** `section-commentaires`

**Classe CSS d'un commentaire:** `commentaire`

- - -

### Rafraîchissement automatique...

**Intervalle de vérification:** `15` secondes

**Stratégie de récupération:**
- [X] Recharger TOUS les commentaires à chaque intervalle
- [ ] Recharger seulement les NOUVEAUX commentaires depuis le dernier ID

- - -

### Structure de données...

**Nom de la table:** `commentaire`

**Champs de la table:**
- `id` (ex: id_commentaire)
- `id_utilisateur` (ex: id_utilisateur)
- `id_album` (ex: id_item commenté)
- `message` (ex: message)
- `date` (ex: date_publication)

- - -