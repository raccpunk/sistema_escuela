<?php

use App\Http\Controllers\word_pruebaController;
use App\Http\Controllers\CalificacionesController;
use Illuminate\Support\Facades\Route;
use League\CommonMark\Block\Element\Document;
use PhpOffice\PhpSpreadsheet\Worksheet\Row;
use SebastianBergmann\Template\Template;


Route::get('/', function () {
    return view('welcome');
});
Route::get('/AprovechamientoEsc', function () {
    return view('AprovechamientoEsc');
});
Route::get('/Docentes', function () {
    return view('PlantillaDocente');
});

$path = 'App\\Http\\Controllers\\';
Route::get('/menu', function () {
    return view('layout');
});
Route::get('/Calificaciones', [CalificacionesController::class,'index']);
Route::post('/Calificaciones', [CalificacionesController::class,'post']);
//--------------------------------------
//ROUTES Documentos
//--------------------------------------
// Route::post('/kardex' );
//Route de Plantilla Docente
Route::get('/docentes', 'App\Http\Controllers\DocwordController@docenteword');
Route::get('/personal', 'App\Http\Controllers\DocwordController@personalword');
//Route de kardex
Route::get('/PlantillaDocenteDoc', 'App\Http\Controllers\PlantillaDocenteDocController@PlantillaDocenteword');

Route::get('/Kardexprimero/{alumno}/{grado}/{grupo}/{ciclo_escolar}/', 'App\Http\Controllers\KardexController@KardexPrimeroDocword');
Route::get('/Kardex/{grado}/{grupo}/{ciclo_escolar}/', 'App\Http\Controllers\KardexController@GetAlumnosGrupo');
Route::get('/Kardexsegundo/{alumno}/{grado}/{grupo}/{ciclo_escolar}/', 'App\Http\Controllers\KardexController@KardexSegundoDocword');
Route::get('/Kardextercero/{alumno}/{grado}/{grupo}/{ciclo_escolar}/', 'App\Http\Controllers\KardexController@KardexTerceroDocword');
// Route::get('/Kardex', 'App\Http\Controllers\KardexController@index');

// Route::post('/KardexSegundo', 'App\Http\Controllers\KardexSegundoDocController@KardexSegundoDocword');

// Route::post('/KardexTercero', 'App\Http\Controllers\KardexTerceroDocController@KardexTerceroDocword');

Route::resource('alumno', $path . 'AlumnoController');
// Route::resource('Calificaciones', $path . 'CalificacionesController');

Route::resource('asignaturas', $path .'AsignaturasController');








Route::resource('calificaciones_periodo',$path.'calificaciones_periodoController');
