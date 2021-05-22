<!DOCTYPE html>


<html lang="es-mx">
<head>
<meta charset="utf-8">
<title>Menu</title>
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<style>
    #menu * { list-style:none; color: #ddd}
#menu li{ line-height:180%;}
#menu li a{color:#ddd; text-decoration:none;}
/* don't touch */
/* #menu li a:before{
    font-family: FontAwesome;
    font-style: normal;
    font-weight: normal;
    text-decoration: inherit;
/*--adjust as necessary--
    color: #ddd;
    font-size: 0.75em;
    padding-right: 10px;
    position: absolute;
    top: 10px;
    left: 0;
    content:"\025b8";
    margin-right:4px;
    } */
#menu input[name="list"] {
	position: absolute;
	left: -1000em;
	}
#menu label:before{
    font-family: FontAwesome;
    font-style: normal;
    font-weight: normal;
    text-decoration: inherit;
/*--adjust as necessary--*/
    color: #ddd;
    margin-left: 1.3em;
    font-size: 0.75em;
    padding-right: 10px;
    position: absolute;
    /* top: 25px; */
    left: 0;
    content:"\f067"; margin-right:4px;
}
#menu input:checked ~ label:before{ content:"\f068";}
#menu .interior{display: none;}
#menu input:checked ~ ul{display:block;}
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
    <header style="background-color: #303030; height: 80px;width: 100%">
        <h1 style="font-size: 30px; color: white;text-align: center; padding-top: 15px;"></h1>
       </header>
    @section('sidebar')
<ul class="navbar-nav ml-auto">
  <li><a href="http://localhost/sistema_escuela/public/menu"type="button" class="Active  "><i class="fa fa-file-word-o"></i>  Documentos de control escolar</button>
  <li><a href="http://localhost/sistema_escuela/public/Docentes">Reporte de plantilla docente</a></li>
  <li>

    <ul id="menu">
        <li><input type="checkbox" name="list" id="nivel1-1"><label style="margin-left:1.8em;" for="nivel1-1">Kardex</label>
        <ul class="interior">
              <li><input type="checkbox" name="list"><a href="{{url('/CalificacionesPrimero')}}">Primer Grado</a></li>
              <li><input type="checkbox" name="list"><a href="{{url('/CalificacionesSegundo')}}">Segundo Grado</a></li>
              <li><input type="checkbox" name="list"><a href="{{url('/CalificacionesTercero')}}">Tercer Grado</a></li>
           </ul>
        </li>
        {{-- don't touch --}}
        {{-- <li><input type="checkbox" name="list" id="nivel2-1"><label style="margin:1em;" for="nivel2-1">Kardex</label>
            <ul class="interior">
                  <li><input type="checkbox" name="list"><a>Primeros</a></li>
                  <li><input type="checkbox" name="list"><a>Segundos</a></li>
                  <li><input type="checkbox" name="list"><a>Terceros</a></li>
               </ul>
            </li> --}}
     </ul>
  </li>
</ul>
<div class="container">
    @yield('content')
</div>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
</body>
</html>
