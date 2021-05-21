<?php

namespace App\Http\Controllers;

use App\Models\KardexSegundoDoc;
use Illuminate\Http\Request;

class KardexSegundoDocController extends Controller
{

    public function KardexSegundoDocWord()
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

        //$section->addTextBreak(1);
        $section->addText('                      INFORMACIÓN ESCOLAR CICLO 2020-2021', $header);
        $section->addText('');
        $section->addText('                        CURP     |', $nature2);
        $section->addText('                   NOMBRE    |', $nature2,);
        $section->addText('     CLAVE ESCUELA    |', $nature2);
        $section->addText('                        NIVEL    |', $nature2);
        $section->addText(' NOMBRE ESCUELA    |', $nature2, 'FRAY DIEGO DE LANDA', $nature);
        $section->addText('                      GRADO   |', $nature2);
        $section->addText('                      GRUPO   |', $nature2);
        $section->addText('                   ESTATUS   |', $nature2);
        $section->addText('');
        $section->addText('                                                          CALIFICACIONES DEL CICLO 2020-2021', $nature3);


        $cellColSpan = array('gridSpan' => 5000000, 'valign' => 'center');
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
        $table->addCell(5000)->addText("LENGUA MATERNA (ESPAÑOL)");
        $table->addCell(500)->addText("");
        $table->addCell(500)->addText("");
        $table->addCell(500)->addText("");
        $table->addCell(2000)->addText("");
        $table->addRow();
        $table->addCell(5000)->addText("MATEMÁTICAS");
        $table->addCell(500)->addText("");
        $table->addCell(500)->addText("");
        $table->addCell(500)->addText("");
        $table->addCell(2000)->addText("");
        $table->addRow();
        $table->addCell(5000)->addText("LENGUA EXTRANGERA (INGLES)");
        $table->addCell(500)->addText("");
        $table->addCell(500)->addText("");
        $table->addCell(500)->addText("");
        $table->addCell(2000)->addText("");
        $table->addRow();
        $table->addCell(5000)->addText("CIENCIAS (FÍSICA)");
        $table->addCell(500)->addText("");
        $table->addCell(500)->addText("");
        $table->addCell(500)->addText("");
        $table->addCell(2000)->addText("");
        $table->addRow();
        $table->addCell(5000)->addText("HISTORIA");
        $table->addCell(500)->addText("");
        $table->addCell(500)->addText("");
        $table->addCell(500)->addText("");
        $table->addCell(2000)->addText("");
        $table->addRow();
        $table->addCell(5000)->addText("FORMACIÓN CÍVICA Y ÉTICA");
        $table->addCell(500)->addText("");
        $table->addCell(500)->addText("");
        $table->addCell(500)->addText("");
        $table->addCell(2000)->addText("");
        $table->addRow();
        $table->addCell(5000)->addText("TECNOLOGÍA");
        $table->addCell(500)->addText("");
        $table->addCell(500)->addText("");
        $table->addCell(500)->addText("");
        $table->addCell(2000)->addText("");
        $table->addRow();
        $table->addCell(5000)->addText("EDUCACIÓN FÍSICA");
        $table->addCell(500)->addText("");
        $table->addCell(500)->addText("");
        $table->addCell(500)->addText("");
        $table->addCell(2000)->addText("");
        $table->addRow();
        $table->addCell(5000)->addText("ARTES");
        $table->addCell(500)->addText("");
        $table->addCell(500)->addText("");
        $table->addCell(500)->addText("");
        $table->addCell(2000)->addText("");
        $table->addRow();
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
        $table = $section->addTable($fancyTableStyleName);
        $table->addRow(900);
        $table->addCell(5000, $fancyTableCellStyle)->addText('    ASIGNATURA', $fancyTableFontStyle);
        $table->addCell(500, $fancyTableCellStyle)->addText(' ADEUDA', $fancyTableFontStyle);
        $table->addCell(500, $fancyTableCellStyle)->addText(' APROVADO EN EXTRAORDINARIO', $fancyTableFontStyle);
        $table->addCell(500, $fancyTableCellStyle)->addText(' CICLO REGULARIZACIÓN', $fancyTableFontStyle);
        $table->addCell(2000, $fancyTableCellBtlrStyle)->addText('PROMEDIO', $nature4);
        $table->addRow(900);

        $cellColSpan = array('gridSpan' => 5, 'valign' => 'center'); //esta variable cobina la celda
        $cellHCentered1 = array('align' => 'left','size' => 9, 'bold' => true); //esta variable alinea el texto a la derecha
        $table->addCell(2000, $cellColSpan)->addText("PROMEDIOS 1 er GRADO CICLO 2018-2019", $nature5, $cellHCentered1);


        $table->addRow();
        $table->addCell(5000)->addText("Lengua Materna: Español");
        $table->addCell(500)->addText("");
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
        $table->addCell(2000, $cellColSpan)->addText("PROMEDIO GENERAL", $nature5, $cellHCentered);
        $table->addCell(500)->addText("");

        // Saving the document as OOXML file...
        $objWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord, 'Word2007');
        $objWriter->save('KardexSegundo.docx');

        // Saving the document as ODF file...
        $objWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord, 'ODText');
        $objWriter->save('KardexSegundo.odt');

        // Saving the document as HTML file...
        $objWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord, 'HTML');

        return response()->download('KardexSegundo.docx');

        /* Note: we skip RTF, because it's not XML-based and requires a different example. */
        /* Note: we skip PDF, because "HTML-to-PDF" approach is used to create PDF documents. */
    }
}
