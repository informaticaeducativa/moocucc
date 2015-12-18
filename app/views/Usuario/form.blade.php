@extends ('template')

<?php

    if ($usuario->exists):
        $form_data = array('route' => array('usuario.update', $usuario->id_usuario), 'method' => 'PATCH');
        $action    = 'Editar';
    else:
        $form_data = array('route' => 'usuario.store', 'method' => 'POST');
        $action    = 'Crear';        
    endif;

?>

@section ('title') {{ $action }} Usuario @stop

@section ('title_div') {{ $action }} Usuario @stop

@section ('contenido') 
  <p>
    <a href="{{ route('usuario.index') }}" class="btn btn-info">Lista de Usuarios</a>
  </p>

<br>

{{ Form::model($usuario, $form_data, array('role' => 'form')) }}

  @include ('errors', array('errors' => $errors))

  <div class="row">
    <div class="form-group col-md-5">
      {{ Form::label('nombre', 'Nombre del usuario') }}
      {{ Form::text('nombre', null, array('placeholder' => 'Introduce el nombre del usuario', 'class' => 'form-control')) }}
    </div>
    <div class="form-group col-md-5">
      {{ Form::label('apellido', 'Fecha de inicio') }}
      {{ Form::input('apellido', 'fecha_inicio', null, array('placeholder' => 'Introduce la fecha de inicio del usuario', 'class' => 'form-control')) }}        
    </div>
    <div class="form-group col-md-5">
      {{ Form::label('imagen_presentacion', 'Imagen del usuario') }}
      {{ Form::file('imagen_presentacion', null, array('placeholder' => 'Introduce la imagen del usuario', 'class' => 'form-control')) }}        
    </div>
     <div class="form-group col-md-5">
      {{ Form::label('comienzo', 'Comienzo del usuario') }}
      {{ Form::text('comienzo', null, array('placeholder' => 'Introduce cuando comienza el usuario', 'class' => 'form-control')) }}        
    </div>
    <div class="form-group col-md-5">
      {{ Form::label('id_tematica', 'Tematica del usuario') }}
      {{ Form::select('id_tematica', $tematicas, null, array('placeholder' => 'Introduce cuando comienza el usuario', 'class' => 'form-control')) }}        
    </div>
    <div class="form-group col-md-5">
      {{ Form::label('nivel', 'Nivel del usuario') }}
      {{ Form::select('nivel',  array('Principiante' => 'Principiante', 'Medio' => 'Medio', 'Avanzado'=>'Avanzado'), null, array('class' => 'form-control')) }}        
    </div>
  </div>
  
  {{ Form::button($action . ' usuario', array('type' => 'submit', 'class' => 'btn btn-primary')) }}    
  
{{ Form::close() }}



@stop  
