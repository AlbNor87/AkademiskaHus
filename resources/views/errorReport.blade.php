@extends('layouts.default')

@section('content')
<div class="akaContainer">
    <div class="row">
        <div class="col mt-2">
            
            @if (Auth::check())
            
            <div id="app" class="justify-content-center">
                <errorreport :auth="true" ></errorreport>
            </div>

            @else

            <h2 class="text-center mt-3 akaPink">Felanmälan</h2>
            <div id="app" class="justify-content-center">
                <errorreport :auth="false" ></errorreport>
            </div>
                
            @endif

        </div><!-- /col -->
    </div><!-- /row -->
</div><!-- /akaContainer -->
@stop