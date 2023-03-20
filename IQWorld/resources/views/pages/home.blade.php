@extends('template')




@section('content')
    <div class='containerMiddleColumn websiteBackground littlePadding1'>
        <h1 class='bigText2 colorLight'>
            IQWorld
        </h1>

        <img src="{{ Storage::url('static/logo.png') }}">

        <p class='smallText1 colorLight textCenter'>
            @lang('text.welcome')
        </p>
    </div>

    <div class='backgroundLight littlePadding1'>

        <hr>

        <h1 class='colorDark'>
            Jeux du jour
        </h1>

        <div class='containerAlign littleMargin1'>
        
            @foreach ($gameOfDay[0] as $game)
            <div class="card background{{$game['categoryGames']['name']}} littleMargin1">

                <a href={{ route('gameInfo', ['id' => $game['id']]) }} class='smallText2 colorWhite '>

                    <div class='containerSpaceBetween'>
                        <p>{{ $game['name'] }}</p>
                        <img src="{{ Storage::url("static/gamesIcon/" . $game['categoryGames']['name'] . ".png") }}" alt="Avatar" class="card-image">
                    </div>

                    <div>
                    <p class='smallText2'>{{ $game['categoryGames']['name'] }}</p>
                    </div>
                </a>
            </div>
            @endforeach

        </div>

        <hr>

        <h1 class='colorDark'>
            Actualités
        </h1>

        @foreach ($posts as $post)
        <div class='containerAlign'>
            <div class="page backgroundWhite">
            <a href='' class='smallText1'>
                <h1 class="smallText1 colorDark">{{ $post['title'] }}</h1>
                <hr class="line">
                <div class="smallText2 colorDark"> {!! $post['content'] !!} </div>
                <hr class="line">
                <p class="smallText2 author colorDark">- {{ $post['users']['name'] }}</p>
            </a>
            </div>
        </div>
        @endforeach

        <hr>

        <h1 class='colorDark'>
            Derniers jeux ajoutés
        </h1>


        <div class='containerAlign littleMargin1'>
        
            @foreach ($games as $game)
            <div class="card background{{$game['categoryGames']['name']}} littleMargin1">

                <a href={{ route('gameInfo', ['id' => $game['id']]) }} class='smallText2 colorWhite '>

                    <div class='containerSpaceBetween'>
                        <p>{{ $game['name'] }}</p>
                        <img src="{{ Storage::url("static/gamesIcon/" . $game['categoryGames']['name'] . ".png") }}" alt="Avatar" class="card-image">
                    </div>

                    <div>
                    <p class='smallText2'>{{ $game['categoryGames']['name'] }}</p>
                    </div>

                </a>

            </div>
            @endforeach

        </div>


    </div>

@endsection