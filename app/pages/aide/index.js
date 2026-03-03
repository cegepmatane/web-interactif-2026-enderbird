import Link from 'next/link';
import sujetsAide from '@/donnees/aide.json';

export default function PageAideIndex() {
  return (
    <div className="page-fondu">
      <h1 style={{margin:0}}>
        Centre d'aide
      </h1>
      <p style={{margin:0}}>
        Tout savoir sur la Cheatsheet Interactive
      </p>

      <div className="aide-grille">
        {sujetsAide.map((sujet, indexSujet) => (
          <Link
            key={sujet.id}
            href={`/aide/${sujet.id}`}
            className="aide-carte-lien"
            style={{
              animation: `apparitionBloc 0.4s ease-out ${indexSujet * 0.1}s both`
            }}
          >
            <span className="aide-carte-icone">{sujet.icone}</span>
            <span className="aide-carte-titre">{sujet.titre}</span>
          </Link>
        ))}
      </div>
    </div>
  );
}
