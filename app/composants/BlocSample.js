function BlocSample({
  concept,
  surClic,
  couleurCategorie,
  etiquetteCategorie,
  variante
}) {
  const estCompact = variante === 'compact';
  const premiereLigne = concept.resume;

  return (
    <div
      className={`bloc-concept ${estCompact ? 'bloc-concept-compact' : ''}`}
      onClick={() => surClic && surClic(concept)}
      style={{
        borderLeftColor: couleurCategorie,
        '--couleur-categorie': couleurCategorie,
        background: `linear-gradient(145deg, var(--background-dark) 20%, ${couleurCategorie || '#888'} 50%, var(--background-dark) 80%)`,
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
      >{concept.titre}{concept.artiste == null ? "" : (" - " + concept.artiste)}</div>

      {!estCompact && (
        <div className="bloc-concept-apercu">
          <code>{premiereLigne}</code>
        </div>
      )}
    </div>
  );
}

export default BlocSample;
