@extends ('template2')

@section ('title') Tareas del curso {{ $curso->nombre }} @stop



@section ('contenido')

<div class="col-sm-3 col-xs-12  bg_blue_80">
	<div class=" espaciado">
		<img class="imagen_div" src="../imagenes/{{$curso->imagen_presentacion}} " >

		<table class="table-curso-detalles">

				<tr>
					<th width="5%">
						<center>
							<a href="{{ URL::route('ver-curso-info', $curso->id_curso ) }}">
								<span class="glyphicon glyphicon glyphicon-home" aria-hidden="true"></span>
							</a>
						</center>
					</th>
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
		<br/>
		<h1 class="strong"><center>Tareas del curso {{ $curso->nombre }}</center></h1>
		<br/>
		<h5 class="strong">Progreso</h5>
		<div class="progress progress-striped active">
		  <div class="progress-bar" role="progressbar"
			   aria-valuenow="80" aria-valuemin="0" aria-valuemax="100"
			   style="width: 80%">
			80% completado
		  </div>
		</div>
		@foreach ($curso->getTemariosSemana() as $temario)
			<h2>Semana {{$temario->posicion }}</h2>
			@foreach ($curso->getEvaluaciones($temario->posicion) as $evaluacion)
				<a href="{{ URL::route('ver-tarea', array($curso->id_curso, $evaluacion->id_evaluacion ) ) }}">
					<div id="id_leccion_{{$evaluacion->id_evaluacion }}" class="div_item row_cursos">
						<span class="strong">{{ $evaluacion->nombre }}   (calificable: {{$evaluacion->calificable}})</span>
						@if ($evaluacion->getRealizado($curso->id_curso))
							<img src="{{URL::to('imagenes/chulo.png')}}" width="20px">
							{{ $evaluacion->getCalificacion() }}
						@endif
					</div>
				</a>
			@endforeach
			<br/><hr/>
		@endforeach
		<br/><br/>
</div>

@stop
