<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Alumno extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'alumnos';

    /**
    * The database primary key value.
    *
    * @var string
    */
    protected $primaryKey = 'id';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['foto:', 'apellido_paterno', 'apellido_materno', 'edad', 'curp', 'sexo', 'direccion', 'telefono', 'email', 'otros', 'talla_polo', 'beca'];

    
}
