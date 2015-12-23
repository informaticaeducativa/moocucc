<?php

class UsuarioController extends BaseController 
{
      
     
	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$usuarios = Usuario::all();
		return View::make('Usuario/lista')->with('usuarios', $usuarios);
   	}
   	
   	
   	
   	public function lista()
   	{
		$usuarios = Usuario::all();
		return View::make('Usuario/lista')->with('usuarios', $usuarios);
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		$usuario = new Usuario;
		return View::make('Usuario/form')->with('usuario', $usuario);
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		// Creamos un nuevo objeto para nuestro nuevo materia
		$usuario = new Usuario;
		// Obtenemos la data enviada por el materia
		$data = Input::all();
				
		// Revisamos si la data es válido
		if ($usuario->isValid($data))
		{
			// Si la data es valida se la asignamos al materia
			$usuario->fill($data);
			// Guardamos el materia
			$usuario->save();
			// Y Devolvemos una redirección a la acción show para mostrar el materia
			return Redirect::route('usuario.show', array($usuario->id));
		}
		else
		{
			// En caso de error regresa a la acción create con los datos y los errores encontrados
			return Redirect::route('usuario.create')->withInput()->withErrors($usuario->errors);
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
		$usuario = Usuario::find($id);
		return View::make('Usuario/view')->with('usuario', $usuario);
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$usuario = Usuario::find($id);
		if (is_null ($usuario))
		{
		App::abort(404);
		}
		
		$form_data = array('route' => array('usuario.update', $usuario->id), 'method' => 'PATCH');
        $action    = 'Editar';
        
        return View::make('Usuario/form', compact('usuario', 'form_data', 'action'));
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		   $usuario = Usuario::find($id);
			$data = Input::all();

		 // Revisamos si la data es válida y guardamos en ese caso
        if ($usuario->validAndSave($data))
        {
            // Y Devolvemos una redirección a la acción show para mostrar el materia
            return Redirect::route('usuario.show', array($usuario->id));
        }
        else
        {
            // En caso de error regresa a la acción create con los datos y los errores encontrados
            return Redirect::route('usuario.edit', $usuario->id)->withInput()->withErrors($usuario->errors);
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


