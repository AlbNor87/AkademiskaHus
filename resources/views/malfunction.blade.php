@extends('layouts.default')

@section('content')
<div class="akaContainer">
    <div class="row">
        <div class="col mt-2">
            
            @if (Auth::check())
            <div id="app" class="justify-content-center">
                <malfunction></malfunction>
            </div>

            @else

            <h3>Driftstörning</h3>
            
            @endif

            <div id="app"></div>
        </div><!-- /col -->
    </div><!-- /row -->
</div><!-- /akaContainer -->
@stop
