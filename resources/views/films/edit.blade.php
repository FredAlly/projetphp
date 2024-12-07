@extends('layouts.app')

@section('content')

    <h1>Modifier le film : {{ $film->nom }}</h1>

    @if ($message = Session::get('warning'))
        <div class="alert alert-warning">
            <p>{{ $message }}</p>
        </div>
    @endif

    <form method="post" action="{{ url('films/'. $film->id) }}">
        @method('PATCH')
        @csrf

        <!-- Champ pour le nom du film -->
        <div class="form-group mb-3">
            <label for="nom">Nom du film:</label>
            <input type="text" class="form-control" id="nom" placeholder="Entrer le nom du film" name="nom" value="{{ $film->nom }}" required>
        </div>

        <!-- Champ pour l'auteur -->
        <div class="form-group mb-3">
            <label for="auteur">Auteur:</label>
            <input type="text" class="form-control" id="auteur" placeholder="Entrer le nom de l'auteur" name="auteur" value="{{ $film->auteur }}" required>
        </div>

        <!-- Champ pour le genre -->
        <div class="form-group mb-3">
            <label for="genre">Genre:</label>
            <select class="form-control" id="genre" name="genre" required>
        <option value="">Sélectionnez le genre du film</option>
        <option value="science fiction">Science-fiction</option>
        <option value="aventure">Aventure</option>
        <option value="horreur">Horreur</option>
        <option value="humour">Humour</option>
        <option value="drame">Drame</option>
        <option value="action">Action</option>
        </div>

        <!-- Champ pour la note -->
        <div class="form-group mb-3">
            <label for="note">Note:</label>
            <input type="number" class="form-control w-25" id="note" name="note" required min="0" max="10" step="1" value="{{ $film->note }}" readonly onfocus="this.removeAttribute('readonly');" onblur="this.setAttribute('readonly', true);">
        </div>

        <div class="form-group mb-3">
            <label><strong>Modifier l'image</strong></label>
            <input type = "file" name= "photo"  id = "photo"  accept="image/*" class = "form-control">
        </div>

        <!-- Boutons de soumission et d'annulation -->
        <button type="submit" class="btn btn-primary">Enregistrer</button>
        <a href="{{ url('films/'. $film->id) }}" class="btn btn-info">Annuler</a>
    </form>

@endsection
