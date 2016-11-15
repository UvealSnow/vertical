<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="/assets/css/reset.css">
    <link rel="stylesheet" href="/assets/css/style.min.css">

    <title>Vertical Pole & Fitness</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css" integrity="sha384-XdYbMnZ/QjLh6iI4ogqCTaIjrFk87ip+ekIjefZch0Y+PvJ8CDYtEs1ipDmPorQ+" crossorigin="anonymous">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato:100,300,400,700">

    <!-- Styles -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
    <link rel="stylesheet" href="/normalize.css">
    <link rel="stylesheet" href="/style.min.css">
    <link rel="stylesheet" href="/app.css">
    <link rel='stylesheet' href='/fullcalendar.css' />

    <link rel="stylesheet" href="http://cdnjs.cloudflare.com/ajax/libs/select2/3.4.5/select2.css">

    <script type="text/javascript" src="/assets/js/vendor/angular.min.js"></script>
    <script src="http://ajax.googleapis.com/ajax/libs/angularjs/1.5.0/angular-sanitize.min.js"></script>
    <script src='http://fullcalendar.io/js/fullcalendar-2.1.1/lib/moment.min.js'></script>
    <script src='http://fullcalendar.io/js/fullcalendar-2.1.1/lib/jquery.min.js'></script>
    <script src="http://fullcalendar.io/js/fullcalendar-2.1.1/lib/jquery-ui.custom.min.js"></script>
    <script src='http://fullcalendar.io/js/fullcalendar-2.1.1/fullcalendar.js'></script>
    <script type="text/javascript" src="/assets/js/vendor/ui-select.min.js"></script>
    <script type="text/javascript" src="/assets/js/app.js"></script>

</head>

<body id="app-layout" ng-app="verticalApp">
    <nav class="navbar navbar-default navbar-static-top">
        <div class="container">
            <div class="navbar-header">

                <!-- Collapsed Hamburger -->
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                    <span class="sr-only">Toggle Navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>

                <!-- Branding Image -->
                <a class="navbar-brand" href="{{ url('/') }}">
                    <img src="/assets/Vertical.svg">
                </a>
            </div>

            <div class="collapse navbar-collapse" id="app-navbar-collapse">
                <!-- Left Side Of Navbar -->
                <ul class="nav navbar-nav">
                    @if (Auth::check())
                    <li><a href="{{ url('/user/profile') }}">Mi Perfil</a></li>
                    @endif
                </ul>

                <!-- Right Side Of Navbar -->
                <ul class="nav navbar-nav navbar-right">
                    <!-- Authentication Links -->
                    @if (Auth::guest())
                        
                        <li><a href="{{ url('/') }}">Volver a Vertical</a></li>
                    @elseif (Auth::user()->role_id == 1)
                        <li><a href="{{ url('/user') }}">Usuarios</a></li>
                        <li><a href="{{ url('/package') }}">Paquetes</a></li>
                        <li><a href="{{ url('/lecture') }}">Clases</a></li>
                        <li><a href="{{ url('/medal') }}">Medallas</a></li>
                    @elseif (Auth::user()->role_id == 2)
                        <li><a href="{{ url('/lecture') }}">Clases</a></li>
                    @elseif (Auth::user()->role_id == 3)
                        <li><a href="{{ url('/diet') }}">Dietas</a></li>
                    @elseif (Auth::user()->role_id == 4)
                        @if (Auth::user()->diet)
                            <li><a href="{{ url('/diet/'.Auth::user()->diet->id) }}">Dieta</a></li>
                        @endif
                        <li><a href="{{ url('/lecture') }}">Clases</a></li>
                        <li><a href="{{ url('/user/profile') }}">Medallas</a></li>
                    @endif
                    @if (Auth::check())
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                {{ Auth::user()->name }} <span class="caret"></span>
                            </a>
                            <ul class="dropdown-menu" role="menu">
                                <li><a href="{{ url('/user/profile') }}"><i class="glyphicon glyphicon-user"></i> Perfil</a></li>
                                <li><a href="{{ url('/logout') }}"><i class="fa fa-btn fa-sign-out"></i>Cerrar Sesión</a></li>
                            </ul>
                        </li>
                    @endif
                </ul>
            </div>
        </div>
    </nav>
    <hr class="navbar-separator">

    @if (!Auth::guest() && Auth::user()->role_id != 4)
        <div class="container" ng-controller="uiSearchCtrl as ctrl">
            <div class="row">
                <div class="col-md-6 col-md-offset-6">
                    <form action="/user/profile" method="POST">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <input type="hidden" name="user_id" value=" <% ctrl.person.selected.id %> ">
                        
                        <div class="form-group">
                            <label for="quote-name" class="col-sm-3 control-label"></label>
                            <div class="col-sm-10">
                                <div class="select-box">
                                   <ui-select ng-model="ctrl.person.selected" theme="select2" ng-disabled="ctrl.disabled" style="width: 100%;" append-to-body="true">
                                      <ui-select-match placeholder="Selecciona o busca por nombre o email"><% ctrl.person.selected.name + ' (' + ctrl.person.selected.title + ')' + ' - ' + ctrl.person.selected.email %></ui-select-match>
                                      <ui-select-choices repeat="person in ctrl.people | propsFilter: { name: $select.search, email: $select.search }">
                                         <div ng-bind-html="person.name | highlight: $select.search"></div>
                                         <small>
                                            Email: <span ng-bind-html="person.email | highlight: $select.search"></span> - 
                                            Rol: <span ng-bind-html="person.title"></span>
                                         </small>
                                      </ui-select-choices>
                                   </ui-select>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <button class="btn btn-primary">Buscar</button>
                        </div>

                        <br>

                    </form>
                </div>
            </div>
        </div>
    @endif

    @yield('content')
    <br><br><br>
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default logo-vertical">
                <img src="/assets/Verticalc.svg" alt="Vertical Pole & Fitness">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default dir-vertical">
                <p>
                    Av. Tercer Milenio #385<br>
                    San Luis Potosí, 78211
                </p>
            </div>
        </div>
    </div>
    <!-- JavaScripts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.3/jquery.min.js" integrity="sha384-I6F5OKECLVtK/BL+8iSLDEHowSAfUo76ZL9+kGAgTRdiByINKJaqTPH/QVNS1VDb" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/fullcalendar/2.2.7/fullcalendar.min.js"></script>
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/fullcalendar/2.2.7/fullcalendar.min.css"/>
    {{-- <script src="{{ elixir('js/app.js') }}"></script> --}}
</body>
<script>
    
</script>
</html>
