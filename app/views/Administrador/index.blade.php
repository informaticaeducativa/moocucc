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
		<a href="#">
			<div class="div_item row_cursos">
				<span class="strong">Modificar Curso</span>
			</div>
		</a>		
		<a href="#">
			<div class="div_item row_cursos">
				<span class="strong">Asignar Profesor Administrador</span>
			</div>
		</a>	
		<a href="#">
			<div class="div_item row_cursos">
				<span class="strong">Asignar Profesor Básico</span>
			</div>
		</a>	
		<a href="#">
			<div class="div_item row_cursos">
				<span class="strong">Crear Nueva Temática (Sin hacer)</span>
			</div>
		</a>	
		<a href="#">
			<div class="div_item row_cursos">
				<span class="strong">Ver estadisticas de Administrador (Sin hacer)</span>
			</div>
		</a>		
	</div>
	<div class="col-md-9 col-sm-9 col-xs-12 div_list2">
		<h2 class="strong"><center>Contenido</center></h2>
		<br/>
	</div>

</div>

@stop
