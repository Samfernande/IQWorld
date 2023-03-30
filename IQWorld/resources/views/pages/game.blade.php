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

        @if ($user != null)
    @php
        $maxPoints = 0;
        foreach ($user['game'] as $game) {
            if ($game['pivot']['points'] > $maxPoints) {
                $maxPoints = $game['pivot']['points'];
            }
        }
    @endphp
    <div class="card colorWhite backgroundDark littleMargin1">
        <h1>Vos statistiques</h1>
        <p class='smallText1'>- Rang : {{ $ranking }}</p>
        <p class='smallText1'>- Record : {{ $maxPoints }}</p>
    </div>
        @else
        <div class="card colorWhite backgroundDark littleMargin1">
                <h1>Statistiques</h1>
                <p class='smallText1'>- Rang : {{ $ranking }}</p>
                <p class='smallText1'>- Points : 0</p>
            </div>
        @endif

        

    </div>  

@endsection