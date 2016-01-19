@extends ('template2')

@section ('title') Ver Curso @stop

@section ('contenido')
<?php $contador=1; ?>
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
					<th width="5%"><center><a href="{{ URL::route('desuscribirse', $curso->id_curso) }}"><span class="glyphicon glyphicon-minus-sign" aria-hidden="true"></span></center></a></th>
					<th colspan="3">{{ HTML::linkRoute('desuscribirse', 'Darse de baja del Curso', array($curso->id_curso), array()) }}</th>
				</tr>
		</table>
	</div>
</div>

<div class="col-sm-9 col-xs-12 div_list2 top_menos_20">
	<div class="col-md-12 col-sm-12 col-xs-12">
		<h6 class="strong">{{ $curso->nombre }}</h6>
		<h2 class="strong"><center>{{ $evaluacion->nombre }}</center></h2>
		<br/>
			<h6 class="strong">Calificable: {{ $evaluacion->calificable }}</h6>

			@foreach ($evaluacion->getPreguntas() as $pregunta)
			<div class="col-md-12 col-sm-12 col-xs-12 espaciado ">
				{{ '('.$contador.') '.$pregunta->nombre }}
			@if ( $pregunta->opcion_multiple == 'si')
				<br/>
				A) {{ $pregunta->opcion_a }}<br/>
				B) {{ $pregunta->opcion_b }}<br/>
				C) {{ $pregunta->opcion_c }}<br/>
				D) {{ $pregunta->opcion_d }}<br/>
				<div class="col-md-12 col-sm-12 col-xs-12 espaciado ">
					<div class="col-md-6 col-sm-8 col-xs-12 espaciado ">
						<table width="100%">
							<tr>
								<th>
									<button id="btn_{{$evaluacion->id_evaluacion}}x{{$pregunta->id_pregunta}}xa"  class="btn btn-primary btn_res">A</button>
								</th>
								<th>
									<button id="btn_{{$evaluacion->id_evaluacion}}x{{$pregunta->id_pregunta}}xb"   class="btn btn-primary btn_res">B</button>
								</th>
								<th>
									<button id="btn_{{$evaluacion->id_evaluacion}}x{{$pregunta->id_pregunta}}xc"   class="btn btn-primary btn_res">C</button>
								</th>
								<th>
									<button id="btn_{{$evaluacion->id_evaluacion}}x{{$pregunta->id_pregunta}}xd"   class="btn btn-primary btn_res">D</button>
								</th>
							</tr>
							<input type="hidden" id="r_{{$evaluacion->id_evaluacion}}x{{$pregunta->id_pregunta}}" class="result">
						</table>
					</div>
					<div class="col-md-6 col-sm-8 col-xs-12 espaciado" id="mensaje_{{$evaluacion->id_evaluacion}}x{{$pregunta->id_pregunta}}">

					</div>
				</div>
			@else
			<div class="col-md-12 col-sm-12 col-xs-12 espaciado">
				<input type="text" class="form-control input_res" id="input_{{$evaluacion->id_evaluacion}}x{{$pregunta->id_pregunta}}">
				<input type="hidden" class="result" id="r_{{$evaluacion->id_evaluacion}}x{{$pregunta->id_pregunta}}">
			</div>
				<div class="col-md-12 col-sm-12 col-xs-12 espaciado" id="mensaje_{{$evaluacion->id_evaluacion}}x{{$pregunta->id_pregunta}}">
				</div>
			@endif
				<hr/>
			</div>
			<?php $contador++; ?>
			@endforeach

			<br/><br/><br/>
				<button id="btn_terminar_prueba" class="btn btn-success btn-block">Terminar Prueba</button>
				<a href="{{ URL::route('ver-curso-tareas', $curso->id_curso) }}" id="regresar_button" style="visibility:hidden;" class="btn btn-primary btn-block">Finalizar</a>
			<br/><br/>

	</div>
</div>


<!-- Modal -->
<div class="modal fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title strong text-center" id="myModalLabel">Curso Completado</h4>
      </div>
      <div class="modal-body">
					<center>
							<canvas id="canvas_completo" width="140" height="140"></canvas>
					</center>
					<h3>Felicitaciones</h3>
					Has completado satisfactoriamente el curso
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-dismiss="modal">Salir</button>
      </div>
    </div>
  </div>
</div>
<script type="text/javascript" src="{{URL::to('js/canvas1.js')}}"></script>
<script type="text/javascript">
		makeCanvasCompleto({{$evaluacion->semana}}, '{{$badge->color1}}', '{{$badge->color2}}');
</script>

<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title strong text-center" id="myModalLabel">Semana {{$evaluacion->semana}}</h4>
      </div>
      <div class="modal-body">
					<center>
							<canvas id="canvas" width="140" height="140"></canvas>
					</center>
					<h3>Felicitaciones</h3>
					Has completado satisfactoriamente la semana 1 del curso {{$curso->nombre}}
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-dismiss="modal">Salir</button>
      </div>
    </div>
  </div>
</div>
<script type="text/javascript" src="{{URL::to('js/canvas1.js')}}"></script>
<script type="text/javascript">
		makeCanvasSemanal({{$evaluacion->semana}}, '{{$badge->color1}}', '{{$badge->color2}}');
</script>


@stop
