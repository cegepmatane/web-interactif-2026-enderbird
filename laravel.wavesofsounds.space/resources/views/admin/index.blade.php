<!DOCTYPE html>
<html>
<head>
    <title>Admin</title>
</head>
<body>

<h1>Liste des albums</h1>

<a href="{{ url('/admin/create') }}">
    Ajouter un morceau
</a>

@foreach($albums as $album)

    <h2>{{ $album->name }}</h2>

    <ul>
        @foreach($album->morceaux as $morceau)
            <li>
                {{ $morceau->ordre }}.
                {{ $morceau->titre }}
                - {{ $morceau->artiste }}
                - {{ $morceau->duree }}

                <a href="{{ url('/admin/edit/' . $morceau->id) }}">
                    Modifier
                </a>

                <form action="{{ url('/admin/delete/' . $morceau->id) }}"
                      method="POST"
                      style="display:inline;">

                    @csrf
                    @method('DELETE')

                    <button type="submit">
                        Supprimer
                    </button>
                </form>
            </li>
        @endforeach
    </ul>

@endforeach

</body>
</html>