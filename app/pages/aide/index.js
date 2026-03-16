import Link from 'next/link';
import sujetsAide from '@/donnees/aide.json';
import styles from "@/styles/Accueil.module.css";

export default function PageAideIndex() {
  return (
    <div className={styles.main}>
      <h1 className={styles.titrePage}>
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
