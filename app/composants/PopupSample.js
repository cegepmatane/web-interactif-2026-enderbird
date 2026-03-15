import { useState, useEffect } from 'react';

const TYPES = {
  'one-shot': { etiquette: 'One-shot', couleur: '#ff004c' },
  morceau: { etiquette: 'Morceau', couleur: '#ffae00' },
  fx: { etiquette: 'FX', couleur: '#0088ff' },
  loop: { etiquette: 'Loop', couleur: '#ff006a' },
  vocal: { etiquette: 'Vocal', couleur: '#fbff00' },
  remix: { etiquette: 'Remix', couleur: '#ff0000' }
};

function PopupSample({ 
    concept, 
    ongletInitial, 
    surFermer, 
    couleurCategorie, 
    etiquetteCategorie 
  }) 
  {

  const [ongletCode, definirOngletCode] = useState(ongletInitial || '');

  useEffect(() => {
    definirOngletCode(ongletInitial || '');
  }, [concept, ongletInitial]);

  // Fermer avec Escape
  useEffect(() => {
    function gererTouche(evenement) {
      if (evenement.key === 'Escape') surFermer();
    }
    document.addEventListener('keydown', gererTouche);
    document.body.style.overflow = 'hidden';

    return () => {
      document.removeEventListener('keydown', gererTouche);
      document.body.style.overflow = '';
    };
  }, [surFermer]);

  return (
    <div className="popup-overlay" onClick={surFermer}>
      <div className="popup-contenu" onClick={(e) => e.stopPropagation()}>
        <button className="popup-fermer" onClick={surFermer}>✕</button>

        {/* En-tête */}
        <div className="popup-entete">
          <span className="popup-icone">{concept.icone}</span>
          <div>
            <h2 className="popup-titre">{concept.titre}</h2>
            <span
              className="bloc-concept-categorie"
              style={{
                backgroundColor: `${couleurCategorie}15`,
                color: couleurCategorie
              }}
            >
              {etiquetteCategorie}
            </span>
          </div>
        </div>

        <p className="popup-description">{concept.description}</p>

        {/* Onglets des TYPES */}
        <div className="popup-onglets">
          {Object.entries(TYPES).map(([cle, sample]) => (
            <button
              key={cle}
              className={`popup-onglet ${ongletCode === cle ? 'popup-onglet-actif' : ''}`}
              onClick={() => definirOngletCode(cle)}
              style={ongletCode === cle ? {
                borderBottomColor: sample.couleur,
                color: sample.couleur
              } : {}}
            >
              {sample.etiquette}
            </button>
          ))}
        </div>

        {/* Bloc de code */}
        <div className="popup-code" key={ongletCode}>
          <pre><code>{concept[ongletCode] || ''}</code></pre>
        </div>

        {/* Indicateur visuel du sample */}
        {ongletCode && (
          <div
            className="popup-indicateur-sample"
            style={{ backgroundColor: TYPES[ongletCode].couleur }}
          >
            {TYPES[ongletCode].etiquette}
          </div>
        )}
      </div>
    </div>
  );
}

export default PopupSample;