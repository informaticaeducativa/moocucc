@extends ('template2')

@section ('title') Administrador @stop


@section ('contenido')
<script>

</script>

<div class="col-sm-12 col-xs-12 div_list2 top_menos_20">
	@if ($tipo_user = (Session::get('tipo_usuario') == 'Administrador'))
	<center><h1 class="strong">Perfil de Administrador</h1></center>
	@else
	<center><h1 class="strong">Panel docentes</h1></center>

	@endif
	<div class="col-md-3 col-sm-3 col-xs-12 div_list2">

	<h2 class="strong"><center>Menú</center></h2>

			<img class="col-md-12 col-sm-12 col-xs-12" src="../../imagenes/{{ $curso->imagen_presentacion  }} " />

		</br></br>
	<div class="col-md-12 col-sm-12 col-xs-12" >
		</br>
	</div>
	<div class="col-md-12 col-sm-12 col-xs-12" >
		@if ($tipo_user)
		<a href="{{ URL::route('crear-curso' ) }}">
			<div class="div_item row_cursos">
				<span class="strong">Crear Curso</span>
			</div>
		</a>
		<a href="{{ URL::route('administrador-estadisticas' ) }}">
			<div class="div_item row_cursos">
				<span class="strong">Regresar</span>
			</div>
		</a>
		@else
		<a href="{{ URL::route('administrador-listar-estadisticas' ) }}">
			<div class="div_item row_cursos">
				<span class="strong">Regresar</span>
			</div>
		</a>
		@endif
		</div>
	</div>
	<div class="col-md-9 col-sm-9 col-xs-12 div_list2">
		<h2 class="strong"><center>{{ $curso->nombre }}</center></h2>
		<br/>
			<table class="table">
				<tr>
					<th>Fecha de inicio del curso:</th>
					<td>{{ $curso->fecha_inicio }}</td>
				</tr>
				<tr>
					<th>Estudiantes Inscritos desde su inicio:</th>
					<td>{{ $curso->getInscritosTotal() }}</td>
				</tr>
				<tr>
					<th>Estudiantes Inscritos a la fecha:</th>
					<td>{{ $curso->getInscritos() }} - {{ round($curso->getInscritos()*100/($curso->getInscritosTotal() ), 2) }} %</td>
				</tr>
				<tr>
					<th>Estudiantes Retirados a la fecha:</th>
					<td>{{ $curso->getRetirados() }} - {{ round($curso->getRetirados()*100/($curso->getInscritosTotal() ), 2) }} %</td>
				</tr>

				@if ($relacion == 'admin')
				<tr>
					<th colspan="2">
						<center>
							<h4 class="strong">Gráfica de estudiantes activos</h4>
							<canvas id="myChart" class='img-responsive'></canvas>
						</center>
					</th>
				</tr>
				@endif
			</table>

			<table width="100%">
				<tr>
						<th colspan="4">
								<h4 class="text-center strong">Datos de Evaluaciones</h4>
						</th>
				</tr>
				<tr>
					<th width="55%">Nombre de evaluación</th>
					<th width="15%" class="text-center">Promedio Notas</th>
					<th width="15%" class="text-center">Promedio Intentos</th>
					<th width="15%" class="text-center">Estudiantes</th>
				</tr>
				@foreach ($curso->getAllEvaluaciones() as $evaluacion):
				<tr>
					<th>{{ $evaluacion->nombre }}</th>
					<td class="text-center">{{ $evaluacion->getPromedioNota() }} </td>
					<td class="text-center">{{ $evaluacion->getPromedioIntentos() }}</td>
					<td class="text-center">{{ $evaluacion->getPromedioEstudiantes() }}</td>
				</tr>
				@endforeach;
			</table>

			<br/>
			@if ($relacion == 'admin')
			<center>
				<h4 class="strong">Gráfica de estudiantes por ciudades</h4>
			</center>
			<div class="col-md-6 col-sm-6 col-xs-12">
				<table id="CiudadDataTable" class="table">
				</table>
			</div>
			<div class="col-md-6 col-sm-6 col-xs-12">
				<center>
					<canvas id="myChart2"  class='img-responsive'></canvas>
				</center>
			</div>
			</br>
			<center>
				<h4 class="strong">Gráfica de estudiantes por Países</h4>
			</center>
			<div class="col-md-6 col-sm-6 col-xs-12">
				<table id="PaisDataTable" class="table">
				</table>
			</div>
			<div class="col-md-6 col-sm-6 col-xs-12">
				<center>
					<canvas id="myChart3"   class='img-responsive' ></canvas>
				</center>
			</div>
			</br>
			<center>
				<h4 class="strong">Gráfica de estudiantes por Universidad</h4>
			</center>
			<div class="col-md-6 col-sm-6 col-xs-12">
				<table id="UniversidadDataTable" class="table">
				</table>
			</div>
			<div class="col-md-6 col-sm-6 col-xs-12">
				<center>
					<canvas id="myChart4"   class='img-responsive' ></canvas>
				</center>
			</div>
			@endif
	</div>
<input type="hidden" id="datas" value='{{ $curso->id_curso}}'>
</div>

@stop
