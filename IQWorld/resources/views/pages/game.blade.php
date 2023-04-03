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

        @if ($user !== null)

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
                <p class='smallText1'>- Record : {{ $maxPoints }}pts</p>
            </div>
        @endif


        <div id="graph" style="width: 70%;height: 400px;"></div>

        <script type="text/javascript">
            var averagePointsPerGame = @json($statistics);

        // Récupérez l'élément DOM dans lequel vous voulez afficher le graphique
        var chartDom = document.getElementById('graph');
        var myChart = echarts.init(chartDom);

        // Calculez le nombre total de scores
        var totalScores = averagePointsPerGame.reduce(function(total, game) {
            return total + game.count;
        }, 0);

        // Préparez les données pour le graphique
        var data = [];
        averagePointsPerGame.forEach(function(game) {
            var percentage = game.count / totalScores * 100;
            data.push([percentage, game.debut]);
        });

        var option = {
            title: {
                text: 'Average scores',
                left: 'right',
                top: 20,
                textStyle: {
                    color: '#fff'
                }
            },
            xAxis: {
                type: 'value',
                name: 'Scores',
                nameTextStyle: {
                    color: '#fff'
                },
                axisLabel: {
                    textStyle: {
                        color: '#fff'
                    }
                },
                splitLine: {
                    show: false
                }
            },
            yAxis: {
                type: 'value',
                name: '% of players',
                nameTextStyle: {
                    color: '#fff'
                },
                axisLabel: {
                    textStyle: {
                        color: '#fff'
                    },
                    formatter: function(value) {
                        return value + '%';
                    }
                },
                splitLine: {
                    show: false
                }
            },
            series: [{
                data: data.map(function(item) {
                    return [item[1], item[0]];
                }),
                type: 'line',
                lineStyle: {
                    color: '#fff'
                },
                itemStyle: {
                    color: '#fff'
                }
            }]
        };

        // Affichez le graphique
        myChart.setOption(option);
    </script>

    </div>

</div>  

@endsection