<!DOCTYPE html>
<html lang="es-mx">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<title>Menu</title>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="dns-prefetch" href="//fonts.gstatic.com">
<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.1/css/bootstrap.min.css"    rel="stylesheet">
<style>
body {
    margin: 0;
}

ul {
    list-style-type: none;
    margin: 0;
    padding: 0;
    width: 19%;
    background-color: #056897;
    position: fixed;
    height: 100%;
    overflow: auto;
}

li a {
    display: block;
    color: #ffffff;
    padding: 8px 0 8px 16px;
    text-decoration: none;
}

li a.active {
    background-color: #144e6a;
    color: white;
}

li a:hover:not(.active) {
    background-color: #f7d109;
    color: rgb(0, 0, 0);
}
</style>
</head>
<body>
<div class="card-header " >INICIO</div>
<ul class="navbar-nav ml-auto">
  <li><a href="{{url('/menu')}}"type="button" class="Active  "><i class="fa fa-file-word-o"></i>  Documentos de control escolar</button>
  <li><a href="{{url('/Calificaciones')}}">Kardex</a></li>
  <li><a href="{{url('/Docentes')}}">Reporte de plantilla docente</a></li>
</ul>
    @yield('content')
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>