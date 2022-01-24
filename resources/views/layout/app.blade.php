<!DOCTYPE html>
<html lang="en">
    <head>
        <title>@yield('title') - Bee Active</title>

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
                            <button type="submit">Logout</button>
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
