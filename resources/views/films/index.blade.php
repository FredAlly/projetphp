@extends('layouts.app')

@section('content')

<div class="row">
    <div class="col-lg-10">
        <h2>@lang("general.Liste des films")</h2>
    </div>

    @if(request()->is('admin*') && auth()->user() && auth()->user()->isAdmin())
    <div class="col-lg-2">
        <a class="btn btn-success" href="{{ url('films/create') }}">
            @lang("general.Ajouter un Film")  
        </a>
    </div>
    @endif
</div>

@if ($message = Session::get('success'))
    <div class="alert alert-success">
        <p>{{ $message }}</p>
    </div>
@endif

<div class="container">
    <div class="row">
        @foreach ($films as $film)
            <div class="col-md-4">
                <div class="card card-body">
                    {{-- Affichage de l'image si elle existe --}}
                    @if ($film->photo)
                        <img src="../images/upload/{{ $film->photo }}" class="card-img-top" alt="{{ $film->nom }}" style="height: 200px; object-fit: cover;">
                    @endif
                    <h2>
                        {{ $film->nom }}
                    </h2>
                    <p>Auteur : {{ $film->auteur }}</p>
                    <p>Genre : @lang('general.' . $film->genre)</p>
                    <p>Note : {{ $film->note }}</p>
                    <a href="{{ url('films/' . $film->id) }}" class="btn btn-outline-primary">@lang("general.En savoir plus")</a>
                </div>
            </div>
        @endforeach
        <div class= "d-flex justify-content-center"> 
            {!! $films->links() !!} <!-- Gardez cela -->
        </div>
    </div>
</div>

@endsection
