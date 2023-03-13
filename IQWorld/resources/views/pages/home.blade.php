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

        <hr>


        <h1 class='colorDark'>
            Derniers jeux ajoutés
        </h1>


        <div class='containerSpaceAround littleMargin1'>
        
            @foreach ($data as $game)
            <div class="card background{{$game['categoryGames']['name']}} colorWhite littleMargin1">

                <div class='containerSpaceBetween'>
                    <p>{{ $game['name'] }}</p>
                    <img src={{ Storage::url("static/gamesIcon/" . $game['categoryGames']['name'] . ".png") }} alt="Avatar" class="card-image">
                </div>

                <div>
                  <p class='smallText2'>{{ $game['categoryGames']['name'] }}</p>
                </div>
            </div>
            @endforeach

        </div>


    </div>

@endsection