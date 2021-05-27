<?php

use App\Http\Controllers\word_pruebaController;
use App\Http\Controllers\CalificacionesController;
use Illuminate\Support\Facades\Route;
use League\CommonMark\Block\Element\Document;
use SebastianBergmann\Template\Template;


Route::get('/', function () {
    return view('welcome');
});
Route::get('/kardex', function () {
    return view('kardex');
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
Route::post('/Fetch', [CalificacionesController::class,'post']);
//--------------------------------------
//ROUTES Documentos
//--------------------------------------
//Route de la lista de aprovechamiento de los alumnos
Route::get('/AprovechamientoEscDoc', 'App\Http\Controllers\AprovechamientoEscDocController@AprovechamientoEscWord');
//Route de Plantilla Docente
Route::get('/docentes', 'App\Http\Controllers\DocwordController@docenteword');
Route::get('/personal', 'App\Http\Controllers\DocwordController@personalword');
//Route de kardex
Route::get('/PlantillaDocenteDoc', 'App\Http\Controllers\PlantillaDocenteDocController@PlantillaDocenteword');
//Todo: Change the routes to kardex documents
// Route::post('/KardexPrimero', 'App\Http\Controllers\KardexPrimeroDocController@KardexPrimeroDocword');

// Route::post('/KardexSegundo', 'App\Http\Controllers\KardexSegundoDocController@KardexSegundoDocword');

// Route::post('/KardexTercero', 'App\Http\Controllers\KardexTerceroDocController@KardexTerceroDocword');

Route::resource('alumno', $path . 'AlumnoController');
// Route::resource('Calificaciones', $path . 'CalificacionesController');

Route::resource('asignaturas', $path .'AsignaturasController');








Route::resource('calificaciones_periodo',$path.'calificaciones_periodoController');
