import Navigation from '@/composants/Navigation';
import "@/styles/globals.css";

// Réutilisé sur chaque page
export default function App({ Component, pageProps }) 
{
  return (
    <>
      <Navigation/>
        <Component {...pageProps} />
    </>
  );
}