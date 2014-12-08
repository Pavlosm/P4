@extends('UltraBaseTemplate')

@section('title')
    <title>Login</title>
@stop


@section('body')
<div class="container">
    <div class="row">
        <div class="col-sm-6 col-md-4 col-md-offset-4">
            <h2 class="login-title">Sign in</h2>
            <div class="account-wall">
                @if (isset($error))
                    <div> {{ $error }}</div>
                @endif
                {{ Form::open(array('class'=>'form-signin','url'=>'/login', 'method'=>'POST', 'role'=>'form')) }}

                    {{ Form::text('email', null, array( 'class' => 'form-control',
                                                        'placeholder' => 'email',
                                                        'id' => 'email')) }}
                    @if ($errors->has('email'))
                        <p class="err">{{ $errors->first('email') }}</p>
                    @endif
                    <p id="par"></p><br/>
                    {{ Form::password('password', array( 'class' => 'form-control',
                                                         'type'=>'password',
                                                         'placeholder' => 'password',
                                                         'id' => 'password')) }}
                    @if ($errors->has('password'))
                        <p class="err">{{ $errors->first('password') }}</p>
                    @endif
                    <br/><br/>
                    {{ Form::submit('Sign In', array('class' => 'btn btn-primary  btn-block')) }}<br/>
                     Stay signed in &nbsp; {{ Form::checkbox('keepLoggedIn', 'yes')}}

                {{ Form::close() }}
                <br/>
            </div>
            <a href="/register" class="text-center new-account">Create an account </a><br/><br/>
            <a href="/"><span class="glyphicon glyphicon-circle-arrow-left"></span>&nbsp; Homepage </a>
        </div>
    </div>
</div>
@stop
