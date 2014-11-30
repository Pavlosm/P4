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

        img {
            width: 100%;
        }
        .image {
            padding-bottom: 10px;
        }
        .txt {
            color: white;
        }
    </style>

@stop

@section('navbar')
    <ul class="nav navbar-nav navbar-right">
        @if(Auth::check())
            <li class="active">
                <a href='/logout'>Log out </a>
            </li>
            <li>
                or
            </li>
            <li class="active">
                <a href='/unregister'>Unregister </a>
            </li>
            <li>
                or
            </li>
            <li class="txt">
                {{ Auth::user()->email; }}
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
    <div class="image">
        {{ HTML::image('index.jpg', $alt="food_black_n'_white") }}
    </div>
    <div class="preText">
        <p class="warning">
            <span  style="color: red; font-weight: bold">WARNING !!!</span> This is a school project not a commercial website. It provides you the
            option to register and store your menus but it does not provide any guarantee that it will be up and
            running.
        </p>
    </div>


    <br/>

    <h2>Create a menu</h2>
    <div class="row form">
        {{ Form::open(array('class'=>'form-signin','url'=>'/main', 'method'=>'POST', 'role'=>'form')) }}
            <!-- Ingredients text box -->
            <div class="col-sm-7">
                {{ Form::label('ingr', 'Ingredients (separate with comma for separate recipes)') }}
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
        <h2> Recipes </h2>

        @if( isset($response) )
            {{ $response }}
        @endif
        @if( isset($userID))
            {{ $userID }}
        @endif
    </div>
    <br/>
@stop