<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Alumno;
use App\Models\GrupoAlumno;

class CalificacionesController extends Controller
{
    public function primeroA()
    {
        $grupo1 = GrupoAlumno::where('grado_id', '=', 1)->where('grupo_id', '=', 3)->get();
        $primero = [];
        foreach ($grupo1 as $item) {
            array_push($primero, Alumno::findOrFail($item->alumno_id));
        }
        return view('CalificacionesPrimeroA', compact('primero'));
    }

    public function primeroB()
    {
        $grupo1 = GrupoAlumno::where('grado_id', '=', 1)->where('grupo_id', '=', 5)->get();
        $primero = [];
        foreach ($grupo1 as $item) {
            array_push($primero, Alumno::findOrFail($item->alumno_id));
        }
        return view('CalificacionesPrimeroB', compact('primero'));
    }
    public function segundoA()
    {
        $grupo2 = GrupoAlumno::where('grado_id', '=', 2)->where('grupo_id', '=', 3)->get();
        $segundo = [];
        foreach ($grupo2 as $item) {

            array_push($segundo, Alumno::findOrFail($item->alumno_id));
        }
        return view('CalificacionesSegundoA', compact('segundo'));

    }
    public function segundoB()
    {
        $grupo2 = GrupoAlumno::where('grado_id', '=', 2)->where('grupo_id', '=', 3)->get();
        $segundo = [];
        foreach ($grupo2 as $item) {

            array_push($segundo, Alumno::findOrFail($item->alumno_id));
        }
        return view('CalificacionesSegundoB', compact('segundo'));
    }
    public function terceroA()
    {
        $grupo3 = GrupoAlumno::where('grado_id', '=', 3)->where('grupo_id', '=', 3)->get();
        $tercero = [];
        foreach ($grupo3 as $item) {

            array_push($tercero, Alumno::findOrFail($item->alumno_id));
        }
        return view('CalificacionesTerceroA', compact('tercero'));
    }
    public function terceroB()
    {
        $grupo3 = GrupoAlumno::where('grado_id', '=', 3)->where('grupo_id', '=', 5)->get();
        $tercero = [];
        foreach ($grupo3 as $item) {

            array_push($tercero, Alumno::findOrFail($item->alumno_id));
        }
        return view('CalificacionesTerceroB', compact('tercero'));
    }
}
