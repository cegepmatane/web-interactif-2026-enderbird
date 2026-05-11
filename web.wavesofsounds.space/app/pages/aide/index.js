import { useRouter } from "next/router";
import samplesAide from '@/donnees/aide.json';
import styles from "@/styles/Aide.module.css";
import BlocSample from "@/composants/BlocSample.js";

export default function PageAideIndex() {

  const router = useRouter();

  function ouvrirSample(sample) {
    router.push(`/aide/${sample.id}`);
  }

  return (
    <div className={styles.main}>

      <h1 className={styles.titrePage}>
        Aide et infos
      </h1>

      <p>
        Les choses à savoir à propos des musiques
      </p>

      <div className={styles.aideGrille}>

        {samplesAide.map((sample) => (

          <BlocSample
            key={sample.id}
            concept={sample}
            surClic={ouvrirSample}
            etiquetteCategorie=""
            couleurCategorie="#6b7bff"
            variante="compact"
          />

        ))}

      </div>

    </div>
  );
}