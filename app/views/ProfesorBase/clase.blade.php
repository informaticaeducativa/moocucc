@extends ('template2')

@section ('title') Ver Curso @stop

@section ('contenido')

<div class="col-sm-3 col-xs-12  bg_blue_80">
	<div class=" espaciado">
		<img class="imagen_div" src="../../../../imagenes/{{$curso->imagen_presentacion}} " >

		<table class="table-curso-detalles">
				<tr>
					<th width="5%"><center><a href="{{ URL::route('profesor-base-ver-curso-info', $curso->id_curso ) }}"><span class="glyphicon glyphicon glyphicon-home" aria-hidden="true"></span></center></a></th>
					<th colspan="3">{{ HTML::linkRoute('profesor-base-ver-curso-info', 'Inicio', array($curso->id_curso), array()) }}</th>
				</tr>
				<tr>
					<th width="5%"><center><a href="{{ URL::route('profesor-base-ver-curso-contenido', $curso->id_curso) }}"><span class="glyphicon glyphicon glyphicon-list" aria-hidden="true"></span></center></a></th>
					<th colspan="3">{{ HTML::linkRoute('profesor-base-ver-curso-contenido', 'Contenido del Curso', array($curso->id_curso), array()) }}</th>
				</tr>
				<tr>
					<th width="5%"><center><a href="{{ URL::route('profesor-base-ver-curso-tareas', $curso->id_curso) }}"><span class="glyphicon glyphicon glyphicon-list-alt" aria-hidden="true"></span></center></a></th>
					<th colspan="3">{{ HTML::linkRoute('profesor-base-ver-curso-tareas', 'Tareas', array($curso->id_curso), array()) }}</th>
				</tr>
				<tr>
					<th width="5%"><center><a href="{{ URL::route('profesor-base-ver-curso', $curso->id_curso) }}"><span class="glyphicon glyphicon glyphicon-info-sign" aria-hidden="true"></span></center></a></th>
					<th colspan="3">{{ HTML::linkRoute('profesor-base-ver-curso', 'Información del Curso', array($curso->id_curso), array()) }}</th>
				</tr>
		</table>
	</div>
</div>

<div class="col-sm-9 col-xs-12 div_list2 top_menos_20">
	<div class="col-md-12 col-sm-12 col-xs-12">

		<table width="100%">
			<tr>
				<th width="33%"><button class="btn btn-block btn-info" id="btn_kinestesico">Kinestesico</button></th>
				<th width="33%"><button class="btn btn-block btn-primary" id="btn_visual">Visual</button></th>
				<th width="33%"><button class="btn btn-block btn-primary" id="btn_auditivo">Linguistico</button></th>
			</tr>
		</table>
		<h6 class="strong">{{ $curso->nombre }}</h6>
		<h2 class="strong"><center>{{ $leccion->nombre }}</center></h2>
		<br>
			<div id="div_auditivo">
				{{ $leccion->contenido_texto }}
			</div>
			<br>
			<div id="div_visual">
				<center>
					{{ $leccion->contenido_grafico }}
				</center>
			</div>
			<br>
			<hr>
			<br>
			<center><h3>Micro-foro</h3></center>
			<div id="form-microforo">
				<textarea rows="3"  class="form-control mensaje" id="mensajex{{$curso->id_curso}}x{{$leccion->id_leccion}}"></textarea>
				<button class="btn btn-info" id="btn-microforo-2">Enviar</button>
			</div>
			<div id="microforo">
				<table>
					@foreach ($leccion->getPreguntasLeccion() as $pregunta)
						<tr>
							@if(substr( $pregunta->getUsuario()->foto , 0, 4) == 'http')
							<th width="20%"><img class="imagen_redonda_reducida" src="{{ $pregunta->getUsuario()->foto  }}" ></th>
							@else
							<th width="20%"><img class="imagen_redonda_reducida" src="../../../../imagenes/fotos/{{ $pregunta->getUsuario()->foto  }} " ></th>
							@endif
							<th>
								<span class=strong>{{ $pregunta->getUsuario()->nombre." ".$pregunta->getUsuario()->apellido }}</span><br>
								{{ $pregunta->pregunta }}<br>
								<h6>{{$pregunta->fecha_creacion}}</h6>
							</th>
						</tr>
						<br>
					@endforeach
				</table>
			</div>
			<br/>

</div>

@stop
