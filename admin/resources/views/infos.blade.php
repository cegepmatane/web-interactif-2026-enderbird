@extends('template')

@section('contenu')
    <form method="POST" action="/users">
        @csrf

        <label for="nom">Entrez votre nom :</label>
        <input type="text" name="nom" id="nom">

        <button type="submit">Envoyer !</button>
    </form>
@stop