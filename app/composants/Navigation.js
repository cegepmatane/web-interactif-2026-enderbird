import Link from 'next/link';

function Navigation() {
  return (
    <nav id="navigation">
      <ul id="navigation-liens">
        <li><Link href="/">Accueil</Link></li>
        <li><Link href="/sample">Samples</Link></li>
        <li><Link href="/aide">Aide</Link></li>
      </ul>
    </nav>
  );
}

export default Navigation;
