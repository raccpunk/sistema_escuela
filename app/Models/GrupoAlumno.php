<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GrupoAlumno extends Model
{
    protected $table = 'grupo_alumnos';
    protected $primaryKey = 'id';
    protected $fillable = ['id','grado_id','grupo_id','alumno_id','ciclo_escolar_id'];

}
