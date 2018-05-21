@extends('layouts.default')

@section('content')
<div class="akaContainer">
    <div class="row">
        <div class="col mt-2">
            
            @if (Auth::check())
            <h3>Felanmälan</h3>

            @else

            <h3>Felanmälan</h3>
                
            @endif

            <div id="app"></div>
        </div><!-- /col -->
    </div><!-- /row -->
</div><!-- /akaContainer -->
@stop
