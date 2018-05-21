<div class="akaNavPlaceholder"></div>

<nav class="navbar fixed-top akaNavTop">

    <div class="akaNavbarContainer">
    
        <a class="navbar-brand" href="{{url('/')}}"><img src="/images/logo.svg" alt="logo"></a> 

        <ul class="navbar-nav justify-content-end">
                <li class="nav-item">
                        <a class="nav-link" href="{{ url('help') }}">Hjälp</a>
                    </li><!-- /nav-item -->
        </ul><!-- /navbar-nav -->

    </div>
    
</nav>

@if (Auth::check())

    @if(request()->path() === 'errorReport' || request()->path() === 'malfunction')
    @include('partials.nav-subNav')
    @endif

@endif