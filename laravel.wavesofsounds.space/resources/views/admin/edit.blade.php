<!DOCTYPE html>
<html>
<head>
    <title>Modifier un morceau</title>
</head>
<body>

<h1>Modifier un morceau</h1>

<a href="{{ route('admin.index') }}">← Retour</a>

<form action="{{ url('/admin/update/' . $morceau->id) }}" method="POST">

    @csrf
    @method('PUT')

    <div>
        <label>Album</label>

        <select name="album_id">
            <option value="">Aucun album</option>

            @foreach($albums as $album)
                <option value="{{ $album->id }}"
                    {{ $morceau->album_id == $album->id ? 'selected' : '' }}>
                    {{ $album->name }}
                </option>
            @endforeach
        </select>
    </div>

    <br>

    <div>
        <label>Ordre</label>
        <input type="number"
               name="ordre"
               value="{{ $morceau->ordre }}">
    </div>

    <br>

    <div>
        <label>Titre</label>
        <input type="text"
               name="titre"
               value="{{ $morceau->titre }}">
    </div>

    <br>

    <div>
        <label>Artiste</label>
        <input type="text"
               name="artiste"
               value="{{ $morceau->artiste }}">
    </div>

    <br>

    <div>
        <label>Durée</label>
        <input type="text"
               name="duree"
               value="{{ $morceau->duree }}"
               placeholder="00:00:00">
    </div>

    <br>

    <button type="submit">
        Modifier
    </button>

</form>

</body>
</html>