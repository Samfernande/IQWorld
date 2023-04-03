@extends('template')

@section('content')

<div class='backgroundLight noMargin littlePadding1'>
    <h1>Page de profil</h1>

    <div class='containerSpaceBetween'>
        <h1 class='littleMargin1 smallText1'>{{ $user['name'] }}</h1>

        <div class='profilePicture littlePadding2'>
            @if(!empty($user['imgPath']))
            <img class='roundBorder' src="{{ Storage::url($user['imgPath']) }}" alt='Image du profil'/>
            @else
            <img class='roundBorder' src="{{ Storage::url('static/anonym.png') }}" alt='Image du profil'/>
            @endif
        </div>
    </div>

    @if (Auth::check() && Auth::id() == $user->id)
        <p class='smallText1'>Email : {{ $user['email'] }}</p>
        <div class='backgroundWhite roundBorder'>

            <form action="{{ route('profile', ['id' => Auth::user()->id]) }}" method="POST" enctype="multipart/form-data" class='littlePadding1'>
                @csrf
                <label for="image" class='littleMargin1 smallText1'>Ajouter/Modifier la photo de profil</label> <br>
                <input type="file" name="image" class='file-input' id='file-input'> <br>
                <input type="submit" value="Ajouter" class='file-input right'>
            </form>

        </div>
    @endif

    <p class='smallText1'>Date d'inscription : {{ $user['created_at'] }}</p>

    <hr>

    <h1>Statistiques</h1>

    @if (!$user->game->isEmpty())

    <div class='containerAlign littleMargin1'>

        @foreach ($groupedData['games'] as $key => $game)

        <div class="card background{{$game[0]['categoryGames']['name']}} littleMargin1 colorWhite">
            <div class='containerSpaceBetween'>

                <p>{{$game[0]['name']}}</p>

                <img src="{{ Storage::url("static/gamesIcon/" . $game[0]['categoryGames']['name'] . ".png") }}" alt="Avatar" class="card-image">
            </div>

            <p class='smallText1'>Record : {{$game->max('pivot.points')}}</p>

            @if (isset($groupedData['accuracy'][$key]))
            <p class='smallText1'>Précision moyenne : {{$groupedData['accuracy'][$key] * 100}} %</p>
            @endif
            
            @if (isset($groupedData['reaction_time'][$key]))
            <p class='smallText1'>Temps de réaction moyen : {{$groupedData['reaction_time'][$key]}}s</p>
            @endif
        </div>
        @endforeach
    </div>
@else
<p>Ce joueur ne semble pas avoir de statistiques pour l'instant...</p>
@endif


</div>
@if (Auth::check() && Auth::id() == $user->id)
<script>
document.querySelector('input[type="file"]').addEventListener('change', function(event) {
    var maxSize = 1 * 1024 * 1024; // 10 Mo
    var file = event.target.files[0];
    if (file.size > maxSize) {
        alert('Le fichier est trop volumineux. La taille maximale autorisée est de 1 Mo.');
        event.target.value = null;
    }
});
</script>
@endif

<h1 class='bigText1 colorDark littleMargin1'>Centiles</h1>

<p class='littleMargin1'>
    A centile is a statistical measure that allows you to 
    situate the level of a user in relation to other users. 
    For example, if a user is at the 90th centile, 
    this means that only 10% of players have scored higher than them. 
    In other words, they performed better than 90% of players.
</p>

<div class='containerMiddleColumn littleMargin1 backgroundWhite'>

    <div class="progress-circle">
        <h1 class='giganticText colorDark noMargin'>{{ $generalPercentage }}%</h1>
        <svg class='noMargin'>
          <circle cx="75" cy="-25" r="100"></circle>
          <circle cx="75" cy="-25" r="100"></circle>
        </svg>
    </div>

    <script>
        const percentage = document.querySelector('.giganticText').textContent.slice(0, -1);
        document.querySelector('.progress-circle svg circle:nth-of-type(2)').style.setProperty('--percentage', percentage);

        const textElement = document.querySelector('.giganticText');
const finalValue = parseInt(textElement.textContent.slice(0, -1));
let currentValue = 0;
let startTime;

const easeOutQuad = (t) => t * (2 - t);

const animateValue = (timestamp) => {
  if (!startTime) startTime = timestamp;
  const elapsedTime = timestamp - startTime;
  const duration = 2000; // durée de l'animation en millisecondes
  currentValue = Math.round(easeOutQuad(elapsedTime / duration) * finalValue);
  textElement.textContent = currentValue + '%';
  if (elapsedTime < duration) {
    requestAnimationFrame(animateValue);
  } else {
    textElement.textContent = finalValue + '%';
  }
};

const handleScroll = () => {
  const rect = textElement.getBoundingClientRect();
  if (rect.top < window.innerHeight && !startTime) {
    requestAnimationFrame(animateValue);
  }
};

window.addEventListener('scroll', handleScroll);
    </script>

    <h1 class='littleMargin1 colorDark'>General</h1>
    <div class="progress-container littleMargin1">
        <div class="progress-bar" style="width:{{$generalPercentage}}%; background-color:#a0a0a0">{{$generalPercentage}}%</div>
    </div><br>

    <p>Reflexes</p>
    <div class="progress-container">
        <div class="progress-bar" style="width:{{$reflexesPercentage}}%; background-color:#EB4511">{{$reflexesPercentage}}%</div>
    </div><br>
    
    <p>Concentration</p>
    <div class="progress-container">
        <div class="progress-bar" style="width:{{$concentrationPercentage}}%; background-color:#FE7F2D">{{$concentrationPercentage}}%</div>
    </div><br>
    
    <p>Memory</p>
    <div class="progress-container">
        <div class="progress-bar" style="width:{{$memoryPercentage}}%; background-color:#5995ED">{{$memoryPercentage}}%</div>
    </div><br>
    
    <p>Logic</p>
    <div class="progress-container">
        <div class="progress-bar" style="width:{{$logicPercentage}}%; background-color:#23CE6B">{{$logicPercentage}}%</div>
    </div><br>
</div>

@endsection