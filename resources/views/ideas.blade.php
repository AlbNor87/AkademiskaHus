
@extends('layouts.default')

@section('content')
<div class="akaContainer">
    <div class="row">
        <div class="col mt-2">
        

            @if (Auth::check())
                
            <h3>Idelådan (inloggad)</h3>

            @else

            <h3>Idelådan (ej inloggad)</h3>
                
            @endif
         

        </div><!-- /col -->
    </div><!-- /row -->
</div><!-- /akaContainer -->
@stop
