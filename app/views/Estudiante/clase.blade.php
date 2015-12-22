@extends ('template2')

@section ('title') Ver Curso @stop

@section ('contenido') 

<div class="col-sm-3 col-xs-12  bg_blue_80">
	<div class=" espaciado">
		{{ HTML::image('imagenes/'.$curso->imagen_presentacion, $alt="", $attributes = array('class' => 'imagen_div')) }}	
		<table class="table-curso-detalles">
			
				<tr>
					<th width="5%"><center><a href="{{ URL::route('ver-curso-info', $curso->id_curso ) }}"><span class="glyphicon glyphicon glyphicon-home" aria-hidden="true"></span></center></a></th>
					<th colspan="3">{{ HTML::linkRoute('ver-curso-info', 'Inicio', array($curso->id_curso), array()) }}</th>
				</tr>
			
			<a href="#">
				<tr>
					<th width="5%"><center><a href="{{ URL::route('ver-curso-contenido', $curso->id_curso) }}"><span class="glyphicon glyphicon glyphicon-list" aria-hidden="true"></span></center></a></th>
					<th colspan="3">{{ HTML::linkRoute('ver-curso-contenido', 'Contenido del Curso', array($curso->id_curso), array()) }}</th>
				</tr>
			<a href="#">
			</a>	
				<tr>
					<th width="5%"><center><a href="{{ URL::route('ver-curso-tareas', $curso->id_curso) }}"><span class="glyphicon glyphicon glyphicon-list-alt" aria-hidden="true"></span></center></a></th>
					<th colspan="3">{{ HTML::linkRoute('ver-curso-tareas', 'Tareas', array($curso->id_curso), array()) }}</th>
				</tr>
			<a href="#">
			</a>	
				<tr>
					<th width="5%"><center><a href="{{ URL::route('ver-curso', $curso->id_curso) }}"><span class="glyphicon glyphicon glyphicon-info-sign" aria-hidden="true"></span></center></a></th>
					<th colspan="3">{{ HTML::linkRoute('ver-curso', 'Información del Curso', array($curso->id_curso), array()) }}</th>
				</tr>
			</a>
		</table>
	</div>
</div>

<div class="col-sm-9 col-xs-12 div_list2 top_menos_20">
	<div class="col-md-12 col-sm-12 col-xs-12">
		
		<table width="100%">
			<tr>
				<th width="33%"><button class="btn btn-block btn-info" id="btn_kinestesico">Kinestesico</button></th>
				<th width="33%"><button class="btn btn-block btn-primary" id="btn_visual">Visual</button></th>
				<th width="33%"><button class="btn btn-block btn-primary" id="btn_auditivo">Auditivo</button></th>
			</tr>
		</table>
		<h6><strong>{{ $curso->nombre }}</strong></h6>
		<h2><center><strong>{{ $leccion->nombre }}</strong></center></h2>
		<br>
			<div id="div_auditivo">
				{{ $leccion->contenido_texto }}
			</div>	
			<br>
			<div id="div_visual">
				<center>
					{{ $leccion->contenido_grafico }}
				</center>
			</div>	
				
			<br>
			<br>
		

</div>

@stop


