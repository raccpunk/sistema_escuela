<?php

namespace App\Http\Controllers;

use App\Models\docword;
use Illuminate\Http\Request;
use App\Models\Personal;
use App\Models\Puestos;
use App\Models\Grados;
use App\Models\Grupos;
use App\Models\Asignatura;
use App\Models\Clases;

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
    public function ejemploword()
    {

        $phpWord = new \PhpOffice\PhpWord\PhpWord();
        $section = $phpWord->addSection();
        $header = array('size' => 14, 'bold' => true);
        $sources = file_get_contents('C:\xampp\htdocs\sistema_escuela\app\img\membrete.jpg');
        $section->addImage(
            $sources,
            array(
                'width'         => 100,
                'height'        => 100,
                'marginTop'     => -1,
                'marginLeft'    => -1,
                'wrappingStyle' => 'behind'
            )
        );
        $section->addTextBreak(1);
        $section->addText('DIRRECCIÓN GENERAL DE EDUCACIÓN BÁSICA', $header);
        $section = $phpWord->addSection(array('orientation' => 'landscape'));

        $fancyTableStyleName = 'Prueba Con Tablas';
        $fancyTableStyle = array('borderSize' => 1, 'borderColor' => 'a9acb4', 'cellMargin' => 0, 'alignment' => \PhpOffice\PhpWord\SimpleType\JcTable::CENTER, 'cellSpacing' => 0);
        $fancyTableFirstRowStyle = array('borderBottomSize' => 2, 'borderBottomColor' => '0000FF', 'bgColor' => 'ecdcb4');
        $fancyTableCellStyle = array('valign' => 'center');
        $fancyTableFontStyle = array('bold' => true);
        $phpWord->addTableStyle($fancyTableStyleName, $fancyTableStyle, $fancyTableFirstRowStyle);
        $table = $section->addTable($fancyTableStyleName);
        $table->addRow(300);
        $table->addCell(300, $fancyTableCellStyle)->addText('NO.', $fancyTableFontStyle);
        $table->addCell(1000, $fancyTableCellStyle)->addText('RFC', $fancyTableFontStyle);
        $table->addCell(15000, $fancyTableCellStyle)->addText('NOMBRES Y APELLIDOS', $fancyTableFontStyle);
        $table->addCell(5000, $fancyTableCellStyle)->addText('FUNCIÓN', $fancyTableFontStyle);
        $table->addCell(5000, $fancyTableCellStyle)->addText('LICENCIATURA', $fancyTableFontStyle);
        $table->addCell(5000, $fancyTableCellStyle)->addText('ASIGNATURA', $fancyTableFontStyle);
        $table->addCell(5000, $fancyTableCellStyle)->addText('Gdo y Gpo.', $fancyTableFontStyle);
        $table->addCell(10000, $fancyTableCellStyle)->addText('FORMACIÓN ACADÉMICA', $fancyTableFontStyle);
        $table->addCell(6000, $fancyTableCellStyle)->addText('OBSERVACIONES', $fancyTableFontStyle);
        $Personas = Personal::where('puesto_id', '=',3)->get();

        foreach ($Personas as $Persona) {
            $puesto = Puestos::find($Persona->puesto_id);
            $clases = clases::where('maestro_id', '=', $Persona->id)->get();
            $table->addRow();
            $table->addCell(300)->addText($Persona->id);
            $table->addCell(300)->addText($Persona->RFC);
            $table->addCell(500)->addText($Persona->nombres . ' ' . $Persona->apellidos);
            $table->addCell(500)->addText($puesto->funcion);
            $table->addCell(500)->addText($Persona->licenciatura);
            $asignatura = $table->addCell(500);
            $gradoGrupo = $table->addCell(500);
            foreach ($clases as $clase) {
                $grado = Grados::find($clase->grado_id);
                $grupo = Grupos::find($clase->grupo_id);
                $Asignaturas = Asignatura::find($clase->asignatura_id);
                $asignatura->addText($Asignaturas->nombre);
                $gradoGrupo->addText($grado->nombre_corto . $grupo->nombre);
            }
            $table->addCell(500)->addText($Persona->formacion);
            $table->addCell(500)->addText($Persona->observaciones);
        }

        // Saving the document as OOXML file...
        $objWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord, 'Word2007');
        $objWriter->save('Kardex.docx');

        // Saving the document as ODF file...
        $objWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord, 'ODText');
        $objWriter->save('Kardex.odt');

        // Saving the document as HTML file...
        $objWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord, 'HTML');

        return response()->download('Kardex.docx');
    }
}
