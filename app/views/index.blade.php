<!DOCTYPE html>
<html lang="en" class="no-js">
<!--
  clase index.blade.php
  @copyright 2015
-->
<head>
	<title>MOOC UCC</title>
	<meta charset="utf-8">
	<!-- CSS -->
	<link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.0.3/css/bootstrap.min.css" >
	
<!--
	<link rel="stylesheet" href="../css/estilo.css" >
-->
	<link href="{{URL::to('css/estilo.css')}}" rel="stylesheet">

	<!-- js -->
	<script src= "https://code.jquery.com/jquery.js" ></script>
	<script src= "//netdna.bootstrapcdn.com/bootstrap/3.0.3/js/bootstrap.min.js"></script>
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
    <a class="navbar-brand" href="#">Logotipo</a>
  </div>
 
  <!-- Agrupar los enlaces de navegación, los formularios y cualquier
       otro elemento que se pueda ocultar al minimizar la barra -->
  <div class="collapse navbar-collapse navbar-ex1-collapse">
    <ul class="nav navbar-nav">
      <li class="active"><a href="#">Enlace #1</a></li>
      <li><a href="#">Enlace #2</a></li>
      <li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
          Menú #1 <b class="caret"></b>
        </a>
        <ul class="dropdown-menu">
          <li><a href="#">Acción #1</a></li>
          <li><a href="#">Acción #2</a></li>
          <li><a href="#">Acción #3</a></li>
          <li class="divider"></li>
          <li><a href="#">Acción #4</a></li>
          <li class="divider"></li>
          <li><a href="#">Acción #5</a></li>
        </ul>
      </li>
    </ul>
 
    <form class="navbar-form navbar-left" role="search">
      <div class="form-group">
        <input type="text" class="form-control" placeholder="Buscar">
      </div>
      <button type="submit" class="btn btn-default">Enviar</button>
    </form>
 
    <ul class="nav navbar-nav navbar-right">
      <li><a href="#">Enlace #3</a></li>
      <li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
          Menú #2 <b class="caret"></b>
        </a>
        <ul class="dropdown-menu">
          <li><a href="#">Acción #1</a></li>
          <li><a href="#">Acción #2</a></li>
          <li><a href="#">Acción #3</a></li>
          <li class="divider"></li>
          <li><a href="#">Acción #4</a></li>
        </ul>
      </li>
    </ul>
  </div>
</nav>
</header>
<body>
<div class="container">
	<center><h1>MOOC UCC</h1></center>
		
<!--
			<table width="100%">
				<tr>
					<th>{{ Form::label('id_usuario', 'Estudiante') }}</th>
					<td>{{ Form::text('id_usuario', 'Estudiante') }}</td>
				</tr>
				<tr>
					<th>{{ Form::label('id_curso', 'Curso') }}</th>
					<td>{{ Form::text('id_curso', 'cursos') }}</td>
				</tr>
				<tr>
					<th colspan="2"><button class='btn btn-primary btn-block' id="boton_revisar">Revisar</button></th>
				</tr>
			</table>            
-->
	<div class="row">
		
    </div>    
	<div class="row row_cursos">
		@foreach ($cursos as $curso)
			<a href="curso/{{ $curso->id_curso }}"> 
			
			<div class="col-md-4 col-sm-6 col-xs-12 album_list">
				<div class="div_list">
						<img class="imagen_div" src="imagenes/{{$curso->imagen_presentacion}} " >
					<div class="espaciado">
						<div class="titulo_curso">
							<h3>{{ $curso->nombre }}</h3>
						</div>
						
						Nivel: {{ $curso->nivel }}<br>
						{{ $curso->getTematica() }}<br>
						{{ $curso->getFechaInicio() }}
					</div>
				</div>
			</div>
			</a>
		@endforeach
    </div>    
        <div id="resultados"></div>
		
		<br>
		<center>
<!--
			route('menu')
-->
			<a href="#" class="btn btn-primary" style="width:200px;">Regresar al menu</a><br><br>
		</center>
</div>
</body>

</html>
