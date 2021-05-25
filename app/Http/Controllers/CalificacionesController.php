<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Alumno;
use App\Models\cicloEscolar;
use App\Models\Grupos;
use App\Models\Grados;
use App\models\GrupoAlumno;
use Illuminate\Http\Request;

use function PHPUnit\Framework\isNull;

class CalificacionesController extends Controller
{
    public function index()
    {
        $grupos = Grupos::all();
        $ciclo_escolar = cicloEscolar::all();
        $grados = Grados::all();

        $alumnos = [];
        $grupoAlumno = GrupoAlumno::where('grado_id', '=', 1)->Where('grupo_id', '=', 3)->get();
        foreach ($grupoAlumno as $item) {
            array_push($alumnos, Alumno::findOrFail($item->alumno_id));
        }
        return view('Calificaciones', compact('grupos', 'grados', 'ciclo_escolar', 'alumnos'));
    }
    public function post(Request $request)
    {
        if (!empty($request)) {
            $alumnos = [];
            $grupos = Grupos::all();
            $ciclo_escolar = cicloEscolar::all();
            $grados = Grados::all();
            $grupoAlumno = GrupoAlumno::where('grado_id', '=', $request->grado)
                ->Where('grupo_id', '=', $request->grupo)
                ->Where('ciclo_escolar_id', '=', $request->ciclo_escolar)->get();
            foreach ($grupoAlumno as $item) {
                array_push($alumnos, Alumno::findOrFail($item->alumno_id));
            }
            return view('Calificaciones', compact('grupos', 'grados', 'ciclo_escolar', 'alumnos'));
        }
    }
}
