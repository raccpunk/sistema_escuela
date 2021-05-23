<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MapaCurricular extends Model
{
    protected $table = 'mapa_curricular';
    protected $primaryKey = 'id';
    protected $fillable = ['id','asignatura_id','grado_id','ciclo_escolar_id'];


}
?>
