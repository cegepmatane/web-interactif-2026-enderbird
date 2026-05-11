<!DOCTYPE html>
<html>
<head>
    <title>Modifier album</title>
</head>
<body>

<h1>Modifier l’album</h1>

<a href="{{ route('admin.index') }}">← Retour</a>

<br><br>

<form action="{{ route('admin.albums.update', $album->id) }}" method="POST">
    @csrf
    @method('PUT')

    <div>
        <label>Nom de l’album</label><br>
        <input type="text" name="name" value="{{ $album->name }}" required>
    </div>

    <br>

    <button type="submit">
        Modifier
    </button>

</form>

<br>

<form action="{{ route('admin.albums.destroy', $album->id) }}" method="POST">
    @csrf
    @method('DELETE')

    <button type="submit" onclick="return confirm('Supprimer cet album ?')">
        Supprimer l’album
    </button>
</form>

</body>
</html>