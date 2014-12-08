@extends('BaseTemplate')


@section('scripts')

<script>

function openNext() {

    var el = document.getElementById("hidden");
    if (el.style.visibility == 'hidden') {
        el.style.visibility = 'visible'
    } else {
        el.style.visibility = 'hidden'
    }
}


</script>

@stop

@section('main-body')

{{ Form::open(array('url' => '/add_recipe')) }}


{{ Form::submit('Submit') }}
{{ Form::close() }}


@stop