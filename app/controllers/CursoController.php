<?php

class CursoController extends BaseController 
{
      
     
	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$cursos = Curso::all();
		return View::make('Curso/lista')->with('cursos', $cursos);
   	}
   	
   	
   	
   	public function lista()
   	{
		$cursos = Curso::all();
		return View::make('Curso/lista')->with('cursos', $cursos);
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		$curso = new Curso;
		$tematicas = Tematica::lists('nombre','id_tematica');
		return View::make('Curso/form')->with('curso', $curso)->with('tematicas', $tematicas);
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		// Creamos un nuevo objeto para nuestro nuevo materia
		$curso = new Curso;
		// Obtenemos la data enviada por el materia
		$data = Input::all();
				
		// Revisamos si la data es válido
		if ($curso->isValid($data))
		{

				$file = Input::file('imagen_presentacion');
				$file->move('imagenes', $file->getClientOriginalName());
				
				$data['imagen_presentacion'] = 	$file->getClientOriginalName();			

			// Si la data es valida se la asignamos al materia
			$curso->fill($data);
			// Guardamos el materia
			$curso->save();
			// Y Devolvemos una redirección a la acción show para mostrar el materia
			return Redirect::route('crear-curso-2', array($curso->id_curso));
		}
		else
		{
			// En caso de error regresa a la acción create con los datos y los errores encontrados
			return Redirect::route('curso.create')->withInput()->withErrors($curso->errors);
		}
				
	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$curso = Curso::find($id);
		$usuario = Usuario::find(Session::get('user_id'));
		$count = RelacionUsuarioCurso::where('tipo_relacion', '=', 'Estudiante')->where('id_usuario', '=', $usuario->id)->where('id_curso', '=', $id)->count();
		return View::make('Curso/view')->with('curso', $curso)->with('inscrito', $count);
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$curso = Curso::find($id);
		if (is_null ($curso))
		{
		App::abort(404);
		}
		
		$form_data = array('route' => array('curso.update', $curso->id_curso), 'method' => 'PATCH');
        $action    = 'Editar';
        
   		$tematicas = Tematica::lists('nombre','id_tematica');
        return View::make('Curso/form', compact('curso', 'form_data', 'action'))->with('tematicas', $tematicas);
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		   $curso = Curso::find($id);
			$data = Input::all();

		 // Revisamos si la data es válida y guardamos en ese caso
        if ($curso->validAndSave($data))
        {
            // Y Devolvemos una redirección a la acción show para mostrar el materia
            return Redirect::route('curso.show', array($curso->id_curso));
        }
        else
        {
            // En caso de error regresa a la acción create con los datos y los errores encontrados
            return Redirect::route('curso.edit', $curso->id_curso)->withInput()->withErrors($curso->errors);
        }
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}


}

