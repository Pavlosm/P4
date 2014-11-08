@extends('BaseTemplate')

@section('style')
    <style>
        .preText {

            background-size: cover;
        }
        .warning {
            background-color: #e4e2ea;
        }


    </style>

@stop

@section('navbar')
    <ul class="nav navbar-nav navbar-right">
        <li class="active"><a href="/login">Sign In</a></li>
    </ul>
@stop

@section('main-body')
    <div class="preText">
        <h2>Too bored to plan my dinner</h2>
        <div class="row black">
            <div class="col-xs-6">
                <p>
                    Some people (names not mentioned...) find it quite boring to think what they will cook for dinner every day. A
                    solution to that, sometimes, is to forward-plan your weekly dinners and buy all ingredients needed, but then
                    again some people (wild guess-those same people) are bored to do that too...
                </p>
                <p>
                    <i>Too bored to plan my dinner</i> is intended for YOU, those lazy lazy peps. What it gives you is a full
                    dinner plan for the specified number of days <i>(max is a week, if you want more then you're not meant for it,
                    delivery is the way to go!)</i>.
                </p>
            </div>
            <div class="col-xs-6 ">
                <p>
                    Of course it would be useless to have zero control on what to eat during the
                    week, so it also gives you the opportunity to choose some primary ingredients for your dinners; You may choose
                    a single ingredient or more or none for a particular dinner and you'll get a suggestion that most likely will
                    meet your criteria. Now whether you like it ... it depends, so again in an effort to make your dinner-life
                    easier with a click to a single button you get another suggestion and maybe you like that one better.
                </p>
            </div>
    
    
    
        </div>
    
        <p class="warning">
            <span  style="color: red; font-weight: bold">WARNING !!!</span>: This is a school project not a commercial
            website. It provides you the option to register and store your menus but it does not provide any guarantee that
            it will be up and running.
        </p>
    </div>
    <div class="row">
        <div class="col-xs-6">
            {{ $response }}
        </div>

        <div class="col-xs-6">
            <h2>Create a menu</h2>

            {{ Form::open(array('class'=>'form-signin','url'=>'/main', 'method'=>'POST', 'role'=>'form')) }}
                <!-- Ingredients text box -->
                {{ Form::label('ingredients', 'Type the ingredients to include:') }}
                {{ Form::text('ingredients', null, array('class' => 'form-control', 'placeholder' => 'type ingredients')) }}<br/>

                <!-- Number of days -->
                {{ Form::label('numOfDays', 'Choose number of days') }}
                {{ Form::select('numOfDays', [ '1' => '1', '2' => '2', '3' => '3', '4' => '4', '5' => '5', '6' => '6',
                                                '7' => '7'], '5', array('class' => 'form-control select')) }}

                <!-- Include Breakfast -->
                 <div class="checkbox">
                    {{ Form::label('breakfast', 'Include Breakfast') }}
                    {{ Form::checkbox('breakfast', 'yes') }}
                </div>

                <!-- Submit it -->
                {{ Form::submit('Get Menu', array('class' => 'btn btn-primary  btn-block')) }}<br/>

            {{ Form::close() }}

            <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu3">
                <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Regular link</a></li>
                <li role="presentation" class="disabled"><a role="menuitem" tabindex="-1" href="#">Disabled link</a></li>
                <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Another link</a></li>
            </ul>
        </div>
    </div>

    <br/>
@stop