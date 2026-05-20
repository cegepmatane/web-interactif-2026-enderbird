@extends('template')

@section('titre') 
  Modifier {{ $morceau->titre }}
@stop

@section('contenu')
  <h1>Modifier un morceau</h1>
  
  <a href="{{ route('index') }}">← Retour</a>
  
  <form action="{{ route('morceau.update', $morceau->id) }}" method="POST">
    @csrf
    @method('PUT')
  
    <div>
      <label>Album</label>
      <select name="id_album">
        <option value="">Aucun album</option>
  
        @foreach($albums as $album)
        <option value="{{ $album->id }}" {{ $morceau->id_album == $album->id ? 'selected' : '' }}>{{ $album->nom }}</option>
        @endforeach
      </select>
    </div>
  
    <div>
      <label>Ordre</label>
      <input type="number" name="ordre" value="{{ $morceau->ordre }}">
    </div>
  
    <div>
      <label>Titre</label>
      <input type="text" name="titre" value="{{ $morceau->titre }}">
    </div>
  
    <div>
      <label>Artiste</label>
      <input type="text" name="artiste" value="{{ $morceau->artiste }}">
    </div>
  
    <div>
      <label>Durée</label>
      <input type="text" name="duree" value="{{ $morceau->duree }}" placeholder="00:00:00">
    </div>
  
    <button type="submit">Modifier</button>
  </form>

  <form action="{{ route('morceau.delete', $morceau->id) }}" method="POST">
    @csrf
    @method('DELETE')

    <button type="submit" onclick="return confirm('Supprimer ce morceau ?')">Supprimer</button>
  </form>

@stop
