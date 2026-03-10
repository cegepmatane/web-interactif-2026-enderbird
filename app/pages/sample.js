import Head from "next/head";
import styles from "@/styles/Sample.module.css";
import { useEffect, useState } from "react";
import samples from '../donnees/samples.json';
import BlocSample from '../composants/BlocSample';
import PopupSample from '../composants/PopupSample';

const TYPES = {
  'one-shot':  { etiquette: 'One-shot',       couleur: '#ff004c', icone: '🔊' },
  morceau:     { etiquette: 'Morceau',        couleur: '#ffae00', icone: '🎵' },
  fx:          { etiquette: 'FX',             couleur: '#0088ff', icone: '✨' },
  loop:        { etiquette: 'Loop',           couleur: '#ff006a', icone: '🔁' },
  vocal:       { etiquette: 'Vocal',          couleur: '#fbff00', icone: '🎤' },
  remix:       { etiquette: 'Remix',          couleur: '#ff0000', icone: '🎛️' }
}; 

const CATEGORIES = {
  court:       { etiquette: 'Court',         couleur: '#6c5ce7' },
  long:        { etiquette: 'Long',          couleur: '#00b894' },
  evenements:  { etiquette: 'Événements',    couleur: '#f0932b' },
  routage:     { etiquette: 'Routage',       couleur: '#e17055' },
  'cycle-vie': { etiquette: 'Cycle de vie',  couleur: '#0984e3' },
  styles:      { etiquette: 'Styles',        couleur: '#e84393' },
  donnees:     { etiquette: 'Données',       couleur: '#00cec9' }
};

export default function Sample() {
  const [typeActif, definirTypeActif] = useState('one-shot');
  const [categorieActive, definirCategorieActive] = useState('toutes');
  const [recherche, definirRecherche] = useState('');
  const [conceptActif, definirConceptActif] = useState(null);
  const [cleAnimation, definirCleAnimation] = useState(0);

  /* Charger le sample choisi depuis localStorage */
  useEffect(() => {
    const sauvegarde = localStorage.getItem('typeChoisi');
    if (sauvegarde && TYPES[sauvegarde]) {
      definirTypeActif(sauvegarde);
    }
  }, []);

  /* Changer de sample avec animation */
  function changersample(cle) {
    definirTypeActif(cle);
    definirCleAnimation((ancienne) => ancienne + 1);
    localStorage.setItem('typeChoisi', cle);
  }

  /* Filtrer les samples - RECHERCHE EN TEMPS RÉEL */
  const samplesFiltres = samples.filter((concept) => {
    const correspondRecherche = concept.titre.toLowerCase().includes(recherche.toLowerCase()) || concept.description.toLowerCase().includes(recherche.toLowerCase());

    const correspondCategorie = categorieActive === 'toutes' || concept.categorie === categorieActive;

    const correspondType = concept.type === typeActif;

    return correspondRecherche && correspondCategorie && correspondType;
  });

  /* samples reliés pour le popup (même catégorie, différent du concept actif) */
  const samplesRelies = conceptActif
    ? samples
        .filter((concept) =>
          concept.categorie === conceptActif.categorie && concept.id !== conceptActif.id
        )
        .slice(0, 3)
    : [];

  return (
    <>
      {
      /* - - - SAMPLE - - - */
      }
      <Head>
        <title>Sample</title>
        <meta name="viewport" content="width=device-width, initial-scale=1" />
      </Head>
      {
      /* - - - LE CORPS - - - */
      }

      <div className={styles.main}>
        {/* Sélecteur de sample */}
        <div className={styles.selecteurSample}>
          {Object.entries(TYPES).map(([cle, sample]) => (
            <button
              key={cle}
              className={`${typeActif === cle ? 'actif' : ''}`}
              onClick={() => changersample(cle)}
              style={typeActif === cle ? {
                borderColor: sample.couleur,
                color: sample.couleur === '#000000' ? '#ffffff' : sample.couleur,
                backgroundColor: '#ffffff',
                transform: 'scale(1.1)'
              } : {}}
            >
              <span className="selecteur-onglet-icone">{sample.icone}</span>
              {sample.etiquette}
            </button>
          ))}
        </div>

        {/* Recherche */}
        <div id="boite-recherche">
          <span id="icone-recherche">🔍</span>
          <input
            id="champs-recherche"
            type="text"
            placeholder="Rechercher un concept..."
            value={recherche}
            onChange={(evenement) => definirRecherche(evenement.target.value)}
          />
        </div>

        {/* Filtres de catégorie */}
        <div id="filtres-categorie">
          <button
            className={`filtre-categorie ${categorieActive === 'toutes' ? 'filtre-categorie-actif' : ''}`}
            onClick={() => definirCategorieActive('toutes')}
          >
            Toutes
          </button>
          {Object.entries(CATEGORIES).map(([cle, categorie]) => (
            <button
              key={cle}
              className={`filtre-categorie ${categorieActive === cle ? 'filtre-categorie-actif' : ''}`}
              onClick={() => definirCategorieActive(cle)}
              style={categorieActive === cle ? {
                backgroundColor: categorie.couleur,
                borderColor: categorie.couleur,
                color: 'white'
              } : {
                borderColor: `${categorie.couleur}40`,
                color: categorie.couleur
              }}
            >
              {categorie.etiquette}
            </button>
          ))}
        </div>

        {/* Compteur de résultats */}
        <p className="compteur-resultats">
          {samplesFiltres.length} fiche{samplesFiltres.length > 1 ? 's' : ''}
          {categorieActive !== 'toutes' && ` · ${CATEGORIES[categorieActive].etiquette}`}
          {recherche && ` · « ${recherche} »`}
        </p>

        {/* Grille de samples */}
        {samplesFiltres.length > 0 ? (
          <div className="grille-samples" key={cleAnimation}>
            {samplesFiltres.map((concept, indexConcept) => (
              <div
                key={concept.id}
                style={{
                  animation: `apparitionBloc 0.4s ease-out ${indexConcept * 0.05}s both`
                }}
              >
                <BlocSample
                  concept={concept}
                  cadricicielActif={typeActif}
                  surClic={definirConceptActif}
                  couleurCategorie={CATEGORIES[concept.categorie]?.couleur || '#888'}
                  etiquetteCategorie={CATEGORIES[concept.categorie]?.etiquette || concept.categorie}
                  variante="complet"
                />
              </div>
            ))}
          </div>
        ) : (
          <div className="message-vide">
            <span className="message-vide-icone">🔍</span>
            <p>Aucun concept trouvé pour cette recherche.</p>
          </div>
        )}

        {/* Popup du concept sélectionné */}
        {conceptActif && (
          <PopupSample
            concept={conceptActif}
            cadricicielActif={typeActif}
            surFermer={() => definirConceptActif(null)}
            couleurCategorie={CATEGORIES[conceptActif.categorie]?.couleur || '#888'}
            etiquetteCategorie={CATEGORIES[conceptActif.categorie]?.etiquette || conceptActif.categorie}
            samplesRelies={samplesRelies} // pas utlisé encore
          />
        )}
      </div>
    </>
  );
}
