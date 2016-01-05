<!DOCTYPE html>
<html lang="en" class="no-js">
<!--
  clase index.blade.php
  @copyright 2015
-->
<head>
	<title>@yield('title', 'MOOC UCC')</title></title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<!-- CSS -->
	<link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.0.3/css/bootstrap.min.css" >
	<link href="{{URL::to('css/estilo.css')}}" rel="stylesheet">

	<!-- js -->
	<script src= "https://code.jquery.com/jquery.js" ></script>
	<script src= "{{URL::to('js/Chart.js')}}"></script>
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
			
            if("Linguistico" == track)
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
			
			$("#btn-microforo").click(function() {
				var mensaje = $(".mensaje").val();
				var texto_id = $(".mensaje").attr('id');
				var texto = (texto_id.substr(8,texto_id.length));
				var textos = texto.split("x");
				var clase = textos[0];
				var leccion = textos[1];
				var usuario = "";
				
				jQuery.ajax({
					url: '../../../postear-en-microforo',					
					data: {clase: clase, leccion: leccion, mensaje: mensaje },
					success: function (result) {
						usuario = result;
						location.reload();
					},
					async: true
				});
				
			});

			$("#btn-microforo-2").click(function() {
				var mensaje = $(".mensaje").val();
				var texto_id = $(".mensaje").attr('id');
				var texto = (texto_id.substr(8,texto_id.length));
				var textos = texto.split("x");
				var clase = textos[0];
				var leccion = textos[1];
				var usuario = "";
				
				jQuery.ajax({
					url: '../../../../postear-en-microforo',					
					data: {clase: clase, leccion: leccion, mensaje: mensaje },
					success: function (result) {
						usuario = result;
						location.reload();
					},
					async: true
				});
				
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
			
			$(".btn_res_num").click(function() {
				var texto_id = $(this).attr('id');
				var texto = (texto_id.substr(4,texto_id.length));
				var textos = texto.split("x");
				var leccion = textos[0];
				var pregunta = textos[1];
				var opcion = textos[2];
				
				$("#btn_"+leccion+"x"+pregunta+"x1").attr("class","btn btn-primary btn_res");
				$("#btn_"+leccion+"x"+pregunta+"x2").attr("class","btn btn-primary btn_res");
				$("#btn_"+leccion+"x"+pregunta+"x3").attr("class","btn btn-primary btn_res");
				$("#btn_"+leccion+"x"+pregunta+"x4").attr("class","btn btn-primary btn_res");
				$(this).attr("class","btn btn-danger btn_res");

				$("#r_"+leccion+"x"+pregunta).html(opcion);
			});
			
			var ctx = $("#myChart").get(0).getContext("2d");
			var ctx2 = $("#myChart2").get(0).getContext("2d");
			var ctx3 = $("#myChart3").get(0).getContext("2d");
			var ctx4 = $("#myChart4").get(0).getContext("2d");

			var ctx = document.getElementById("myChart").getContext("2d");
			var ctx2 = document.getElementById("myChart2").getContext("2d");
			var ctx3 = document.getElementById("myChart3").getContext("2d");
			var ctx4 = document.getElementById("myChart4").getContext("2d");
				
						
			jQuery.ajax({
					url: '../../../obtener-inscritos',
					data: {curso: $("#datas").val() },
					success: function (result) {
						var myBarChart = new Chart(ctx).Pie(result, {});
					},
					async: false
				});
			
			jQuery.ajax({
					url: '../../../obtener-demografia',
					data: {curso: $("#datas").val() },
					success: function (result) {
						var myBarChart2 = new Chart(ctx2).Pie(result, {});
						drawTable(result, "CiudadDataTable", "Ciudad");
					},
					async: false
				});
				
			jQuery.ajax({
					url: '../../../obtener-demografia-pais',
					data: {curso: $("#datas").val() },
					success: function (result) {
						var myBarChart3 = new Chart(ctx3).Pie(result, {});
						drawTable(result, "PaisDataTable", "Pais");
					},
					async: false
				});
			
			jQuery.ajax({
					url: '../../../obtener-inscritos-universidad',
					data: {curso: $("#datas").val() },
					success: function (result) {
						var myBarChart4 = new Chart(ctx4).Pie(result, {});
						drawTable(result, "UniversidadDataTable", "Universidad");
					},
					async: false
				});
			
			function drawTable(data, table, demografia) {
				var row = $("<tr />")
				$("#"+table).append(row); //this will append tr element to table... keep its reference for a while since we will add cels into it
				row.append($("<th>"+demografia+"</th>"));
				row.append($("<th>Cantidad</th>"));
				for (var i = 0; i < data.length; i++) {
					drawRow(data[i], table);
				}
			}

			function drawRow(rowData, table) {
				var row = $("<tr />")
				$("#"+table).append(row); //this will append tr element to table... keep its reference for a while since we will add cels into it
				row.append($("<td>" + rowData.label + "</td>"));
				row.append($("<td>" + rowData.value + "</td>"));
			}
			
			$("#btn_inteligencia").click(function() {
					
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
					
					preguntas[i] = pregunta;
					respuestas[i] = parseInt(opcion);
					contador++;
				});
				console.log("comienza");
				jQuery.ajax({
					url: '../../../validar-inteligencia',
					data: {preguntas: preguntas, respuestas: respuestas },
					success: function (result) {
						console.log(result);
						$("#regresar").show();
						
						alert("Resultado: "+result);
						
					},
					async: true
				});
				  
			});
			
		});
		
	$("#menu-toggle").click(function(e) {
        e.preventDefault();
		$("#wrapper").toggleClass("toggled");
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
      
      <li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
          {{ Session::get('user') }}<b class="caret"></b>
        </a>
        <ul class="dropdown-menu">
          <li><a href="{{ URL::route('usuario', Session::get('user_id') ) }}">Mi perfil</a></li>
          <li class="divider"></li>
          <li><a href="{{ URL::route('logout')}}">Salir</a></li>
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

		
