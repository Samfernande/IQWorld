@extends('template')

@section('content')

    <div class='background{{ $game['categoryGames']['name'] }} littlePadding1 colorWhite' id='background'>

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

        <div class='containerAlign littleMargin1'>

            <div class="card colorWhite backgroundDark littleMargin1">
                <h1>Vos statistiques</h1>
                <p class='smallText1'>- 98'992 points</p>
                <p class='smallText1'>- Rang : Nul à ch*er</p>
                <p class='smallText1'>- Temps de réponse moyen : 99s</p>
            </div>

        </div>

        

        <hr>

        <!--=======JEU========-->

        @vite(['resources/js/games/launchGame.js', 'resources/js/games/RabbitDance/rabbitDance.js'])

            <div class="box-1" id='buttonPlay'>
                <div class="btn btn-one">
                    <span>JOUER</span>
                </div>
            </div>

            <div id='textGame' class='containerMiddleColumn littleMargin1'>
                <h1 id='titleGame'> </h1>
                <p id='infoGame' class='smallText1'> </p>
            </div>

            <div class='containerAlign littleMargin1'>

                <canvas id="canvasGames" width="300" height="500" style="border:1px solid;">
                    Votre navigateur ne supporte pas le canvas.
                </canvas>

            </div>

    </div>  

@endsection