@extends('UltraBaseTemplate')


@section('title')
    <title>Login</title>
@stop


@section('body')
<div class="container">
    <div class="row">
        <div class="col-sm-6 col-md-4 col-md-offset-4">
            <h2 class="login-title">Register</h2>
            <div class="account-wall">

                <form class="form-signin">
                    <input type="text" class="form-control" placeholder="Email" required autofocus><br/>
                    <input type="password" class="form-control" placeholder="Password" required><br/>
                    <input type="password" class="form-control" placeholder="Enter password again" required><br/>
                    <button class="btn btn-default btn-block" type="submit">Register</button><br/><br/>
                </form>
            </div>
            <a href="/"><span class="glyphicon glyphicon-circle-arrow-left"></span>&nbsp; Homepage </a>
        </div>
    </div>
</div>
@stop