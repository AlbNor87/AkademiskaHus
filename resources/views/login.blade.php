@extends('layouts.default')

@section('content')
    <div class="row">
        <div class="col">
            <h1 class="mt-5">Login</h1>

            <form action="{{url('login')}}" method="POST">
                @csrf
                <div>
                    <label for="email">Email</label>
                    <input type="email" name"email">
                </div>
                <div>
                    <label for="email">Password</label>  
                    <input type="password" name"password">
                </div>
                <button type="submit">Login</button>
            </form>

        </div><!-- /col -->
    </div><!-- /row -->
@stop
