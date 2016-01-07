<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class PreguntaLeccion extends Eloquent implements UserInterface, RemindableInterface 
{
 
 	use UserTrait, RemindableTrait;

	public $errors;
    protected $primaryKey = 'id_pregunta';

 
 	protected $table = 'pregunta_leccion';
 	 	
 	protected $fillable = array('id_pregunta', 'id_usuario', 'id_leccion', 'pregunta', 'fecha_creacion', 'relacion');

	//protected $hidden = array('password', 'remember_token');
    public $timestamps = false;

	public function isValid($data)
    {
		$rules = array(
            'id_usuario' => 'required|numeric',
            'id_leccion' => 'required|numeric',
            'pregunta' => 'required',
            'fecha_creacion' => 'required'
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
    
    public function getUsuario()
    {
		$usuario = Usuario::find($this->id_usuario);
		return $usuario;
	}
    
    public function getPreguntasRelacionadas()
    {
		$preguntas = PreguntaLeccion::where('relacion','=', $this->id_pregunta)->orderBy('fecha_creacion','ASC')->get();
		return $preguntas;
	}
    
}

