<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

use App\Models\Alumno;
use App\Models\GrupoAlumno;

class CalificacionesController extends Controller
{

    public function primero(){
        $grupo1 = GrupoAlumno::where('grado_id', '=', 1)->get();;
        $primero =[];
        foreach ($grupo1 as $item){

            array_push($primero,Alumno::findOrFail($item->alumno_id));
        }
        return view('CalificacionesPrimero', compact('primero'));
    }
    public function segundo(){
        $grupo2 = GrupoAlumno::where('grado_id', '=', 2)->get();;
        $segundo =[];
        foreach ($grupo2 as $item){

            array_push($segundo,Alumno::findOrFail($item->alumno_id));
        }
        return view('CalificacionesSegundo', compact('segundo'));
    }
    public function tercero(){
        $grupo3 = GrupoAlumno::where('grado_id', '=', 3)->get();;
        $tercero =[];
        foreach ($grupo3 as $item){

            array_push($tercero,Alumno::findOrFail($item->alumno_id));
        }
        return view('CalificacionesTercero', compact('tercero'));
    }

}
