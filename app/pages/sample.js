import Head from "next/head";
import styles from "@/styles/Sample.module.css";
import { useState, useEffect, useMemo } from "react";
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
  drums:        { etiquette: 'Drums',        couleur: '#ff7675' },
  bass:         { etiquette: 'Bass',         couleur: '#fdcb6e' },
  melodie:      { etiquette: 'Mélodie',      couleur: '#6c5ce7' },
  ambiance:     { etiquette: 'Ambiance',     couleur: '#00cec9' },
  transition:   { etiquette: 'Transition',   couleur: '#e84393' },
  voix:         { etiquette: 'Voix',         couleur: '#00b894' },
  experimental: { etiquette: 'Experimental', couleur: '#636e72' }
};

export default function Sample() {
  // Par défaut, pas de type sélectionné -> tout afficher
  const [typeActif, definirTypeActif] = useState('');
  const [categorieActive, definirCategorieActive] = useState('');
  const [recherche, definirRecherche] = useState('');
  const [conceptActif, definirConceptActif] = useState(null);
  const [cleAnimation, definirCleAnimation] = useState(0);
  const [affiches, setAffiches] = useState([]);

  /* Charger le sample choisi depuis localStorage */
  useEffect(() => {
    const sauvegarde = localStorage.getItem('typeChoisi');
    if (sauvegarde && TYPES[sauvegarde]) {
      definirTypeActif(sauvegarde);
    }
  }, []);

  /* Changer de sample avec animation */
  function changersample(cle) {
    // Si le type cliqué est déjà actif, on le déselectionne (affiche tous)
    const nouveauType = typeActif === cle ? '' : cle;
    definirTypeActif(nouveauType);
    definirCleAnimation((ancienne) => ancienne + 1);
    localStorage.setItem('typeChoisi', nouveauType);
  }

  /* Filtrer les samples - RECHERCHE EN TEMPS RÉEL */

const samplesFiltres = useMemo(() => {
  return samples
    .filter((concept) => {
      const correspondRecherche =
        concept.titre.toLowerCase().includes(recherche.toLowerCase()) ||
        concept.description.toLowerCase().includes(recherche.toLowerCase()) ||
        concept.artiste.toLowerCase().includes(recherche.toLowerCase());

      const correspondCategorie =
        !categorieActive || concept.categorie === categorieActive;

      const correspondType =
        !typeActif || concept.type === typeActif;

      return correspondRecherche && correspondCategorie && correspondType;
    })
    .sort((a, b) => {
      const dateA = parseInt(a.dateCreation);
      const dateB = parseInt(b.dateCreation);

      if (isNaN(dateA) && isNaN(dateB)) return 0;
      if (isNaN(dateA)) return 1;
      if (isNaN(dateB)) return -1;

      return dateA - dateB; // récent → ancien
    });
  }, [recherche, categorieActive, typeActif]);
  
  useEffect(() => {
    setAffiches(samplesFiltres);
  }, [samplesFiltres]);

  /* samples reliés pour le popup (même catégorie, différent du concept actif) */
  const samplesRelies = conceptActif
    ? samples.filter((concept) => concept.categorie === conceptActif.categorie && concept.id !== conceptActif.id).slice(0, 3)
    : [];

  return (
    <>
      <Head>
        <title>Sample</title>
        <meta name="viewport" content="width=device-width, initial-scale=1" />
      </Head>

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
              <span className={styles.selecteurOngletIcone}>{sample.icone}</span>
              {sample.etiquette}
            </button>
          ))}
        </div>

        {/* Recherche */}
        <div className={styles.zoneRecherche}>
          <span className={styles.iconeRecherche}>🔍</span>
          <input
            className={styles.champsRecherche}
            type="text"
            placeholder="Rechercher un concept..."
            value={recherche}
            onChange={(evenement) => definirRecherche(evenement.target.value)}
          />
        </div>

        {/* Filtres de catégorie */}
        <div className={styles.filtresCategorie}>
          {Object.entries(CATEGORIES).map(([cle, categorie]) => (
            <button
              key={cle}
              className={`${styles.filtreCategorie} ${categorieActive === cle ? styles.filtreCategorieActif : ''}`}
              onClick={() => definirCategorieActive(cle === categorieActive ? '' : cle)}
              style={categorieActive === cle ? {
                borderColor: categorie.couleur,
                backgroundColor: '#fff',
                color: categorie.couleur
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
        <p className={styles.compteurResultats}>
          {samplesFiltres.length} fiche{samplesFiltres.length > 1 ? 's' : ''}
          {categorieActive && ` · ${CATEGORIES[categorieActive]?.etiquette || 'Toutes'}`}
          {recherche && ` · « ${recherche} »`}
        </p>

        {/* Grille de samples */}
        {affiches.length > 0 ? (
          <div className={styles.grilleSamples}>
            {affiches.map((concept, indexConcept) => (
              <div
                key={`${concept.id}-${cleAnimation}`} // force React to remount
                className={styles.apparitionBloc}
                style={{ 
                  animationDelay: `${indexConcept * 0.05}s`
                }}
              >
                <BlocSample
                  concept={concept}
                  typeActif={typeActif}
                  surClic={definirConceptActif}
                  couleurCategorie={CATEGORIES[concept.categorie]?.couleur || '#888'}
                  etiquetteCategorie={CATEGORIES[concept.categorie]?.etiquette || concept.categorie}
                />
              </div>
            ))}
          </div>
          ) : (
            <div className={styles.messageVide}>
              <span className={styles.messageVideIcone}>🔍</span>
              <p>Aucun concept trouvé pour cette recherche.</p>
            </div>
          )}

        {/* Popup du concept sélectionné */}
        {conceptActif && (
          <PopupSample
            concept={conceptActif}
            ongletInitial={conceptActif.type}
            surFermer={() => definirConceptActif(null)}
            couleurCategorie={CATEGORIES[conceptActif.categorie]?.couleur || '#888'}
            etiquetteCategorie={CATEGORIES[conceptActif.categorie]?.etiquette || conceptActif.categorie}
            samplesRelies={samplesRelies}
          />
        )}
      </div>
    </>
  );
}