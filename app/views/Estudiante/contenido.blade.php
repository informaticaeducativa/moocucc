@extends ('template2')

@section ('title') Contenido del curso {{ $curso->nombre }} @stop



@section ('contenido')

<div class="col-sm-3 col-xs-12  bg_blue_80">
	<div class=" espaciado">
		<img class="imagen_div" src="../imagenes/{{$curso->imagen_presentacion}} " >

		<table class="table-curso-detalles">

				<tr>
					<th width="5%"><center><a href="{{ URL::route('ver-curso-info', $curso->id_curso ) }}"><span class="glyphicon glyphicon glyphicon-home" aria-hidden="true"></span></center></a></th>
					<th colspan="3">{{ HTML::linkRoute('ver-curso-info', 'Inicio', array($curso->id_curso), array()) }}</th>
				</tr>
				<tr>
					<th width="5%"><center><a href="{{ URL::route('ver-curso-contenido', $curso->id_curso) }}"><span class="glyphicon glyphicon glyphicon-list" aria-hidden="true"></span></center></a></th>
					<th colspan="3">{{ HTML::linkRoute('ver-curso-contenido', 'Contenido del Curso', array($curso->id_curso), array()) }}</th>
				</tr>
				<tr>
					<th width="5%"><center><a href="{{ URL::route('ver-curso-tareas', $curso->id_curso) }}"><span class="glyphicon glyphicon glyphicon-list-alt" aria-hidden="true"></span></center></a></th>
					<th colspan="3">{{ HTML::linkRoute('ver-curso-tareas', 'Tareas', array($curso->id_curso), array()) }}</th>
				</tr>
				<tr>
					<th width="5%"><center><a href="{{ URL::route('ver-curso', $curso->id_curso) }}"><span class="glyphicon glyphicon glyphicon-info-sign" aria-hidden="true"></span></center></a></th>
					<th colspan="3">{{ HTML::linkRoute('ver-curso', 'Información del Curso', array($curso->id_curso), array()) }}</th>
				</tr>
				<tr>
					<th width="5%"><center><a href="{{ URL::route('desuscribirse', $curso->id_curso) }}"><span class="glyphicon glyphicon-minus-sign" aria-hidden="true"></span></center></a></th>
					<th colspan="3">{{ HTML::linkRoute('desuscribirse', 'Darse de baja del Curso', array($curso->id_curso), array()) }}</th>
				</tr>
		</table>
	</div>
</div>

<div class="col-sm-9 col-xs-12 div_list2 top_menos_20">
	<div class="col-md-12 col-sm-12 col-xs-12">
		<br/>
		<h1 class="strong"><center>Contenido del curso {{ $curso->nombre }}</center></h1>
		<br/>
		<h5 class="strong">Progreso</h5>
		<div class="progress progress-striped active">
		  <div class="progress-bar" role="progressbar"
			   aria-valuenow="{{ $porcentaje }}" aria-valuemin="0" aria-valuemax="100"
			   style="width: {{ $porcentaje }}%">
			{{ $porcentaje }}% completado
		  </div>
		</div>

		@if ($cantidad == 0)
		<h2 class="text-center">No hay contenido agregado en este curso</h2>
		@endif

		@if ($valor = (1 == 1))
		@endif
		@foreach ($curso->getTemariosSemana() as $temario)
			<h2>Semana {{$temario->posicion }}
									@if($editable)
											{{ HTML::linkRoute('editar-temario-semanal', 'Editar Mensaje', array($temario->id_temario), array('class' => 'btn btn-primary btn-xs')) }}
									@endif</h2>
			{{$temario->contenido }}<br/><br/>
			@foreach ($curso->getLecciones($temario->posicion) as $leccion)
				@if($valor)
				<a href="{{ URL::route('ver-clase', array($curso->id_curso, $leccion->id_leccion) ) }}">
				@endif
					<div id="id_leccion_{{$leccion->id_leccion }}" class="div_item row_cursos">
						<span class="strong">{{ $leccion->nombre }}</span>
						@if ($leccion->getRegistro($curso->id_curso))
							<img src="{{URL::to('imagenes/chulo.png')}}" width="20px">
						@endif
						@if($editable)
								{{ HTML::linkRoute('editar-leccion', 'Editar Leccion', array($leccion->id_leccion), array('class' => 'btn btn-primary btn-xs')) }}
						@endif
					</div>




				@if($valor)
				</a>
				@endif
			@endforeach
			@if ($valor = $leccion->getAvanceClases($temario->posicion))
			@endif
			<br/><hr/>
		@endforeach
		<br/><br/>
</div>

@stop
