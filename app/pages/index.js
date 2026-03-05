import Head from "next/head";
import styles from "@/styles/Accueil.module.css";
import { useRouter } from 'next/router';
import { useRef, useState } from "react";

const TYPES = [
  { cle: 'one-shot',
    icone: '🔊',
    nom: 'One-shot',
    description: 'Son court et unique (kick, snare, hit, stab...).',
    couleur: '#00ff95'
  },
  {
    cle: 'morceau',
    icone: '🎵',
    nom: 'Morceau',
    description: 'Track complet prêt à écouter ou télécharger.',
    couleur: '#004cff'
  },
  {
    cle: 'fx',
    icone: '✨',
    nom: 'FX',
    description: 'Effets sonores : impacts, transitions, ambiances.',
    couleur: '#ff5100'
  },
  {
    cle: 'loop',
    icone: '🔁',
    nom: 'Loop',
    description: 'Boucle audio répétable et synchronisable au tempo.',
    couleur: '#00ffa6'
  },
  {
    cle: 'vocal',
    icone: '🎤',
    nom: 'Vocal',
    description: 'Voix chantée, parlée ou phrases vocales.',
    couleur: '#0011ff'
  },
  {
    cle: 'remix',
    icone: '🎛️',
    nom: 'Remix',
    description: 'Version retravaillée ou réinterprétée d’un morceau.',
    couleur: '#00ffae'
  }
]

export default function Accueil() {
  const routeur = useRouter();

  function choisirType(cle) {
    localStorage.setItem('typeChoisi', cle);
    routeur.push('/interactive');
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
      /* - - - Nom de la page - - - */
      }
      <Head>
        <title>Accueil</title>
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        {/* <link rel="icon" href="/favicon.ico" /> */}
      </Head>
      
      {
      /* - - - LE CORPS - - - */
      }
      <main className={styles.main}>
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
