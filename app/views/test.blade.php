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

<div id="one" onclick="openNext()">
    some text here
</div>

<div id="expand">

</div>
<div id="hidden">
    am I there?

</div>


@stop