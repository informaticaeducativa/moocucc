<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

//
//RUTAS DEL INDEX
//
Route::get('/', function()
{
	Session::put('user_id', '1');
	Session::put('user', 'Mark Gonzales');
	Session::put('inteligencia', 'Kinestesico');
	$cursos = Curso::all();
	return View::make('index')->with('cursos', $cursos); 
});


Route::get('index',  array('as' => 'index',function()
{
	$cursos = Curso::all();
	return View::make('index')->with('cursos', $cursos); 
}));

Route::get('logout',  array('as' => 'logout',function()
{
	Session::flush();
	return Redirect::to('index');
}));




Route::get('ver-usuario/{id}', array('as' => 'ver-usuario', function($id)
{
	if(Session::get('user_id') == "")
		return Redirect::to('index');

	$curso = Curso::find($id);
    return View::make('ProfesorBase/evaluacion')->with('curso', $curso)->with('evaluacion', $evaluacion);
    
}))->where('id', '[0-9]+');

//Ver usuario (todos)
Route::get('usuario/{id}', array('as'=>'usuario','uses'=> 'UsuarioController@show' ))->where('id', '[0-9]+');



//
//RUTAS DE ELEMENTOS LLAMADOS POR AJAX
//
Route::get('obtener-inteligencia',  function()
{
    return Session::get('inteligencia');
});

Route::get('validar-quiz',  function()
{
	$data = Input::all();
	
	$leccion = $data['leccion'];
	$preguntas = $data['preguntas'];
	$respuestas = $data['respuestas'];
	$evaluacion = Evaluacion::find($leccion);
	$postData = $evaluacion->getPreguntasQuiz();
	$respuestas_buenas=0;
	$contador=0;
	
	foreach ($postData as $pregunta)
	{
		if($pregunta["respuesta"] === $respuestas[$contador])
		{
			$respuestas_buenas++;
		}
		$contador++;
	}
	return $respuestas_buenas;
	
});

Route::get('validar-inteligencia',  function()
{
	$data = Input::all();
	
	$preguntas = $data['preguntas'];
	$respuestas = $data['respuestas'];
	$evaluacion = Evaluacion::find(2);
	$postData = $evaluacion->getPreguntasQuiz();
	$contador=0;
	$kinestesico=0;
	$linguistico=0;
	$visual=0;
	
	foreach ($postData as $pregunta)
	{
		if($pregunta["respuesta"] === "Kinestesico")
		{
			$kinestesico += $respuestas[$contador];
		}
		if($pregunta["respuesta"] === "Visual")
		{
			$visual += $respuestas[$contador];
		}
		if($pregunta["respuesta"] === "Linguistico")
		{
			$linguistico += $respuestas[$contador];
		}
		$contador++;
	}
	$respuesta = "Kinestesico: ".$kinestesico." Visual: ".$visual." Linguistico: ".$linguistico;

	$usuario = (Session::get('user_id'));
	
	if($kinestesico >= $visual && $kinestesico>= $linguistico){
		Usuario::where('id', '=', $usuario)->update(array('tipo_inteligencia' => 'Kinestesico'));
		Session::put('inteligencia', 'Kinestesico');	
		return "Ganador Kinestesico: ".$kinestesico." -- Visual: ".$visual." Linguistico: ".$linguistico;
	}else if($visual >= $kinestesico && $visual>= $linguistico){
		Usuario::where('id', '=', $usuario)->update(array('tipo_inteligencia' => 'Visual'));
		Session::put('inteligencia', 'Visual');	
		return "Ganador Visual: ".$visual." -- Kinestesico: ".$kinestesico." Linguistico: ".$linguistico;
	}else{
		Usuario::where('id', '=', $usuario)->update(array('tipo_inteligencia' => 'Linguistico'));
		Session::put('inteligencia', 'Linguistico');	
		return "Ganador Linguistico: ".$linguistico." -- Kinestesico: ".$kinestesico." Visual: ".$visual;
	}
});

