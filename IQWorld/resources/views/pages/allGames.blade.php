@extends('template')

@section('content')
<div class='backgroundLight littlePadding1'>
<h1 class='giganticText colorDark'>All games</h1>

  <h1 class='colorDark'>Games of the day</h1>

  <div class='containerAlignLeft littleMargin1'>
        
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
  <h1 class='colorDark'>Logic games</h1>
    <div class='containerAlignLeft littleMargin1'>
            @foreach ($logicGame as $game)
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
  <h1 class='colorDark'>Concentration games</h1>
  <div class='containerAlignLeft littleMargin1'>
  @foreach ($concentrationGame as $game)
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
    </div
  <hr>
  <h1 class='colorDark'>Reflex games</h1>

  <div class='containerAlignLeft littleMargin1'>
  @foreach ($reflexGame as $game)
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
  <h1 class='colorDark'>Memory games</h1>

  <div class='containerAlignLeft littleMargin1'>
  @foreach ($memoryGame as $game)
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