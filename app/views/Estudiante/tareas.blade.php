@extends ('template2')

@section ('title') Tareas del curso {{ $curso->nombre }} @stop



@section ('contenido') 

<div class="col-sm-3 col-xs-12  bg_blue_80">
	<div class=" espaciado">
		<img class="imagen_div" src="../imagenes/{{$curso->imagen_presentacion}} " >
	
		<table class="table-curso-detalles">
			
				<tr>
					<th width="5%"><center><a href="{{ URL::route('ver-curso-info', $curso->id_curso ) }}"><span class="glyphicon glyphicon glyphicon-home" aria-hidden="true"></span></center></a></th>
					<th colspan="3">{{ HTML::linkRoute('ver-curso-info', 'Inicio', array($curso->id_curso), array()) }}</th>
				</tr>
			
			<a href="#">
				<tr>
					<th width="5%"><center><a href="{{ URL::route('ver-curso-contenido', $curso->id_curso) }}"><span class="glyphicon glyphicon glyphicon-list" aria-hidden="true"></span></center></a></th>
					<th colspan="3">{{ HTML::linkRoute('ver-curso-contenido', 'Contenido del Curso', array($curso->id_curso), array()) }}</th>
				</tr>
			<a href="#">
			</a>	
				<tr>
					<th width="5%"><center><a href="{{ URL::route('ver-curso-tareas', $curso->id_curso) }}"><span class="glyphicon glyphicon glyphicon-list-alt" aria-hidden="true"></span></center></a></th>
					<th colspan="3">{{ HTML::linkRoute('ver-curso-tareas', 'Tareas', array($curso->id_curso), array()) }}</th>
				</tr>
			<a href="#">
			</a>	
				<tr>
					<th width="5%"><center><a href="{{ URL::route('ver-curso', $curso->id_curso) }}"><span class="glyphicon glyphicon glyphicon-info-sign" aria-hidden="true"></span></center></a></th>
					<th colspan="3">{{ HTML::linkRoute('ver-curso', 'Información del Curso', array($curso->id_curso), array()) }}</th>
				</tr>
			</a>
		</table>
	</div>
</div>

<div class="col-sm-9 col-xs-12 div_list2 top_menos_20">
	<div class="col-md-12 col-sm-12 col-xs-12">
		<br>
		<h1><center><strong>Tareas del curso {{ $curso->nombre }}</strong></center></h1>
		<br>
		@foreach ($curso->getTemariosSemana() as $temario)
			<h2>Semana {{$temario->posicion }}</h2>
			@foreach ($curso->getEvaluaciones($temario->posicion) as $evaluacion)
				<a href="{{ URL::route('ver-tarea', array($curso->id_curso, $evaluacion->id_evaluacion ) ) }}">
					<div id="id_leccion_{{$evaluacion->id_evaluacion }}" class="div_item row_cursos">
						<strong>{{ $evaluacion->nombre }}   (calificable: {{$evaluacion->calificable}})</strong>
					</div>
				</a>
			@endforeach
			<br><hr>
		@endforeach
		<br><br>
</div>

@stop


