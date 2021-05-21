<!DOCTYPE html>
<html>
  <head>
	<title></title>
  </head>
 <body>
    <header style="background-color: #303030; height: 80px;width: 100%">
	<h1 style="font-size: 30px; color: white;text-align: center; padding-top: 15px;"></h1>
   </header>
 </body>
</html>

@extends('layout')
@section('content')

<head>

<style>

body {
	font-family: 'Varela Round', sans-serif;
}
.modal-confirm {
	color: #636363;
	width: 325px;
	font-size: 14px;
}
.modal-confirm .modal-content {
	padding: 20px;
	border-radius: 5px;
	border: none;
}
.modal-confirm .modal-header {
	border-bottom: none;
	position: relative;
}
.modal-confirm h4 {
	text-align: center;
	font-size: 26px;
	margin: 30px 0 -15px;
}
.modal-confirm .form-control, .modal-confirm .btn {
	min-height: 40px;
	border-radius: 3px;
}
.modal-confirm .close {
	position: absolute;
	top: -5px;
	right: -5px;
}
.modal-confirm .modal-footer {
	border: none;
	text-align: center;
	border-radius: 5px;
	font-size: 13px;
}
.modal-confirm .icon-box {
	color: #fff;
	position: absolute;
	margin: 0 auto;
	left: 0;
	right: 0;
	top: -70px;
	width: 95px;
	height: 95px;
	border-radius: 50%;
	z-index: 9;
	background: #82ce34;
	padding: 15px;
	text-align: center;
	box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.1);
}
.modal-confirm .icon-box i {
	font-size: 58px;
	position: relative;
	top: 3px;
}
.modal-confirm.modal-dialog {
	margin-top: 80px;
}
.modal-confirm .btn {
	color: #fff;
	border-radius: 4px;
	background: #82ce34;
	text-decoration: none;
	transition: all 0.4s;
	line-height: normal;
	border: none;
}
.modal-confirm .btn:hover, .modal-confirm .btn:focus {
	background: #6fb32b;
	outline: none;
}
.trigger-btn {
	display: inline-block;
	margin: 100px auto;
}
</style>

</head>

<body>
<div class="text-center" style="padding:200px;">
    <h1>Plantilla Docente</h1>
    <p>Seleccionar Documento</p>
<select name="plantilla" id="plantilla">
    <option value="">seleccionar</option>
    <option value="{{url('/docentes')}}" >Reporte de plantilla docente</option>
	<option value="{{url('/personal')}}">Reporte de plantilla de personal. </option>
</select>

<hr />

	<button onclick="ShowSelected()"  data-toggle="modal" type="button" data-toggle="modal"href="#myModal" class="btn btn-outline-success"><i class="fa fa-floppy-o"></i> Descargar</button>
</div>

<!-- Modal HTML -->
<div id="myModal" class="modal fade">
	<div class="modal-dialog modal-confirm">
		<div class="modal-content">
			<div class="modal-header">
				<div class="icon-box">
					<i class="material-icons">&#xE876;</i>
				</div>
				<h4 class="modal-title w-100">Exito al descargar documento !</h4>
			</div>
			<div class="modal-body">
				<p class="text-center">Tu documento fue descargado de manera correcta </p>
			</div>
			<div class="modal-footer">
				<button class="btn btn-success btn-block" data-dismiss="modal" >OK</button>
			</div>
		</div>
	</div>
</div>
</body>
</html>
<script type="text/javascript">
    function ShowSelected()
    {
        var combo = document.getElementById("plantilla");
        var selected = combo.selectedIndex;
    if(selected!=0){
    /* Para obtener el valor */
    var cod = combo.value;
    window.location.href = cod;
    }
    // /* Para obtener el texto */
    // var combo = document.getElementById("plantilla");
    // var selected = combo.options[combo.selectedIndex].text;
    // alert(selected);
    }
</script>
@endsection
