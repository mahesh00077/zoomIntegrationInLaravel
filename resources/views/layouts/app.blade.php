<!DOCTYPE html>
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

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <!-- <link type="text/css" rel="stylesheet" href="https://source.zoom.us/1.8.6/css/bootstrap.css" /> -->
    <!-- <link type="text/css" rel="stylesheet" href="https://source.zoom.us/1.8.6/css/react-select.css" /> -->
    <style>

    </style>
</head>

<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse"
                    data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                    aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->


                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                        </li>
                        @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                        </li>
                        @endif
                        @else
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->name }} <span class=""></span>
                            </a>

                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                    style="display: none;">
                                    @csrf
                                </form>
                            </div>
                        </li>
                        <?php

                        $role = getRoleID(Auth::id());
                        if ($role == '1' || $role == 1) {
                        ?>
                        <li class="">
                            <a class="nav-link" href="{{ url('create/meeting') }}">Create Meeting</a>
                        </li>
                        <?php } elseif ($role == '2' || $role == 2) { ?>
                        <li class="">
                            <a class="nav-link" href="{{ url('join/meeting') }}">Join Meeting</a>
                        </li>
                        <?php } ?>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

    <!-- <script src="https://source.zoom.us/1.7.8/lib/vendor/react.min.js"></script>
    <script src="https://source.zoom.us/1.7.8/lib/vendor/react-dom.min.js"></script>
    <script src="https://source.zoom.us/1.7.8/lib/vendor/redux.min.js"></script>
    <script src="https://source.zoom.us/1.7.8/lib/vendor/redux-thunk.min.js"></script>
    <script src="https://source.zoom.us/1.7.8/lib/vendor/lodash.min.js"></script> -->
    <script src="https://us05st1.zoom.us/web_client/o3ep7n/js/av-sdk/js_media.min.js"></script>
    <script nonce="9-O-Hm4ASYiQBU8EPp-xKg" type="text/javascript"
        src="https://us05st1.zoom.us/web_client/o3ep7n/js/vendor/react.min.js"></script>
    <script nonce="9-O-Hm4ASYiQBU8EPp-xKg" type="text/javascript"
        src="https://us05st1.zoom.us/web_client/o3ep7n/js/vendor/react-dom.min.js"></script>
    <script nonce="9-O-Hm4ASYiQBU8EPp-xKg" type="text/javascript"
        src="https://us05st1.zoom.us/web_client/o3ep7n/js/vendor/redux.min.js"></script>
    <script nonce="9-O-Hm4ASYiQBU8EPp-xKg" type="text/javascript"
        src="https://us05st1.zoom.us/web_client/o3ep7n/js/vendor/redux-thunk.min.js"></script>
    <script nonce="9-O-Hm4ASYiQBU8EPp-xKg" type="text/javascript"
        src="https://us05st1.zoom.us/web_client/o3ep7n/js/vendor/classnames.min.js"></script>
    <script nonce="9-O-Hm4ASYiQBU8EPp-xKg" type="text/javascript"
        src="https://us05st1.zoom.us/web_client/o3ep7n/js/vendor/lodash.min.js"></script>
    <!-- import ZoomMtg -->
    <!-- <script src="https://source.zoom.us/zoom-meeting-1.8.5.min.js"></script> -->
    @section('script')
    @show
</body>


</html>