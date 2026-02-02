## PAGE SPLASH DHTML

### Type de splash choisi

- [ ] **Page vignette-détail**  
      Quand on clique sur une vignette, une section détail apparaît ou se remplit
      
- [X] **Liste d'items avec révélation**  
      Boutons "en savoir plus" ou interactions qui dévoilent du contenu
      
- [ ] **Site déroulant interactif**  
      À mesure qu'on scrolle, des objets s'animent, apparaissent, disparaissent
      
- [ ] **Animation HTML5 complexe**  
      Orchestration de plusieurs animations CSS et effets d'apparition/disparition

### Description de ma page splash

**URL de la page:** `web.wavesofsounds.space/________/`

**Données affichées:** Album de l'année, du mois, le meilleur album (selon les votes).
<!-- (ex: équipe, personnages, galerie photos, FAQ, etc.) -->

**Interactions prévues:** Découvrir des nouvelles informations sur les albums et les musiques populaires.
<!-- (décrire comment l'utilisateur va interagir avec la page) -->

**Effets visuels:** Transition, changement de couleurs, apparition d'éléments après click.
<!-- (décrire les animations, transitions, apparitions prévues) -->


<!-- - - - - - - - - - - - - - - - - - - - - - - - - -->
<!-- - - - - - - - - - - - - - - - - - - - - - - - - -->
<!-- - - - - - - - - - - - - - - - - - - - - - - - - -->
---
<!-- - - - - - - - - - - - - - - - - - - - - - - - - -->
<!-- - - - - - - - - - - - - - - - - - - - - - - - - -->
<!-- - - - - - - - - - - - - - - - - - - - - - - - - -->

## AUTOCOMPLETE

### Champ de recherche

**Placeholder du champ:** Rechercher un album/chanson à partir de la chanson/album
<!-- (ex: "Rechercher un produit...", "Trouver une formation...", etc.) -->

**Données recherchées:** Album et musiques, date sortie, artiste
<!-- (ex: noms de produits, titres de films, noms de personnages, etc.) -->

### Suggestions

**Nombre de suggestions affichées:** `10` 
<!-- (ex: 5, 10, etc.) -->

**Format d'affichage des suggestions:** Nom + année de sortie + artiste
<!-- (ex: nom seulement, nom + image, nom + catégorie, etc.) -->

**ID de la liste de suggestions:** `_________________`

**Classe CSS d'une suggestion:** `_________________`

**Classe CSS d'une suggestion survolée:** `_________________`

### Structure de données

**Nom de la table:** `morceau` et `album` (2 tables parce que album et morceau c'est different)

**Champs recherchés:**
- `album.nom` 
- `morceau.titre`
- `album.artiste` et `morceau.artiste` (une chanson avec un feat)
- `album.date_sortie`

### Comportement après clic sur suggestion

- [ ] **Suggestion directe:** mène directement à la page détail de l'item  
      URL de la page détail: `web.wavesofsounds.space/_________________`
      
- [X] **Suggestion vers recherche:** affiche une page liste de résultats  
      URL de la page liste: `web.wavesofsounds.space/_________________`  
      URL de la page détail: `web.wavesofsounds.space/_________________`

<!-- - - - - - - - - - - - - - - - - - - - - - - - - -->
<!-- - - - - - - - - - - - - - - - - - - - - - - - - -->
<!-- - - - - - - - - - - - - - - - - - - - - - - - - -->
---
<!-- - - - - - - - - - - - - - - - - - - - - - - - - -->
<!-- - - - - - - - - - - - - - - - - - - - - - - - - -->
<!-- - - - - - - - - - - - - - - - - - - - - - - - - -->

## MARQUE-PAGE / LIKE

### Choix visuels

**Symbole choisi:** coeur
<!-- (ex: cœur, étoile, signet, pouce levé, etc.) -->

**État NON-CHOISI:**
- Classe CSS: `_________________`
- Apparence: cœur vide <!-- (ex: cœur vide gris, étoile contour noir, etc.) -->

**État CHOISI:**
- Classe CSS: `_________________`
- Apparence: cœur plein <!-- (ex: cœur plein rouge, étoile jaune, etc.) -->

### Structure de données

**Nom de la table:** `favori`

**Champs de la table:**
- `id`
- `id_utilisateur`
- `id_morceau`
- `date`

### Pages

**URL de la page avec les items likables:**  
`web.wavesofsounds.space/_________________`

**URL de la page affichant la liste des favoris:**  
`web.wavesofsounds.space/_________________`  
(optionnel)

<!-- - - - - - - - - - - - - - - - - - - - - - - - - -->
<!-- - - - - - - - - - - - - - - - - - - - - - - - - -->
<!-- - - - - - - - - - - - - - - - - - - - - - - - - -->
---
<!-- - - - - - - - - - - - - - - - - - - - - - - - - -->
<!-- - - - - - - - - - - - - - - - - - - - - - - - - -->
<!-- - - - - - - - - - - - - - - - - - - - - - - - - -->

## NOTATION PAR ÉTOILES

### Affichage visuel

**Classe CSS étoile VIDE:** `_________________`

**Classe CSS étoile PLEINE:** `_________________`

### Stratégie d'enregistrement

- [X] **Enregistrer chaque vote individuellement**  
      (permet de recalculer la moyenne, de voir l'historique, de modifier son vote)
      
- [ ] **Enregistrer seulement le total et la moyenne**  
      (plus simple, mais impossible de modifier un vote ou voir l'historique)

### Structure de données

**Nom de la table:** `vote`

**Champs de la table:**
- `id` (ex: id_vote)
- `id_utilisateur` (ex: id_utilisateur)
- `id_album` (ex: id_item)
- `note` (ex: note)
- `date` (ex: date_vote)

<!-- - - - - - - - - - - - - - - - - - - - - - - - - -->
<!-- - - - - - - - - - - - - - - - - - - - - - - - - -->
<!-- - - - - - - - - - - - - - - - - - - - - - - - - -->
---
<!-- - - - - - - - - - - - - - - - - - - - - - - - - -->
<!-- - - - - - - - - - - - - - - - - - - - - - - - - -->
<!-- - - - - - - - - - - - - - - - - - - - - - - - - -->

## COMMENTAIRES

### Formulaire de commentaire

**ID du textarea:** `_________________`

**ID du bouton d'envoi:** `_________________`

### Affichage des commentaires

**Ordre d'affichage:**
- [X] Nouveaux commentaires en HAUT (ordre chronologique inversé)
- [ ] Nouveaux commentaires en BAS (ordre chronologique)

**ID de la zone d'affichage des commentaires:** `_________________`

**Classe CSS d'un commentaire:** `_________________`

### Rafraîchissement automatique

**Intervalle de vérification:** `30` secondes (ex: 5, 10, 15)

**Stratégie de récupération:**
- [X] Recharger TOUS les commentaires à chaque intervalle
- [ ] Recharger seulement les NOUVEAUX commentaires depuis le dernier ID

### Structure de données

**Nom de la table:** `commentaire`

**Champs de la table:**
- `id` (ex: id_commentaire)
- `id_utilisateur` (ex: id_utilisateur ou nom_auteur)
- `id_album` (ex: id_item commenté)
- `message` (ex: message)
- `date` (ex: date_publication)
