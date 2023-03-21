<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        @vite([
                'resources/css/style.css',
                'resources/css/container.css', 
                'resources/css/animation.css', 
                'resources/css/specific.css', 
                'resources/css/color.css'])

        <title>IQWorld</title>

    </head>

    <header>

        <div class="navbar backgroundDark">

            <a href="{{ route('home') }}" class="backgroundBlue">IQWorld</a>
            <a href="">@lang("text.games")</a>
            <a href="">@lang("text.leaderboards")</a>
            
          <!-- Ajouter un espace entre les liens à gauche et à droite -->
        <div style="flex-grow:1;"></div>

        @guest
            <a href="{{ route('login') }}">@lang("text.login")</a>
            <a href="{{ route('register') }}">@lang("text.register")</a>
        @else
            <a href="">Profil</a>
            <a href="{{ url('logout') }}">Se déconnecter</a>
        @endguest
        <a class='smallText2' href="{{ route('language.switch', ['lang' => 'fr']) }}">FR</a>
        <a class='smallText2' href="{{ route('language.switch', ['lang' => 'en']) }}">EN</a>
          
        </div>
                {{-- <div>
                    @auth
                        <a href="{{ url('logout') }}">Se déconnecter</a>
                    @else
                        <a href="{{ route('login') }}">Se connecter</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}">S'inscrire</a>
                        @endif
                    @endauth
                </div> --}}
    </header>
    <body>
            @yield('content')
    </body>
</html>
