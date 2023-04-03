<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta id={{Auth::id()}}>
        <!-- Script pour les graphiques -->
        <script src="https://cdn.jsdelivr.net/npm/echarts@latest"></script>
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
            <a href="{{ route('rankings') }}">@lang("text.leaderboards")</a>
            
          <!-- Ajouter un espace entre les liens à gauche et à droite -->
        <div style="flex-grow:1;"></div>

        @guest
            <a href="{{ route('login') }}">@lang("text.login")</a>
            <a href="{{ route('register') }}">@lang("text.register")</a>
        @else
            <a href="{{ route('profile', ['id' => Auth::user()->id]) }}">@lang("text.profile")</a>
            <a href="{{ url('logout') }}">@lang("text.disconnect")</a>
        @endguest
          
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
    <footer>
        <div class="footer-container">
            <div class="footer-links">
                <a href="{{ route('home') }}">IQWorld</a>
                <a href="">@lang("text.games")</a>
                <a href="{{ route('rankings') }}">@lang("text.leaderboards")</a>
                @guest
                    <a href="{{ route('login') }}">@lang("text.login")</a>
                    <a href="{{ route('register') }}">@lang("text.register")</a>
                @else
                    <a href="{{ route('profile', ['id' => Auth::user()->id]) }}">@lang("text.profile")</a>
                    <a href="{{ url('logout') }}">@lang("text.disconnect")</a>
                @endguest
            </div>
            <div class="footer-text">
                Tous droits réservés © 2023 IQWorld
            </div>
        </div>
    </footer>
</html>
