@extends('layouts.app')

@section('content')

<h1>Ajouter un film</h1>
@if ($message = Session::get('warning'))
    <div class="alert alert-warning">
        <p>{{ $message }}</p>
    </div>
@endif

<form action="{{ route('films.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    
    <!-- Champ pour le nom du film -->
    <div class="form-group mb-3">
        <label for="nom">Nom du film:</label>
        <input type="text" class="form-control" id="nom" placeholder="Entrez le nom du film" name="nom" required>
    </div>

    <!-- Champ pour l'auteur -->
    <div class="form-group mb-3">
        <label for="auteur">Auteur:</label>
        <input type="text" class="form-control" id="auteur" placeholder="Entrez le nom de l'auteur" name="auteur" required>
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
        </select>
    </div>

    <!-- Champ pour la note -->
    <div class="form-group mb-3">
        <label for="note">Note:</label>
        <input style="width: 100px;" type="number" id="note" name="note" required min="0" max="10" value="0" onwheel="event.preventDefault();">
    </div>

    <script>
        const noteInput = document.getElementById('note');
        noteInput.addEventListener('keydown', function(event) {
            if (event.key === 'ArrowUp') {
                event.preventDefault();  // Empêche l'action par défaut
                let value = parseInt(noteInput.value);
                if (value < 10) {
                    noteInput.value = value + 1;  // Incrémente la valeur
                }
            } else if (event.key === 'ArrowDown') {
                event.preventDefault();  // Empêche l'action par défaut
                let value = parseInt(noteInput.value);
                if (value > 0) {
                    noteInput.value = value - 1;  // Décrémente la valeur
                }
            }
        });
    </script>

    <!-- Champ caché pour user_id avec valeur fixe 1 -->
    <input type="hidden" name="user_id" value="1" /><br />

    <!-- Champ pour l'image -->
    <div class="form-group mb-3">
        <label><strong>Image</strong></label>
        <input type="file" name="photo" class="form-control" required> 
    </div> 

    <!-- Boutons de soumission et de retour -->
    <button type="submit" class="btn btn-primary">Publier</button>   
    <a href="{{ url('/') }}" class="btn btn-info">@lang("general.Retour à la page d'accueil")</a>  
</form>

@endsection
