@extends ('template')

<?php
    if ($temario->exists):
        $form_data = array('route' => array('temario.update', $temario->id_temario), 'method' => 'PATCH', 'files'=> true);
        $action    = 'Editar';
    else:
        $form_data = array('route' => 'temario.store', 'method' => 'POST', 'files'=> true);
        $action    = 'Crear';
    endif;
?>

@section ('title') {{ $action }} Temario @stop

@section ('title_div') {{ $action }} Temario @stop

@section ('contenido') 

<br><br>
<table>
	<tr>
		<th colspan="2"><center>Información del curso</center></th>
	</tr>
	<tr>
		<th>ID:</th>
		<td>{{ $curso->id_curso }}</td>
	</tr>
	<tr>
		<th>Nombre:</th>
		<td>{{ $curso->nombre }}</td>
	</tr>
	<tr>
		<th>Imagen:</th>
		<td><img src="../../imagenes/{{ $curso->imagen_presentacion }}" width="200px" height="200px"></td>
	</tr>
	<tr>
		<th>Fecha de inicio:</th>
		<td>{{ $curso->fecha_inicio }}</td>
	</tr>
	<tr>
		<th>Estilo del curso:</th>
		<td>{{ $curso->comienzo }}</td>
	</tr>
	<tr>
		<th>Tematica:</th>
		<td>{{ $curso->getTematica() }}</td>
	</tr>
	<tr>
		<th>Nivel:</th>
		<td>{{ $curso->nivel }}</td>
	</tr>
	<tr>
		<th>Duración:</th>
		<td>{{ $curso->duracion }}</td>
	</tr>	
	<tr>
		<th>Esfuerzo:</th>
		<td>{{ $curso->esfuerzo }}</td>
	</tr>
	<tr>
		<th>Precio:</th>
		<td>{{ $curso->precio }}</td>
	</tr>
	<tr>
		<th>Prerrequisitos:</th>
		<td>{{ $curso->prerrequisitos }}</td>
	</tr>
	<tr>
		<th colspan="2"><center>Contenidos</center>	</th>
	</tr>
	@foreach( $temarios as $temariu)
	<tr>
		<th>{{ $temariu->titulo }}</th>
		<td>{{ $temariu->contenido }}</td>
	</tr>
	@endforeach
</table>



<br>
<h2>Crear contenido del curso {{ $curso->nombre }}</h2>


{{ Form::model($temario, $form_data, array('role' => 'form')) }}

  @include ('errors', array('errors' => $errors))

  <div class="row">
    <div class="form-group col-md-10">
      {{ Form::label('titulo', 'Titulo del Contenido') }}
      {{ Form::text('titulo', null, array('placeholder' => 'Ej: Acerca de este curso, Temas de este curso', 'class' => 'form-control')) }}
    </div>
    <div class="form-group col-md-10">
      {{ Form::label('contenido', 'Contenido de inicio') }}
      {{ Form::textarea('contenido', null, array('placeholder' => 'Introduce el contenido', 'class' => 'form-control')) }}
    </div>
  </div>
  {{ Form::hidden('id_curso', $curso->id_curso) }}
  {{ Form::hidden('tipo_contenido', 'info_curso') }}
  
  {{ Form::button($action . ' temario', array('type' => 'submit', 'class' => 'btn btn-primary')) }}
  
{{ Form::close() }}



@stop  
