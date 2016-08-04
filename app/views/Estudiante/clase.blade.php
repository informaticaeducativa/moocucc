@extends ('template2')

@section ('title') Ver Curso @stop

@section ('contenido')

<div class="col-sm-3 col-xs-12  bg_blue_80">
	<div class=" espaciado">
		{{ HTML::image('imagenes/'.$curso->imagen_presentacion, $alt="", $attributes = array('class' => 'imagen_div')) }}
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
					<th width="5%"><center><a href="#" id="desuscribirx{{$curso->id_curso}}" class="btn_desuscribirse"><span class="glyphicon glyphicon-minus-sign" aria-hidden="true"></span></center></a></th>
					<th colspan="3"> <a href="#" id="desuscribirx{{$curso->id_curso}}" class="btn_desuscribirse">Darse de baja</a> </th>
				</tr>
		</table>
	</div>
</div>

<div class="col-sm-9 col-xs-12 div_list2 top_menos_20">
	<div class="col-md-12 col-sm-12 col-xs-12">

		<table width="100%">
			<tr>
				<th width="33%"><button class="btn btn-block btn-info" id="btn_kinestesico">Kinestésico</button></th>
				<th width="33%"><button class="btn btn-block btn-primary" id="btn_visual">Visual</button></th>
				<th width="33%"><button class="btn btn-block btn-primary" id="btn_auditivo">Lingüístico</button></th>
			</tr>
		</table>
		<h6 class="strong">{{ $curso->nombre }}</h6>
		<h2 class="strong"><center>{{ $leccion->nombre }}</center></h2>
		<br>
			<div id="div_visual">
				<center>
					{{ $leccion->kinestesico }}
				</center>
			</div>
			<!-- <div id="div_auditivo">
				{{ $leccion->contenido_texto }}
			</div> -->
			<br>
			<br>
			<hr>
			<br>
			<center><h3>Micro-foro</h3></center>
			<div id="form-microforo">
				<textarea rows="3"  class="form-control mensaje" id="mensajex{{$curso->id_curso}}x{{$leccion->id_leccion}}"></textarea>
				<br/>
				<button class="btn btn-info" id="btn-microforo">Enviar</button>
			</div>
			<div id="microforo">
				<table>
					@foreach ($leccion->getPreguntasLeccion() as $pregunta)
						<tr>
							@if(substr( $pregunta->getUsuario()->foto , 0, 4) == 'http')
							<th width="15%"><img class="imagen_redonda_reducida" src="{{ $pregunta->getUsuario()->foto }}" ></th>
							@else
							<th width="15%"><img class="imagen_redonda_reducida" src="../../../imagenes/fotos/{{ $pregunta->getUsuario()->foto  }} " ></th>
							@endif

							<th colspan="2">
								<span class=strong>{{ $pregunta->getUsuario()->nombre." ".$pregunta->getUsuario()->apellido }}</span><br>
								{{ $pregunta->pregunta }}<br>
								<h6>{{$pregunta->fecha_creacion}}</h6>
							</th>
						</tr>
						@if (count($pregunta->getPreguntasRelacionadas()) == 0)
						<tr>
							<th colspan="3">
								<table width="100%">
									<tr>
										<td width="5%">
										</td>
										<td width="80%">
											<input type="text" class="form-control" id="mensajex{{$curso->id_curso}}x{{$leccion->id_leccion}}x{{$pregunta->id_pregunta}}">
										</td>
										<td>
											<button class="btn btn-info responder_microforo" id="btnx{{$curso->id_curso}}x{{$leccion->id_leccion}}x{{$pregunta->id_pregunta}}">Responder</button>
										</td>
									</tr>
								</table>
							</th>
						</tr>
						@else
						@foreach ($pregunta->getPreguntasRelacionadas() as $pregunta2)
						<tr>
							<th width="5%"></th>

							@if(substr( $pregunta2->getUsuario()->foto , 0, 4) == 'http')
							<th width="15%"><img class="imagen_redonda_reducida" src="{{ $pregunta2->getUsuario()->foto }}" ></th>
							@else
							<th width="15%"><img class="imagen_redonda_reducida" src="../../../imagenes/fotos/{{ $pregunta2->getUsuario()->foto  }} " ></th>
							@endif

							<th>
								<span class=strong>{{ $pregunta2->getUsuario()->nombre." ".$pregunta2->getUsuario()->apellido }}</span><br>
								{{ $pregunta2->pregunta }}<br>
								<h6>{{$pregunta2->fecha_creacion}}</h6>
							</th>
						</tr>
						@endforeach
						<tr>
							<th colspan="3">
								<table width="100%">
									<tr>
										<td width="15%">
										</td>
										<td width="80%">
											<input type="text" class="form-control" id="mensajex{{$curso->id_curso}}x{{$leccion->id_leccion}}x{{$pregunta->id_pregunta}}">
										</td>
										<td>
											<button class="btn btn-info responder_microforo" id="btnx{{$curso->id_curso}}x{{$leccion->id_leccion}}x{{$pregunta->id_pregunta}}">Responder</button>
										</td>
									</tr>
								</table>
							</th>
						</tr>
						@endif


						<br>
					@endforeach
				</table>
			</div>
			<br/>

</div>

@stop
