@extends ('template')

<?php

    if ($pregunta_leccion->exists):
        $form_data = array('route' => array('pregunta_leccion.update', $pregunta_leccion->id_pregunta_leccion), 'method' => 'PATCH');
        $action    = 'Editar';
    else:
        $form_data = array('route' => 'pregunta_leccion.store', 'method' => 'POST');
        $action    = 'Crear';
    endif;

?>

@section ('title') {{ $action }} Pregunta de leccion @stop

@section ('title_div') {{ $action }} Pregunta de leccion @stop

@section ('contenido')
  <p>
    <a href="{{ route('pregunta_leccion.index') }}" class="btn btn-info">Lista de Preguntas de la lección</a>
  </p>

<br>

{{ Form::model($pregunta_leccion, $form_data, array('role' => 'form')) }}

  @include ('errors', array('errors' => $errors))

  <div class="row">
    <div class="form-group col-md-5">
      {{ Form::label('nombre', 'Nombre del pregunta_leccion') }}
      {{ Form::text('nombre', null, array('placeholder' => 'Introduce el nombre del pregunta_leccion', 'class' => 'form-control')) }}
    </div>
    <div class="form-group col-md-5">
      {{ Form::label('fecha_inicio', 'Fecha de inicio') }}
      {{ Form::input('date', 'fecha_inicio', null, array('placeholder' => 'Introduce la fecha de inicio del pregunta_leccion', 'class' => 'form-control')) }}
    </div>
    <div class="form-group col-md-5">
      {{ Form::label('imagen_presentacion', 'Imagen del pregunta_leccion') }}
      {{ Form::file('imagen_presentacion', null, array('placeholder' => 'Introduce la imagen del pregunta_leccion', 'class' => 'form-control')) }}
    </div>
     <div class="form-group col-md-5">
      {{ Form::label('comienzo', 'Comienzo del pregunta_leccion') }}
      {{ Form::text('comienzo', null, array('placeholder' => 'Introduce cuando comienza el pregunta_leccion', 'class' => 'form-control')) }}
    </div>

    <div class="form-group col-md-5">
      {{ Form::label('nivel', 'Nivel del pregunta_leccion') }}
      {{ Form::select('nivel',  array('Principiante' => 'Principiante', 'Medio' => 'Medio', 'Avanzado'=>'Avanzado'), null, array('class' => 'form-control')) }}
    </div>
  </div>

  {{ Form::button($action . ' pregunta_leccion', array('type' => 'submit', 'class' => 'btn btn-primary')) }}

{{ Form::close() }}



@stop
