@extends('template')

@section('content')
<div class='backgroundLight bigPadding2 containerMiddleAlign'>
<hr>

    @if ($noProfile == 0)
    <h1 class='giganticText'>@lang("text.404")</h1>
    <p class='bigText1'>@lang("text.messageError")</p>
    <a href="{{route('home')}}" class='smallText1 littleMargin1'><p class='smallText1 colorDark'>You can go back here</p></a>
    @else
    <h1 class='giganticText'>This user does not seem to exist...</h1>
    <a href="{{route('rankings')}}" class='smallText1 littleMargin1'><p class='smallText1 colorDark'>You can go back here</p></a>
    @endif
<hr>

</div>
@endsection