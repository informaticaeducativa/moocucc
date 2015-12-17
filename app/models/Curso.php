<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class Curso extends Eloquent implements UserInterface, RemindableInterface 
{
 
 	use UserTrait, RemindableTrait;

	public $errors;
    protected $primaryKey = 'id_curso';

 
 	protected $table = 'curso';
 	 	
 	protected $fillable = array('id_curso', 'nombre', 'fecha_inicio', 'imagen_presentacion', 'comienzo', 'id_tematica', 'nivel');

	//protected $hidden = array('password', 'remember_token');
    public $timestamps = false;

	public function isValid($data)
    {
		$rules = array(
            'id_usuario'     => 'required|numeric',
            'nombre' => 'required',
            'fecha_inicio' => 'required',
            'imagen_presentacion' => 'required',            
            'comienzo' => 'required',
            'id_tematica' => 'required|numeric',
            'nivel' => 'required'
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
    
	public function getTematica() {
		$tematica = Tematica::find($this->id_tematica);
		return $tematica->nombre;
	}
	
	public function getFechaInicio(){
		if($this->comienzo == "Auto-aprendizaje"){		return $this->comienzo;		}
		else if($this->fecha_inicio > date("Y-m-d")){	return "Proximo a iniciar (".$this->fecha_inicio.")";	}
		else{	return "En curso";	}
	}
    
}

