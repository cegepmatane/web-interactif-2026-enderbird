import Link from 'next/link';

function Navigation() {
  return (
    <nav id="navigation">
      <div id="navigation-logo">
        <span id="navigation-logo-icone">{'</>'}</span>
        Cheatsheet
      </div>
      <ul id="navigation-liens">
        <li><Link href="/">Accueil</Link></li>
        <li><Link href="/feuille">Fiches</Link></li>
        <li><Link href="/aide">Aide</Link></li>
      </ul>
    </nav>
  );
}

export default Navigation;
