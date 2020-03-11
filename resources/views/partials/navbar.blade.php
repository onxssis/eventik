<nav class="navbar evn-navigation" role="navigation" aria-label="main navigation">
    <div class="navbar-brand">
        <a class="navbar-item logo" href="/">
            <h2>Eventik</h2>
        </a>
    </div>

    <input type="checkbox" id="navbar-burger-toggle" class="navbar-burger-toggle is-hidden">
    <label for="navbar-burger-toggle" class="navbar-burger">
        <span></span>
        <span></span>
        <span></span>
    </label>

    <div id="navbarBasicExample" class="navbar-menu">

        <div class="navbar-start">
            <form action="/b">
                <div class="control has-icons-left">
                    <input class="input is-rounded search-bar" name="q" type="search">

                    <span class="icon is-left">
                        <i class="fas fa-search"></i>
                    </span>
                </div>
            </form>
        </div>

        <div class="navbar-end">
            <a href="/b" class="navbar-item">
                Browse Events
            </a>

            @auth

            <a class="navbar-item" href="{{ route('events.create') }}">
                Create Event
            </a>

            <div class="navbar-item has-dropdown is-hoverable">
                <a href="" class="navbar-item">
                    <avatar name="{{ auth()->user()->name }}" width="50" height="50"></avatar>
                </a>

                <div class="navbar-dropdown">
                    <a href="{{ route('home') }}" class="navbar-item">
                        My Events
                    </a>

                    <a href="{{ route('home') }}" class="navbar-item">
                        Tickets
                    </a>

                    <a href="{{ route('logout') }}" class="navbar-item" onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();">
                        Log Out
                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>

                </div>
            </div>

            @else

            <div class="navbar-item">
                <div class="buttons">
                    <a href="{{ route('register') }}" class="button is-light">
                        Sign up
                    </a>

                    <a href="{{ route('login') }}" class="button login-button">
                        Log in
                    </a>
                </div>
            </div>

            @endauth
        </div>
    </div>
</nav>