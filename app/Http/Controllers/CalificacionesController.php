<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests;

use App\Models\Alumno;
use App\Models\GrupoAlumno;
use App\Models\Periodo;
use Illuminate\Http\Request;

class CalificacionesController extends Controller
{
    public function index()
    {
        $grupo = GrupoAlumno::where('grado_id', '=', 1)->get();;
        $primero =[];
        foreach ($grupo as $item){

            array_push($primero,Alumno::findOrFail($item->alumno_id));
        }
        $grupo2 = GrupoAlumno::where('grado_id', '=', 2)->get();;
        $segundo =[];
        foreach ($grupo2 as $item){

            array_push($segundo,Alumno::findOrFail($item->alumno_id));
        }
        $grupo3 = GrupoAlumno::where('grado_id', '=', 3)->get();;
        $tercero =[];
        foreach ($grupo3 as $item){

            array_push($tercero,Alumno::findOrFail($item->alumno_id));
        }
        return view('Calificaciones', compact('primero','segundo','tercero'));
    }
}