Route::get('postear-en-microforo',  function()
{
	$data = Input::all();
	
	$leccion = $data['leccion'];
	$mensaje = $data['mensaje'];
	$usuario = Session::get('user_id');
	
	$pregunta_leccion = PreguntaLeccion::create(array('id_usuario'=>$usuario, 'id_leccion'=>$leccion, 'pregunta'=>$mensaje, 'fecha_creacion'=> date('Y-m-d H:i:s')));
	
	return Session::get('user');
	
});

//
//RUTAS PARA EL ACCESO A LOGIN
//
Route::get('login-facebook',array('as'=>'login-facebook','uses'=>'LoginController@loginWithFacebook'));
Route::get('login-twitter',array('as'=>'login-twitter','uses'=>'LoginController@loginWithTwitter'));
Route::get('login-google',array('as'=>'login-google','uses'=>'LoginController@loginWithGoogle'));


//
//RUTAS QUE TOMA EL USUARIO ESTUDIANTE
//
Route::get('desuscribirse/{id}', array('as' => 'desuscribirse', function($id)
{
	$usuario = Session::get('user_id');
	RelacionUsuarioCurso::where('tipo_relacion', '=', 'Estudiante')->where('id_usuario', '=', $usuario)->where('id_curso', '=', $id)->delete();
	return Redirect::to('index');
}))->where('id', '[0-9]+');

Route::get('ver-curso/{id}', array('as' => 'ver-curso', function($id)
{
	if(Session::get('user_id') == "")
		return Redirect::to('index');

	$curso = Curso::find($id);
    return View::make('Estudiante/ver-curso')->with('curso', $curso); 
}))->where('id', '[0-9]+');

Route::get('prueba-inteligencias', array('as' => 'prueba-inteligencias', function()
{
	$evaluacion = Evaluacion::find(2);
    return View::make('Estudiante/pruebainteligencia')->with('evaluacion', $evaluacion);    
}));

Route::get('ver-curso-info/{id}', array('as' => 'ver-curso-info', function($id)
{
	if(Session::get('user_id') == "")
		return Redirect::to('index');

	$usuario = Usuario::find(Session::get('user_id'));
	if($usuario->tipo_inteligencia == "")
		return Redirect::to('prueba-inteligencias');
	
	$count = RelacionUsuarioCurso::where('tipo_relacion', '=', 'Estudiante')->where('id_usuario', '=', Session::get('user_id'))->where('id_curso', '=', $id)->count();
	if ($count == 0){
		//$respuestas = RelacionUsuarioCurso::create(array('id_usuario' => Session::get('user_id'), 'id_curso' => $id, 'tipo_relacion' => 'Estudiante', 'fecha_creacion' => date('Y-m-d H:i:s')));
	  DB::table('relacion_usuario_curso')->insert(	array('id_usuario' => Session::get('user_id'), 'id_curso' => $id, 'tipo_relacion' => 'Estudiante', 'fecha_creacion' => date('Y-m-d H:i:s'))	);
	}
	$curso = Curso::find($id);
    return View::make('Estudiante/info')->with('curso', $curso); 
}))->where('id', '[0-9]+');

Route::get('ver-curso-contenido/{id}', array('as' => 'ver-curso-contenido', function($id)
{
	if(Session::get('user_id') == "")
		return Redirect::to('index');

	$curso = Curso::find($id);
    return View::make('Estudiante/contenido')->with('curso', $curso); 
}))->where('id', '[0-9]+');

Route::get('ver-curso-tareas/{id}', array('as' => 'ver-curso-tareas', function($id)
{
	if(Session::get('user_id') == "")
		return Redirect::to('index');

	$curso = Curso::find($id);
    return View::make('Estudiante/tareas')->with('curso', $curso);
}))->where('id', '[0-9]+');

Route::get('ver-curso/{id}/clase/{id2}', array('as' => 'ver-clase', function($id, $id2)
{
	if(Session::get('user_id') == "")
		return Redirect::to('index');

	$curso = Curso::find($id);
	$leccion = Leccion::find($id2);
    return View::make('Estudiante/clase')->with('curso', $curso)->with('leccion', $leccion);
}))->where('id', '[0-9]+')->where('id2', '[0-9]+');

