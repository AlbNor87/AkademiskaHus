@extends('layouts.default')

@section('content')

    @if (Auth::check())

        <h2 class="text-center">Välkommen {{ Auth::user()->name }}, du är nu inloggad!</h2>
        
        <div id="app">
            <div class="container">
                <manageposts></manageposts>
            </div>
        </div>

    @else

    <h2 class="text-center">Välkommen!</h2>
    <div id="app">
        <div class="container">
            <posts></posts>
        </div>
    </div>
        
    @endif

@stop