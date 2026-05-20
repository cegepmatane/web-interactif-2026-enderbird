
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="images/icon.svg" type="image/x-icon">

    <!-- <script src="js/general.js" defer></script> -->
    <link rel="stylesheet" href="{{ asset('css/main.css') }}">

    <title>@yield('titre')</title>
</head>
<body>

  <!-- Navigation du projet -->
  <nav id="navigation-projet">
      <a href="../../../" class="lien-navigation accueil">🏠 Accueil</a>
      <a href="../../../splash.php" class="lien-navigation splash">🫟 Splash</a>
      <a href="../../../liste-albums.php" class="lien-navigation liste">🎵 Albums</a>
      <a href="https://web-projet-app.wavesofsounds.space" class="lien-navigation accueil">🔊 App</a>
      <a href="../../../blog/" class="lien-navigation blog">📝 Blog</a>
      <a href="../../../espace-membre.php" class="lien-navigation espace">✨ Mon Espace</a>
      <a href="{{ route('index') }}" class="lien-navigation admin">⚙️ Admin</a>
  </nav>

  <!-- En-tête -->
  <header id="entete-principal">
      <h1 id="titre-site">SoundWave</h1>
      <p id="slogan">Ta musique, ton style</p>
  </header>

  @yield('contenu')

  <footer id="pied-page">
      SoundWave © <?=date('Y')?> • Votre musique, votre univers
  </footer>

</body>
</html>