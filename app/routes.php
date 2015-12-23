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

Route::get('/', function()
{
	Session::put('user_id', '1');
	Session::put('user', 'Mark Gallego');
	Session::put('inteligencia', 'Visual');
	$cursos = Curso::all();
	return View::make('index')->with('cursos', $cursos); 
});


Route::get('index', function()
{
	$cursos = Curso::all();
	return View::make('index')->with('cursos', $cursos); 
});


Route::get('google/authorize', function()
{
    return OAuth::authorize('google');
});
Route::get('google/login', function() {
    try {
        OAuth::login('google');
    } catch (ApplicationRejectedException $e) {
        // User rejected application
    } catch (InvalidAuthorizationCodeException $e) {
        // Authorization was attempted with invalid
        // code,likely forgery attempt
    }
    // Current user is now available via Auth facade
    $user = Auth::user();
    dd($user);
    return Redirect::intended();
});

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

Route::get('postear-en-microforo',  function()
{
	$data = Input::all();
	
	$leccion = $data['leccion'];
	$mensaje = $data['mensaje'];
	$usuario = Session::get('user_id');
	
	$pregunta_leccion = PreguntaLeccion::create(array('id_usuario'=>$usuario, 'id_leccion'=>$leccion, 'pregunta'=>$mensaje, 'fecha_creacion'=> date('Y-m-d H:i:s')));
	
	return Session::get('user');
	
});

Route::get('login-facebook',array('as'=>'login-facebook','uses'=>'LoginController@loginWithFacebook'));
Route::get('login-twitter',array('as'=>'login-twitter','uses'=>'LoginController@loginWithTwitter'));
Route::get('login-google',array('as'=>'login-google','uses'=>'LoginController@loginWithGoogle'));

Route::get('ver-curso/{id}', array('as' => 'ver-curso', function($id)
{
	if(Session::get('user_id') == "")
		return Redirect::to('index');

	$curso = Curso::find($id);
    return View::make('Estudiante/ver-curso')->with('curso', $curso); 
}))->where('id', '[0-9]+');

Route::get('ver-curso-info/{id}', array('as' => 'ver-curso-info', function($id)
{
	if(Session::get('user_id') == "")
		return Redirect::to('index');

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




Route::resource('curso', 'CursoController');
Route::resource('usuario', 'UsuarioController');
Route::resource('evaluacion', 'EvaluacionController');
Route::resource('leccion', 'LeccionController');
Route::resource('pregunta', 'PreguntaController');
Route::resource('pregunta_leccion', 'PreguntaLeccionController');
Route::resource('temario', 'PreguntaLeccionController');
