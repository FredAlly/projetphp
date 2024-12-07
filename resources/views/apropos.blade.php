@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <h1>À propos </h1>
        <p><strong>Nom :</strong> Alcide, Fred</p>
        <p><strong>Titre du cours :</strong> 420-5H6 MO : Applications Web transactionnelles</p>
        <p><strong>Semestre :</strong> Automne 2023, Collège Montmorency</p>

        <h2>Description des étapes d'utilisation</h2>
        <p>Pour vérifier le bon fonctionnement de l'application, suivez ces étapes :</p>
        <ol>
            <li>Accédez à la page principale de l'application.</li>
            <li>Pour ajouter un film, cliquez sur le bouton "Ajouter un film" dans le menu.</li>
            <li>Remplissez tous les champs obligatoires, y compris le nom, l'auteur, la note et téléchargez une image.</li>
            <li>Une fois les informations saisies, cliquez sur le bouton "Enregistrer".</li>
            <li>Vous devriez voir un message de confirmation indiquant que le film a été ajouté avec succès.</li>
            <li>Si un champ requis est manquant ou si l'image n'est pas valide, un message d'erreur s'affichera.</li>
        </ol>

        <h2>Diagramme de la base de données</h2>
        <p>Voici un diagramme  de la base de données utilisée par l'application :</p>
        <img src="{{ asset('images/database_diagram.png') }}" alt="Diagramme de la base de données" class="img-fluid">
       
    </div>
</div>
@endsection
