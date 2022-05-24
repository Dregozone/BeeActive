<!DOCTYPE html>
<html lang="en">
    <head>
        <title>@yield('title') - {{ config('app.name') }}</title>

        <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('apple-touch-icon.png') }}">
        <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('favicon-32x32.png') }}">
        <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('favicon-16x16.png') }}">
        <link rel="manifest" href="{{ asset('site.webmanifest') }}">
        <link rel="mask-icon" href="{{ asset('safari-pinned-tab.svg') }}" color="#ffc40d">
        <meta name="msapplication-TileColor" content="#ffc40d">
        <meta name="theme-color" content="#ffc40d">        

        <link rel="stylesheet" href="{{ asset('css/app.css') }}" />
        <link rel="stylesheet" href="{{ asset('css/shared.css') }}" />

        @if ( file_exists('css/' . Route::currentRouteName() . '.css') )
            <link rel="stylesheet" href="{{ asset('css/' . Route::currentRouteName() . '.css') }}" />
        @endif 

        @if ( file_exists('js/' . Route::currentRouteName() . '.js') )
            <script src="{{ asset('js/' . Route::currentRouteName() . '.js') }}"></script>
        @endif 

    </head>
    <body>

        <nav>
            <div class="container">
                <ul>
                    <li>
                        <img src="{{ asset('img/logo.png') }}" alt="Bee Active logo" class="logo" />
                    </li>

                    <li>
                        <a href="{{ route('dashboard') }}">
                            Dashboard
                        </a>
                    </li>

                    @auth
                        <li>
                            <a href="{{ route('schedule') }}">
                                Schedule
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('workouts') }}">
                                Workouts
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('nutrition') }}">
                                Nutrition
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('weight') }}">
                                Weight
                            </a>
                        </li>
                    @endauth
                </ul>

                <ul>
                    @auth
                        <li>
                            <a href="{{ route('profile') }}">
                                Profile
                            </a>
                        </li>
                        <li>
                            <form action="{{ route('logout') }}" method="post">
                                @csrf
                                <button class="logoutButton" type="submit">Logout</button>
                            </form>
                        </li>
                    @endauth

                    @guest
                        <li>
                            <a href="{{ route('login') }}">
                                Login
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('register') }}">
                                Register
                            </a>
                        </li>
                    @endguest
                </ul>
            </div>
        </nav>

        <main class="container">
            @yield('content')
        </main>
    
    </body>
</html>
