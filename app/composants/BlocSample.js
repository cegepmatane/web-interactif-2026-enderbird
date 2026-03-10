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
        '--couleur-categorie': couleurCategorie
      }}
    >
      <div className="bloc-concept-entete">
        <span className="bloc-concept-icone">{concept.icone}</span>
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

      <div className="bloc-concept-titre">{concept.titre}</div>

      {!estCompact && (
        <div className="bloc-concept-apercu">
          <code>{premiereLigne}</code>
        </div>
      )}
    </div>
  );
}

export default BlocSample;
