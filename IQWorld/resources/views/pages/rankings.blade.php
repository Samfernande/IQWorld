@extends('template')

@section('content')

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
          <tr>
            <td>1</td>
            <td>Alice</td>
            <td>Gold</td>
            <td>1500</td>
          </tr>
          <tr>
            <td>2</td>
            <td>Bob</td>
            <td>Silver</td>
            <td>1300</td>
          </tr>
          <tr>
            <td>3</td>
            <td>Charlie</td>
            <td>Bronze</td>
            <td>1200</td>
          </tr>
        </tbody>
      </table>

</div>

@endsection