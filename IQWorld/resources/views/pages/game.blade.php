@extends('template')

@section('content')

    <div class='background{{ $game['categoryGames']['name'] }} littlePadding1 colorWhite'>

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

        <div class='containerAlign littleMargin1'>

            <canvas id="canvasGames" width="500" height="500" style="border:1px solid;">
                Votre navigateur ne supporte pas le canvas.
            </canvas>

        </div>

    </div>

    @vite('resources/js/games/speedcalcul.js')

@endsection