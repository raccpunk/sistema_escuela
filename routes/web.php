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
Route::get('/AprovechamientoEsc', function () {
    return view('AprovechamientoEsc');
});
Route::get('/Docentes', function () {
    return view('PlantillaDocente');
});
Route::get('/MenuJefaControlEscolar', function () {
    return view('MenuJefaControlEscolar');
});
Route::get('/menu', function () {
    return view('layout');
});
// Route::get('/Calificaciones', function () {
//     return view('Calificaciones');
// });
$path = 'App\\Http\\Controllers\\';
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

Route::post('/KardexPrimero', 'App\Http\Controllers\KardexPrimeroDocController@KardexPrimeroDocword');

Route::get('/KardexSegundo', 'App\Http\Controllers\KardexSegundoDocController@KardexSegundoDocword');

Route::get('/KardexTercero', 'App\Http\Controllers\KardexTerceroDocController@KardexTerceroDocword');

Route::resource('alumno', $path . 'AlumnoController');
Route::resource('Calificaciones', $path . 'CalificacionesController');

Route::resource('asignaturas', $path .'AsignaturasController');








Route::resource('calificaciones_periodo',$path.'calificaciones_periodoController');
