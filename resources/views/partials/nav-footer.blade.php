<div class="akaNavPlaceholder"></div>

<nav class="navbar fixed-bottom akaNavBottom">
    
    {{-- @if (Auth::check()) --}}
{{-- 
    <div class="akaBubbleContainer">

                <a href="/errorReport">
                    <div class="akaBubble akaFel">
                        <p>Felanmälan</p>
                    </div>
                </a>
    
                <a href="/">
                    <div class="akaBubble akaHem">              
                        <p>Hem</p>
                    </div>
                </a>
    
                <a href="/ideas">
                    <div class="akaBubble akaIde">
                        <p>Idélådan</p>
                    </div>
                </a>
    
            </div> --}}
        
    {{-- @else --}}

        <div class="akaBubbleContainer">

                <a href="/errorReport">
                        <div class="akaBubble akaFel {{ request()->path() === 'errorReport' || request()->path() === 'malfunction' ? 'active' : '' }}">
                        
                        <p>Felanmälan</p>
                        </div>
                </a>

                <a href="/">
                        <div class="akaBubble akaHem {{ request()->path() === '/' ? 'active' : '' }}">
                        <p>Hem</p>
                        </div>
                </a>

                <a href="/ideas">
                        <div class="akaBubble akaIde {{ request()->path() === 'ideas' ? 'active' : '' }}">
                        <p>Idélådan</p>
                        </div>
                </a>

        </div>
        
    {{-- @endif --}}
        
</nav>