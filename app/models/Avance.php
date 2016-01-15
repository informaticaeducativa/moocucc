<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class Avance extends Eloquent implements UserInterface, RemindableInterface
{

  use UserTrait, RemindableTrait;

  public $errors;
  protected $primaryKey = array('id_usuario', 'id_curso', 'semana', 'tipo');
  protected $table = 'avance';

  protected $fillable = array('id_usuario', 'id_curso', 'semana', 'tipo', 'fecha', 'porcentaje');

  public $timestamps = false;

  public function isValid($data)
  {
    $rules = array(
      'id_usuario' => 'required|numeric',
      'id_curso' => 'required|numeric',
      'semana' => 'required|numeric',
      'porcentaje' => 'required|numeric',
      'fecha' => 'required',
      'tipo' => 'required'
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
      // Si la data es válida se la asignamos al usuario
      $this->fill($data);
      // Guardamos el usuario
      $this->save();

      return true;
    }

    return false;
  }

  public function getCurso()
  {
    // Ésta función Retorna el curso cuando se busca por id
    $curso = Curso::find($this->id_curso);
    return $curso;
  }

  public function getUsuario()
  {
    $usuario = Usuario::find($this->id_usuario);
    return $usuario;
  }

  public function getBadge()
  {
    $badge = Badge::find($this->id_curso);
    return $badge;
  }


}
