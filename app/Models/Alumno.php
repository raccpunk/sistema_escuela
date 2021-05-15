<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Alumno extends Model
{
    protected $table = 'alumnos';
    protected $primaryKey = 'id';
    protected $fillable = ['id','foto', 'apellido_paterno', 'apellido_materno', 'edad', 'curp', 'sexo', 'direccion', 'telefono', 'email', 'otros', 'talla_polo', 'beca','grado_id','grupo_id'];


}
?>
