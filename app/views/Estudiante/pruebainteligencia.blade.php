@extends ('template2')

@section ('title') Prueba de inteligencias @stop

@section ('contenido')


<div class="col-sm-12 col-xs-12 div_list2 top_menos_20">
	<div class="col-md-12 col-sm-12 col-xs-12">
		<h2 class="strong"><center>{{ $evaluacion->nombre }}</center></h2>
		<br/>
			<h6 class="strong">Calificable: {{ $evaluacion->calificable }}</h6>
			<h5>Para realizar este test, debe seleccionar Verdadero o False según corresponda:</h5>
			<br/>
			@foreach ($evaluacion->getPreguntas() as $pregunta)
			<div class="col-md-12 col-sm-12 col-xs-12 espaciado ">
				{{ $pregunta->nombre }}<br>

				<div class="col-md-12 col-sm-12 col-xs-12 espaciado ">
					<div class="col-md-6 col-sm-8 col-xs-12 espaciado ">
						<table width="100%">
							<tr>
								<th>
									<button id="btn_{{$evaluacion->id_evaluacion}}x{{$pregunta->id_pregunta}}x1"  class="btn btn-primary btn_res_num">Falso</button>
								</th>
								<th>
									<button id="btn_{{$evaluacion->id_evaluacion}}x{{$pregunta->id_pregunta}}x2"   class="btn btn-primary btn_res_num">Verdadero</button>
								</th>
							</tr>
							<input type="hidden" id="r_{{$evaluacion->id_evaluacion}}x{{$pregunta->id_pregunta}}" class="result">
						</table>
					</div>
					<div class="col-md-6 col-sm-8 col-xs-12 espaciado" id="mensaje_{{$evaluacion->id_evaluacion}}x{{$pregunta->id_pregunta}}" style="color:red;">

					</div>
				</div>
				<hr>
			</div>
			@endforeach

			<br/><br/><br/>
				<button id="btn_inteligencia" class="btn btn-success btn-block">Terminar Prueba</button>
				<a href="{{ URL::route('mis-cursos') }}" style="visibility:hidden;" id="regresar" class="btn btn-primary btn-block">Regresar</a>
			<br/>

	</div>
</div>

@stop
