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
  
  <h1 class='colorDark containerAlignLeft gamesTitle'>Logic games <p class='smallText1 arrow'>▼</p></h1>
<div class='containerAlignLeft littleMargin1 gamesList'>
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
  <h1 class='colorDark containerAlignLeft gamesTitle'>Concentration games <p class='smallText1 arrow'>▼</p></h1>
  <div class='containerAlignLeft littleMargin1 gamesList'>
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
</div>
  <hr>
  <h1 class='colorDark containerAlignLeft gamesTitle'>Reflex games <p class='smallText1 arrow'>▼</p></h1>


  <div class='containerAlignLeft littleMargin1 gamesList'>
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
  <h1 class='colorDark containerAlignLeft gamesTitle'>Memory games <p class='smallText1 arrow'>▼</p></h1>


  <div class='containerAlignLeft littleMargin1 gamesList'>
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

<style>
  /*TU DOIS ARRANGER LES ANIMATIONS, METTRE LE SCRIPT DANS UN JS, APPLIQUER CA A TOUT*/

    /* Ajouter une transition CSS sur la propriété max-height */
    .gamesList {
        overflow: hidden;
        transition: max-height 0.5s ease-in-out;
    }

    .gamesTitle:hover {
      cursor: pointer;
    }
</style>

<script>
    // Sélectionner tous les éléments h1 et div
    const logicGamesTitles = document.querySelectorAll('.gamesTitle');
    const logicGamesLists = document.querySelectorAll('.gamesList');

    // Parcourir tous les éléments h1
    logicGamesTitles.forEach((logicGamesTitle, index) => {
        // Sélectionner l'élément span et l'élément div correspondant
        const arrow = logicGamesTitle.querySelector('.arrow');
        const logicGamesList = logicGamesLists[index];

        // Cacher l'élément div au chargement de la page
        logicGamesList.style.maxHeight = '0';

        // Ajouter un gestionnaire d'événements click à l'élément h1
        logicGamesTitle.addEventListener('click', () => {
            // Si l'élément div est caché, le montrer
            if (logicGamesList.style.maxHeight === '0px') {
                logicGamesList.style.maxHeight = '500px'; // Définir sur une valeur suffisamment grande pour montrer tous les éléments
                arrow.innerHTML = '▲'; // Changer la flèche vers le haut
            } else {
                // Sinon, le cacher
                logicGamesList.style.maxHeight = '0';
                arrow.innerHTML = '▼'; // Changer la flèche vers le bas
            }
        });
    });
</script>

@endsection