<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Alumno;
use App\Models\cicloEscolar;
use App\Models\Grupos;
use App\Models\Grados;

class CalificacionesController extends Controller
{
    public function index()
    {
        $grupos = Grupos::all();
        $ciclo_escolar = cicloEscolar::all();
        $grados = Grados::all();
        return view('Calificaciones', compact('grupos', 'grados','ciclo_escolar'));
    }

    // public function primeroB()
    // {
    //     $grupo1 = GrupoAlumno::where('grado_id', '=', 1)->where('grupo_id', '=', 5)->get();
    //     $primero = [];
    //     foreach ($grupo1 as $item) {
    //         array_push($primero, Alumno::findOrFail($item->alumno_id));
    //     }
    //     return view('CalificacionesPrimeroB', compact('primero'));
    // }
    // public function segundoA()
    // {
    //     $grupo2 = GrupoAlumno::where('grado_id', '=', 2)->where('grupo_id', '=', 3)->get();
    //     $segundo = [];
    //     foreach ($grupo2 as $item) {

    //         array_push($segundo, Alumno::findOrFail($item->alumno_id));
    //     }
    //     return view('CalificacionesSegundoA', compact('segundo'));

    // }
    // public function segundoB()
    // {
    //     $grupo2 = GrupoAlumno::where('grado_id', '=', 2)->where('grupo_id', '=', 3)->get();
    //     $segundo = [];
    //     foreach ($grupo2 as $item) {

    //         array_push($segundo, Alumno::findOrFail($item->alumno_id));
    //     }
    //     return view('CalificacionesSegundoB', compact('segundo'));
    // }
    // public function terceroA()
    // {
    //     $grupo3 = GrupoAlumno::where('grado_id', '=', 3)->where('grupo_id', '=', 3)->get();
    //     $tercero = [];
    //     foreach ($grupo3 as $item) {

    //         array_push($tercero, Alumno::findOrFail($item->alumno_id));
    //     }
    //     return view('CalificacionesTerceroA', compact('tercero'));
    // }
    // public function terceroB()
    // {
    //     $grupo3 = GrupoAlumno::where('grado_id', '=', 3)->where('grupo_id', '=', 5)->get();
    //     $tercero = [];
    //     foreach ($grupo3 as $item) {

    //         array_push($tercero, Alumno::findOrFail($item->alumno_id));
    //     }
    //     return view('CalificacionesTerceroB', compact('tercero'));
    // }
}
