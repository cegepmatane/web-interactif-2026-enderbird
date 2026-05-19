@extends('template')

@section('titre') 
  Modifier {{ $album->name }}
@stop

@section('contenu')
  <h1>Modifier l’album</h1>
  
  <a href="{{ route('admin.index') }}">← Retour</a>
  
  <form action="{{ route('admin.album.update', $album->id) }}" method="POST">
    @csrf
    @method('PUT')
  
    <div>
      <label>Nom de l’album</label><br>
      <input type="text" name="name" value="{{ $album->name }}" required>
    </div>
  
    <button type="submit">Modifier</button>
  </form>
  
  <form action="{{ route('admin.album.delete', $album->id) }}" method="POST">
    @csrf
    @method('DELETE')

    <button type="submit" onclick="return confirm('Supprimer cet album ?')">Supprimer</button>
  </form>
@stop
