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
	$cursos = Curso::all();
	return View::make('index')->with('cursos', $cursos); 
});


Route::get('index', function()
{
	$cursos = Curso::all();
	return View::make('index')->with('cursos', $cursos); 
});

Route::get('curso/$id', function()
{
	$curso = Curso::find($id);
	return View::make('curso')->with('curso', $curso); 
});

Route::resource('curso', 'CursoController');
Route::resource('usuario', 'UsuarioController');
Route::resource('evaluacion', 'EvaluacionController');
Route::resource('leccion', 'LeccionController');
Route::resource('pregunta', 'PreguntaController');
Route::resource('pregunta_leccion', 'PreguntaLeccionController');
Route::resource('temario', 'PreguntaLeccionController');