Route::get('ver-curso/{id}/tarea/{id2}', array('as' => 'ver-tarea', function($id, $id2)
{
	if(Session::get('user_id') == "")
		return Redirect::to('index');

	$curso = Curso::find($id);
	$evaluacion = Evaluacion::find($id2);
    return View::make('Estudiante/evaluacion')->with('curso', $curso)->with('evaluacion', $evaluacion);
}))->where('id', '[0-9]+')->where('id2', '[0-9]+');


//
//RUTAS DEL PROFESOR BASE
//
Route::get('profesor-base/cursos', array('as' => 'profesor-base-cursos', function()
{
	if(Session::get('user_id') == "")
		return Redirect::to('index');
	
	$cursos = RelacionUsuarioCurso::where('id_usuario','=', Session::get('user_id'))->where('tipo_relacion','=', 'Profesor Basico')->get();
    return View::make('ProfesorBase/cursos')->with('relaciones', $cursos); 
}))->where('id', '[0-9]+');

Route::get('profesor-base/ver-curso-info/{id}', array('as' => 'profesor-base-ver-curso-info', function($id)
{
	if(Session::get('user_id') == "")
		return Redirect::to('index');

	$usuario = Usuario::find(Session::get('user_id'));
	
	$curso = Curso::find($id);
    return View::make('ProfesorBase/info')->with('curso', $curso); 
}))->where('id', '[0-9]+');

Route::get('profesor-base/ver-curso/{id}', array('as' => 'profesor-base-ver-curso', function($id)
{
	if(Session::get('user_id') == "")
		return Redirect::to('index');

	$curso = Curso::find($id);
    return View::make('ProfesorBase/ver-curso')->with('curso', $curso); 
}))->where('id', '[0-9]+');

Route::get('profesor-base/prueba-inteligencias', array('as' => 'profesor-base-prueba-inteligencias', function()
{
	$evaluacion = Evaluacion::find(2);
    return View::make('ProfesorBase/pruebainteligencia')->with('evaluacion', $evaluacion);    
}));


Route::get('profesor-base/ver-curso-contenido/{id}', array('as' => 'profesor-base-ver-curso-contenido', function($id)
{
	if(Session::get('user_id') == "")
		return Redirect::to('index');

	$curso = Curso::find($id);
    return View::make('ProfesorBase/contenido')->with('curso', $curso); 
}))->where('id', '[0-9]+');

Route::get('profesor-base/ver-curso-tareas/{id}', array('as' => 'profesor-base-ver-curso-tareas', function($id)
{
	if(Session::get('user_id') == "")
		return Redirect::to('index');

	$curso = Curso::find($id);
    return View::make('ProfesorBase/tareas')->with('curso', $curso);
}))->where('id', '[0-9]+');

Route::get('profesor-base/ver-curso/{id}/clase/{id2}', array('as' => 'profesor-base-ver-clase', function($id, $id2)
{
	if(Session::get('user_id') == "")
		return Redirect::to('index');

	$curso = Curso::find($id);
	$leccion = Leccion::find($id2);
    return View::make('ProfesorBase/clase')->with('curso', $curso)->with('leccion', $leccion);
}))->where('id', '[0-9]+')->where('id2', '[0-9]+');

Route::get('profesor-base/ver-curso/{id}/tarea/{id2}', array('as' => 'profesor-base-ver-tarea', function($id, $id2)
{
	if(Session::get('user_id') == "")
		return Redirect::to('index');

	$curso = Curso::find($id);
	$evaluacion = Evaluacion::find($id2);
    return View::make('ProfesorBase/evaluacion')->with('curso', $curso)->with('evaluacion', $evaluacion);
}))->where('id', '[0-9]+')->where('id2', '[0-9]+');


//
//RUTAS DEL ADMINISTRADOR
//
Route::get('administrador', array('as' => 'administrador', function()
{
	if(Session::get('user_id') == "")
		return Redirect::to('index');

	//$curso = Curso::find($id);
	//$evaluacion = Evaluacion::find($id2);
    return View::make('Administrador/index');
}));

