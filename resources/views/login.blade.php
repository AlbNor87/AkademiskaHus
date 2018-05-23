@extends('layouts.default')

@section('content')
<div class="akaContainer">
    <div class="row">
        <div class="col mt-5">
            <h2>Logga in</h2>

            <div id="app"></div>

            @if ($errors->any())
                <div class="alert alert-danger" role="alert">
                    {{ $errors->first() }}
                </div><!-- /alert -->
            @endif

            <form action="{{ url('login') }}" method="post">
                {{ csrf_field() }}

                <div class="form-group">
                    <label for="email">Email</label>
                    <input class="form-control" type="email" name="email" placeholder="användare@akademiskahus.se">
                </div><!-- /form-group -->

                <div class="form-group">
                    <label for="email">Lösenord</label>
                    <input class="form-control" type="password" name="password">
                </div><!-- /form-group -->

                <button class="btn btn-block text-white" type="submit">Logga in</button>
            </form><!-- / -->
        </div><!-- /col -->
    </div><!-- /row -->
</div><!-- /akaContainer -->
@stop
