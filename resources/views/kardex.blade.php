@extends('layout')
{{-- <link rel="dns-prefetch" href="//fonts.gstatic.com">
<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.1/css/bootstrap.min.css"  rel="stylesheet">
<div class="card-header">Kardex</div>
<ul class="navbar-nav ml-auto">
<div class="card-body">
    <blockquote class="blockquote">
        <p>Descarga del Kardex de estudio conforme al formato SEP.</p>
</div>
<div class="container"> --}}
@section('content')
    <div class="row">
      <div class="col text-center">
<a href="{{url('/KardexPrimero')}}" class="btn btn-success ">Descargar Kardex de primero grado</a>

<a href="{{url('/KardexSegundo')}}" class="btn btn-success ">Descargar Kardex de segundo grado</a>
<a href="{{url('/KardexTercero')}}" class="btn btn-success ">Descargar Kardex de tercer grado</a>
  <input type="button" class= "btn btn-primary"onclick="history.back()" name="volver atrás" value="volver atrás">
  @endsection
{{-- </div> --}}

