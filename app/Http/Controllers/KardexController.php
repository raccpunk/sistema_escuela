<?php

namespace App\Http\Controllers;

use App\Models\Kardex;
use Illuminate\Http\Request;
use App\Models\Alumno;
use App\Models\Asignatura;
use App\Models\MapaCurricular;
use App\Models\calificaciones_periodo;
use App\Models\cicloEscolar;
use App\Models\Grados;
use App\Models\GrupoAlumno;
use App\Models\Grupos;
use App\Models\EstadoAlumnos;
use DB;

class KardexController extends Controller
{

    public function KardexPrimeroDocWord($alumno, $grado, $grupo, $ciclo_escolar)
    {
        // dd($alumno,$grado,$grupo,$ciclo_escolar); // to check all the data dumped from the form
        $phpWord = new \PhpOffice\PhpWord\PhpWord();
        // Creating the new document...
        $section = $phpWord->addSection(array('orientation' => ''));
        $fontStyleName = 'oneUserDefinedStyle';
        $phpWord->addFontStyle(
            $fontStyleName,
            array('name' => 'Tahoma', 'size' => 10, 'color' => '1B2232', 'bold' => true)
        );
        $header = array('size' => 14, 'bold' => true, 'align' => 'center', 'spaceAfter' => 100);
        $nature = array('size' => 9, 'bold' => true);
        $nature2 = array('size' => 9, 'bold' => false);
        $nature3 = array('size' => 9, 'bold' => false);
        $nature4 = array('size' => 7, 'bold' => true);
        $nature5 = array('size' => 11, 'bold' => true);
        $alumno = Alumno::find($alumno);
        $nombre = $alumno->nombres . ' ' . $alumno->apellido_paterno . ' ' . $alumno->apellido_materno;

        $grado = Grados::find($grado);
        $grupo = Grupos::find($grupo);
        $estadoAlumno = EstadoAlumnos::find($alumno->status_id);

        $ciclo_escolaresc = str_replace('Curso escolar ', "", cicloEscolar::find($ciclo_escolar)->nombre);

        $section->addText('                      INFORMACIÓN ESCOLAR CICLO ' . $ciclo_escolaresc, $header);
        $section->addText('');
        $section->addText('                        CURP     | ' . $alumno->curp, $nature2);
        $section->addText('                   NOMBRE    | ' . $nombre, $nature3);
        $section->addText('     CLAVE ESCUELA    | 31PES0079A', $nature2);
        $section->addText('                        NIVEL    | SECUNDARIA', $nature2);
        $section->addText(' NOMBRE ESCUELA    | FRAY DIEGO DE LANDA', $nature2);
        $section->addText('                      GRADO   |  ' . $grado->nombre_largo, $nature2);
        $section->addText('                      GRUPO   |  ' . $grupo->nombre, $nature2);
        $section->addText('                   ESTATUS   |  ' . $estadoAlumno->descripcion, $nature3);
        $section->addText('');
        $section->addText('                                                          CALIFICACIONES DEL CICLO ' . $ciclo_escolaresc, $nature3);

        $section->addTextBreak(1);
        $fancyTableStyleName = 'Fancy Table';
        $fancyTableStyle = array('borderSize' => 6, 'borderColor' => '', 'cellMargin' => 0, 'alignment' => \PhpOffice\PhpWord\SimpleType\JcTable::CENTER, 'cellSpacing' => 0);
        $fancyTableFirstRowStyle = array('borderBottomSize' => 0, 'borderBottomColor' => '0000FF', 'bgColor' => '');
        $fancyTableCellStyle = array('valign' => 'center');
        $fancyTableCellBtlrStyle = array('valign' => 'center', 'textDirection' => \PhpOffice\PhpWord\Style\Cell::TEXT_DIR_BTLR);
        $fancyTableFontStyle = array('bold' => true);
        $phpWord->addTableStyle($fancyTableStyleName, $fancyTableStyle, $fancyTableFirstRowStyle);
        $table = $section->addTable($fancyTableStyleName);
        $table->addRow(900);
        $table->addCell(5000, $fancyTableCellStyle)->addText('    ASIGNATURA', $fancyTableFontStyle);
        $table->addCell(500, $fancyTableCellStyle)->addText('  I', $fancyTableFontStyle);
        $table->addCell(500, $fancyTableCellStyle)->addText('  II', $fancyTableFontStyle);
        $table->addCell(500, $fancyTableCellStyle)->addText('  III', $fancyTableFontStyle);
        $table->addCell(2000, $fancyTableCellBtlrStyle)->addText('PROMEDIO', $nature4);
        $table->addRow();
        $mapaDelGradoYCiclo = MapaCurricular::where('ciclo_escolar_id', $ciclo_escolar)
            ->where('grado_id', $grado->id)->get();
        $materias = [];
        foreach ($mapaDelGradoYCiclo as $mapa) {
            $asignatura = Asignatura::find($mapa->asignatura_id);
            // dd($mapa->asignatura_id);
            $table->addCell(5000)->addText($asignatura->nombre);
            //aqui se toman los promedios de los 3 momentos, si alguna esta vacia entonces se añade una columna vacia.
            $calificacion1 = calificaciones_periodo::join('clases', 'clases.id', '=', 'calificaciones_periodo.clase_id')
                ->where('calificaciones_periodo.periodo_id', 2)
                ->where('calificaciones_periodo.alumno_id', $alumno->id)
                ->where('clases.asignatura_id', $asignatura->id)
                ->select('calificaciones_periodo.promedio')
                ->get()->first();
            $calificacion2 = calificaciones_periodo::join('clases', 'clases.id', '=', 'calificaciones_periodo.clase_id')
                ->where('calificaciones_periodo.periodo_id', 3)
                ->where('calificaciones_periodo.alumno_id', $alumno->id)
                ->where('clases.asignatura_id', $asignatura->id)
                ->select('calificaciones_periodo.promedio')
                ->get()->first();
            $calificacion3 = calificaciones_periodo::join('clases', 'clases.id', '=', 'calificaciones_periodo.clase_id')
                ->where('calificaciones_periodo.periodo_id', 4)
                ->where('calificaciones_periodo.alumno_id', $alumno->id)
                ->where('clases.asignatura_id', $asignatura->id)
                ->select('calificaciones_periodo.promedio')
                ->get()->first();
            if (!is_null($calificacion1)) {
                $table->addCell(500)->addText($calificacion1->promedio);
            } else {
                $table->addCell(500)->addText("");
            }
            if (!is_null($calificacion2)) {
                $table->addCell(500)->addText($calificacion2->promedio);
            } else {
                $table->addCell(500)->addText("");
            }
            if (!is_null($calificacion3)) {
                $table->addCell(500)->addText($calificacion3->promedio);
            } else {
                $table->addCell(500)->addText("");
            }
            if (!is_null($calificacion1) && !is_null($calificacion2) && !is_null($calificacion3)) {
                $promediofinal = ($calificacion1->promedio + $calificacion2->promedio + $calificacion3->promedio) / 3;
                $table->addCell(500)->addText($promediofinal);
            } else if (!is_null($calificacion1) && !is_null($calificacion2) && is_null($calificacion3)) {
                $promediofinal = ($calificacion1->promedio + $calificacion1->promedio) / 2;
                $table->addCell(500)->addText($promediofinal);
            } else if (!is_null($calificacion1) && is_null($calificacion2) && is_null($calificacion3)) {
                $table->addCell(500)->addText("");
            } else {
                $table->addCell(500)->addText("");
            }
            $table->addRow();
        }
        $cellColSpan = array('gridSpan' => 4, 'valign' => 'center'); //esta variable cobina la celda
        $cellHCentered = array('align' => 'right'); //esta variable alinea el texto a la derecha
        $table->addCell(2000, $cellColSpan)->addText("PROMEDIO GENERAL", $nature5, $cellHCentered);
        $table->addCell(500)->addText("");



        // Saving the document as OOXML file...
        $objWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord, 'Word2007');
        $objWriter->save($nombre . ' KardexPrimero.docx');
        // Saving the document as HTML file...
        $objWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord, 'HTML');

        return response()->download($nombre . ' KardexPrimero.docx')->deleteFileAfterSend(true);
    }

    public function KardexSegundoDocWord($alumno, $grado, $grupo, $ciclo_escolar)
    {
        // Creating the new document...
        $phpWord = new \PhpOffice\PhpWord\PhpWord();
        $section = $phpWord->addSection(array('orientation' => ''));
        $fontStyleName = 'oneUserDefinedStyle';
        $phpWord->addFontStyle(
            $fontStyleName,
            array('name' => 'Tahoma', 'size' => 10, 'color' => '1B2232', 'bold' => true)
        );
        $header = array('size' => 14, 'bold' => true, 'align' => 'center', 'spaceAfter' => 100);
        $nature = array('size' => 9, 'bold' => true);
        $nature2 = array('size' => 9, 'bold' => false);
        $nature3 = array('size' => 9, 'bold' => false, 'underline' => true);
        $nature4 = array('size' => 7, 'bold' => true);
        $nature5 = array('size' => 11, 'bold' => true);
        $alumno = Alumno::find($alumno);
        $nombre = $alumno->nombres . ' ' . $alumno->apellido_paterno . ' ' . $alumno->apellido_materno;

        $grado = Grados::find($grado);
        $grupo = Grupos::find($grupo);
        $estadoAlumno = EstadoAlumnos::find($alumno->status_id);
        $ciclo_escolaresc = str_replace('Curso escolar ', "", cicloEscolar::find($ciclo_escolar)->nombre);
        //header
        $section->addText('                      INFORMACIÓN ESCOLAR CICLO ' . $ciclo_escolaresc, $header);
        $section->addText('');
        $section->addText('                        CURP     | ' . $alumno->curp, $nature2);
        $section->addText('                   NOMBRE    | ' . $nombre, $nature3);
        $section->addText('     CLAVE ESCUELA    | 31PES0079A', $nature2);
        $section->addText('                        NIVEL    | SECUNDARIA', $nature2);
        $section->addText(' NOMBRE ESCUELA    | FRAY DIEGO DE LANDA', $nature2);
        $section->addText('                      GRADO   |  ' . $grado->nombre_largo, $nature2);
        $section->addText('                      GRUPO   |  ' . $grupo->nombre, $nature2);
        $section->addText('                   ESTATUS   |  ' . $estadoAlumno->descripcion, $nature3);
        $section->addText('');
        // $section->addText('                                                          CALIFICACIONES DEL CICLO ' . $ciclo_escolaresc, $nature3);

        $cellColSpan = array('gridSpan' => 4, 'valign' => 'center'); //esta variable cobina la celda
        $fancyTableStyleName = 'Fancy Table';
        $fancyTableStyle = array('borderSize' => 6, 'borderColor' => '', 'cellMargin' => 0, 'alignment' => \PhpOffice\PhpWord\SimpleType\JcTable::CENTER, 'cellSpacing' => 0);
        $fancyTableFirstRowStyle = array('borderBottomSize' => 0, 'borderBottomColor' => '0000FF', 'bgColor' => '');
        $fancyTableCellStyle = array('valign' => 'center');
        $fancyTableCellBtlrStyle = array('valign' => 'center', 'textDirection' => \PhpOffice\PhpWord\Style\Cell::TEXT_DIR_BTLR);
        $fancyTableFontStyle = array('bold' => true);
        $phpWord->addTableStyle($fancyTableStyleName, $fancyTableStyle, $fancyTableFirstRowStyle);
        $table = $section->addTable($fancyTableStyleName);
        //calificaciones
        $table->addRow(900);
        $table->addCell(5000, $fancyTableCellStyle)->addText('    ASIGNATURA', $fancyTableFontStyle);
        $table->addCell(500, $fancyTableCellStyle)->addText('  I', $fancyTableFontStyle);
        $table->addCell(500, $fancyTableCellStyle)->addText('  II', $fancyTableFontStyle);
        $table->addCell(500, $fancyTableCellStyle)->addText('  III', $fancyTableFontStyle);
        $table->addCell(2000, $fancyTableCellBtlrStyle)->addText('PROMEDIO', $nature4);
        $table->addRow();
        $mapaDelGradoYCiclo = MapaCurricular::where('ciclo_escolar_id', $ciclo_escolar)
            ->where('grado_id', $grado->id)->get();

        foreach ($mapaDelGradoYCiclo as $mapa) {
            $asignatura = Asignatura::find($mapa->asignatura_id);
            $table->addCell(5000)->addText($asignatura->nombre);
            //aqui se toman los promedios de los 3 momentos, si alguna esta vacia entonces se añade una columna vacia.
            $calificacion1 = calificaciones_periodo::join('clases', 'clases.id', '=', 'calificaciones_periodo.clase_id')
                ->where('calificaciones_periodo.periodo_id', 2)
                ->where('calificaciones_periodo.alumno_id', $alumno->id)
                ->where('clases.asignatura_id', $asignatura->id)
                ->select('calificaciones_periodo.promedio')
                ->get()->first();
            $calificacion2 = calificaciones_periodo::join('clases', 'clases.id', '=', 'calificaciones_periodo.clase_id')
                ->where('calificaciones_periodo.periodo_id', 3)
                ->where('calificaciones_periodo.alumno_id', $alumno->id)
                ->where('clases.asignatura_id', $asignatura->id)
                ->select('calificaciones_periodo.promedio')
                ->get()->first();
            $calificacion3 = calificaciones_periodo::join('clases', 'clases.id', '=', 'calificaciones_periodo.clase_id')
                ->where('calificaciones_periodo.periodo_id', 4)
                ->where('calificaciones_periodo.alumno_id', $alumno->id)
                ->where('clases.asignatura_id', $asignatura->id)
                ->select('calificaciones_periodo.promedio')
                ->get()->first();
            if (!is_null($calificacion1)) {
                $table->addCell(500)->addText($calificacion1->promedio);
            } else {
                $table->addCell(500)->addText("");
            }
            if (!is_null($calificacion2)) {
                $table->addCell(500)->addText($calificacion2->promedio);
            } else {
                $table->addCell(500)->addText("");
            }
            if (!is_null($calificacion3)) {
                $table->addCell(500)->addText($calificacion3->promedio);
            } else {
                $table->addCell(500)->addText("");
            }
            if (!is_null($calificacion1) && !is_null($calificacion2) && !is_null($calificacion3)) {
                $promediofinal = ($calificacion1->promedio + $calificacion2->promedio + $calificacion3->promedio) / 3;
                $table->addCell(500)->addText($promediofinal);
            } else if (!is_null($calificacion1) && !is_null($calificacion2) && is_null($calificacion3)) {
                $promediofinal = ($calificacion1->promedio + $calificacion1->promedio) / 2;
                $table->addCell(500)->addText($promediofinal);
            } else if (!is_null($calificacion1) && is_null($calificacion2) && is_null($calificacion3)) {
                $table->addCell(500)->addText("");
            } else {
                $table->addCell(500)->addText("");
            }
            $table->addRow();
        }
        $cellColSpan = array('gridSpan' => 4, 'valign' => 'center'); //esta variable cobina la celda
        $cellHCentered = array('align' => 'right'); //esta variable alinea el texto a la derecha
        $table->addCell(2000, $cellColSpan)->addText("PROMEDIO GENERAL", $nature5, $cellHCentered);
        $table->addCell(500)->addText("");
        $section->addText(' ');
        $section->addTextBreak(8);
        $section->addText('                                                          PROMEDIOS DE GRADOS ANTERIORES ', $nature3);

        $cellColSpan = array('gridSpan' => 5000000, 'valign' => 'center');
        $fancyTableStyleName = 'Fancy Table';
        $fancyTableStyle = array('borderSize' => 6, 'borderColor' => '', 'cellMargin' => 0, 'alignment' => \PhpOffice\PhpWord\SimpleType\JcTable::CENTER, 'cellSpacing' => 0);
        $fancyTableFirstRowStyle = array('borderBottomSize' => 0, 'borderBottomColor' => '0000FF', 'bgColor' => '');
        $fancyTableCellStyle = array('valign' => 'center');
        $fancyTableCellBtlrStyle = array('valign' => 'center', 'textDirection' => \PhpOffice\PhpWord\Style\Cell::TEXT_DIR_BTLR);
        $fancyTableFontStyle = array('bold' => true);
        $phpWord->addTableStyle($fancyTableStyleName, $fancyTableStyle, $fancyTableFirstRowStyle);
        $ciclos_escolares = cicloEscolar::select()->orderBy('fecha_inicio', 'desc')->get();

        foreach ($ciclos_escolares as $ciclos) {

            $mapaDelGradoYCiclo = MapaCurricular::where('ciclo_escolar_id', $ciclos)
                ->where('grado_id', $grado->id)->get();
            foreach ($mapaDelGradoYCiclo as $mapa) {
                $table->addCell(200, $cellColSpan)->addText("PROMEDIOS CICLO" . $ciclos->nombre, $nature5, $cellHCentered);
                $table = $section->addTable($fancyTableStyleName);
                $table->addRow(900);
                $table->addCell(5000, $fancyTableCellStyle)->addText('    ASIGNATURA', $fancyTableFontStyle);
                $table->addCell(500, $fancyTableCellStyle)->addText('  I', $fancyTableFontStyle);
                $table->addCell(500, $fancyTableCellStyle)->addText('  II', $fancyTableFontStyle);
                $table->addCell(500, $fancyTableCellStyle)->addText('  III', $fancyTableFontStyle);
                $table->addCell(2000, $fancyTableCellBtlrStyle)->addText('PROMEDIO', $nature4);
                $table->addRow();
                $asignatura = Asignatura::find($mapa->asignatura_id);
                $table->addCell(5000)->addText($asignatura->nombre);
                //aqui se toman los promedios de los 3 momentos, si alguna esta vacia entonces se añade una columna vacia.
                $calificacion1 = calificaciones_periodo::join('clases', 'clases.id', '=', 'calificaciones_periodo.clase_id')
                    ->where('calificaciones_periodo.periodo_id', 2)
                    ->where('calificaciones_periodo.alumno_id', $alumno->id)
                    ->where('clases.asignatura_id', $asignatura->id)
                    ->select('calificaciones_periodo.promedio')
                    ->get()->first();
                $calificacion2 = calificaciones_periodo::join('clases', 'clases.id', '=', 'calificaciones_periodo.clase_id')
                    ->where('calificaciones_periodo.periodo_id', 3)
                    ->where('calificaciones_periodo.alumno_id', $alumno->id)
                    ->where('clases.asignatura_id', $asignatura->id)
                    ->select('calificaciones_periodo.promedio')
                    ->get()->first();
                $calificacion3 = calificaciones_periodo::join('clases', 'clases.id', '=', 'calificaciones_periodo.clase_id')
                    ->where('calificaciones_periodo.periodo_id', 4)
                    ->where('calificaciones_periodo.alumno_id', $alumno->id)
                    ->where('clases.asignatura_id', $asignatura->id)
                    ->select('calificaciones_periodo.promedio')
                    ->get()->first();
                if (!is_null($calificacion1)) {
                    $table->addCell(500)->addText($calificacion1->promedio);
                } else {
                    $table->addCell(500)->addText("");
                }
                if (!is_null($calificacion2)) {
                    $table->addCell(500)->addText($calificacion2->promedio);
                } else {
                    $table->addCell(500)->addText("");
                }
                if (!is_null($calificacion3)) {
                    $table->addCell(500)->addText($calificacion3->promedio);
                } else {
                    $table->addCell(500)->addText("");
                }
                if (!is_null($calificacion1) && !is_null($calificacion2) && !is_null($calificacion3)) {
                    $promediofinal = ($calificacion1->promedio + $calificacion2->promedio + $calificacion3->promedio) / 3;
                    $table->addCell(500)->addText($promediofinal);
                } else if (!is_null($calificacion1) && !is_null($calificacion2) && is_null($calificacion3)) {
                    $promediofinal = ($calificacion1->promedio + $calificacion1->promedio) / 2;
                    $table->addCell(500)->addText($promediofinal);
                } else if (!is_null($calificacion1) && is_null($calificacion2) && is_null($calificacion3)) {
                    $table->addCell(500)->addText("");
                } else {
                    $table->addCell(500)->addText("");
                }
                $table->addRow();
            }
        }
        // Saving the document as OOXML file...
        $objWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord, 'Word2007');
        $objWriter->save($nombre . ' KardexSegundo.docx');
        // Saving the document as HTML file...
        $objWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord, 'HTML');
        return response()->download($nombre . ' KardexSegundo.docx')->deleteFileAfterSend(true);
    }
    public function KardexTerceroDocWord($alumno, $grado, $grupo, $ciclo_escolar)
    {
        // Creating the new document...
        $phpWord = new \PhpOffice\PhpWord\PhpWord();
        $section = $phpWord->addSection(array('orientation' => ''));
        $fontStyleName = 'oneUserDefinedStyle';
        $phpWord->addFontStyle(
            $fontStyleName,
            array('name' => 'Tahoma', 'size' => 10, 'color' => '1B2232', 'bold' => true)
        );
        $header = array('size' => 14, 'bold' => true, 'align' => 'center', 'spaceAfter' => 100);
        $nature = array('size' => 9, 'bold' => true);
        $nature2 = array('size' => 9, 'bold' => false);
        $nature3 = array('size' => 9, 'bold' => false, 'underline' => true);
        $nature4 = array('size' => 7, 'bold' => true);
        $nature5 = array('size' => 11, 'bold' => true);

        $alumno = Alumno::find($alumno);
        $nombre = $alumno->nombres . ' ' . $alumno->apellido_paterno . ' ' . $alumno->apellido_materno;

        $grado = Grados::find($grado);
        $grupo = Grupos::find($grupo);
        $estadoAlumno = EstadoAlumnos::find($alumno->status_id);
        $ciclo_escolaresc = str_replace('Curso escolar ', "", cicloEscolar::find($ciclo_escolar)->nombre);
        //header
        $section->addText('                      INFORMACIÓN ESCOLAR CICLO ' . $ciclo_escolaresc, $header);
        $section->addText('');
        $section->addText('                        CURP     | ' . $alumno->curp, $nature2);
        $section->addText('                   NOMBRE    | ' . $nombre, $nature3);
        $section->addText('     CLAVE ESCUELA    | 31PES0079A', $nature2);
        $section->addText('                        NIVEL    | SECUNDARIA', $nature2);
        $section->addText(' NOMBRE ESCUELA    | FRAY DIEGO DE LANDA', $nature2);
        $section->addText('                      GRADO   |  ' . $grado->nombre_largo, $nature2);
        $section->addText('                      GRUPO   |  ' . $grupo->nombre, $nature2);
        $section->addText('                   ESTATUS   |  ' . $estadoAlumno->descripcion, $nature3);
        $section->addText('');
        $section->addText('                                                          CALIFICACIONES DEL CICLO ' . $ciclo_escolaresc, $nature3);

        $cellColSpan = array('gridSpan' => 4, 'valign' => 'center'); //esta variable cobina la celda
        $fancyTableStyleName = 'Fancy Table';
        $fancyTableStyle = array('borderSize' => 6, 'borderColor' => '', 'cellMargin' => 0, 'alignment' => \PhpOffice\PhpWord\SimpleType\JcTable::CENTER, 'cellSpacing' => 0);
        $fancyTableFirstRowStyle = array('borderBottomSize' => 0, 'borderBottomColor' => '0000FF', 'bgColor' => '');
        $fancyTableCellStyle = array('valign' => 'center');
        $fancyTableCellBtlrStyle = array('valign' => 'center', 'textDirection' => \PhpOffice\PhpWord\Style\Cell::TEXT_DIR_BTLR);
        $fancyTableFontStyle = array('bold' => true);
        $phpWord->addTableStyle($fancyTableStyleName, $fancyTableStyle, $fancyTableFirstRowStyle);
        $table = $section->addTable($fancyTableStyleName);
        //calificaciones
        $table->addRow(900);
        $table->addCell(5000, $fancyTableCellStyle)->addText('    ASIGNATURA', $fancyTableFontStyle);
        $table->addCell(500, $fancyTableCellStyle)->addText('  I', $fancyTableFontStyle);
        $table->addCell(500, $fancyTableCellStyle)->addText('  II', $fancyTableFontStyle);
        $table->addCell(500, $fancyTableCellStyle)->addText('  III', $fancyTableFontStyle);
        $table->addCell(2000, $fancyTableCellBtlrStyle)->addText('PROMEDIO', $nature4);
        $table->addRow();
        $mapaDelGradoYCiclo = MapaCurricular::where('ciclo_escolar_id', $ciclo_escolar)
            ->where('grado_id', $grado->id)->get();

        $materias = [];
        foreach ($mapaDelGradoYCiclo as $mapa) {
            $asignatura = Asignatura::find($mapa->asignatura_id);
            $table->addCell(5000)->addText($asignatura->nombre);
            //aqui se toman los promedios de los 3 momentos, si alguna esta vacia entonces se añade una columna vacia.
            $calificacion1 = calificaciones_periodo::join('clases', 'clases.id', '=', 'calificaciones_periodo.clase_id')
                ->where('calificaciones_periodo.periodo_id', 2)
                ->where('calificaciones_periodo.alumno_id', $alumno->id)
                ->where('clases.asignatura_id', $asignatura->id)
                ->select('calificaciones_periodo.promedio')
                ->get()->first();
            $calificacion2 = calificaciones_periodo::join('clases', 'clases.id', '=', 'calificaciones_periodo.clase_id')
                ->where('calificaciones_periodo.periodo_id', 3)
                ->where('calificaciones_periodo.alumno_id', $alumno->id)
                ->where('clases.asignatura_id', $asignatura->id)
                ->select('calificaciones_periodo.promedio')
                ->get()->first();
            $calificacion3 = calificaciones_periodo::join('clases', 'clases.id', '=', 'calificaciones_periodo.clase_id')
                ->where('calificaciones_periodo.periodo_id', 4)
                ->where('calificaciones_periodo.alumno_id', $alumno->id)
                ->where('clases.asignatura_id', $asignatura->id)
                ->select('calificaciones_periodo.promedio')
                ->get()->first();
            if (!is_null($calificacion1)) {
                $table->addCell(500)->addText($calificacion1->promedio);
            } else {
                $table->addCell(500)->addText("");
            }
            if (!is_null($calificacion2)) {
                $table->addCell(500)->addText($calificacion2->promedio);
            } else {
                $table->addCell(500)->addText("");
            }
            if (!is_null($calificacion3)) {
                $table->addCell(500)->addText($calificacion3->promedio);
            } else {
                $table->addCell(500)->addText("");
            }
            if (!is_null($calificacion1) && !is_null($calificacion2) && !is_null($calificacion3)) {
                $promediofinal = ($calificacion1->promedio + $calificacion2->promedio + $calificacion3->promedio) / 3;
                $table->addCell(2000)->addText($promediofinal);
            } else if (!is_null($calificacion1) && !is_null($calificacion2) && is_null($calificacion3)) {
                $promediofinal = ($calificacion1->promedio + $calificacion1->promedio) / 2;
                $table->addCell(2000)->addText($promediofinal);
            } else if (!is_null($calificacion1) && is_null($calificacion2) && is_null($calificacion3)) {
                $table->addCell(2000)->addText("");
            } else {
                $table->addCell(500)->addText("");
            }
            $table->addRow();
        }
        $cellColSpan = array('gridSpan' => 4, 'valign' => 'center'); //esta variable cobina la celda
        $cellHCentered = array('align' => 'right'); //esta variable alinea el texto a la derecha
        $table->addCell(2000, $cellColSpan)->addText("PROMEDIO GENERAL", $nature5, $cellHCentered);
        $table->addCell(500)->addText("");
        $section->addText(' ');
        $section->addTextBreak(8);
        $section->addText('                                                          PROMEDIOS DE GRADOS ANTERIORES ', $nature3);

        $cellColSpan = array('gridSpan' => 5000000, 'valign' => 'center');
        $fancyTableStyleName = 'Fancy Table';
        $fancyTableStyle = array('borderSize' => 6, 'borderColor' => '', 'cellMargin' => 0, 'alignment' => \PhpOffice\PhpWord\SimpleType\JcTable::CENTER, 'cellSpacing' => 0);
        $fancyTableFirstRowStyle = array('borderBottomSize' => 0, 'borderBottomColor' => '0000FF', 'bgColor' => '');
        $fancyTableCellStyle = array('valign' => 'center');
        $fancyTableCellBtlrStyle = array('valign' => 'center', 'textDirection' => \PhpOffice\PhpWord\Style\Cell::TEXT_DIR_BTLR);
        $fancyTableFontStyle = array('bold' => true);
        $phpWord->addTableStyle($fancyTableStyleName, $fancyTableStyle, $fancyTableFirstRowStyle);
        $ciclos_escolares = cicloEscolar::select()->orderBy('fecha_inicio', 'desc')->get();
        foreach ($ciclos_escolares as $ciclos) {

            $mapaDelGradoYCiclo = MapaCurricular::where('ciclo_escolar_id', $ciclos)
                ->where('grado_id', $grado->id)->get();
            foreach ($mapaDelGradoYCiclo as $mapa) {
                $table->addCell(200, $cellColSpan)->addText("PROMEDIOS CICLO" . $ciclos->nombre, $nature5, $cellHCentered);
                $table = $section->addTable($fancyTableStyleName);
                $table->addRow(900);
                $table->addCell(5000, $fancyTableCellStyle)->addText('    ASIGNATURA', $fancyTableFontStyle);
                $table->addCell(500, $fancyTableCellStyle)->addText('  I', $fancyTableFontStyle);
                $table->addCell(500, $fancyTableCellStyle)->addText('  II', $fancyTableFontStyle);
                $table->addCell(500, $fancyTableCellStyle)->addText('  III', $fancyTableFontStyle);
                $table->addCell(2000, $fancyTableCellBtlrStyle)->addText('PROMEDIO', $nature4);
                $table->addRow();
                $asignatura = Asignatura::find($mapa->asignatura_id);
                $table->addCell(5000)->addText($asignatura->nombre);
                //aqui se toman los promedios de los 3 momentos, si alguna esta vacia entonces se añade una columna vacia.
                $calificacion1 = calificaciones_periodo::join('clases', 'clases.id', '=', 'calificaciones_periodo.clase_id')
                    ->where('calificaciones_periodo.periodo_id', 2)
                    ->where('calificaciones_periodo.alumno_id', $alumno->id)
                    ->where('clases.asignatura_id', $asignatura->id)
                    ->select('calificaciones_periodo.promedio')
                    ->get()->first();
                $calificacion2 = calificaciones_periodo::join('clases', 'clases.id', '=', 'calificaciones_periodo.clase_id')
                    ->where('calificaciones_periodo.periodo_id', 3)
                    ->where('calificaciones_periodo.alumno_id', $alumno->id)
                    ->where('clases.asignatura_id', $asignatura->id)
                    ->select('calificaciones_periodo.promedio')
                    ->get()->first();
                $calificacion3 = calificaciones_periodo::join('clases', 'clases.id', '=', 'calificaciones_periodo.clase_id')
                    ->where('calificaciones_periodo.periodo_id', 4)
                    ->where('calificaciones_periodo.alumno_id', $alumno->id)
                    ->where('clases.asignatura_id', $asignatura->id)
                    ->select('calificaciones_periodo.promedio')
                    ->get()->first();
                if (!is_null($calificacion1)) {
                    $table->addCell(500)->addText($calificacion1->promedio);
                } else {
                    $table->addCell(500)->addText("");
                }
                if (!is_null($calificacion2)) {
                    $table->addCell(500)->addText($calificacion2->promedio);
                } else {
                    $table->addCell(500)->addText("");
                }
                if (!is_null($calificacion3)) {
                    $table->addCell(500)->addText($calificacion3->promedio);
                } else {
                    $table->addCell(500)->addText("");
                }
                if (!is_null($calificacion1) && !is_null($calificacion2) && !is_null($calificacion3)) {
                    $promediofinal = ($calificacion1->promedio + $calificacion2->promedio + $calificacion3->promedio) / 3;
                    $table->addCell(500)->addText($promediofinal);
                } else if (!is_null($calificacion1) && !is_null($calificacion2) && is_null($calificacion3)) {
                    $promediofinal = ($calificacion1->promedio + $calificacion1->promedio) / 2;
                    $table->addCell(500)->addText($promediofinal);
                } else if (!is_null($calificacion1) && is_null($calificacion2) && is_null($calificacion3)) {
                    $table->addCell(500)->addText("");
                } else {
                    $table->addCell(500)->addText("");
                }
                $table->addRow();
            }
        }


        // Saving the document as OOXML file...
        $objWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord, 'Word2007');
        $objWriter->save($nombre . ' KardexTercero.docx');
        // Saving the document as HTML file...
        $objWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord, 'HTML');

        return response()->download($nombre . ' KardexTercero.docx')->deleteFileAfterSend(true);
    }
}
