<!DOCTYPE html>
<html lang="es" class="no-js">
<!--
clase index.blade.php
@copyright 2015
-->
<head>
	<title>MOOC UCC</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<!-- CSS -->
	<link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.0.3/css/bootstrap.min.css" >
	<link href="{{URL::to('css/estilo.css')}}" rel="stylesheet">
	<script src="{{URL::to('js/canvas1.js')}}"></script>

	<script>
	$(function() {

		$("#boton_revisar").click( function()
		{
			$.ajax({
				url:'postquery1',
				type:'GET',
				dataType:'json',
				data: { usuario: $("#id_usuario").val(), curso: $("#id_curso").val() },
				//cache:false,
				success:function(data){
					if(data['success']) {
						var html = "<table border=1 width='100%'>";
						html+="<tr><th>Codigo</th><th>Estudiante</th><th>Curso</th><th>Valor</th><th>Fecha</th></tr>";
						$(data.records).each(function(i,item){
							html+="<tr><td>"+item.codigo+"</td><td>"+item.nombres+"</td><td>"+item.nombre+"</td><td>"+item.cantidad+"</td><td>"+item.fecha+"</td></tr>";
						});
						html+="</table>";
						$("#resultados").html(html);
					}
				}
			});
		});

	});

	$(document).ready(function() {
		var sideslider = $('[data-toggle=collapse-side]');
		var sel = sideslider.attr('data-target');
		var sel2 = sideslider.attr('data-target-2');
		sideslider.click(function(event){
			$(sel).toggleClass('in');
			$(sel2).toggleClass('out');
		});
	});

	</script>
	<script>
	(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
		(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
		m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
	})(window,document,'script','//www.google-analytics.com/analytics.js','ga');
	ga('create', 'UA-71691218-1', 'auto');
	ga('send', 'pageview');
	</script>
</head>

<body>

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
				<a class="navbar-brand" href="{{ URL::route('index') }}" style="padding: 0 15px;"><img src="{{URL::to('imagenes/logo.png')}}" width="50px" style="position:relative; top:6px;"></a>
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
				<form class="navbar-form navbar-left" role="search" action="{{ URL::route('index') }}" method="POST">
					<div class="form-group">
						<input type="text" id="texto-buscar" name="texto-buscar" class="form-control" placeholder="Buscar">
					</div>
					<button type="submit" class="btn btn-default">Buscar</button>
				</form>

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

	<div class="container">
		<header>
			<h1 class="strong text-center">Mis Badges</h1>
		</header>

		<div class="row row_cursos">

			@if (count($avances) == 0)
			<h2 class="text-center strong">No tienes Badges asignados</h2>
			@endif

			<?php $cursoActual = ""; ?>
			@foreach ($avances as $avance)
			@if ($cursoActual != $avance->id_curso)
			<h2>{{$avance->getCurso()->nombre}}</h2>
			<?php $cursoActual = $avance->id_curso; ?>
			@endif
			<canvas id="canvas{{$avance->semana}}-{{$avance->getBadge()->color1}}-{{$avance->getBadge()->color2}}" width="140" height="140"></canvas>
			@if ($avance->porcentaje == 100)
			<canvas id="canvas{{$avance->semana}}-{{$avance->getBadge()->color1}}-{{$avance->getBadge()->color2}}-100" width="140" height="140"></canvas>
			@endif
			@endforeach
		</div>
		<br/>
	</div>

	<!-- bootstrap - js -->
	<script src= "http://code.jquery.com/jquery-2.2.0.min.js" ></script>
	<script src= "//netdna.bootstrapcdn.com/bootstrap/3.0.3/js/bootstrap.min.js"></script>
	<!-- bootstrap - js -->
	<script type="text/javascript">
	@foreach ($avances as $avance)
	makeCanvasSemanal2({{$avance->semana}}, '{{$avance->getBadge()->color1}}', '{{$avance->getBadge()->color2}}' , {{$avance->porcentaje}});
	@endforeach
	</script>

</body>

</html>
