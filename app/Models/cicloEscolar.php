<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class cicloEscolar extends Model
{
    protected $table = 'ciclo_escolar';
    protected $primaryKey = 'id';
    protected $fillable = ['id','nombre'];
}
?>
