@extends('template')

@section('titre') 
  SoundWave - Admin
@stop

@section('contenu')
  <h1>Liste des albums</h1>
  
  <a href="{{ route('morceau.creer') }}">Ajouter un morceau</a>
  <a href="{{ route('album.creer') }}">Ajouter un album</a>
  
    @foreach($albums as $album)
    <h2>
      {{ $album->nom }}
  
      <a href="{{ route('album.modifier', $album->id) }}">Éditer</a>
    </h2>
    <ul>
      @foreach($album->morceaux as $morceau)
        <li>
          {{ $morceau->ordre }}. {{ $morceau->titre }} - {{ $morceau->artiste }} - {{ $morceau->duree }}
  
          <a href="{{ route('morceau.modifier', $morceau->id) }}">Modifier</a>
        </li>
      @endforeach
    </ul>
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
