import Head from "next/head";
import { useRouter } from 'next/router';
import styles from "@/styles/Accueil.module.css";

const TYPES = [
  {
    cle: 'one-shots'
  },
  {
    cle: 'musiques'
  },
  {
    cle: 'loops'
  },
  {
    cle: 'multi-samples'
  },
  {
    cle: 'fxs'
  },
  {
    cle: 'vocals'
  },
  {
    cle: 'remix'
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
      <main className={`${styles.main}`}>
        <div className="accueil-grille">
          {TYPES.map((type, i) => (
            <div
              key={type.cle}
              className={styles.main}
              onClick={() => choisirType(type.cle)}
            >
              allo
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
