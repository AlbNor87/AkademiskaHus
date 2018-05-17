<nav class="navbar bg-light">
    <a class="navbar-brand" href="{{url('/')}}">Akademiska Hus</a> 

        <ul class="navbar-nav justify-content-end">
            @if (Auth::check())
                <li class="nav-item">
                    <a class="nav-link" href="{{ url('logout') }}">Logga ut</a>
                </li><!-- /nav-item -->
            @else
                <li class="nav-item {{ request()->path() === 'login' ? 'active' : '' }}">
                    <a class="nav-link" href="{{ url('login') }}">Logga in</a>
                </li><!-- /nav-item -->
            @endif
        </ul><!-- /navbar-nav -->

  </nav>