<nav class="navbar">

    <div class="akaSubNavContainer mt-3">

        <a class="akaNavLink {{ request()->path() === 'errorReport' ? 'active' : '' }}" href="{{ url('errorReport') }}">Felanmälan</a>
        
        <a class="akaNavLink {{ request()->path() === 'malfunction' ? 'active' : '' }}" href="{{ url('malfunction') }}">Driftstörning</a>
     
    </div>
    
</nav>