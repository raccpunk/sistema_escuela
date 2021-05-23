<?php

namespace App\Http\Controllers;

use App\Models\KardexTerceroDoc;
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

class KardexTerceroDocController extends Controller
{
    public function KardexTerceroDocWord(Request $request)
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

        $alumno = Alumno::find($request->alumno_id);
        $nombre = $alumno->nombres . ' ' . $alumno->apellido_paterno . '' . $alumno->apellido_materno;
        $grupoAlumno = GrupoAlumno::where('alumno_id', '=', $request->alumno_id)->get();
        $grado = Grados::find($grupoAlumno[0]->grado_id);
        $grupo = Grupos::find($grupoAlumno[0]->grupo_id);
        $estadoAlumno = EstadoAlumnos::find($alumno->status_id);
        $ciclo_escolar = str_replace('Curso escolar ', "", cicloEscolar::find($grupoAlumno[0]->ciclo_escolar_id)->nombre);
        //header
        $section->addText('                      INFORMACIÓN ESCOLAR CICLO ' . $ciclo_escolar, $header);
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
        $section->addText('                                                          CALIFICACIONES DEL CICLO ' . $ciclo_escolar, $nature3);

        $cellColSpan = array('gridSpan' => 5000000, 'valign' => 'center');
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
        $mapaDelGradoYCiclo = MapaCurricular::where('ciclo_escolar_id', 1)
            ->where('grado_id', 3)->get();

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
            $table->addCell(2000)->addText("");
            $table->addRow();
        }
        $cellColSpan = array('gridSpan' => 4, 'valign' => 'center'); //esta variable cobina la celda
        $cellHCentered = array('align' => 'right'); //esta variable alinea el texto a la derecha
        $table->addCell(2000, $cellColSpan)->addText("PROMEDIO GENERAL", $nature5, $cellHCentered);
        $table->addCell(500)->addText("");
        $section->addText(' ');
        // $section->addTextBreak(8);
        // $section->addText('                                                          PROMEDIOS DE GRADOS ANTERIORES ',$nature3);

        // $cellColSpan = array('gridSpan' => 5000000, 'valign' => 'center');
        // $fancyTableStyleName = 'Fancy Table';
        // $fancyTableStyle = array('borderSize' => 6, 'borderColor' => '', 'cellMargin' => 0, 'alignment' => \PhpOffice\PhpWord\SimpleType\JcTable::CENTER, 'cellSpacing' => 0);
        // $fancyTableFirstRowStyle = array('borderBottomSize' => 0, 'borderBottomColor' => '0000FF', 'bgColor' => '');
        // $fancyTableCellStyle = array('valign' => 'center');
        // $fancyTableCellBtlrStyle = array('valign' => 'center', 'textDirection' => \PhpOffice\PhpWord\Style\Cell::TEXT_DIR_BTLR);
        // $fancyTableFontStyle = array('bold' => true);
        // $phpWord->addTableStyle($fancyTableStyleName, $fancyTableStyle, $fancyTableFirstRowStyle);
        // $table = $section->addTable($fancyTableStyleName);
        // $table->addRow(900);
        // $table->addCell(5000, $fancyTableCellStyle)->addText('    ASIGNATURA', $fancyTableFontStyle);
        // $table->addCell(500, $fancyTableCellStyle)->addText(' ADEUDA', $fancyTableFontStyle);
        // $table->addCell(500, $fancyTableCellStyle)->addText(' APROVADO EN EXTRAORDINARIO', $fancyTableFontStyle);
        // $table->addCell(500, $fancyTableCellStyle)->addText(' CICLO REGULARIZACIÓN', $fancyTableFontStyle);
        // $table->addCell(2000, $fancyTableCellBtlrStyle)->addText('PROMEDIO', $nature4);
        // $table->addRow(900);
        // $cellColSpan = array('gridSpan' => 5, 'valign' => 'center'); //esta variable cobina la celda
        // $cellHCentered1 = array('align' => 'left','size' => 9, 'bold' => true); //esta variable alinea el texto a la derecha
        // $table->addCell(2000, $cellColSpan)->addText("PROMEDIOS 1 er GRADO CICLO 2018-2019", $nature5, $cellHCentered1);


        // $table->addRow();
        // $table->addCell(5000)->addText("Lengua Materna: Español");
        // $table->addCell(500)->addText("");
        // $table->addCell(500)->addText("");
        // $table->addCell(500)->addText("");
        // $table->addCell(2000)->addText("");
        // $table->addRow();
        // $table->addCell(5000)->addText("Matemáticas");
        // $table->addCell(500)->addText("");
        // $table->addCell(500)->addText("");
        // $table->addCell(500)->addText("");
        // $table->addCell(2000)->addText("");
        // $table->addRow();
        // $table->addCell(5000)->addText("Ingles");
        // $table->addCell(500)->addText("");
        // $table->addCell(500)->addText("");
        // $table->addCell(500)->addText("");
        // $table->addCell(2000)->addText("");
        // $table->addRow();
        // $table->addCell(5000)->addText("Ciencias Naturales Y Tecnología: Biología");
        // $table->addCell(500)->addText("");
        // $table->addCell(500)->addText("");
        // $table->addCell(500)->addText("");
        // $table->addCell(2000)->addText("");
        // $table->addRow();
        // $table->addCell(5000)->addText("Historia");
        // $table->addCell(500)->addText("");
        // $table->addCell(500)->addText("");
        // $table->addCell(500)->addText("");
        // $table->addCell(2000)->addText("");
        // $table->addRow();
        // $table->addCell(5000)->addText("Geografía");
        // $table->addCell(500)->addText("");
        // $table->addCell(500)->addText("");
        // $table->addCell(500)->addText("");
        // $table->addCell(2000)->addText("");
        // $table->addRow();
        // $table->addCell(5000)->addText("Formación Cívica y Ética");
        // $table->addCell(500)->addText("");
        // $table->addCell(500)->addText("");
        // $table->addCell(500)->addText("");
        // $table->addCell(2000)->addText("");
        // $table->addRow();
        // $table->addCell(5000)->addText("Tecnologia");
        // $table->addCell(500)->addText("");
        // $table->addCell(500)->addText("");
        // $table->addCell(500)->addText("");
        // $table->addCell(2000)->addText("");
        // $table->addRow();
        // $table->addCell(5000)->addText("Educación Física");
        // $table->addCell(500)->addText("");
        // $table->addCell(500)->addText("");
        // $table->addCell(500)->addText("");
        // $table->addCell(2000)->addText("");
        // $table->addRow();
        // $table->addCell(5000)->addText("Artes");
        // $table->addCell(500)->addText("");
        // $table->addCell(500)->addText("");
        // $table->addCell(500)->addText("");
        // $table->addCell(2000)->addText("");
        // $table->addRow();
        // $cellColSpan = array('gridSpan' => 4, 'valign' => 'center'); //esta variable cobina la celda
        // $cellHCentered = array('align' => 'right'); //esta variable alinea el texto a la derecha
        // $table->addCell(2000, $cellColSpan)->addText("PROMEDIO GENERAL", $nature5, $cellHCentered);
        // $table->addCell(500)->addText("");
        // $table->addRow(900);
        // $table->addCell(5000, $fancyTableCellStyle)->addText('    ASIGNATURA', $fancyTableFontStyle);
        // $table->addCell(500, $fancyTableCellStyle)->addText(' ADEUDA', $fancyTableFontStyle);
        // $table->addCell(500, $fancyTableCellStyle)->addText(' APROVADO EN EXTRAORDINARIO', $fancyTableFontStyle);
        // $table->addCell(500, $fancyTableCellStyle)->addText(' CICLO REGULARIZACIÓN', $fancyTableFontStyle);
        // $table->addCell(2000, $fancyTableCellBtlrStyle)->addText('PROMEDIO', $nature4);
        // $table->addRow(900);
        // $cellColSpan = array('gridSpan' => 5, 'valign' => 'center'); //esta variable cobina la celda
        // $cellHCentered1 = array('align' => 'left','size' => 9, 'bold' => true); //esta variable alinea el texto a la derecha
        // $table->addCell(2000, $cellColSpan)->addText('PROMEDIOS 2do GRADO CICLO 2019-2020', $nature5, $cellHCentered1);

        // $table->addRow();
        // $table->addCell(5000)->addText("LENGUA MATERNA (ESPAÑOL)");
        // $table->addCell(500)->addText("");
        // $table->addCell(500)->addText("");
        // $table->addCell(500)->addText("");
        // $table->addCell(2000)->addText("");
        // $table->addRow();
        // $table->addCell(5000)->addText("MATEMÁTICAS");
        // $table->addCell(500)->addText("");
        // $table->addCell(500)->addText("");
        // $table->addCell(500)->addText("");
        // $table->addCell(2000)->addText("");
        // $table->addRow();
        // $table->addCell(5000)->addText("LENGUA EXTRANGERA (INGLES)");
        // $table->addCell(500)->addText("");
        // $table->addCell(500)->addText("");
        // $table->addCell(500)->addText("");
        // $table->addCell(2000)->addText("");
        // $table->addRow();
        // $table->addCell(5000)->addText("CIENCIAS (FÍSICA)");
        // $table->addCell(500)->addText("");
        // $table->addCell(500)->addText("");
        // $table->addCell(500)->addText("");
        // $table->addCell(2000)->addText("");
        // $table->addRow();
        // $table->addCell(5000)->addText("HISTORIA");
        // $table->addCell(500)->addText("");
        // $table->addCell(500)->addText("");
        // $table->addCell(500)->addText("");
        // $table->addCell(2000)->addText("");

        // $table->addRow();
        // $table->addCell(5000)->addText("FORMACIÓN CÍVICA Y ÉTICA");
        // $table->addCell(500)->addText("");
        // $table->addCell(500)->addText("");
        // $table->addCell(500)->addText("");
        // $table->addCell(2000)->addText("");
        // $table->addRow();
        // $table->addCell(5000)->addText("TECNOLOGÍA");
        // $table->addCell(500)->addText("");
        // $table->addCell(500)->addText("");
        // $table->addCell(500)->addText("");
        // $table->addCell(2000)->addText("");
        // $table->addRow();
        // $table->addCell(5000)->addText("EDUCACIÓN FÍSICA");
        // $table->addCell(500)->addText("");
        // $table->addCell(500)->addText("");
        // $table->addCell(500)->addText("");
        // $table->addCell(2000)->addText("");
        // $table->addRow();
        // $table->addCell(5000)->addText("ARTES");
        // $table->addCell(500)->addText("");
        // $table->addCell(500)->addText("");
        // $table->addCell(500)->addText("");
        // $table->addCell(2000)->addText("");
        // $table->addRow();
        // $cellColSpan = array('gridSpan' => 4, 'valign' => 'center'); //esta variable cobina la celda
        // $cellHCentered = array('align' => 'right'); //esta variable alinea el texto a la derecha
        // $table->addCell(2000, $cellColSpan)->addText("PROMEDIO GENERAL", $nature5, $cellHCentered);
        // $table->addCell(500)->addText("");


        // Saving the document as OOXML file...
        $objWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord, 'Word2007');
        $objWriter->save($nombre . '.docx');

        // Saving the document as ODF file...
        $objWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord, 'ODText');
        $objWriter->save($nombre . '.docx');

        // Saving the document as HTML file...
        $objWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord, 'HTML');

        return response()->download($nombre . '.docx');
    }
}
