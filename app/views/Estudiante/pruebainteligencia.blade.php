@extends ('template2')

@section ('title') Prueba de inteligencias @stop

@section ('contenido')


<div class="col-sm-12 col-xs-12 div_list2 top_menos_20">
	<div class="col-md-12 col-sm-12 col-xs-12">
		<h2 class="strong"><center>{{ $evaluacion->nombre }}</center></h2>
		<br/>
			<h6 class="strong">Calificable: {{ $evaluacion->calificable }}</h6>
			<h5>Para realizar este test, debe puntuar cada pregunta de 1 a 4 siguiendo las siguientes indicaciones:
				<br/>
				1. Parcialmente en desacuerdo
				<br/>
				2. Ligeramente en desacuerdo
				<br/>
				3. Ligeramente de acuerdo
				<br/>
				4. Parcialmente de acuerdo
			</h5>
			<br/>
			@foreach ($evaluacion->getPreguntas() as $pregunta)
			<div class="col-md-12 col-sm-12 col-xs-12 espaciado ">
				{{ $pregunta->nombre }}<br>

				<div class="col-md-12 col-sm-12 col-xs-12 espaciado ">
					<div class="col-md-6 col-sm-8 col-xs-12 espaciado ">
						<table width="100%">
							<tr>
								<th>
									<button id="btn_{{$evaluacion->id_evaluacion}}x{{$pregunta->id_pregunta}}x1"  class="btn btn-primary btn_res_num">1</button>
								</th>
								<th>
									<button id="btn_{{$evaluacion->id_evaluacion}}x{{$pregunta->id_pregunta}}x2"   class="btn btn-primary btn_res_num">2</button>
								</th>
								<th>
									<button id="btn_{{$evaluacion->id_evaluacion}}x{{$pregunta->id_pregunta}}x3"   class="btn btn-primary btn_res_num">3</button>
								</th>
								<th>
									<button id="btn_{{$evaluacion->id_evaluacion}}x{{$pregunta->id_pregunta}}x4"   class="btn btn-primary btn_res_num">4</button>
								</th>
							</tr>
							<input type="hidden" id="r_{{$evaluacion->id_evaluacion}}x{{$pregunta->id_pregunta}}" class="result" value="0">
						</table>
					</div>
					<div class="col-md-6 col-sm-8 col-xs-12 espaciado" id="mensaje_{{$evaluacion->id_evaluacion}}x{{$pregunta->id_pregunta}}">

					</div>
				</div>
				<hr>
			</div>
			@endforeach

			<br/><br/><br/>
				<button id="btn_inteligencia" class="btn btn-warning btn-block">Terminar Prueba</button>
			<br/><br/>
			<div id="regresar" style="display:none;">
				<a href="{{ URL::route('index') }}"><button class="btn btn-primary btn-block">Regresar</button></a>
			</div>	
			
			<br>
		
	</div>
</div>

@stop
