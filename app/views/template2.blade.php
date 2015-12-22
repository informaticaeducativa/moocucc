<!DOCTYPE html>
<html lang="en" class="no-js">
<!--
  clase index.blade.php
  @copyright 2015
-->
<head>
	<title>@yield('title', 'MOOC UCC')</title></title>
	<meta charset="utf-8">
	<!-- CSS -->
	<link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.0.3/css/bootstrap.min.css" >
	<link href="{{URL::to('css/estilo.css')}}" rel="stylesheet">

	<!-- js -->
	<script src= "https://code.jquery.com/jquery.js" ></script>
	<script src= "//netdna.bootstrapcdn.com/bootstrap/3.0.3/js/bootstrap.min.js"></script>
	<script>

    $(document).ready(function() {   
            var track =  "";

			jQuery.ajax({
				url: '../../../obtener-inteligencia',
				success: function (result) {
					track = result;
				},
				async: false
			});
			
            var sideslider = $('[data-toggle=collapse-side]');
            var sel = sideslider.attr('data-target');
            var sel2 = sideslider.attr('data-target-2');
            sideslider.click(function(event){
                $(sel).toggleClass('in');
                $(sel2).toggleClass('out');
            });
            
			
            
            
            if("Kinestesico" == track)
            {
				$("#btn_kinestesico").attr("class","btn btn-block btn-info");
				$("#btn_visual").attr("class","btn btn-block btn-primary");
				$("#btn_auditivo").attr("class","btn btn-block btn-primary");
				
				$("#div_auditivo").show();
				$("#div_visual").show();
			}
			
            if("Visual" == track)
            {
				$("#btn_kinestesico").attr("class","btn btn-block btn-info");
				$("#btn_visual").attr("class","btn btn-block btn-primary");
				$("#btn_auditivo").attr("class","btn btn-block btn-info");
				
				$("#div_auditivo").hide();
				$("#div_visual").show();
			}
			
            if("Auditivo" == track)
			{
				$("#btn_kinestesico").attr("class","btn btn-block btn-info");
				$("#btn_auditivo").attr("class","btn btn-block btn-primary");
				$("#btn_visual").attr("class","btn btn-block btn-info");
				
				$("#div_auditivo").show();
				$("#div_visual").hide();
			}
            
            $("#btn_kinestesico").click(function() {
				$("#btn_kinestesico").attr("class","btn btn-block btn-info");
				$("#btn_visual").attr("class","btn btn-block btn-primary");
				$("#btn_auditivo").attr("class","btn btn-block btn-primary");
				
				$("#div_auditivo").show();
				$("#div_visual").show();
			});
			
			$("#btn_visual").click(function() {
				$("#btn_kinestesico").attr("class","btn btn-block btn-info");
				$("#btn_visual").attr("class","btn btn-block btn-primary");
				$("#btn_auditivo").attr("class","btn btn-block btn-info");
				
				$("#div_auditivo").hide();
				$("#div_visual").show();
			});
			
			$("#btn_auditivo").click(function() {
				$("#btn_kinestesico").attr("class","btn btn-block btn-info");
				$("#btn_auditivo").attr("class","btn btn-block btn-primary");
				$("#btn_visual").attr("class","btn btn-block btn-info");
				
				$("#div_auditivo").show();
				$("#div_visual").hide();
			});

			
			$(".btn_res").click(function() {
				var texto_id = $(this).attr('id');
				var texto = (texto_id.substr(4,texto_id.length));
				var textos = texto.split("x");
				var leccion = textos[0];
				var pregunta = textos[1];
				var opcion = textos[2];
				
				$("#btn_"+leccion+"x"+pregunta+"xa").attr("class","btn btn-primary btn_res");
				$("#btn_"+leccion+"x"+pregunta+"xb").attr("class","btn btn-primary btn_res");
				$("#btn_"+leccion+"x"+pregunta+"xc").attr("class","btn btn-primary btn_res");
				$("#btn_"+leccion+"x"+pregunta+"xd").attr("class","btn btn-primary btn_res");
				$(this).attr("class","btn btn-danger btn_res");

				$("#r_"+leccion+"x"+pregunta).html(opcion);
			});
			



			$("#btn_terminar_prueba").click(function() {
					
				var leccion1 = 0;
				var preguntas = [];
				var respuestas = [];
				var contador = 0;
				$(".result").each(function( i ) {
					  
					var texto_id = $(this).attr('id');
					var texto = (texto_id.substr(2,texto_id.length));
					var textos = texto.split("x");
					var leccion = textos[0];
					var pregunta = textos[1];
					var opcion = $(this).text();
					
					leccion1 = leccion;
					preguntas[i] = pregunta;
					respuestas[i] = opcion;
					contador++;
				});
				
				jQuery.ajax({
					url: '../../../validar-quiz',
					data: {leccion: leccion1, preguntas: preguntas, respuestas: respuestas },
					success: function (result) {
						alert("Resultado: "+parseFloat(((result*100)/contador)).toFixed(2)+" % con "+result+" / "+contador);
					},
					async: false
				});
				  
			});
			
			
		});
		
	$("#menu-toggle").click(function(e) {
        e.preventDefault();
		$("#wrapper").toggleClass("toggled");
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
  <div class="collapse navbar-collapse navbar-ex1-collapse navbar_back">
    <ul class="nav navbar-nav">
    </ul>
 
    <ul class="nav navbar-nav navbar-right">
      <li><a href="../usuario/{{ Session::get('user_id') }}">{{ Session::get('user') }}</a></li>
      <li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
          Configuración<b class="caret"></b>
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


<body class="body_div bg_blue_80">
<!--
	<div class="container" style="position:relative; top:-30px;">
-->
		@yield('contenido', '')
<!--
	</div>			 
-->
</body>

</html>

		
