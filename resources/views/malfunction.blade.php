@extends('layouts.default')

@section('content')
<div class="akaContainer">
    <div class="row">
        <div class="col mt-2">
            
            @if (Auth::check())
            <div id="app" class="justify-content-center">
                <managemalfunctions></managemalfunctions>
            </div>

            @else
            <h2 class="text-center mt-3">Driftstörningar</h2>
            <div id="app" class="justify-content-center">
                <viewmalfunctions></viewmalfunctions>
            </div>
            
            @endif

        </div><!-- /col -->
    </div><!-- /row -->
</div><!-- /akaContainer -->
@stop
