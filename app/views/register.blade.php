@extends('UltraBaseTemplate')


@section('title')
    <title>Sign Up</title>
@stop


@section('style')
    <link rel="stylesheet" href="styles/register.css" type="text/css">
@stop


@section('script')
    <script src="scripts/register.js"></script>
@stop


@section('body')
<div class="container">

    <div class="row">
        <div class="col-sm-6 col-md-4 col-md-offset-4">
            @if(Session::get('flash_message'))
                <div class='flash-message'>{{ Session::get('flash_message') }}</div>
            @endif

            <h2 class="login-title">Register</h2>
            <div class="account-wall">
                {{ Form::open(array('class'=>'form-signin','url'=>'/register', 'method'=>'POST', 'role'=>'form')) }}


                    {{ Form::text('email', null, array( 'class' => 'form-control',
                                                        'placeholder' => 'email',
                                                        'id' => 'email',
                                                        'oninput' => 'check_email()')) }}
                    @if ($errors->has('email'))
                        <p class="err">{{ $errors->first('email') }}</p>
                    @endif
                    <p id="email_err" class="err"></p>

                    {{ Form::password('password', array( 'class' => 'form-control',
                                                       'type'=>'password',
                                                       'placeholder' => 'password',
                                                       'id' => 'password1',
                                                       'oninput' => 'check_password()')) }}
                    @if ($errors->has('password'))
                        <p class="err">{{ $errors->first('password') }}</p>
                    @endif
                    <p id="pass_err" class="err"></p>

                    {{ Form::password('password_confirmation', array( 'class' => 'form-control',
                                                              'type'=>'password',
                                                              'placeholder' => 'Enter password again',
                                                              'id' => 'password2',
                                                              'oninput' => 'match_passwords()')) }}
                    @if ($errors->has('password_confirmation'))
                        <p class="err">{{ $errors->first('password_confirmation') }}</p>
                    @endif
                    <p id="pass_err" class="err"></p><br/>

                    {{ Form::submit('Sign up', array('class' => 'btn btn-primary  btn-block')) }}<br/>

                {{ Form::close() }}
            </div>
            <a href="/"><span class="glyphicon glyphicon-circle-arrow-left"></span>&nbsp; Homepage </a>
            <br/><br/>
            <p class="note">
                Note: &nbsp; Password must be more than 6 characters long, and must contain at least one number.
            </p>

        </div>


    </div>
</div>
@stop