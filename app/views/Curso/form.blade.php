@extends ('template')

<?php

    if ($curso->exists):
        $form_data = array('route' => array('curso.update', $curso->id_curso), 'method' => 'PATCH');
        $action    = 'Editar';
    else:
        $form_data = array('route' => 'curso.store', 'method' => 'POST');
        $action    = 'Crear';
    endif;

?>

@section ('title') {{ $action }} Curso @stop


@section ('contenido')
<center>
	<h1>
		{{ $action }} Curso
	</h1>
</center>
  <p>
    <a href="{{ route('curso.index') }}" class="btn btn-info">Lista de Cursos</a>
  </p>

<br>

{{ Form::model($curso, $form_data, array('role' => 'form')) }}

  @include ('errors', array('errors' => $errors))

  <div class="row">
    <div class="form-group col-md-5">
      {{ Form::label('nombre', 'Nombre del curso') }}
      {{ Form::text('nombre', null, array('placeholder' => 'Introduce el nombre del curso', 'class' => 'form-control')) }}
    </div>
    <div class="form-group col-md-5">
      {{ Form::label('fecha_inicio', 'Fecha de inicio') }}
      {{ Form::input('date', 'fecha_inicio', null, array('placeholder' => 'Introduce la fecha de inicio del curso', 'class' => 'form-control')) }}
    </div>
    <div class="form-group col-md-5">
      {{ Form::label('imagen_presentacion', 'Imagen del curso') }}
      {{ Form::file('imagen_presentacion', null, array('placeholder' => 'Introduce la imagen del curso', 'class' => 'form-control')) }}
    </div>
     <div class="form-group col-md-5">
      {{ Form::label('comienzo', 'Comienzo del curso') }}
      {{ Form::text('comienzo', null, array('placeholder' => 'Introduce cuando comienza el curso', 'class' => 'form-control')) }}
    </div>
    <div class="form-group col-md-5">
      {{ Form::label('id_tematica', 'Temática del curso') }}
      {{ Form::select('id_tematica', $tematicas, null, array('placeholder' => 'Introduce cuando comienza el curso', 'class' => 'form-control')) }}
    </div>
    <div class="form-group col-md-5">
      {{ Form::label('nivel', 'Nivel del curso') }}
      {{ Form::select('nivel',  array('Principiante' => 'Principiante', 'Medio' => 'Medio', 'Avanzado'=>'Avanzado'), null, array('class' => 'form-control')) }}
    </div>
  </div>

  {{ Form::button($action . ' curso', array('type' => 'submit', 'class' => 'btn btn-primary')) }}

{{ Form::close() }}



@stop
