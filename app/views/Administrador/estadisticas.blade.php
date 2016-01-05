@extends ('template2')

@section ('title') Administrador @stop


@section ('contenido')


<div class="col-sm-12 col-xs-12 div_list2 top_menos_20">
	<center><h1 class="strong">Perfil de Administrador</h1></center>
	<div class="col-md-3 col-sm-3 col-xs-12 div_list2">
		<h2 class="strong"><center>Menú</center></h2>
		<br/>
		<a href="{{ URL::route('crear-curso' ) }}">
			<div class="div_item row_cursos">
				<span class="strong">Crear Curso</span>
			</div>
		</a>		
		<a href="{{ URL::route('administrador-estadisticas' ) }}">
			<div class="div_item row_cursos">
				<span class="strong">Ver estadisticas de Administrador</span>
			</div>
		</a>
		
	</div>
	<div class="col-md-9 col-sm-9 col-xs-12 div_list2">
		<h2 class="strong"><center>Ver estadísticas de un Curso</center></h2>
		<br/>
		@foreach($cursos as $curso)
		<a href="{{ URL::route('administrador-ver-estadisticas', $curso->id_curso ) }}">
			<div class="div_item row_cursos col-md-5 col-sm-5 col-xs-5 ">
				<table>
					<tr>
						<th><img class="imagen_cuadrada_reducida" src="../imagenes/{{ $curso->imagen_presentacion  }} "></th>
						<th><span class="strong">{{ $curso->nombre }}<br>Inscritos: {{ $curso->getInscritos() }}</span></th>
					</tr>
				</table>
			</div>
		</a>
		@endforeach

	</div>

</div>

@stop
