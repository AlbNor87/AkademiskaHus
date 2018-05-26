@extends('layouts.default')

@section('content')

    @if (Auth::check())

        {{-- <h2 class="text-center">Välkommen {{ Auth::user()->name }}, du är nu inloggad!</h2> --}}
        
        <div id="app" class="justify-content-center">
            <manageposts></manageposts>
        </div>

    @else
    
    <div id="app">
        <malfunctions></malfunctions>
        <h2 class="text-center mt-4">Välkommen!</h2>
        <posts></posts>   
    </div>
        
    @endif

@stop