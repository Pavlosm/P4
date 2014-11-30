@extends('BaseTemplate')

@section('style')
    <style>

        .warning {
            background-color: #f5f3fb;

        }

        .recipes {
            padding: 15px;
            background-color: #f4ff7b;
            border-radius: 10px;
            border-color: #ececec;
            border-bottom-style: solid;
            -webkit-box-shadow: 0 10px 6px -6px #777;
            -moz-box-shadow: 0 10px 6px -6px #777;
            box-shadow: 0 10px 6px -6px #777;
        }

        .form {
            padding-left: 20px;
            background-color: #eceaff;
            border-radius: 10px;
        }
        .col-md-4 {
            text-align: justify;
        }
        img {

            width: 100%;
        }
        .image {
            padding-bottom: 10px;
        }
        .textHere {
            background-color: #e5dfff;
            border-radius: 10px;
        }
    </style>
    <script>

    </script>
@stop

@section('navbar')
    <ul class="nav navbar-nav navbar-right">
        @if(Auth::check())
            <li class="active">
                <a href='/logout'>Log out {{ Auth::user()->email; }}</a>
            </li>
        @else
            <li class="active">
                <a href='/register'>Sign up</a>
            </li>
            <li class="active">
                or
            </li>
            <li class="active">
                <a href='/login'>Log in</a>
            </li>
        @endif
    </ul>
@stop

@section('main-body')
    <h2>Too bored to plan my dinner</h2>
    <div class="image">
        {{ HTML::image('index.jpg', $alt="food_black_n'_white") }}
    </div>
    <div class="preText">
        <div class="row textHere">
            <div class="col-md-6">
                <p>
                    Some people (names not mentioned...) find it quite boring to think what they will cook for dinner
                    every day. A solution to that, sometimes, is to forward-plan your weekly dinners and buy all
                    ingredients needed, but then again some people (wild guess-those same people) are bored to do that
                    too...
                </p>
                <p>
                    <i>Too bored to plan my dinner</i> is intended for YOU, those lazy lazy peps. What it gives you is
                    a full dinner plan for the specified number of days <i>(max is a week, if you want more then you're
                    not meant for it, delivery is the way to go!)</i>.
                </p>
            </div>
            <div class="col-md-6 mid_col">
                <p>
                    Of course it would be useless to have zero control on what to eat during the week, so it also gives
                    you the opportunity to choose some primary ingredients for your dinners; You may choose a single
                    ingredient or more or none for a particular dinner and you'll get a suggestion that most likely will
                    meet your criteria. Now whether you like it ... it depends, so again in an effort to make your
                    dinner-life easier with a click to a single button you get another suggestion and maybe you like
                    that one better.
                </p>
            </div>
        </div>
    
        <p class="warning">
            <span  style="color: red; font-weight: bold">WARNING !!!</span> This is a school project not a commercial website. It provides you the
            option to register and store your menus but it does not provide any guarantee that it will be up and
            running.
        </p>
    </div>

    <br/>

    <h2>Create a menu</h2>
    <div id="dd" class="wrapper-dropdown-2 row form">
        {{ Form::open(array('class'=>'form-signin','url'=>'/', 'method'=>'POST', 'role'=>'form')) }}
            <!-- Ingredients text box -->
            <div class="col-sm-7">
                {{ Form::label('ingredients', 'Ingredients (separate with comma for separate recipes)') }}
                {{ Form::text('ingredients', null, array('class' => 'form-control', 'placeholder' => 'type ingredients')) }}
                <br/>
            </div>
            <!-- Number of dinners -->
            <div class="col-sm-2 form">
                {{ Form::label('numOfDays', 'Dinners') }}
                {{ Form::select('numOfDays', [ '1' => '1', '2' => '2', '3' => '3', '4' => '4', '5' => '5', '6' => '6',
                                                '7' => '7'], '5', array('class' => 'form-control select')) }}
            </div>
            <!-- Submit it -->
            <div class="col-sm-3"><br/>
                {{ Form::submit('Get Menu', array('class' => 'btn btn-primary  btn-block')) }}<br/>
            </div>
        {{ Form::close() }}

    </div>
    <div class="recipe_container">
        @if( isset($response) )
            <h2> Recipes </h2>
            {{ $response }}
        @endif

    </div>
    <br/>
@stop