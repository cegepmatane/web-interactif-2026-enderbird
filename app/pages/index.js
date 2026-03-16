import Head from "next/head";
import styles from "@/styles/Accueil.module.css";
import { useRouter } from 'next/router';
import { useRef, useState } from "react";

const TYPES = [
  { cle: 'one-shot',
    icone: '🔊',
    nom: 'One-shot',
    description: 'Son court et unique (kick, snare, hit, stab...).',
    couleur: '#ff004c'
  },
  {
    cle: 'morceau',
    icone: '🎵',
    nom: 'Morceau',
    description: 'Piste complète et prête à écouter.',
    couleur: '#ffae00'
  },
  {
    cle: 'fx',
    icone: '✨',
    nom: 'FX',
    description: 'Effets sonores : impacts, transitions, ambiances.',
    couleur: '#0088ff'
  },
  {
    cle: 'loop',
    icone: '🔁',
    nom: 'Loop',
    description: 'Boucle audio répétable et synchronisable au tempo.',
    couleur: '#ff006a'
  },
  {
    cle: 'vocal',
    icone: '🎤',
    nom: 'Vocal',
    description: 'Voix chantée, parlée ou phrases vocales.',
    couleur: '#fbff00'
  },
  {
    cle: 'remix',
    icone: '🎛️',
    nom: 'Remix',
    description: 'Version retravaillée ou réinterprétée d’un morceau.',
    couleur: '#ff0000'
  }
]

export default function Accueil() {
  const routeur = useRouter();

  function choisirType(cle) {
    localStorage.setItem('typeChoisi', cle);
    routeur.push('/sample');
  }

  // Scroll pour centrer l'élément (Carousel)
  const referenceConteneur = useRef(null);
  const [centerIndex, setCenterIndex] = useState(0);

  function scrollToElement(index) {
    if (index === centerIndex) return;

    const conteneur = referenceConteneur.current;
    if (!conteneur) return;

    const el = conteneur.children[index];
    if (!el) return;

    const rectConteneur = conteneur.getBoundingClientRect();
    const rectElement = el.getBoundingClientRect();

    const decalage = rectElement.left - rectConteneur.left - (rectConteneur.width / 2) + (rectElement.width / 2);
    conteneur.scrollBy({ left: decalage, behavior: "smooth" });

    setCenterIndex(index);
  };

  return (
    <>
      {
      /* - - - ACCUEIL - - - */
      }
      <Head>
        <title>Accueil</title>
        <meta name="viewport" content="width=device-width, initial-scale=1" />
      </Head>
      {
      /* - - - LE CORPS - - - */
      }
      <main className={styles.main}>
        
        <h1 className={styles.titrePage}>Découvrez des sons, des chansons et plus encore !!!</h1>

        <div className={styles.typesCarousel} ref={referenceConteneur}>
          {TYPES.map((type, i) => (
            <div
              key={type.cle}
              className={`${styles.type} ${centerIndex === i ? 'focus' : ''}`}
              onClick={() => choisirType(type.cle)}
              onMouseEnter={() => scrollToElement(i)} // centrer au hover
              style={{color: type.couleur, boxShadow: "0px 0px 16px 0px " + type.couleur}}
            >
              <div className={styles.nom}>{type.nom}</div>
              <div className={styles.iconeParent} style={{border: "3px solid" + type.couleur}}>
                <div className={styles.icone}>{type.icone}</div>
              </div>
              <div className={styles.description}>{type.description}</div>
            </div>
          ))}
        </div>
      </main>
    </>
  );
}
