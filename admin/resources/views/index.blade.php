@extends('template')

@section('titre') 
  SoundWave - Admin
@stop

@section('contenu')
  <h1>Liste des albums</h1>
  
  <a href="{{ route('morceau.creer') }}">Ajouter un morceau</a>
  <a href="{{ route('album.creer') }}">Ajouter un album</a>

  @foreach($albums as $album)
  <section class="album-vedette">
    <div class="info-album-vedette">
      <h2>{{ $album->nom }}</h2>
      <p class="artiste-vedette">{{ $album->artiste }}</p>
      <div class="stats-album">
        <div class="stat-item">
          <div class="stat-nombre">{{ $album->date_sortie }}</div>
          <div class="stat-label">Date sortie</div>
        </div>
        <div class="stat-item">
          <div class="stat-nombre">{{ $album->type }}</div>
          <div class="stat-label">Type</div>
        </div>
      </div>
      
      <a class="bouton" href="{{ route('album.modifier', $album->id) }}">Éditer</a>
    </div>
  </section>

  <section class="liste-pistes">
    @foreach($album->morceaux as $morceau)
      <article class="piste">
        <span class="piste-numero">{{ $morceau->ordre }}</span>
        <div class="piste-info">
          <div class="piste-titre">{{ $morceau->titre }}</div>
          <div class="piste-artiste">{{ $morceau->artiste }}</div>
        </div>
        <span class="{{ $morceau->duree }}"></span>

        <div class="piste-action">
          <a class="bouton-piste" href="{{ route('morceau.modifier', $morceau->id) }}">Modifier</a>
        </div>
      </article>
    @endforeach
  </section>
  @endforeach
  
    <h2>Morceaux sans album</h2>
    <ul>
      @foreach($morceauxSansAlbum as $morceau)
        <li>
          {{ $morceau->ordre }}. {{ $morceau->titre }} - {{ $morceau->artiste }} - {{ $morceau->duree }}
  
          <a href="{{ route('morceau.modifier', $morceau->id) }}">Modifier</a>
        </li>
      @endforeach
    </ul>

@stop
