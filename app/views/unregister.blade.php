@extends('UltraBaseTemplate')

@section('title')
    <title>Unregister</title>
@stop


@section('body')
    <div class="container">
        <div class="row">
            <div class="col-sm-6 col-md-4 col-md-offset-4">
                <h2 class="login-title">Are you sure you want to unregister ?</h2>
                <div class="account-wall">
                    {{ Form::open(array('class'=>'form-signin','url'=>'/unregister', 'method'=>'POST', 'role'=>'form')) }}

                        {{ Form::submit('Yes', array('class' => 'btn btn-primary  btn-block')) }}<br/>
                        {{ Form::submit('No', array('class' => 'btn btn-primary  btn-block')) }}<br/>

                    {{ Form::close() }}

                    <br/>
                </div>
            </div>
        </div>
    </div>
@stop