<?php

namespace App\Http\Controllers;

use App\Models\KardexPrimeroDoc;
use Illuminate\Http\Request;
use App\Models\Alumno;
use App\Models\calificaciones_periodo;
use App\Models\cicloEscolar;
use App\Models\Grados;
use App\Models\GrupoAlumno;
use App\Models\Grupos;
use App\Models\EstadoAlumnos;

class KardexPrimeroDocController extends Controller
{
    public function KardexPrimeroDocWord(Request $request)
    {
        // dd($request->all()); // to check all the data dumped from the form
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
        $alumno = Alumno::find($request->alumno_id);
        $nombre = $alumno->nombres . ' ' . $alumno->apellido_paterno . '' . $alumno->apellido_materno;
        $grupoAlumno = GrupoAlumno::where('alumno_id','=',$request->alumno_id)->get();
        $grado = Grados::find($grupoAlumno[0]->grado_id);
        $grupo = Grupos::find($grupoAlumno[0]->grupo_id);
        $estadoAlumno = EstadoAlumnos::find($alumno->status_id);
        $calificaciones = calificaciones_periodo::where('alumno_id','=',$request->alumno_id);
        $ciclo_escolar = str_replace('Curso escolar ', "", cicloEscolar::find($grupoAlumno[0]->ciclo_escolar_id)->nombre);

        //$section->addTextBreak(1);
        $section->addText('                      INFORMACIÓN ESCOLAR CICLO '. $ciclo_escolar, $header);
        $section->addText('');
        $section->addText('                        CURP     | ' . $alumno->curp, $nature2);
        $section->addText('                   NOMBRE    | ' . $nombre, $nature3);
        $section->addText('     CLAVE ESCUELA    | 31PES0079A', $nature2);
        $section->addText('                        NIVEL    | SECUNDARIA', $nature2);
        $section->addText(' NOMBRE ESCUELA    | FRAY DIEGO DE LANDA',$nature2);
        $section->addText('                      GRADO   |  ' . $grado->nombre_largo, $nature2);
        $section->addText('                      GRUPO   |  ' . $grupo->nombre, $nature2);
        $section->addText('                   ESTATUS   |  ' . $estadoAlumno->descripcion, $nature3);
        $section->addText('');
        $section->addText('                                                          CALIFICACIONES DEL CICLO ' . $ciclo_escolar, $nature3);

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
        foreach ($calificaciones as $calificacion){
            //todo: take data from db
        }
        $table->addCell(5000)->addText("Lengua Materna: Español");
        $table->addCell(500)->addText();
        $table->addCell(500)->addText("");
        $table->addCell(500)->addText("");
        $table->addCell(2000)->addText("");
        $table->addRow();
        $table->addCell(5000)->addText("Matemáticas");
        $table->addCell(500)->addText("");
        $table->addCell(500)->addText("");
        $table->addCell(500)->addText("");
        $table->addCell(2000)->addText("");
        $table->addRow();
        $table->addCell(5000)->addText("Ingles");
        $table->addCell(500)->addText("");
        $table->addCell(500)->addText("");
        $table->addCell(500)->addText("");
        $table->addCell(2000)->addText("");
        $table->addRow();
        $table->addCell(5000)->addText("Ciencias Naturales Y Tecnología: Biología");
        $table->addCell(500)->addText("");
        $table->addCell(500)->addText("");
        $table->addCell(500)->addText("");
        $table->addCell(2000)->addText("");
        $table->addRow();
        $table->addCell(5000)->addText("Historia");
        $table->addCell(500)->addText("");
        $table->addCell(500)->addText("");
        $table->addCell(500)->addText("");
        $table->addCell(2000)->addText("");
        $table->addRow();
        $table->addCell(5000)->addText("Geografía");
        $table->addCell(500)->addText("");
        $table->addCell(500)->addText("");
        $table->addCell(500)->addText("");
        $table->addCell(2000)->addText("");
        $table->addRow();
        $table->addCell(5000)->addText("Formación Cívica y Ética");
        $table->addCell(500)->addText("");
        $table->addCell(500)->addText("");
        $table->addCell(500)->addText("");
        $table->addCell(2000)->addText("");
        $table->addRow();
        $table->addCell(5000)->addText("Tecnologia");
        $table->addCell(500)->addText("");
        $table->addCell(500)->addText("");
        $table->addCell(500)->addText("");
        $table->addCell(2000)->addText("");
        $table->addRow();
        $table->addCell(5000)->addText("Educación Física");
        $table->addCell(500)->addText("");
        $table->addCell(500)->addText("");
        $table->addCell(500)->addText("");
        $table->addCell(2000)->addText("");
        $table->addRow();
        $table->addCell(5000)->addText("Artes");
        $table->addCell(500)->addText("");
        $table->addCell(500)->addText("");
        $table->addCell(500)->addText("");
        $table->addCell(2000)->addText("");
        $table->addRow();
        $cellColSpan = array('gridSpan' => 4, 'valign' => 'center'); //esta variable cobina la celda
        $cellHCentered = array('align' => 'right'); //esta variable alinea el texto a la derecha
        $table->addCell(2000, $cellColSpan)->addText("Promedio General", null, $cellHCentered);
        $table->addCell(500)->addText("");




        // Saving the document as OOXML file...
        $objWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord, 'Word2007');
        $objWriter->save('KardexPrimero.docx');

        // Saving the document as ODF file...
        $objWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord, 'ODText');
        $objWriter->save('KardexPrimero.odt');

        // Saving the document as HTML file...
        $objWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord, 'HTML');

        return response()->download('KardexPrimero.docx');

        /* Note: we skip RTF, because it's not XML-based and requires a different example. */
        /* Note: we skip PDF, because "HTML-to-PDF" approach is used to create PDF documents. */
    }
}
