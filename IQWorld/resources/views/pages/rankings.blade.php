@extends('template')

@section('content')
<div class='backgroundLight littlePadding1'>
  <h1 class='colorDark littleMargin1'>General Ranking</h1>

  <form action="{{ url('search') }}" method="POST">
      @csrf
      <div class="search-container littleMargin1">
        <input type="text" name="search" class="search-input" placeholder="Search a player">
        <button type="submit" class="search-button">➜</button>
      </div>
    </form>

  <div class='containerMiddleColumn'>

      <table class='tableRanking littleMargin1'>
          <thead>
            <tr>
              <th>Position</th>
              <th>Pseudo</th>
              <th>Rank</th>
              <th>Points</th>
            </tr>
          </thead>
          <tbody>
          @php
            $counter = 1;
          @endphp
          @foreach($user as $soloUser)
              <tr>
                  <td>{{ $counter++ }}</td>
                  <td><a class='smallText2 colorDark' href=" {{ route('profile', ['id' => $soloUser['id']]) }}">{{ $soloUser['name'] }}</a></td>
                  <td>{{ $soloUser['ranking'] }}</td>
                  <td>{{ $soloUser['total_points'] }}</td>
              </tr>
          @endforeach
          </tbody>
        </table>


  </div>

  <hr>

</div>

@endsection