Route::get('administrador/crear-curso',array('as'=>'crear-curso','uses'=>'CursoController@create'));
Route::get('administrador/crear-curso/{id}',array('as'=>'crear-curso-2', 'uses'=>'TemarioController@create'));
Route::get('administrador/crear-inicio/{id}',array('as'=>'crear-curso-4b', 'uses'=>'TemarioController@create1b'));
Route::get('administrador/crear-contenido/{id}',array('as'=>'crear-curso-5', 'uses'=>'TemarioController@create2'));
Route::get('administrador/crear-leccion/{id}',array('as'=>'crear-curso-6', 'uses'=>'LeccionController@create'));
Route::get('administrador/crear-evaluacion/{id}',array('as'=>'crear-curso-7', 'uses'=>'EvaluacionController@create'));

Route::get('administrador/asignar-profesor/{id}',array('as'=>'crear-curso-3', function($id) {
	$profesores = Usuario::all();
	$curso = Curso::find($id);
	return View::make('Administrador/asignar-profe')->with('profesores', $profesores)->with('curso', $curso);
}))->where('id', '[0-9]+');

Route::get('administrador/asignar-profesor/{id}-{nombre}',array('as'=>'crear-curso-4', function($id, $nombre) {
	$profesores = Usuario::all();
	$profesores2 = Usuario::where('nombre', 'ILIKE', '%'.$nombre.'%')->get();
	$curso = Curso::find($id);
	return View::make('Administrador/asignar-profe2')->with('profesores', $profesores)->with('profesores2', $profesores2)->with('curso', $curso);
}))->where('id', '[0-9]+');



//Ruta para redireccionar los profesores buscados en las 2 anteriores rutas
Route::get('redirect-asignar-profesores',array('as'=>'redirect-asignar-profesores', function() {
	$datos = Input::all();
	$id = $datos['id'];
	$nombre = $datos['nombre'];
	$profesores = Usuario::all();
	$profesores2 = Usuario::where('nombre', 'ILIKE', '%'.$nombre.'%')->get();
	$curso = Curso::find($id);
	return Redirect::Route('crear-curso-4', array($id, $nombre));
}));

//Ruta para redireccionar los contenidos creados en el administrador
Route::get('redirect-temario-curso',array('as'=>'redirect-temario-curso', function() {
	$datos = Input::all();
	$id = $datos['id_curso'];
	$tipo_contenido = $datos['tipo_contenido'];
	$curso = Curso::find($id);
	return Redirect::Route('crear-curso-5', array($id));
}));

//Ruta para asignar profesor a un curso
Route::get('asignar-profesor/{id_curso}/{id_usuario}/{tipo}', array('as'=>'asignar-profesor', function($id_curso, $id_usuario, $tipo) {
	DB::table('relacion_usuario_curso')->insert(	array('id_usuario' => $id_usuario, 'id_curso' => $id_curso, 'tipo_relacion' => $tipo, 'fecha_creacion' => date('Y-m-d H:i:s'))	);
	return Redirect::route('crear-curso-3', $id_curso);
}))->where('id_curso', '[0-9]+');

//Ruta para eliminar una asignacion de profesor a un curso
Route::get('desasignar-profesor/{id_curso}/{id_usuario}/{tipo}', array('as'=>'desasignar-profesor', function($id_curso, $id_usuario, $tipo) {
	RelacionUsuarioCurso::where('tipo_relacion', '=', $tipo)->where('id_usuario', '=', $id_usuario)->where('id_curso', '=', $id_curso)->delete();
	return Redirect::route('crear-curso-3', $id_curso);
}))->where('id_curso', '[0-9]+');

//Ruta para Ver como queda un curso desde el perfil administrador
Route::get('administrador/ver-curso/{id}',array('as'=>'admin-ver-curso', function($id) {
	$curso = Curso::find($id);
    return View::make('Administrador/ver-curso')->with('curso', $curso); 
}))->where('id', '[0-9]+');



Route::resource('curso', 'CursoController');
Route::resource('usuario', 'UsuarioController');
Route::resource('evaluacion', 'EvaluacionController');
Route::resource('leccion', 'LeccionController');
Route::resource('pregunta', 'PreguntaController');
Route::resource('pregunta_leccion', 'PreguntaLeccionController');
Route::resource('temario', 'TemarioController');
