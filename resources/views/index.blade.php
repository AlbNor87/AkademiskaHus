@extends('layouts.default')

@section('content')

    @if (Auth::check())

        <h1>Välkommen {{ Auth::user()->name }}, du är nu inloggad!</h1>
        
        <div id="app">
            <div class="container">
                <posts></posts>
            </div>
        </div>

    @else

    <h1>Welcome! You are not logged in...</h1>
        
    @endif

@stop