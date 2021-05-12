<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class clases extends Model
{
    protected $table = 'clases';

    protected $primaryKey = 'id';

    protected $fillable =['maestro_id','asignatura_id','grado_id','grupo_id'];

}
