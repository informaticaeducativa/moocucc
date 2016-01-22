<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <!-- CSS -->

      <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.0.3/css/bootstrap.min.css" >
      <link href="{{URL::to('css/estilo.css')}}" rel="stylesheet">

      <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
      <title>Chat UCC</title>
      <script>
      (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
        (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
        m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
      })(window,document,'script','//www.google-analytics.com/analytics.js','ga');
      ga('create', 'UA-71691218-1', 'auto');
      ga('send', 'pageview');
      </script>
      </head>
      <!--Header Start Here-->
      <header>
      <nav class="navbar navbar-default" role="navigation">
        <!-- El logotipo y el icono que despliega el menú se agrupan
        para mostrarlos mejor en los dispositivos móviles -->
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse"
            data-target=".navbar-ex1-collapse">
            <span class="sr-only">Desplegar navegación</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="{{ URL::route('index') }}"><img src="{{URL::to('imagenes/logo.png')}}" width="30px"></a>
        </div>

      <!-- Agrupar los enlaces de navegación, los formularios y cualquier
      otro elemento que se pueda ocultar al minimizar la barra -->
      <div class="collapse navbar-collapse navbar-ex1-collapse navbar_back">
        <ul class="nav navbar-nav">
      <!--
          <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              Temas <b class="caret"></b>
            </a>
            <ul class="dropdown-menu">
              <li><a href="#"></a></li>
              <li class="divider"></li>
              <li><a href="#"></a></li>
              <li class="divider"></li>
              <li><a href="#"></a></li>
            </ul>
          </li>
      -->
        </ul>



        <ul class="nav navbar-nav navbar-right">
          @if (Session::get('tipo_usuario') == "Administrador")
           <li><a href="{{ URL::route('administrador')}}">Panel Administrador</a></li>
           @endif

          @if (Session::get('user') != "")
          <li><a href="{{ URL::route('chat') }}">Chat</a></li>
          <li><a href="{{ URL::route('mis-badges') }}">Mis Badges</a></li>
          <li><a href="{{ URL::route('mis-cursos') }}">Mis Cursos</a></li>
          <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">
            {{ Session::get('user') }}<b class="caret"></b>
          </a>
          <ul class="dropdown-menu">
            <li><a href="{{ URL::route('usuario', Session::get('user_id') ) }}">Mi Perfil</a></li>
            <li class="divider"></li>
              <li><a href="{{ URL::route('logout')}}">Salir</a></li>
          </ul>
          </li>
          @else
          <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown"><b>Login</b> <span class="caret"></span></a>
            <ul id="login-dp" class="dropdown-menu">
              <li>
                 <div class="row">
                    <div class="col-md-12">
                      <center>
                        Login via
                        <div class="social-buttons">
                          <a href="{{ URL::route('login-facebook') }}" class="btn btn-fb"><i class="fa fa-facebook"></i> Facebook</a><br><br>
                          <a href="{{ URL::route('login-twitter') }}" class="btn btn-tw"><i class="fa fa-twitter"></i> Twitter</a><br><br>
                          <a href="{{ URL::route('login-google') }}" class="btn btn-gp"><i class="fa fa-google"></i> Google +</a><br><br>
                        </div>
                       </center>
                    </div>
                 </div>
              </li>
            </ul>
          </li>
          @endif
        </ul>
      </div>
      </nav>
      </header>
    <body style="background-color:#FFFFFF !important;">
        <script type="text/x-handlebars">
            @{{outlet}}
        </script>
        <script type="text/x-handlebars" data-template-name="index">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <h1 class="text-center">Chat UCC</h1>
                        <table class="table table-striped">
                            @{{#each message in model}}
                                <tr>
                                    <td @{{bind-attr class="message.user_id_class"}}>
                                        <strong>@{{message.user_name}}</strong>
                                        @{{message.message}}
                                    </td>
                                </tr>
                            @{{/each}}
                        </table>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="input-group">
                            @{{input type="text" value=command class="form-control"}}
                            <span class="input-group-btn">
                                <button class="btn btn-default" @{{action "send"}}>Send</button>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
            <input type="hidden" id="data-task" class="form-control" value="{{$nombre}}" />
        </script>
        <script type="text/javascript" src='{{ asset("js/jquery.1.9.1.js") }}'></script>
        <script type="text/javascript" src='{{ asset("js/handlebars.1.0.0.js") }}'></script>
        <script type="text/javascript" src='{{ asset("js/ember.1.1.1.js") }}'></script>
        <script type="text/javascript" src='{{ asset("js/ember.data.1.0.0.js") }}'></script>
        <script type="text/javascript" src='{{ asset("js/bootstrap.3.0.0.js") }}'></script>
        <script type="text/javascript" src='{{ asset("js/shared.js") }}'></script>
    </body>
</html>
