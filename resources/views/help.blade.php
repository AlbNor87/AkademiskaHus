
@extends('layouts.default')

@section('content')
<div class="akaContainer mb-4">
    <div class="row">
        <div class="col mt-2">
            

            

            @if (Auth::check())
                <h2>Logga ut</h2>
                <a href="{{ url('logout') }}">
                {{-- <form action="" class="mb-3">
                        {{ csrf_field() }} --}}
        
                        <button class="btn btn-block text-white mb-3" type="submit">Logga ut</button>
                        
                {{-- </form><!-- / --> --}}
                </a>
            @else
            <h2>Logga in</h2>    
            <p>Här kan du som hyresgäst hos Akademiska Hus logga in för att enklare genomföra felanmälan.</p>

            <div id="app"></div>

            @if ($errors->any())
                <div class="alert alert-danger" role="alert">
                    {{ $errors->first() }}
                </div><!-- /alert -->
            @endif

            <form action="{{ url('login') }}" method="post" class="mb-3">
                {{ csrf_field() }}

                <div class="form-group">
                    {{-- <label for="email">Email</label> --}}
                    <input class="form-control" type="email" name="email" placeholder="Användarnamn">
                </div><!-- /form-group -->

                <div class="form-group">
                    {{-- <label for="email">Lösenord</label> --}}
                    <input class="form-control" type="password" name="password" placeholder="Lösenord">
                </div><!-- /form-group -->

                <button class="btn btn-block text-white" type="submit">Logga in</button>
                
            </form><!-- / -->

            <p>Har du som hyresgäst inte mottagit ett konto vänligen kontakta oss <a href="mailto:info@akademiskahus.se?Subject=Hallå%20där!" target="_top">här</a>.</p>
                
            @endif
            
            <h3 class="akaMt2rem">Kontakt oss</h3>
            <p>Välkommen att kontakta oss med dina frågor och funderingar. Vårt huvudkontor ligger i Göteborg och samspelar med våra lokalkontor runt om i landet. Vill du anmäla ett fel i någon av våra byggnader? Det gör du snabbt och enkelt i vår <a href="{{ url('errorReport') }}">felanmälan</a>.</p>
            <p class="akaFontWeightM">Telefon: <span class="akaGreen akaFontWeightL"> 031-63 24 00</span></p>
            <p class="akaFontWeightM">E-post: <span class="akaGreen akaFontWeightL"><a href="mailto:info@akademiskahus.se?Subject=Hallå%20där!" target="_top">info@akademiskahus.se</a></span> <br>
            <span class="akaFontWeightL">För att kontakta en specifik medarbetare via e-post: <span class="akaGreen">fornamn.efternamn@akademiskahus.se</span></span></p>
            {{-- <p class="akaFontWeightL">För att kontakta en specifik medarbetare via e-post: <span class="akaGreen">fornamn.efternamn@akademiskahus.se</span></p> --}}
            <p class="akaFontWeightM">Besöksadress: <span class="akaGreen akaFontWeightL">Stampgatan 14, 411 01 Göteborg</span></p>
            <p class="akaFontWeightM">Postadress: <span class="akaGreen akaFontWeightL">Box 483, 401 27 Göteborg</span></p>

        </div><!-- /col -->
    </div><!-- /row -->
</div><!-- /akaContainer -->
@stop
