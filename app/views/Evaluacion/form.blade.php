@extends ('template')

<?php

    if ($evaluacion->exists):
        $form_data = array('route' => array('evaluacion.update', $evaluacion->id_evaluacion), 'method' => 'PATCH');
        $action    = 'Editar';
    else:
        $form_data = array('route' => 'evaluacion.store', 'method' => 'POST');
        $action    = 'Crear';
    endif;

?>

@section ('title') {{ $action }} Evaluacion @stop

@section ('title_div') {{ $action }} Evaluacion @stop

@section ('contenido')
  <p>
    <a href="{{ route('evaluacion.index') }}" class="btn btn-info">Lista de Evaluaciones</a>
  </p>

<br>

{{ Form::model($evaluacion, $form_data, array('role' => 'form')) }}

  @include ('errors', array('errors' => $errors))

  <div class="row">
    <div class="form-group col-md-5">
      {{ Form::label('nombre', 'Nombre de la evaluación') }}
      {{ Form::text('nombre', null, array('placeholder' => 'Introduce el nombre del evaluacion', 'class' => 'form-control')) }}
    </div>
    <div class="form-group col-md-5">
      {{ Form::label('fecha_inicio', 'Fecha de inicio') }}
      {{ Form::input('date', 'fecha_inicio', null, array('placeholder' => 'Introduce la fecha de inicio del evaluacion', 'class' => 'form-control')) }}
    </div>
    <div class="form-group col-md-5">
      {{ Form::label('imagen_presentacion', 'Imagen de la evaluación') }}
      {{ Form::file('imagen_presentacion', null, array('placeholder' => 'Introduce la imagen del evaluacion', 'class' => 'form-control')) }}
    </div>
     <div class="form-group col-md-5">
      {{ Form::label('comienzo', 'Comienzo de la evaluación') }}
      {{ Form::text('comienzo', null, array('placeholder' => 'Introduce cuando comienza el evaluacion', 'class' => 'form-control')) }}
    </div>
    <div class="form-group col-md-5">
      {{ Form::label('id_tematica', 'Temática de la evaluación') }}
      {{ Form::select('id_tematica', $tematicas, null, array('placeholder' => 'Introduce cuando comienza el evaluacion', 'class' => 'form-control')) }}
    </div>
    <div class="form-group col-md-5">
      {{ Form::label('nivel', 'Nivel de la evaluación') }}
      {{ Form::select('nivel',  array('Principiante' => 'Principiante', 'Medio' => 'Medio', 'Avanzado'=>'Avanzado'), null, array('class' => 'form-control')) }}
    </div>
  </div>

  {{ Form::button($action . ' evaluacion', array('type' => 'submit', 'class' => 'btn btn-primary')) }}

{{ Form::close() }}



@stop
