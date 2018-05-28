<div class="akaNavPlaceholder"></div>

<nav class="navbar fixed-top akaNavTop">

    <div class="akaNavbarContainer">
    
        <a class="navbar-brand" href="{{url('/')}}"><img src="/images/logo.svg" alt="logo"></a> 

        @if (Auth::check())
            
            <p class="akaTime">{{Auth::user()->name}}</p>

        @endif

        <a class="akaNavTopLink" href="{{ url('help') }}">Hjälp</a>
        
    </div>
    
</nav>

@if (Auth::check())

    @if(request()->path() === 'errorReport' || request()->path() === 'malfunction')
    @include('partials.nav-subNav')
    @endif

@endif