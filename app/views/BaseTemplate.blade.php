<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">

    <title>Dinner Lazy (P4)</title>

    <link rel='stylesheet' href='//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css' type='text/css'>
    <link href="//netdna.bootstrapcdn.com/bootswatch/3.1.1/flatly/bootstrap.min.css" rel="stylesheet">

    <script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>

    <script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
    <script src="jquery-1.11.1.min.js"></script>
    <style>
        .footer {
            background-color: #14263d;
            border-color: #14263d;
            padding: 15px;
            color: #ebebeb;
            border-radius: 5px;
        }

    </style>

    @yield('style')

    @yield('scripts')

</head>
<body>
    <div class="container" id="mainBody">
        <div class="navbar navbar-default" role="navigation">
            <div class="container-fluid">
                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="">Dinner Lazy - P4</a>
                </div>

                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Dropdown <span class="caret"></span></a>
                        <ul class="dropdown-menu" role="menu">
                            <li><a href="http://p1.cpmi.ninja">P1</a></li>
                            <li><a href="http://p2.cpmi.ninja">P2</a></li>
                            <li><a href="http://p3.cpmi.ninja">P3</a></li>
                        </ul>
                    </li>
                </ul>

                @yield('navbar')

            </div><!-- /.navbar-collapse -->
          </div><!-- /.container-fluid -->
        </div>

        @yield('main-body')

    </div>
</body>
<footer>
    <div class="container footer">
        <h5>Links to projects:</h5>
        <span class="glyphicon glyphicon-hand-right"></span>
        <a href="http://p1.cpmi.ninja"> Project 1</a> &nbsp;&nbsp;&nbsp;
        <span class="glyphicon glyphicon-hand-right"></span>
        <a href="http://p2.cpmi.ninja"> Project 2</a> &nbsp;&nbsp;&nbsp;
        <span class="glyphicon glyphicon-hand-right"></span>
        <a href="http://p3.cpmi.ninja"> Project 3</a>
       </div>
</footer>
</html>