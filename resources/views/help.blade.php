
@extends('layouts.default')

@section('content')
<div class="akaContainer">
    <div class="row">
        <div class="col mt-2">
            <h2>Om oss</h2>

            

            @if (Auth::check())
                <a href="{{ url('logout') }}">
                {{-- <form action="" class="mb-3">
                        {{ csrf_field() }} --}}
        
                        <button class="btn btn-block text-white mb-3" type="submit">Logga ut</button>
                        
                {{-- </form><!-- / --> --}}
                </a>
            @else

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
            
            <h3>Kontakt</h3>
            <p>Telefon: <span class="akaBlueText"> 031-63 24 00</span></p>
            <p>E-post: <span class="akaBlueText">info@akademiskahus.se</span></p>
            <p>För att kontakta en specifik medarbetare via e-post: <span class="akaBlueText">fornamn.efternamn@akademiskahus.se</span></p>

        </div><!-- /col -->
    </div><!-- /row -->
</div><!-- /akaContainer -->
@stop
