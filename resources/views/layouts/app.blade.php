<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    @yield('css')
    <style>
        /*body{*/
        /*    margin-top: 50px;*/
        /*    background-color: #f1f1f1;*/
        /*}*/
        /*.nav-pills .nav-link.active, .nav-pills .show > .nav-link{*/
        /*    background-color: #17A2B8;*/
        /*}*/
        .dropdown-menu{
            top: 60px;
            right: 0px;
            left: unset;
            width: 460px;
            box-shadow: 0px 5px 7px -1px #c1c1c1;
            padding-bottom: 0px;
            padding: 0px;
        }
        .dropdown-menu:before{
            content: "";
            position: absolute;
            top: -20px;
            right: 12px;
            /*border:10px solid #343A40;*/
            border-color: transparent transparent #343A40 transparent;
        }
        .head{
            padding:5px 15px;
            border-radius: 3px 3px 0px 0px;
        }
        .footer{
            padding:5px 15px;
            border-radius: 0px 0px 3px 3px;
        }
        .notification-box{
            padding: 10px 0px;
        }
        .bg-gray{
            background-color: #eee;
        }
        /*@media (max-width: 640px) {*/
        /*    .dropdown-menu{*/
        /*        top: 50px;*/
        /*        left: -16px;*/
        /*        width: 290px;*/
        /*    }*/
        /*.nav{*/
        /*    display: block;*/
        /*}*/
        /*.nav .nav-item,.nav .nav-item a{*/
        /*    padding-left: 0px;*/
        /*}*/
        .message{
            font-size: 13px;
        }
    </style>
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item">
                            <a href="{{ route('discussions.index') }}" class="nav-link">Discussions</a>
                        </li>
                    </ul>

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
                                <a class="nav-link text-dark" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <svg class="bi bi-bell" width="1em" height="1em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M8 16a2 2 0 002-2H6a2 2 0 002 2z"/>
                                        <path fill-rule="evenodd" d="M8 1.918l-.797.161A4.002 4.002 0 004 6c0 .628-.134 2.197-.459 3.742-.16.767-.376 1.566-.663 2.258h10.244c-.287-.692-.502-1.49-.663-2.258C12.134 8.197 12 6.628 12 6a4.002 4.002 0 00-3.203-3.92L8 1.917zM14.22 12c.223.447.481.801.78 1H1c.299-.199.557-.553.78-1C2.68 10.2 3 6.88 3 6c0-2.42 1.72-4.44 4.005-4.901a1 1 0 111.99 0A5.002 5.002 0 0113 6c0 .88.32 4.2 1.22 6z" clip-rule="evenodd"/>
                                    </svg>
                                    <span class="badge badge-danger">{{auth()->user()->unreadNotifications->count()}}</span>
                                </a>
                                <ul class="dropdown-menu">
                                    <li class="head text-light bg-dark">
                                        <div class="row">
                                            <div class="col-lg-12 col-sm-12 col-12">
                                                <span>Notifications</span>
                                                <a href="" class="float-right text-light">Mark all as read</a>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="notification-box">
                                        <ul class="list-group">
                                           @if(auth()->user()->notifications->count()>0)
                                                @foreach(auth()->user()->unReadNotifications as $notification)
                                                    <li class="list-group-item">
                                                        @if($notification->type == 'App\Notifications\NewReplyAdded')
                                                            <div class="row">
                                                                <div class="col-lg-3 col-sm-3 col-3 text-center">
                                                                    <img height="30px" width="30px" style="border-radius: 50%;" src="{{Gravatar::src($notification->data['discussion']['author']['email'])}}" class="w-50 rounded-circle">
                                                                </div>
                                                                <div class="col-lg-8 col-sm-8 col-8">
                                                                    <strong class="text-info"></strong>
                                                                    <div>
                                                                        New Reply to your discussion from {{$notification->data['discussion']['author']['name']}}
                                                                    </div>
                                                                    <small class="text-primary">{{\Carbon\Carbon::parse($notification->created_at)->diffForHumans()}}</small>
                                                                </div>
                                                            </div>
                                                        @endif
                                                          @if($notification->type == 'App\Notifications\MarkBestReply')
                                                                <div class="row">
                                                                    <div class="col-lg-3 col-sm-3 col-3 text-center">
                                                                        <img height="30px" width="30px" style="border-radius: 50%;" src="{{Gravatar::src($notification->data['discussion']['user_id'])}}" class="w-50 rounded-circle">
                                                                    </div>
                                                                    <div class="col-lg-8 col-sm-8 col-8">
                                                                        <strong class="text-info"></strong>
                                                                        <div>
                                                                            Your reply to <strong>{{$notification->data['discussion']['title']}}</strong> was marked as best reply
                                                                        </div>
                                                                        <small class="text-primary">{{\Carbon\Carbon::parse($notification->created_at)->diffForHumans()}}</small>
                                                                    </div>
                                                                </div>
                                                            @endif
                                                    </li>
                                                @endforeach
                                               @else
                                                <li class="list-group-item text-center">No new notifications</li>
                                               @endif
                                        </ul>
                                    </li>
                                    <li class="footer bg-dark text-center">
                                        <a href="{{ route('users.notification') }}" class="text-light">View All</a>
                                    </li>
                                </ul>
                            </li>
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown" style=" width: 20px;">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

           @if(!in_array(request()->path(),['register','login','password/email','password/reset']))
            <main class="container py-4">
                <div class="row">
                    <div class="col-md-3">
                        <div class="d-flex flex-column justify-content-center mb-2">
                            @auth
                                <a href="{{ route('discussions.create') }}" style="color:#fff;" class="btn btn-info"> Add Discussion</a>
                            @else
                                <a href="{{ route('login') }}" style="color:#fff;" class="btn btn-info">Sign in to Add Discussion</a>
                            @endauth
                        </div>

                        <div class="card-header">
                            <h5>Channels</h5>
                        </div>
                        <ul class="list-group">
                            @foreach($channels as $channel)
                                <li class="list-group-item">
                                    {{$channel->name}}
                                </li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="col-md-9">
                        @yield('content')
                    </div>
                </div>
            </main>
               @else
            <main class="py-4">
                @yield('content')
            </main>
               @endif

    </div>

    <script src="{{ asset('js/app.js') }}"></script>
@yield('js')
</body>
</html>
