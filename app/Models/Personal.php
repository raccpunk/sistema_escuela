<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Personal extends Model
{
    protected $table = 'personal';

    protected $primaryKey = 'id';

    protected $fillable = ['id','nombres', 'apellidos', 'RFC', 'licenciatura', 'puesto_id', 'formacion', 'observaciones'];
}
