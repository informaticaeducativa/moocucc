@extends ('template')

<?php

    if ($curso->exists):
        $form_data = array('route' => array('curso.update', $curso->id_curso), 'method' => 'PATCH', 'files'=> true);
        $action    = 'Editar';
    else:
        $form_data = array('route' => 'curso.store', 'method' => 'POST', 'files'=> true);
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
      {{ Form::label('comienzo', 'Tiempo del curso') }}
      {{ Form::select('comienzo',  array('Auto-aprendizaje' => 'Auto-aprendizaje', 'Con tiempo limite' => 'Con tiempo limite'), null, array('class' => 'form-control')) }}
    </div>
    <div class="form-group col-md-5">
      {{ Form::label('id_tematica', 'Temática del curso') }}
      {{ Form::select('id_tematica', $tematicas, null, array('placeholder' => 'Introduce cuándo comienza el curso', 'class' => 'form-control')) }}
    </div>
    <div class="form-group col-md-5">
      {{ Form::label('nivel', 'Nivel del curso') }}
      {{ Form::select('nivel',  array('Principiante' => 'Principiante', 'Medio' => 'Medio', 'Avanzado'=>'Avanzado'), null, array('class' => 'form-control')) }}
    </div>
    <div class="form-group col-md-5">
      {{ Form::label('duracion', 'Duración del curso') }}
      {{ Form::text('duracion', null, array('placeholder' => 'Ej: 5 Semanas', 'class' => 'form-control')) }}
    </div>
    <div class="form-group col-md-5">
      {{ Form::label('esfuerzo', 'Esfuerzo semanal del curso (en horas)') }}
      {{ Form::text('esfuerzo', null, array('placeholder' => 'Ej: 4 horas por semana ', 'class' => 'form-control')) }}
    </div>
    <div class="form-group col-md-5">
      {{ Form::label('precio', 'Introduce el precio del curso (o gratis)') }}
      {{ Form::text('precio', null, array('placeholder' => 'Ej: 5000 COP, gratis ', 'class' => 'form-control')) }}
    </div>
    <div class="form-group col-md-5">
      {{ Form::label('prerrequisitos', 'Prerrequisitos del curso') }}
      {{ Form::text('prerrequisitos', null, array('placeholder' => 'Escribe los conocimientos que debe tener el estudiante', 'class' => 'form-control')) }}
    </div>

  </div>

  {{ Form::button($action . ' curso', array('type' => 'submit', 'class' => 'btn btn-primary')) }}

{{ Form::close() }}



@stop
