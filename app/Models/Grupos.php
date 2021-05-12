<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Grupos extends Model
{

    protected $table = 'grupos';

    protected $primaryKey = 'id';

    protected $fillable =['id','nombre'];

}
