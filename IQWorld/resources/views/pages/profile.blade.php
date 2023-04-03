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


@endsection