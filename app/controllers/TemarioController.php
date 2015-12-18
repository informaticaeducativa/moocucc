<?php

class TemarioController extends BaseController 
{
      
     
	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$temarios = Temario::all();
		return View::make('Temario/lista')->with('temarios', $temarios);
   	}
   	
   	
   	
   	public function lista()
   	{
		$temarios = Temario::all();
		return View::make('Temario/lista')->with('temarios', $temarios);
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		$temario = new Temario;
		return View::make('Temario/form')->with('temario', $temario);
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		// Creamos un nuevo objeto para nuestro nuevo materia
		$temario = new Temario;
		// Obtenemos la data enviada por el materia
		$data = Input::all();
				
		// Revisamos si la data es válido
		if ($temario->isValid($data))
		{
			// Si la data es valida se la asignamos al materia
			$temario->fill($data);
			// Guardamos el materia
			$temario->save();
			// Y Devolvemos una redirección a la acción show para mostrar el materia
			return Redirect::route('temario.show', array($temario->id));
		}
		else
		{
			// En caso de error regresa a la acción create con los datos y los errores encontrados
			return Redirect::route('temario.create')->withInput()->withErrors($temario->errors);
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
		$temario = Temario::find($id);
		return View::make('Temario/view')->with('temario', $temario);
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$temario = Temario::find($id);
		if (is_null ($temario))
		{
		App::abort(404);
		}
		
		$form_data = array('route' => array('temario.update', $temario->id_temario), 'method' => 'PATCH');
        $action    = 'Editar';
        
        return View::make('Temario/form', compact('temario', 'form_data', 'action'));
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		   $temario = Temario::find($id);
			$data = Input::all();

		 // Revisamos si la data es válida y guardamos en ese caso
        if ($temario->validAndSave($data))
        {
            // Y Devolvemos una redirección a la acción show para mostrar el materia
            return Redirect::route('temario.show', array($temario->id_temario));
        }
        else
        {
            // En caso de error regresa a la acción create con los datos y los errores encontrados
            return Redirect::route('temario.edit', $temario->id_temario)->withInput()->withErrors($temario->errors);
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

