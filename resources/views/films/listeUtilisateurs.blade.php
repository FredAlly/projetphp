@extends('layouts.app')

@section('content')

<div class="row">
    <div class="col-lg-10">
        <h2>Utilisateurs ayant enregistré le film : {{ $film->nom }}</h2>
    </div>
    <div class="col-lg-2">
        <a class="btn btn-success" href="{{ url('films') }}">
        Retour à la page d'accueil
        </a>
    </div>
</div>

@if($film->enregistrements->isEmpty())
    <p>Aucun utilisateur n'a enregistré ce film.</p>
@else
    <div class="container">
        <div class="row">
            <ul class="list-group">
                @foreach($film->enregistrements as $enregistrement)
                    <li class="list-group-item">
                        {{ $enregistrement->nom_utilisateur }} - {{ $enregistrement->email_utilisateur }}
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
@endif

@endsection
