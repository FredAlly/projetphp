@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1>{{ $film->nom }}</h1>

            {{-- Affichage de l'image si elle existe --}}
            @if ($film->photo)
                <img src="../images/upload/{{ $film->photo }}" width="200px" height="100px" alt="{{ $film->nom }}">
            @endif
            
            <strong>@lang("general.Créé le"): {{ $film->created_at }}</strong>
            <p class="lead">{{ $film->content }}</p>

            <div class="buttons">
                @if(auth()->user() && auth()->user()->isAdmin())
                    <a href="{{ url('films/'. $film->id .'/edit') }}" class="btn btn-info">@lang("general.Modifier")</a>
                    <form action="{{ url('films/'. $film->id) }}" method="POST" style="display: inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">@lang("general.Supprimer")</button>
                    </form>
                @endif
                <a href="{{ url('/') }}" class="btn btn-info">@lang("general.Retour à la page d'accueil")</a>
            </div>
        </div>
    </div>

    {{-- Section des enregistrements --}}
    <div class="container">   
        <h2>@lang("general.Les enregistrements"):</h2>
        @foreach ($film->enregistrements as $enregistrement)
            <strong>@lang("general.Enregistrement_numero") : {{ $enregistrement->id }} @lang("general.le") {{ $enregistrement->created_at }}</strong>
           
            <p class="lead">@lang('general.Statut'): @lang('general.'.$enregistrement->statut)</p>

            <div class="buttons">
                @if(auth()->user() && (auth()->user()->isAdmin() || auth()->id() === $enregistrement->utilisateur_id))
                    <form action="{{ url('enregistrements/'. $enregistrement->id) }}" method="POST" style="display: inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">@lang("general.Supprimer")</button>
                    </form>
                @endif
            </div>
        @endforeach

        {{-- Formulaire d'ajout d'enregistrement --}}
        <h4>@lang("general.Ajouter un enregistrement"):</h4>
        <div class="form-group mb-4">
            @if ($message = Session::get('warning'))
                <div class="alert alert-warning">
                    <p>{{ $message }}</p>
                </div>
            @endif
            
            <form action="{{ route('enregistrements.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                {{-- Champ pour le statut --}}
                <div class="form-group mb-3">
                    <label for="statut">@lang("general.Statut")</label>
                    <select name="statut" id="statut" class="form-control" required>
                        <option value="à voir">@lang("general.À voir")</option>
                        <option value="vu">@lang("general.Vu")</option>
                        <option value="en cours">@lang("general.En cours")</option>
                    </select>
                </div>

                <input type="hidden" name="film_id" value="{{ $film->id }}" />
                
                <button type="submit" class="btn btn-primary">@lang("general.Enregistrer")</button>
            </form>
        </div>
    </div>
</div>
@endsection
