import Head from "next/head";
import { useRouter } from 'next/router';
import styles from "@/styles/Accueil.module.css";

const TYPES = [
  {
    cle: 'one-shots',
    icone: '🔊',
    nom: 'One-shot',
    description: 'Son court et unique (kick, snare, hit, stab...).',
    couleur: '#ff0000'
  },
  {
    cle: 'morceaux',
    icone: '🎵',
    nom: 'Morceau',
    description: 'Track complet prêt à écouter ou télécharger.',
    couleur: '#ff00e6'
  },
  {
    cle: 'loops',
    icone: '🔁',
    nom: 'Loops',
    description: 'Boucle audio répétable et synchronisable au tempo.',
    couleur: '#4000ff'
  },
  {
    cle: 'multi-samples',
    icone: '🎹',
    nom: 'Multi-samples',
    description: 'Instrument échantillonné sur plusieurs notes.',
    couleur: '#0088ff'
  },
  {
    cle: 'fxs',
    icone: '✨',
    nom: 'FX',
    description: 'Effets sonores : impacts, transitions, ambiances.',
    couleur: '#00fbff'
  },
  {
    cle: 'vocals',
    icone: '🎤',
    nom: 'Vocal',
    description: 'Voix chantée, parlée ou phrases vocales.',
    couleur: '#15ff00'
  },
  {
    cle: 'remix',
    icone: '🎛️',
    nom: 'Remix',
    description: 'Version retravaillée ou réinterprétée d’un morceau.',
    couleur: '#f2ff00'
  }
]

export default function Home() {
  const routeur = useRouter();

  function choisirType(cle) {
    localStorage.setItem('typeChoisi', cle);
    routeur.push('/interactive');
  }

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
        <div className={styles.types}>
          {TYPES.map((type, i) => (
            <div
              key={type.cle}
              className={styles.type}
              onClick={() => choisirType(type.cle)}
              style={{color: type.couleur, boxShadow: "0px 0px 16px 0px" + type.couleur}}
            >
              <h1>{type.nom}</h1>
              <div>{type.icone}</div>
              <p>{type.description}</p>
            </div>
          ))}
        </div>
      </main>
      
      {/* 
        <main className={styles.main}>
          <div className={styles.intro}> </div>
          <div className={styles.ctas}>
            <a
              className={styles.primary}
              href="https://vercel.com/new?utm_source=create-next-app&utm_medium=appdir-template&utm_campaign=create-next-app"
              target="_blank"
              rel="noopener noreferrer"
            >
              Deploy Now
            </a>
            <a
              className={styles.secondary}
              href="https://nextjs.org/docs?utm_source=create-next-app&utm_medium=appdir-template&utm_campaign=create-next-app"
              target="_blank"
              rel="noopener noreferrer"
            >
              Documentation
            </a>
          </div>
        </main>
      </div> */}
    </>
  );
}
