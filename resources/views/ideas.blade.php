
@extends('layouts.default')

@section('content')
<div class="akaContainer">
    <div class="row">
        <div class="col mt-2">
        
            @if (Auth::check())

            <h2 class="text-center mt-3">Idelådan</h2>
            <div id="app" class="justify-content-center">
                <ideas :auth="true" ></ideas>
            </div>

            @else

            <h2 class="text-center mt-3">Idelådan</h2>
            <div id="app" class="justify-content-center">
                <ideas :auth="false" ></ideas>
            </div>
                
            @endif

        </div><!-- /col -->
    </div><!-- /row -->
</div><!-- /akaContainer -->
@stop
