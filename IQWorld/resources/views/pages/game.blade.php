@extends('template')

@section('content')

<meta game={{$game->id}}>
    <div class='background{{ $game['categoryGames']['name'] }} littlePadding1  colorWhite backgroundGame'>

        <div class='containerSpaceBetween'>

            <h1>
                {{ $game['name'] }}
            </h1>

                <p>
                    {{ $game['categoryGames']['name'] }}
                </p>

        </div>

        <p class='smallText1'>
            {{ $game['description'] }}
        </p>

        @vite(['resources/js/games/launchGame.js'])

            <div class="box-1" id='buttonPlay'>
                <div class="btn btn-one">
                    <span>JOUER</span>
                </div>
            </div>

    </div>

        <!--=======JEU========-->


            <div id='game' class='backgroundDark containerMiddleColumn noMargin height1 colorWhite bigText1'>
            </div>

        <!--=======JEU========-->
        
    <div class='background{{ $game['categoryGames']['name'] }} littlePadding1 colorWhite backgroundGame'>
        <hr>

        <div class='containerAlign littleMargin1'>

            <div class="card colorWhite backgroundDark littleMargin1">
                <h1>Vos statistiques</h1>
                <p class='smallText1'>- 98'992 points</p>
                <p class='smallText1'>- Rang : Nul à ch*er</p>
                <p class='smallText1'>- Temps de réponse moyen : 99s</p>
            </div>

        </div>

        

    </div>  

@endsection