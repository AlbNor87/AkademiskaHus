<div class="akaNavPlaceholder"></div>

<nav class="navbar fixed-bottom akaNavBottom">
    
    <a class="navbar-brand nopacity" href="{{url('/')}}">Akademiska Hus</a> 

        <ul class="navbar-nav justify-content-end">
            @if (Auth::check())
                <li class="nav-item">
                    <a class="nav-link nopacity" href="{{ url('logout') }}">Logga ut</a>
                </li><!-- /nav-item -->
            @else
                <li class="nav-item {{ request()->path() === 'login' ? 'active' : '' }}">
                    <a class="nav-link nopacity" href="{{ url('login') }}">Logga in</a>
                </li><!-- /nav-item -->
            @endif
        </ul><!-- /navbar-nav -->
        
        <div class="akaBubbleContainer">
            <div class="akaBubble akaPink"></div>
            <div class="akaBubble akaGreen"></div>
            <div class="akaBubble akaWhite"></div>
        </div>
</nav>