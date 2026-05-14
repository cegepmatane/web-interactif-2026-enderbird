<!DOCTYPE html>
<html>
<head>
    <title>Ajouter un morceau</title>
</head>
<body>

<h1>Ajouter un morceau</h1>

<a href="{{ route('admin.index') }}">← Retour</a>

<form action="{{ route('admin.morceaux.store') }}" method="POST">

    @csrf

    <div>
        <label>Album</label>

        <select name="album_id">
            <option value="">Aucun album</option>

            @foreach($albums as $album)
                <option value="{{ $album->id }}">
                    {{ $album->name }}
                </option>
            @endforeach
        </select>
    </div>

    <br>

    <div>
        <label>Ordre</label>
        <input type="number" name="ordre">
    </div>

    <br>

    <div>
        <label>Titre</label>
        <input type="text" name="titre">
    </div>

    <br>

    <div>
        <label>Artiste</label>
        <input type="text" name="artiste">
    </div>

    <br>

    <div>
        <label>Durée</label>
        <input type="text" name="duree" value="00:00:00">
    </div>

    <button type="submit">Ajouter</button>

</form>

</body>
</html>