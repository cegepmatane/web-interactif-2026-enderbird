import { useState, useEffect } from 'react';
import styles from "@/styles/PopupSample.module.css";

function PopupSample({ concept, ongletInitial, surFermer, couleurCategorie, etiquetteCategorie }) {

  const [ongletCode, definirOngletCode] = useState(ongletInitial || '');
  const [fermeture, setFermeture] = useState(false);

  function fermerPopup() {
    setFermeture(true);

    setTimeout(() => {
      surFermer();
    }, 250); // durée animation
  }

  useEffect(() => {
    definirOngletCode(ongletInitial || '');
  }, [concept, ongletInitial]);

  useEffect(() => {
    function gererTouche(evenement) {
      if (evenement.key === 'Escape') fermerPopup();
    }

    document.addEventListener('keydown', gererTouche);
    document.body.style.overflow = 'hidden';

    return () => {
      document.removeEventListener('keydown', gererTouche);
      document.body.style.overflow = '';
    };
  }, []);

  return (
    <div
      className={`${styles.overlay} ${fermeture ? styles.fermeture : ''}`}
      onClick={fermerPopup}
    >
      <div
        className={`${styles.contenu} ${fermeture ? styles.contenuFermeture : ''}`}
        onClick={(e) => e.stopPropagation()}
      >
        <button className={styles.fermer} onClick={fermerPopup}>✕</button>

        <div className={styles.entete}>
          <span className={styles.icone}>{concept.dateCreation}</span>

          <div>
            <h2 className={styles.titre}>{concept.titre}{concept.artiste == "" ? "" : " - " + concept.artiste}</h2>

            <span
              className={styles.categorie}
              style={{
                backgroundColor: `${couleurCategorie}15`,
                color: couleurCategorie
              }}
            >
              {etiquetteCategorie}
            </span>

          </div>
        </div>

        <p className={styles.description}>{concept.description}</p>
      </div>
    </div>
  );
}

export default PopupSample;