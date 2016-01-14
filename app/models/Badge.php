<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class Badge extends Eloquent implements UserInterface, RemindableInterface
{

 	  use UserTrait, RemindableTrait;

	  public $errors;
    protected $primaryKey = 'id_curso';

 	  protected $table = 'badge';

 	  protected $fillable = array( 'id_curso', 'color1', 'color2');

    public $timestamps = false;

	  public function isValid($data)
    {
		$rules = array(
            'id_curso' => 'required|numeric',
            'color1' => 'required',
            'color2' => 'required'
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

  	public function getCurso()
    {
  		$curso = Curso::find($this->id_curso);
  		return $curso;
  	}


}
