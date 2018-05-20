<div class="akaNavPlaceholder"></div>

<nav class="navbar fixed-top akaNavTop">
    
    <a class="navbar-brand" href="{{url('/')}}"><img src="http://akademiskahus.test/images/logo.svg" alt=""></a> 

        <ul class="navbar-nav justify-content-end">
                <li class="nav-item">
                        <a class="nav-link" href="{{ url('omoss') }}">Om oss</a>
                    </li><!-- /nav-item -->

            {{-- @if (Auth::check())
                <li class="nav-item">
                    <a class="nav-link" href="{{ url('logout') }}">Logga ut</a>
                </li><!-- /nav-item -->
            @else
                <li class="nav-item {{ request()->path() === 'login' ? 'active' : '' }}">
                    <a class="nav-link" href="{{ url('login') }}">Logga in</a>
                </li><!-- /nav-item -->
            @endif --}}
        </ul><!-- /navbar-nav -->
        
</nav>