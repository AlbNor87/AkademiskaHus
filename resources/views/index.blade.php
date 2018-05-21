@extends('layouts.default')

@section('content')

    @if (Auth::check())

        {{-- <h2 class="text-center">Välkommen {{ Auth::user()->name }}, du är nu inloggad!</h2> --}}
        
        <div id="app" class="justify-content-center">
                <manageposts></manageposts>
            
        </div>

    @else

    <h2 class="text-center">Välkommen!</h2>
    <div id="app">
            
            <posts></posts>
        
    </div>
        
    @endif

@stop