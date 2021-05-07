<?php

namespace App\Http\Controllers;

use App\Models\PlantillaDocenteDoc;
use Illuminate\Http\Request;

class PlantillaDocenteDocController extends Controller
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
     * @param  \App\Models\PlantillaDocenteDoc  $plantillaDocenteDoc
     * @return \Illuminate\Http\Response
     */
    public function show(PlantillaDocenteDoc $plantillaDocenteDoc)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PlantillaDocenteDoc  $plantillaDocenteDoc
     * @return \Illuminate\Http\Response
     */
    public function edit(PlantillaDocenteDoc $plantillaDocenteDoc)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\PlantillaDocenteDoc  $plantillaDocenteDoc
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PlantillaDocenteDoc $plantillaDocenteDoc)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PlantillaDocenteDoc  $plantillaDocenteDoc
     * @return \Illuminate\Http\Response
     */
    public function destroy(PlantillaDocenteDoc $plantillaDocenteDoc)
    {
        //
    }
    public function PlantillaDocenteWord(){
        // Creating the new document...
$phpWord = new \PhpOffice\PhpWord\PhpWord();

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
$objWriter->save('PlantillaDocente.docx');

// Saving the document as ODF file...
$objWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord, 'ODText');
$objWriter->save('PlantillaDocente.odt');

// Saving the document as HTML file...
$objWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord, 'HTML');

return response()->download('PlantillaDocente.docx');

/* Note: we skip RTF, because it's not XML-based and requires a different example. */
/* Note: we skip PDF, because "HTML-to-PDF" approach is used to create PDF documents. */
    }
}