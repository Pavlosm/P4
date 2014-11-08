@extends('BaseTemplate')

@section('navbar')
    <ul class="nav navbar-nav navbar-right">
        <li class="active"><a href="/login">Sign In</a></li>
    </ul>
@stop

@section('main-body')
    <h2>Plan your trip</h2>
    <p>
        Plan your trip is a utility web-page where you can plan your trip schedule working with the google maps api. So
        you can choose the locations you want to visit and make a daily schedule of the places.
    </p>
    <p>
        {{ $list }}
    </p>
    <br/>
@stop