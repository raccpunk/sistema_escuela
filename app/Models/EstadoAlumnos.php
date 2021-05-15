<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EstadoAlumnos extends Model
{
    protected $table = 'status_alumno';
    protected $primaryKey = 'id';
    protected $fillable = ['id','descripcion'];
}
?>
