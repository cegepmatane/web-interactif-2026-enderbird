@extends('template')

@section('titre') 
  Ajouter un morceau
@stop

@section('contenu')
  <h1>Ajouter un morceau</h1>
  
  <a href="{{ route('index') }}">← Retour</a>
  
  <form action="{{ route('morceau.enregistrerCreation') }}" method="POST">
    @csrf
  
    <div>
      <label>Album</label>
  
      <select name="id_album">
        <option value="">Aucun album</option>
  
        @foreach($albums as $album)
        <option value="{{ $album->id }}">{{ $album->nom }}</option>
        @endforeach
      </select>
    </div>
  
    <div>
      <label>Ordre</label>
      <input type="number" name="ordre">
    </div>
  
    <div>
      <label>Titre</label>
      <input type="text" name="titre">
    </div>
  
    <div>
      <label>Artiste</label>
      <input type="text" name="artiste">
    </div>
  
    <div>
      <label>Durée</label>
      <input type="text" name="duree" value="00:00:00">
    </div>
  
    <button type="submit">Ajouter</button>
  </form>
@stop
