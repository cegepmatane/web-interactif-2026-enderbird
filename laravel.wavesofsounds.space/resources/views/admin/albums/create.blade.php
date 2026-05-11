<!DOCTYPE html>
<html>
  <head>
    <title>Créer un album</title>
  </head>
  <body>
  
    <h1>Créer un album</h1>
    
    <a href="{{ route('admin.index') }}">← Retour</a>
    
    <br><br>
    
    <form action="{{ route('admin.albums.store') }}" method="POST">
      @csrf
    
      <div>
        <label>Nom de l’album</label>
        <input type="text" name="name" required>
      </div>
    
      <button type="submit">Créer</button>
    </form>
  
  </body>
</html>