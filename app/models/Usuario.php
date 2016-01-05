<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class Usuario extends Eloquent implements UserInterface, RemindableInterface 
{
 
 	use UserTrait, RemindableTrait;

	public $errors;
    protected $primaryKey = 'id';

 
 	protected $table = 'usuario';
 	 	
 	protected $fillable = array('id', 'nombre', 'apellido', 'id_social', 'red_social', 'tipo_usuario', 'fecha', 'tipo_inteligencia', 'foto', 'titulo');

	//protected $hidden = array('password', 'remember_token');
    public $timestamps = false;

	public function isValid($data)
    {
		$rules = array(
            'id'     => 'required|numeric',
            'nombre' => 'required',
            'apellido' => 'required',
            'id_social' => 'required',
            'red_social' => 'required',
            'tipo_usuario' => 'required',
            'fecha' => 'required',
            'tipo_inteligencia' => 'required',
            'foto' => 'required',
            'titulo' => 'required'
        );
        
        $validator = Validator::make($data, $rules);
        
        if ($validator->passes())
        {
            return true;
        }
        
        $this->errors = $validator->errors();
        
        return false;

    }
    
    public function validAndSave($data)
    {
        // Revisamos si la data es válida
        if ($this->isValid($data))
        {
            // Si la data es valida se la asignamos al usuario
            $this->fill($data);
            // Guardamos el usuario
            $this->save();
            
            return true;
        }
        
        return false;
    }
    
    public function existeRelacionProfesorAdmin($id_curso)
    {
		$count = RelacionUsuarioCurso::where('id_curso','=', $id_curso)->where('tipo_relacion','=','Profesor Admin')->count();
		if ($count > 0)
			return true;
		return false;
	}

    public function existeRelacionProfesorBasico($id_curso)
    {
		$count = RelacionUsuarioCurso::where('id_curso','=', $id_curso)->where('tipo_relacion','=','Profesor Basico')->count();
		if ($count > 0)
			return true;
		return false;
	}
	
	public function getCiudad()
	{
		$ciudad = Ciudad::find($this->id_ciudad);
		return $ciudad;
	}    
    
}

