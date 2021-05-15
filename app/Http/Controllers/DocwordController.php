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
    public function docenteword()
    {

        $phpWord = new \PhpOffice\PhpWord\PhpWord();


        $section = $phpWord->addSection(array('orientation' => 'landscape'));
        $fontStyleName = 'oneUserDefinedStyle';
        $phpWord->addFontStyle(
            $fontStyleName,
            array('name' => 'Tahoma', 'size' => 10, 'color' => '1B2232', 'bold' => true)
        );
        $header = array('size' => 14, 'bold' => true);
        $nature = array('size' => 9, 'bold' => true);
        $nature2 = array('size' => 9, 'bold' => false);
        $sources = file_get_contents('C:\xampp\htdocs\sistema_escuela\app\img\membrete.jpg');


        $section->addImage(

            $sources,
            array(
                'width'         => 165,
                'height'        => 75,
                'marginTop'     => 50,
                'marginLeft'    => 90,
                'wrappingStyle' => 'behind',
                'positioning' => 'absolute',

            )
            );

        //$section->addTextBreak(1);
        $section->addText('                                                        DIRRECCIÓN GENERAL DE EDUCACIÓN BÁSICA', $header);
        $section->addText('                                                        DEPARTAMENTO DE ESCUELAS PARTICULARES', $header);
        $section->addText('                                                                                                  Plantilla de personal de nivel secundaria',$fontStyleName,);
        $section->addText('                                                                                                           CICLO ESCOLAR: 2020-2021',$fontStyleName);
        $section->addText('                                                                                                                                                                                                                                   FECHA: 28/09/2020',$nature2);
        $section->addText('Centro de trabajo: FRAY DIEGO DE LANDA                                                            C.C.T.: 31PES0079A                                   TURNO: MATUTINO');
        $section->addText('Área: 02   LOCALIDAD: HUNUCMA                                                                    MUNICIPIO:HUNUCMA                               TELEFONO DE CT: 98893110737');
        $section->addText('CORREO ELECTRONICO DEL CT: fray_diego69@hotmail.com                 NO° ACUERDO 208                                              FECHA ACUERDO 29/07/199');
        $section->addText('REPRESENTANTE LEGAL: R̲O̲L̲A̲N̲D̲O̲_̲J̲A̲V̲I̲E̲R̲ Q̲U̲I̲N̲T̲A̲L̲_̲C̲A̲S̲T̲I̲L̲L̲A̲_̲_̲_̲_̲_̲_̲_̲_                                 CELULAR DEL REPRESENTANTE:9999000667');
        $section->addText('                                                                                                                                                                                 CELULAR DIRECTOR:9995530999');
        $section->addText('Plantilla de docentes.',$nature);



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
        $objWriter->save('PlantillaDocente.docx');

        // Saving the document as ODF file...
        $objWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord, 'ODText');
        $objWriter->save('PlantillaDocente.odt');

        // Saving the document as HTML file...
        $objWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord, 'HTML');

        return response()->download('PlantillaDocente.docx');
    }
    public function personalword()
    {

        $phpWord = new \PhpOffice\PhpWord\PhpWord();


        $section = $phpWord->addSection(array('orientation' => 'landscape'));
        $fontStyleName = 'oneUserDefinedStyle';
        $phpWord->addFontStyle(
            $fontStyleName,
            array('name' => 'Tahoma', 'size' => 10, 'color' => '1B2232', 'bold' => true)
        );
        $header = array('size' => 14, 'bold' => true);
        $nature = array('size' => 9, 'bold' => true);
        $nature2 = array('size' => 9, 'bold' => false);
        $sources = file_get_contents('C:\xampp\htdocs\sistema_escuela\app\img\membrete.jpg');


        $section->addImage(

            $sources,
            array(
                'width'         => 165,
                'height'        => 75,
                'marginTop'     => 50,
                'marginLeft'    => 90,
                'wrappingStyle' => 'behind',
                'positioning' => 'absolute',

            )
            );

        //$section->addTextBreak(1);
        $section->addText('                                                        DIRRECCIÓN GENERAL DE EDUCACIÓN BÁSICA', $header);
        $section->addText('                                                        DEPARTAMENTO DE ESCUELAS PARTICULARES', $header);
        $section->addText('                                                                                                  Plantilla de personal de nivel secundaria',$fontStyleName,);
        $section->addText('                                                                                                           CICLO ESCOLAR: 2020-2021',$fontStyleName);
        $section->addText('                                                                                                                                                                                                                                   FECHA: 28/09/2020',$nature2);
        $section->addText('Centro de trabajo: FRAY DIEGO DE LANDA                                                            C.C.T.: 31PES0079A                                   TURNO: MATUTINO');
        $section->addText('Área: 02   LOCALIDAD: HUNUCMA                                                                    MUNICIPIO:HUNUCMA                               TELEFONO DE CT: 98893110737');
        $section->addText('CORREO ELECTRONICO DEL CT: fray_diego69@hotmail.com                 NO° ACUERDO 208                                              FECHA ACUERDO 29/07/199');
        $section->addText('REPRESENTANTE LEGAL: R̲O̲L̲A̲N̲D̲O̲_̲J̲A̲V̲I̲E̲R̲ Q̲U̲I̲N̲T̲A̲L̲_̲C̲A̲S̲T̲I̲L̲L̲A̲_̲_̲_̲_̲_̲_̲_̲_                                 CELULAR DEL REPRESENTANTE:9999000667');
        $section->addText('                                                                                                                                                                                 CELULAR DIRECTOR:9995530999');
        $section->addText('Plantilla de personal.',$nature);



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
        $Personas = Personal::where('puesto_id', '!=',3)->get();

        foreach ($Personas as $Persona) {
            $puesto = Puestos::find($Persona->puesto_id);
            $table->addRow();
            $table->addCell(300)->addText($Persona->id);
            $table->addCell(300)->addText($Persona->RFC);
            $table->addCell(500)->addText($Persona->nombres . ' ' . $Persona->apellidos);
            $table->addCell(500)->addText($puesto->funcion);
            $table->addCell(500)->addText($Persona->licenciatura);
            $table->addCell(500)->addText(' ');
            $table->addCell(500)->addText(' ');
            $table->addCell(500)->addText($Persona->formacion);
            $table->addCell(500)->addText($Persona->observaciones);

        }

        // Saving the document as OOXML file...
        $objWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord, 'Word2007');
        $objWriter->save('PlantillaDocente.docx');

        // Saving the document as ODF file...
        $objWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord, 'ODText');
        $objWriter->save('PlantillaDocente.odt');

        // Saving the document as HTML file...
        $objWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord, 'HTML');

        return response()->download('PlantillaPersonal.docx');
    }
}
