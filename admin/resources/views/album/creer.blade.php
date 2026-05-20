@extends('template')

@section('titre') 
  Créer un album
@stop

@section('contenu')
  <h1>Créer un album</h1>
  
  <a href="{{ route('index') }}">← Retour</a>
  
  <form action="{{ route('album.enregistrerCreation') }}" method="POST">
    @csrf
  
    <div>
      <label>Nom de l’album</label>
      <input type="text" name="nom" required>
    </div>
          
    <div>
      <label>Artiste</label>
      <input type="text" name="artiste" required>
    </div>

    <div>
      <label>Type</label>
      <input type="text" name="type" required>
    </div>

    <div>
      <label>Date de sortie</label>
      <input type="date" name="date_sortie" required value="0001-01-01">
    </div>
  
    <button type="submit">Créer</button>
  </form>
@stop
