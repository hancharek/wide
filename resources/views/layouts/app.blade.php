<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    
    <!-- Styles -->
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">
</head>
<body class="bg-gray-100 h-screen antialiased leading-none font-sans">
    <div id="app">
        <header class="h-19 bg-gradient-to-r from-purple-400 via-pink-500 to-red-500 py-6">
            <div class="container mx-auto flex justify-between items-center px-6">
                <div>
                    <a href="{{ url('/') }}" class="text-lg font-semibold text-gray-100 no-underline">
                        {{ config('app.name', 'Laravel') }}
                    </a>
                </div>
                <nav class="w-full space-x-4 text-gray-300 text-sm sm:text-base px-10">
                    <div class="w-2/4 float-left inset-y-0.left-8">
                        @auth
                            <a href="{{ route("projects.index") }}" class="no-underline">
                                {{ __("Projetos") }}
                            </a> |
                            <a href="{{ route("urls.index") }}" class="no-underline">
                                {{ __("Urls") }}
                            </a> |
                            <a href="{{ route("retornos.index") }}" class="no-underline">
                                {{ __("Retorno Url") }}
                            </a>
                        @endauth
                    </div>
                    <div class="wide-space w-2/4 inset-y-0.right-0 text-right float-right">
                        @guest
                            <a class="no-underline" href="{{ route('login') }}">{{ __('Login') }}</a>
                            @if (Route::has('register'))
                                <a class="no-underline" href="{{ route('register') }}">{{ __('Cadastrar') }}</a>
                            @endif
                        @else
                            <span>{{ Auth::user()->name }}</span>

                            <a href="{{ route('logout') }}"
                            class="no-underline"
                            onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();">{{ __('Logout') }}</a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
                                {{ csrf_field() }}
                            </form>   
                        @endguest
                    </div>
                </nav>
                
        </header>
        
        @yield('content')
    </div>
</body>
</html>
