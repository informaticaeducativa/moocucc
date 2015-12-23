@extends ('template')

<?php

    if ($temario->exists):
        $form_data = array('route' => array('temario.update', $temario->id_temario), 'method' => 'PATCH');
        $action    = 'Editar';
    else:
        $form_data = array('route' => 'temario.store', 'method' => 'POST');
        $action    = 'Crear';        
    endif;

?>

@section ('title') {{ $action }} Temario @stop

@section ('title_div') {{ $action }} Temario @stop

@section ('contenido') 
  <p>
    <a href="{{ route('temario.index') }}" class="btn btn-info">Lista de Temarios</a>
  </p>

<br>

{{ Form::model($temario, $form_data, array('role' => 'form')) }}

  @include ('errors', array('errors' => $errors))

  <div class="row">
    <div class="form-group col-md-5">
      {{ Form::label('nombre', 'Nombre del temario') }}
      {{ Form::text('nombre', null, array('placeholder' => 'Introduce el nombre del temario', 'class' => 'form-control')) }}
    </div>
    <div class="form-group col-md-5">
      {{ Form::label('fecha_inicio', 'Fecha de inicio') }}
      {{ Form::input('date', 'fecha_inicio', null, array('placeholder' => 'Introduce la fecha de inicio del temario', 'class' => 'form-control')) }}        
    </div>
    <div class="form-group col-md-5">
      {{ Form::label('imagen_presentacion', 'Imagen del temario') }}
      {{ Form::file('imagen_presentacion', null, array('placeholder' => 'Introduce la imagen del temario', 'class' => 'form-control')) }}        
    </div>
     <div class="form-group col-md-5">
      {{ Form::label('comienzo', 'Comienzo del temario') }}
      {{ Form::text('comienzo', null, array('placeholder' => 'Introduce cuando comienza el temario', 'class' => 'form-control')) }}        
    </div>
    <div class="form-group col-md-5">
      {{ Form::label('nivel', 'Nivel del temario') }}
      {{ Form::select('nivel',  array('Principiante' => 'Principiante', 'Medio' => 'Medio', 'Avanzado'=>'Avanzado'), null, array('class' => 'form-control')) }}        
    </div>
  </div>
  
  {{ Form::button($action . ' temario', array('type' => 'submit', 'class' => 'btn btn-primary')) }}    
  
{{ Form::close() }}



@stop  
