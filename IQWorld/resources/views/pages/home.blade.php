@extends('template')

@section('content')
    <div class='containerMiddleColumn websiteBackground littlePadding1'>
        <h1 class='bigText2 colorLight'>
            IQWorld
        </h1>

        <img src="{{ Storage::url('static/logo.png') }}">

        <p class='smallText1 colorLight textCenter'>
            Quand l'entraînement cognitif devient une passion
        </p>
    </div>

    <div class='backgroundLight littlePadding1'>
        <hr>

        <h1 class='colorDark'>
            Actualités
        </h1>

        <h1 class='colorDark'>
            Derniers jeux ajoutés
        </h1>

            {{ $data }}
        
            @foreach ($data as $game)
                <p>{{ $game['name'] }}</p>
                <p>{{ $game['category_id'] }}</p>
            @endforeach
    </div>

@endsection