@extends ('template')

<?php

    if ($leccion->exists):
        $form_data = array('route' => array('leccion.update', $leccion->id_leccion), 'method' => 'PATCH');
        $action    = 'Editar';
    else:
        $form_data = array('route' => 'leccion.store', 'method' => 'POST');
        $action    = 'Crear';
    endif;

?>

@section ('title') {{ $action }} Leccion @stop

@section ('title_div') {{ $action }} Leccion @stop

@section ('contenido')
  <p>
    <a href="{{ route('leccion.index') }}" class="btn btn-info">Lista de Lecciones</a>
  </p>

<br>

{{ Form::model($leccion, $form_data, array('role' => 'form')) }}

  @include ('errors', array('errors' => $errors))

  <div class="row">
    <div class="form-group col-md-5">
      {{ Form::label('nombre', 'Nombre de la lección') }}
      {{ Form::text('nombre', null, array('placeholder' => 'Introduce el nombre del leccion', 'class' => 'form-control')) }}
    </div>
    <div class="form-group col-md-5">
      {{ Form::label('fecha_inicio', 'Fecha de inicio') }}
      {{ Form::input('date', 'fecha_inicio', null, array('placeholder' => 'Introduce la fecha de inicio del leccion', 'class' => 'form-control')) }}
    </div>
    <div class="form-group col-md-5">
      {{ Form::label('imagen_presentacion', 'Imagen de la lección') }}
      {{ Form::file('imagen_presentacion', null, array('placeholder' => 'Introduce la imagen del leccion', 'class' => 'form-control')) }}
    </div>
     <div class="form-group col-md-5">
      {{ Form::label('comienzo', 'Comienzo de la lección') }}
      {{ Form::text('comienzo', null, array('placeholder' => 'Introduce cuando comienza el leccion', 'class' => 'form-control')) }}
    </div>
    <div class="form-group col-md-5">
      {{ Form::label('id_tematica', 'Temática de la lección') }}
      {{ Form::select('id_tematica', $tematicas, null, array('placeholder' => 'Introduce cuando comienza el leccion', 'class' => 'form-control')) }}
    </div>
    <div class="form-group col-md-5">
      {{ Form::label('nivel', 'Nivel de la lección') }}
      {{ Form::select('nivel',  array('Principiante' => 'Principiante', 'Medio' => 'Medio', 'Avanzado'=>'Avanzado'), null, array('class' => 'form-control')) }}
    </div>
  </div>

  {{ Form::button($action . ' leccion', array('type' => 'submit', 'class' => 'btn btn-primary')) }}

{{ Form::close() }}



@stop
