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

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <link type="text/css" rel="stylesheet" href="{{ mix('css/app.css') }}">

</head>

<body style="background-color:white">
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm fixed-top">
            <div class="container">
                <a class="navbar-brand d-flex" href="{{ url('/') }}">
                    <!-- {{ config('app.name', 'Laravel') }} -->
                    <div><img src="/img/logo.svg" style="height:25px;border-right: 1px solid #333" class="pr-3"></div>
                    <div class="pl-3">Instagram</div>

                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse"
                    data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                    aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                        @if (Route::has('login'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                        </li>
                        @endif

                        @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                        </li>
                        @endif
                        @else
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->username }}
                            </a>

                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </div>
                        </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        @auth
        <div class="wrapper d-flex w-25 mt-5 justify-content-center pt-5">
            <div class="sidebar">
                <!-- <div style="border-bottom:1px solid gray"> -->
                <ul>
                    <li><a href="#"><img src="{{Auth::user()->profile->profileImage()}}"
                                class="w-50  rounded-circle"></a></li>

                    <h6 style="color:#4682B4">&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{ Auth::user()->username}}
                    </h6>

                    <div class="d-flex">
                        <div class="pr-5"><strong>{{Auth::user()->profile->followers->count()}} </strong>followers</div>
                        <div class="pr-5"><strong>{{Auth::user()->following->count()}} </strong>following</div>
                    </div>
                    <hr>
                    <!-- </div> -->
                     
                    <li><a href="/"><i class="fa fa-home"></i>Home</a></li>
                    <li><a href="/profile/{{auth()->user()->id}}"><i class="fa fa-user"></i>Profile</a></li>
                    <li ><a href="#"><i class="fa fa-envelope"></i>Messages</a></li>
                    <li ><a href="#"><i class="fa fa-bell"></i></i>Notifications</li>
                    <li ><a href="#"><i class="fa fa-bookmark"></i>Bookmarks</a></li>
                    <li><a href="#"><i class="fa fa-poll"></i>Trends</a></li>
                
                </ul>
            </div>
        </div>
        @endauth
        <main class="py-4">
            
                <div class="col-8 pt-5 offset-2" style="left:50px">
                    @yield('content')
                </div>
        </main>
    </div>
</body>

</html>