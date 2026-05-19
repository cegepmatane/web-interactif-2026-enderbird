import Link from 'next/link';
import samplesAide from '@/donnees/aide.json';
import styles from "@/styles/Aide.module.css";
import BlocSample from "@/composants/BlocSample.js";
import { useRouter } from "next/router";

export default function PageAideSample({ sample }) {
  const router = useRouter();
  
  if (!sample) return <p className={styles.sujetIntrouvable}>Sujet introuvable.</p>;

  return (
    <main className={styles.main}>
      <Link href="/aide" className={styles.lienRetour}>
        ← Retour au centre d'aide
      </Link>

      <div className={styles.carteAideDetail}>
        <div className={styles.iconeSample}>
          {sample.icone}
        </div>

        <h1 className={styles.titreSample}>
          {sample.titre}
        </h1>

        <p className={styles.paragraphe}>{sample.description}</p>
        <p className={styles.paragraphe}>{sample.origine}</p>

        {sample.conseils.map((conseil, i) => (
          <p key={i} className={styles.conseil}>
            {conseil}
          </p>
        ))}
      </div>

      <h3 className={styles.autresSujets}>Autres sujets</h3>

      <div className={styles.aideGrille}>
        {samplesAide
          .filter((autreSample) => autreSample.id !== sample.id)
          .map((autreSample) => (
            <BlocSample
              key={autreSample.id}
              concept={autreSample}
              surClic={(sample) => router.push(`/aide/${sample.id}`)}
              etiquetteCategorie=""
              couleurCategorie="#a46bff"
              variante="compact"
            />
          ))}
      </div>
    </main>
  );
}

export async function getStaticPaths() {
  const chemins = samplesAide.map((sample) => ({
    params: { sample: sample.id },
  }));
  return { paths: chemins, fallback: false };
}

export async function getStaticProps({ params }) {
  const sample = samplesAide.find(
    (sampleItem) => sampleItem.id === params.sample
  );
  return { props: { sample } };
}