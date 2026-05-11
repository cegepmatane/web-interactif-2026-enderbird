<!DOCTYPE html>
<html>
  <head>
    <title>Admin</title>
  </head>

  <body>
    <form method="POST" action="/admin/backup/create">
      <input type="password" name="password" placeholder="mot de passe">
      <button type="submit">Créer backup</button>
    </form>
  
    <form method="POST" action="/admin/backup/restore">
      <select name="file">
        @forelse($backups as $backup)
          <option value="{{ $backup }}">
            {{ basename($backup) }}
          </option>
        @empty
          <option>Aucun backup trouvé</option>
        @endforelse
      </select>

      <input type="password" name="password" placeholder="mot de passe">
      <button type="submit">Restaurer</button>
    </form>

  <h1>Liste des albums</h1>
  
  <a href="{{ url('/admin/create') }}">Ajouter un morceau</a>
  <a href="{{ url('/admin/albums/create') }}">Ajouter un album</a>
  
    @foreach($albums as $album)
    <h2>
      {{ $album->name }}
  
      <a href="{{ route('admin.albums.edit', $album->id) }}">Éditer</a>
  
      <form action="{{ route('admin.albums.destroy', $album->id) }}" method="POST" style="display:inline;">
        @csrf
        @method('DELETE')
  
        <button type="submit" onclick="return confirm('Supprimer cet album ?')">Supprimer</button>
      </form>
    </h2>
    <ul>
      @foreach($album->morceaux as $morceau)
        <li>
          {{ $morceau->ordre }}.
          {{ $morceau->titre }}
          - {{ $morceau->artiste }}
          - {{ $morceau->duree }}
  
          <a href="{{ url('/admin/edit/' . $morceau->id) }}">Modifier</a>
  
          <form action="{{ url('/admin/delete/' . $morceau->id) }}" method="POST">
              @csrf
              @method('DELETE')
  
              <button type="submit">Supprimer</button>
          </form>
        </li>
      @endforeach
    </ul>
    @endforeach
  
    <h2>Morceaux sans album</h2>
    <ul>
      @foreach($morceauxSansAlbum as $morceau)
        <li>
          {{ $morceau->ordre }}.
          {{ $morceau->titre }}
          - {{ $morceau->artiste }}
          - {{ $morceau->duree }}
  
          <a href="{{ url('/admin/edit/' . $morceau->id) }}">Modifier</a>
  
          <form action="{{ url('/admin/delete/' . $morceau->id) }}" method="POST">
            @csrf
            @method('DELETE')
  
            <button type="submit">Supprimer</button>
          </form>
        </li>
      @endforeach
    </ul>
  </body>
</html>