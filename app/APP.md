## MINI-PROJET APP -- SPA

### Informations générales

- **Cadriciel choisi** : [ ] React  [X] Next.js  [ ] Vue.js
- **Nom de l'application** : Samplage
- **Description en une phrase** : Page pour découvrir des samples audio de plein de types et catégories
- **URL** : `https://web-projet-app.wavesofsounds.space/`

---

### 1. PAGE DE DONNÉES ET AIDE

- **Option choisie** : [ ] Page de choix  [X] Page de résultats
- **Données JSON** : `sample.json`
```
{
    "id": "1",
    "titre": "Nom du sample",
    "album": "Peut être vide s'il n'y a pas d'album",
    "artiste": "S'il y en a un",
    "dateCreation": "Toujours une année",
    "resume": "Petit résumé de la description",
    "description": "3 ou 4 lignes pour décrire",
    "type": "Type",
    "categorie": "Catégorie"
}
```
- **Ce que l'utilisateur voit en arrivant** : `Page d'accueil où on peut changer le type`

- **Sujets d'aide** (3+ sujets) :
- /aide/1 : `Morceau musical`
- /aide/2 : `One-shot`
- /aide/3 : `Loop`
- /aide/4 : `Sample vocal`
- /aide/5 : `Effet sonore (FX)`
- /aide/5 : `Remix`

---

### 2. PAGE INTERACTIVE

- **Événements utilisateur** (3+ types) :
    - [X] **Clic/tap** : `Page acceuil, page recherche, page aide (changer/afficher un élément)`
    - [X] **Saisie clavier** : `Champs de recherche`
    - [X] **Survol** : `hover page d'accueil (et du hover de css partout)`
    - [ ] **Glisser-déposer** : _______________
    - [X] **Défilement** : `Page d'accueil`
    - [ ] **Minuterie** : _______________

- **Effets visuels** (2+ effets) :
    - [X] Scrollable page accueuil
    - [X] Éléments s'affichent de façon dynamiques dans la page de recherche quand elle est updatée

---

### 3. COMPOSANTS PARAMÉTRÉS

- **Composant popup** :
    - Déclenché par : `onClick()`
    - Données affichées : `PopupSample, de sample.json`
    - Effet d'apparition : `Transition opacité`

- **Composant réutilisable** :
    - Nom du composant : `BlocSample`
    - Props reçues : `Infos des samples`
    - Comportement paramétrable : `La couleur (background) / Titre... (+infos samples)`
    - Utilisé dans : 1. `Page recherche` 2. `Page aide`

---

### 4. FILTRE ET PERSISTANCE

- **Recherche/filtre** : `sample.json -> type, catégorie, champs recherche, date`
(où dans l'app et sur quelles données)

- **État persistant** : `tout dans le filtre en haut sauf type`
(quoi est sauvegardé, où est-ce lu)