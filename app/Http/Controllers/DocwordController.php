<?php

namespace App\Http\Controllers;

use App\Models\docword;
use Illuminate\Http\Request;

class DocwordController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\docword  $docword
     * @return \Illuminate\Http\Response
     */
    public function show(docword $docword)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\docword  $docword
     * @return \Illuminate\Http\Response
     */
    public function edit(docword $docword)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\docword  $docword
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, docword $docword)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\docword  $docword
     * @return \Illuminate\Http\Response
     */
    public function destroy(docword $docword)
    {
        //
    }
    public function ejemploword(){




// 1. Basic table


        // Creating the new document...
$phpWord = new \PhpOffice\PhpWord\PhpWord();
$section = $phpWord->addSection();
$header = array('size' => 16, 'bold' => true);

$path=realpath('App\public\resource\Bicho.png');
$section->addTextBreak(1);
$section->addText('Prueba Con Tablas', $header);

$fancyTableStyleName = 'Prueba Con Tablas';
$fancyTableStyle = array('borderSize' => 0, 'borderColor' => '006699', 'cellMargin' => 0, 'alignment' => \PhpOffice\PhpWord\SimpleType\JcTable::CENTER, 'cellSpacing' => 0);
$fancyTableFirstRowStyle = array('borderBottomSize' => 0, 'borderBottomColor' => '0000FF', 'bgColor' => '66BBFF');
$fancyTableCellStyle = array('valign' => 'center');
$fancyTableCellBtlrStyle = array('valign' => 'center', 'textDirection' => \PhpOffice\PhpWord\Style\Cell::TEXT_DIR_BTLR);
$fancyTableFontStyle = array('bold' => true);
$phpWord->addTableStyle($fancyTableStyleName, $fancyTableStyle, $fancyTableFirstRowStyle);
$table = $section->addTable($fancyTableStyleName);
$table->addRow(300);
$table->addCell(300, $fancyTableCellStyle)->addText('NO°', $fancyTableFontStyle);
$table->addCell(3000, $fancyTableCellStyle)->addText('Nombre', $fancyTableFontStyle);
$table->addCell(500, $fancyTableCellStyle)->addText('', $fancyTableFontStyle);
$table->addCell(500, $fancyTableCellStyle)->addText('', $fancyTableFontStyle);
$table->addCell(500, $fancyTableCellBtlrStyle)->addText('', $fancyTableFontStyle);
$table->addCell(500, $fancyTableCellStyle)->addText('', $fancyTableFontStyle);
$table->addCell(500, $fancyTableCellStyle)->addText('', $fancyTableFontStyle);
$table->addCell(500, $fancyTableCellBtlrStyle)->addText('', $fancyTableFontStyle);
$table->addCell(500, $fancyTableCellStyle)->addText('', $fancyTableFontStyle);
$table->addCell(500, $fancyTableCellStyle)->addText('', $fancyTableFontStyle);
$table->addCell(500, $fancyTableCellBtlrStyle)->addText('', $fancyTableFontStyle);
$table->addCell(500, $fancyTableCellStyle)->addText('', $fancyTableFontStyle);
$table->addCell(500, $fancyTableCellStyle)->addText('', $fancyTableFontStyle);
$table->addCell(500, $fancyTableCellBtlrStyle)->addText('', $fancyTableFontStyle);
$table->addCell(500, $fancyTableCellStyle)->addText('', $fancyTableFontStyle);
$table->addCell(500, $fancyTableCellStyle)->addText('', $fancyTableFontStyle);
$table->addCell(500, $fancyTableCellBtlrStyle)->addText('', $fancyTableFontStyle);
$table->addCell(500, $fancyTableCellStyle)->addText('', $fancyTableFontStyle);
$table->addCell(500, $fancyTableCellStyle)->addText('', $fancyTableFontStyle);
$table->addCell(500, $fancyTableCellBtlrStyle)->addText('', $fancyTableFontStyle);
for ($i = 1; $i <= 8; $i++) {
    $table->addRow();
    $table->addCell(300)->addText("");
    $table->addCell(500)->addText("");
    $table->addCell(500)->addText("");
    $table->addCell(500)->addText("");
    $table->addCell(500)->addText("");
    $table->addCell(500)->addText("");
    $table->addCell(500)->addText("");
    $table->addCell(500)->addText("");
    $table->addCell(500)->addText("");
    $table->addCell(500)->addText("");
    $table->addCell(500)->addText("");
    $table->addCell(500)->addText("");
    $table->addCell(500)->addText("");
    $table->addCell(500)->addText("");
    $table->addCell(500)->addText("");
    $table->addCell(500)->addText("");
    $table->addCell(500)->addText("");
    $table->addCell(500)->addText("");
    $table->addCell(500)->addText("");
    $text = (0 == $i % 2) ? '' : '';
    $table->addCell(50000)->addText($text);
}
/* Note: any element you append to a document must reside inside of a Section. */

// Adding an empty Section to the document...
$section = $phpWord->addSection();
// Adding Text element to the Section having font styled by default...
$section->addText(
    'Esto es una prueba de impresion de texto'
);

/*
 * Note: it's possible to customize font style of the Text element you add in three ways:
 * - inline;
 * - using named font style (new font style object will be implicitly created);
 * - using explicitly created font style object.
 */

// Adding Text element with font customized inline...
$section->addText(
    'Esto es una prueba de impresion de texto',
    array('name' => 'Tahoma', 'size' => 10)
);

// Adding Text element with font customized using named font style...
$fontStyleName = 'oneUserDefinedStyle';
$phpWord->addFontStyle(
    $fontStyleName,
    array('name' => 'Tahoma', 'size' => 10, 'color' => '1B2232', 'bold' => true)
);
$section->addText(
    'Esto es una prueba de impresion de texto',
    $fontStyleName
);

// Adding Text element with font customized using explicitly created font style object...
$fontStyle = new \PhpOffice\PhpWord\Style\Font();
$fontStyle->setBold(true);
$fontStyle->setName('Tahoma');
$fontStyle->setSize(13);
$myTextElement = $section->addText('"Esto es una prueba de impresion de texto\'Esto es otra prueba de impresion de texto.');
$myTextElement->setFontStyle($fontStyle);

// Saving the document as OOXML file...
$objWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord, 'Word2007');
$objWriter->save('Kardex.docx');

// Saving the document as ODF file...
$objWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord, 'ODText');
$objWriter->save('Kardex.odt');

// Saving the document as HTML file...
$objWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord, 'HTML');

return response()->download('Kardex.docx');

/* Note: we skip RTF, because it's not XML-based and requires a different example. */
/* Note: we skip PDF, because "HTML-to-PDF" approach is used to create PDF documents. */
    }
}
