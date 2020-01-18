@extends('layouts.app')

@section('content')
<div class="jumbotron text-center">
        <h1>Welcom to laravel</h1>
 <ul class="navbar-nav ml-auto">
                <!-- Authentication Links -->
                @guest

                       <p> <a class="btn btn-primary btn-lg" href="{{ route('login') }}">{{ __('Login') }}</a>


                    @if (Route::has('register'))

                            <a class="btn btn-success btn-lg" href="{{ route('register') }}">{{ __('Register') }}</a>

                    @endif
                    </p>
                @else
                    <li class="nav-item dropdown">


                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="/home">Dashbord</a>

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
@endsection
