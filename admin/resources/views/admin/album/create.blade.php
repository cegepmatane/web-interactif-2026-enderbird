@extends('template')

@section('titre') 
  Créer un album
@stop

@section('contenu')
  <h1>Créer un album</h1>
  
  <a href="{{ route('admin.index') }}">← Retour</a>
  
  <form action="{{ route('admin.album.store') }}" method="POST">
    @csrf
  
    <div>
      <label>Nom de l’album</label>
      <input type="text" name="name" required>
    </div>
  
    <button type="submit">Créer</button>
  </form>
@stop
