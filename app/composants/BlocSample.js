function BlocSample({
  concept,
  typeActif,
  surClic,
  couleurCategorie,
  etiquetteCategorie,
  variante
}) {
  const estCompact = variante === 'compact';
  const codeCourt = concept[typeActif] || '';
  const premiereLigne = codeCourt.split('\n')[0];

  return (
    <div
      className={`bloc-concept ${estCompact ? 'bloc-concept-compact' : ''}`}
      onClick={() => surClic && surClic(concept)}
      style={{
        borderLeftColor: couleurCategorie,
        '--couleur-categorie': couleurCategorie,
        background: `linear-gradient(145deg, var(--background-dark) 10%, ${couleurCategorie || '#888'} 50%, var(--background-dark) 90%)`,
        width: '100%',
        height: '100%',
        padding: '2em',
        borderRadius: '2vh'
      }}
    >
      <div className="bloc-concept-entete">
        <span className="bloc-concept-icone">{concept.icone}</span>
        <span
          className="bloc-concept-categorie"
          style={{
            fontSize: '1em',
            backgroundColor: `${couleurCategorie}15`,
            color: couleurCategorie
          }}
        >
          {etiquetteCategorie}
        </span>
      </div>

      <div className="bloc-concept-titre"
        style={{
          fontSize: '1.5em',
        }}
      >{concept.titre}</div>

      {!estCompact && (
        <div className="bloc-concept-apercu">
          <code>{premiereLigne}</code>
        </div>
      )}
    </div>
  );
}

export default BlocSample;
