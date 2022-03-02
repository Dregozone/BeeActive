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
    </head>
    <body>

        <nav>
            <div class="container">
                <ul>
                    <li>
                        <a href="{{ route('home') }}">
                            Home
                        </a>
                    </li>

                    @auth
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
