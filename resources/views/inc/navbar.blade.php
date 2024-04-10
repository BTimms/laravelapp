<nav class="navbar navbar-inverse navbar-bg">
    <div class="container">
        <div class="navbar-header">

            <button class="navbar-toggle collapse" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                <span class="icon-bar"></span>
            </button>

            <!-- Branding Image -->
            <a class="logo" href="{{ url('/') }}">
                <a class="navbar-brand" style=" color: #FFFFFF" href="/">SportPost</a>
            </a>
        </div>

        <div class="collapse navbar-collapse" id="app-navbar-collapse">
            <!-- Left Side Of Navbar -->
            <ul class="nav navbar-nav">
                &nbsp;
            </ul>

            <!-- Right Side Of Navbar -->
            <ul class="nav navbar-nav navbar-right">
                @auth
                <li><a style="color: #FFFFFF" href="/posts/create">Create Post</a></li>
                @endauth
                <!-- Authentication Links -->
                @if (Auth::guest())
                    <li><a style=" color: #FFFFFF" href="{{ route('login') }}">Login</a></li>
                    <li><a style=" color: #FFFFFF" href="{{ route('register') }}">Register</a></li>
                @else
                    <li class="dropdown">
                        <a style=" color: #FFFFFF" href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                            {{ Auth::user()->name  }}  <span class="caret"></span>
                        </a>

                        <ul class="dropdown-menu" role="menu">
                            <li><a href="/dashboard">Dashboard</a></li>
                            <li>
                                <a href="{{ route('logout') }}"
                                   onclick="event.preventDefault();
                                              document.getElementById('logout-form').submit();">
                                    Logout
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    {{ csrf_field() }}
                                </form>
                            </li>
                        </ul>
                    </li>
                @endif
            </ul>
        </div>
    </div>
</nav>
