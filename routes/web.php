<?php

use App\Http\Controllers\word_pruebaController;
use Illuminate\Support\Facades\Route;
use League\CommonMark\Block\Element\Document;
use SebastianBergmann\Template\Template;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
Route::get('/kardex', function () {
    return view('kardex');
});
Route::get('/BajaAlumno', function () {
    return view('alumnos/BajaAlumno');
});
Route::get('/AprovechamientoEsc', function () {
    return view('AprovechamientoEsc');
});
Route::get('/ListaAsistencia', function () {
    return view('ListaAsistencia');
});
Route::get('/InfoAlumno', function () {
    return view('InfoAlumno');
});
Route::get('/PlantillaDocente', function () {
    return view('PlantillaDocente');
});
Route::get('/MenuJefaControlEscolar', function () {
    return view('MenuJefaControlEscolar');
});
Route::get('/MenuJefaControlEscolar', function () {
    return view('MenuJefaControlEscolar');
});
$path = 'App\\Http\\Controllers\\';
//--------------------------------------
//ROUTES Documentos
//--------------------------------------
//Route de la lista de asistencia
Route::get('/ListaAsistenciaDoc', $path . 'ListaAsistenciaDocController@ListaAsistenciaWord');
//Route de la informacion de los alumnos
Route::get('/InfoAlumnoDoc', 'App\Http\Controllers\InfoAlumnoDocController@InfoAlumnoWord');
//Route de la lista de los documentos de baja para los alumnos
Route::get('/BajaAlumnosDoc', 'App\Http\Controllers\BajaAlumnoDocController@BajaAlumnoWord');
//Route de la lista de aprovechamiento de los alumnos
Route::get('/AprovechamientoEscDoc', 'App\Http\Controllers\AprovechamientoEscDocController@AprovechamientoEscWord');
//Route de kardex
Route::get('/ejemplo', 'App\Http\Controllers\DocwordController@ejemploword');
//Route de kardex
Route::get('/PlantillaDocenteDoc', 'App\Http\Controllers\PlantillaDocenteDocController@PlantillaDocenteword');



Route::resource('alumno', $path . 'AlumnoController');
