
@extends('layouts.default')

@section('content')
<div class="akaContainer">
    <div class="row">
        <div class="col mt-2">
        

            @if (Auth::check())
                
            <h2 class="text-center mt-3">Idelådan (inloggad)</h2>

            @else

            <h2 class="text-center mt-3">Idelådan (ej inloggad)</h2>
                
            @endif
         

        </div><!-- /col -->
    </div><!-- /row -->
</div><!-- /akaContainer -->
@stop
