<nav class="navbar evn-navigation" role="navigation" aria-label="main navigation">
    <div class="navbar-brand">
        <a class="navbar-item logo" href="/">
            <h2>Eventik</h2>
        </a>

        {{-- <a role="button" class="navbar-burger burger" aria-label="menu" aria-expanded="false" data-target="navbarBasicExample">
            <span aria-hidden="true"></span>
            <span aria-hidden="true"></span>
            <span aria-hidden="true"></span>
        </a> --}}
    </div>

    <input type="checkbox" id="navbar-burger-toggle" class="navbar-burger-toggle is-hidden">
    <label for="navbar-burger-toggle" class="navbar-burger">
        <span></span>
        <span></span>
        <span></span>
    </label>

    <div id="navbarBasicExample" class="navbar-menu">

        <div class="navbar-start">
            <div class="control has-icons-left">
                <input class="input is-rounded search-bar" type="search">
        
                <span class="icon is-left">
                    <i class="fas fa-search"></i>
                </span>
            </div>
        </div>

        <div class="navbar-end">
            <a class="navbar-item">
                Browse Events
            </a>

            @auth

                <div class="navbar-item has-dropdown is-hoverable">
                    <a class="navbar-link">
                        John Doe
                    </a>

                    <div class="navbar-dropdown">
                        <a class="navbar-item">
                            My Events
                        </a>

                        <a class="navbar-item">
                            Saved Events
                        </a>

                        <a class="navbar-item">
                            Tickets
                        </a>

                    </div>
                </div>

                <span>
                    
                    <a href="{{ route('logout') }}" class="navbar-item" onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();">
                        Log Out
                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </span>

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