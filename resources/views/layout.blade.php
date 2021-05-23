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
        #menu * {
            list-style: none;
            color: #ddd;
        }

        #menu li {
            line-height: 180%;
        }

        #menu li a {
            color: #ddd;
            text-decoration: none;
        }

        #menu li a:before {
            content: "\025b8";
            color: #ddd;
            font-size:24px;
            margin-right: 8px;
        }

        #menu input[name="list"] {
            position: absolute;
            left: -1000em;
        }

        #menu label:before {
            content: "\025b8";
            font-size:24px;
            color: #ddd;
            margin-right: 8px;
        }

        #menu input:checked~label:before {
            content: "\025be";
            color: #ddd;

        }

        #menu .interior {
            display: none;
        }

        #menu input:checked~ul {
            display: block;
        }

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
            <li><a href="http://localhost/sistema_escuela/public/menu" type="button" class="Active  "><i
                        class="fa fa-file-word-o"></i> Documentos de control escolar</button>
            <li><a href="http://localhost/sistema_escuela/public/Docentes">Reporte de plantilla docente</a></li>
            <li>
                <ul id="menu">
                    <li><input type="checkbox" name="list" id="nivel1-1"><label for="nivel1-1" style="margin-left: 0.66em;">Kardex</label>
                        <ul class="interior">
                            <li><input type="checkbox" name="list" id="nivel2-1"><label for="nivel2-1"
                                    style="margin-left: 1.8em;">Primero</label>
                                <ul class="interior">
                                    <li><a href="{{url('/CalificacionesPrimeroA')}}">A</a></li>
                                    <li><a href="{{url('/CalificacionesPrimeroB')}}">B</a></li>
                                </ul>
                            </li>
                            <li><input type="checkbox" name="list" id="nivel2-2"><label for="nivel2-2"
                                    style="margin-left: 1.8em;">Segundo</label>
                                <ul class="interior">
                                    <li><a href="{{url('/CalificacionesSegundoA')}}">A</a></li>
                                    <li><a href="{{url('/CalificacionesSegundoB')}}">B</a></li>
                                </ul>
                            </li>
                            <li><input type="checkbox" name="list" id="nivel2-3"><label for="nivel2-3"
                                    style="margin-left: 1.8em;">Tercero</label>
                                <ul class="interior">
                                    <li><a href="{{url('/CalificacionesTerceroA')}}">A</a></li>
                                    <li><a href="{{url('/CalificacionesTerceroB')}}">B</a></li>
                                </ul>
                            </li>
                        </ul>
                    </li>

                </ul>

            </li>
        </ul>
        </li>
        </ul>
        <div class="container">
            @yield('content')
        </div>
        @yield('scripts')
        <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
    </body>

    </html>
