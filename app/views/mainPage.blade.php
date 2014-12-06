@extends('BaseTemplate')

@section('style')
     <link rel="stylesheet" href="styles/mainpage.css" type="text/css">
@stop

@section('scripts')
     <script src="scripts/mainPage.js"></script>
     <script src="scripts/general.js"></script>
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
    {{ Form::open(array('class'=>'form-signin','url'=>'/main', 'method'=>'POST', 'role'=>'form')) }}
    <div class="row form">
        <div class="col-sm-4">
            {{ Form::submit('Get My Recipes', array('name' => 'get_my_recipes', 'class' => 'btn btn-primary  btn-block')) }}
        </div>
    </div>
    <br/>
    <div class="row form">

        <!-- Ingredients text box -->
        <div class="col-sm-2">
            {{ Form::label('numOfDays', 'Number of meals') }}
            <br/>
        </div>
        <!-- Number of dinners -->
        <div class="col-sm-4 form">
            {{ Form::select('numOfDays', [ '0' => '0', '1' => '1', '2' => '2', '3' => '3', '4' => '4',
                                                   '5' => '5', '6' => '6', '7' => '7'], '0',
                                                   array('class' => 'form-control select', 'id' => 'mySelect',
                                                         'onchange' => 'createNewTextBoxes()')) }}
        </div>
        <!-- Submit it -->
        <div class="col-sm-3"><br/>

        </div>
    </div>
    <br/>
    <div id="newForm" class="wrapper-dropdown-2 row form">

    </div>
    {{ Form::close() }}
    <div class="recipe_container">
        <h2> Recipes </h2>

        @if( isset($response) )
            {{ $response }}
        @endif

    </div>
    <br/>
@stop