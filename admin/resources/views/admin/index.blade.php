@extends('template')

@section('titre') 
  Admin
@stop

@section('contenu')
  <form method="POST" action="{{ route('admin.backup.create') }}">

    <input type="password" name="password" placeholder="mot de passe">
    <button type="submit">Créer backup</button>

  </form>
  <form method="POST" action="{{ route('admin.backup.restore') }}">

    <select name="file">
      @forelse($backups as $backup)
      <option value="{{ $backup }}">{{ basename($backup) }}</option>
      @empty
      <option>Aucun backup trouvé</option>
      @endforelse
    </select>

    <input type="password" name="password" placeholder="mot de passe">
    <button type="submit">Restaurer</button>
  </form>

  <h1>Liste des albums</h1>
  
  <a href="{{ route('admin.morceau.create') }}">Ajouter un morceau</a>
  <a href="{{ route('admin.album.create') }}">Ajouter un album</a>
  
    @foreach($albums as $album)
    <h2>
      {{ $album->name }}
  
      <a href="{{ route('admin.album.edit', $album->id) }}">Éditer</a>
    </h2>
    <ul>
      @foreach($album->morceaux as $morceau)
        <li>
          {{ $morceau->ordre }}. {{ $morceau->titre }} - {{ $morceau->artiste }} - {{ $morceau->duree }}
  
          <a href="{{ route('admin.morceau.edit', $morceau->id) }}">Modifier</a>
        </li>
      @endforeach
    </ul>
    @endforeach
  
    <h2>Morceaux sans album</h2>
    <ul>
      @foreach($morceauxSansAlbum as $morceau)
        <li>
          {{ $morceau->ordre }}. {{ $morceau->titre }} - {{ $morceau->artiste }} - {{ $morceau->duree }}
  
          <a href="{{ route('admin.morceau.edit', $morceau->id) }}">Modifier</a>
        </li>
      @endforeach
    </ul>

@stop
