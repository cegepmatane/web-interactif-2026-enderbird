import Link from 'next/link';
import sujetsAide from '@/donnees/aide.json';

export default function PageAideIndex() {
  return (
    <div className="page-fondu">
      <h1>
        Aide et infos
      </h1>
      <p>
        Les choses à savoir à propos des musiques
      </p>

      <div className="aide-grille">
        {sujetsAide.map((sujet, i) => (
          <Link
            key={sujet.id}
            href={`/aide/${sujet.id}`}
            className="aide-carte-lien"
          >
          </Link>
        ))}
      </div>
    </div>
  );
}
