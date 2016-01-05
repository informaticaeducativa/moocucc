@extends ('template')

<?php

    if ($usuario->exists):
        $form_data = array('route' => array('usuario.update', $usuario->id), 'method' => 'PATCH');
        $action    = 'Editar';
    else:
        $form_data = array('route' => 'usuario.store', 'method' => 'POST');
        $action    = 'Crear';        
    endif;

?>

@section ('title') {{ $action }} Usuario @stop

@section ('title_div') {{ $action }} Usuario  @stop

@section ('contenido') 
<!--

  <p>
    <a href="{{ route('usuario.index') }}" class="btn btn-info">Lista de Usuarios</a>
  </p>
-->

<br>
<center>
	<h1>
		{{ $action }} Usuario
	</h1>
</center>
{{ Form::model($usuario, $form_data, array('role' => 'form')) }}

  @include ('errors', array('errors' => $errors))

  <div class="row">
    <div class="form-group col-md-5">
      {{ Form::label('nombre', 'Nombre del usuario') }}
      {{ Form::text('nombre', null, array('placeholder' => 'Introduce el nombre del usuario', 'class' => 'form-control')) }}
    </div>
    <div class="form-group col-md-5">
      {{ Form::label('apellido', 'Apellido del usuario') }}
      {{ Form::text('apellido', null, array('placeholder' => 'Introduce el apellido del usuario', 'class' => 'form-control')) }}        
    </div>
    <div class="form-group col-md-5">
      {{ Form::label('tipo_inteligencia', 'Tipo de inteligencia') }}
      {{ Form::select('tipo_inteligencia', array('Visual'=>'Visual', 'Kinestesico'=>'Kinestesico', 'Auditivo'=>'Auditivo'), null, array('placeholder' => 'Introduce la fecha de inicio del usuario', 'class' => 'form-control')) }}        
    </div>
    <div class="form-group col-md-5">
      {{ Form::label('titulo', 'Titulo o cargo universitario') }}
      {{ Form::text('titulo', null,  array('placeholder' => 'Introduce el titulo o cargo universitario usuario', 'class' => 'form-control')) }}        
    </div>

  </div>
  
  {{ Form::button($action . ' usuario', array('type' => 'submit', 'class' => 'btn btn-primary')) }}    
  
{{ Form::close() }}



@stop  
