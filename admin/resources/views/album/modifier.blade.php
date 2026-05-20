@extends('template')

@section('titre') 
  Modifier {{ $album->nom }}
@stop

@section('contenu')
  <h1>Modifier l’album</h1>
  
  <a href="{{ route('index') }}">← Retour</a>
  
  <form action="{{ route('album.enregistrerModifications', $album->id) }}" method="POST">
    @csrf
    @method('PUT')
  
    <div>
      <label>Nom de l’album</label><br>
      <input type="text" name="nom" value="{{ $album->nom }}" required>
    </div>
      
    <div>
      <label>Artiste</label>
      <input type="text" name="artiste" value="{{ $album->artiste }}">
    </div>

    <div>
      <label>Type</label>
      <input type="text" name="type" value="{{ $album->type }}">
    </div>

   <div>
      <label>Date de sortie</label>
      <input type="date" name="date_sortie" value="{{ $album->date_sortie }}">
    </div>

    <button type="submit">Modifier</button>
  </form>
  
  <form action="{{ route('album.supprimer', $album->id) }}" method="POST">
    @csrf
    @method('DELETE')

    <button type="submit" onclick="return confirm('Supprimer cet album ?')">Supprimer</button>
  </form>
@stop
