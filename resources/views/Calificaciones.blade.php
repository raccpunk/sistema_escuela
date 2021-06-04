@extends('layout')
@section('content')
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <style>
        select.form-control {
            /* display: inline-block; */
            /* margin-left: 15px; */
            margin-right: 25px;
        }

        body {
            background-color: #cacfdc;
        }

    </style>

    <div class="row">
        <div class="float-right col-12"
            style=" background-color: #ecedf2;position:fixed;margin-top:3.1em;margin-left: 6.3em;padding-bottom: 8px;">
            <h6 style="padding-left:11px;text-align: left;">GENERADOR DE BOLETAS DE CALIFICACIONES</h6>
        </div>
    </div>6
    <div class="card" style="width: 100%; margin-left: 6.5em; margin-top:6em;position:relative;">
        <div class="card-title bg-light text-dark">
            <p><i class="fa fa-cog" aria-hidden="true" style="margin-left:5px; margin-right: 5px;"></i>Opciones</p>
        </div>
        <div class="card-body">
            <div class="form-group">
                <div class="row">
                    <label class="col-sm-4 control-label" for="grados">GRADO</label>
                    <label class="col-sm-4 control-label" for="grupos">GRUPO</label>
                    <label class="col-sm-4 control-label" for="ciclos_escolares">CICLO ESCOLAR</label>
                </div>
                <div class="row">
                    <select class="form-inline form-control col-md-3" name="grado" id="grados">
                        @foreach ($grados as $item)
                            <option value='{{ $item->id }}'>
                                {{ $item->nombre_largo }}
                            </option>
                        @endforeach
                    </select>
                    <select class="form-inline form-control col-md-3" name="grupo" id="grupos">
                        @foreach ($grupos as $item)
                            <option value='{{ $item->id }}'>
                                {{ $item->nombre }}
                            </option>
                        @endforeach
                    </select>
                    <select class="form-inline form-control col-md-4" name="ciclo_escolar" id="ciclos_escolares">
                        @foreach ($ciclo_escolar as $item)
                            <option value='{{ $item->id }}'>
                                {{ $item->nombre }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>
            <button id="boleta1" class="btn btn-success"><i class="fa fa-download" aria-hidden="true"></i>
                Descargar Una Boleta Especifíca</button>
            <button id="boletas" class="btn btn-success"><i class="fa fa-download" aria-hidden="true"></i>
                Descargar Todas Las Boletas</button>
            <br>
            <br>
            <br>
            <div class="table-responsive">
                <table id="alumnos" class="table table-striped">
                    <caption>Lista de Alumnos</caption>
                    <thead class="thead-light">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Alumno</th>
                            <th scope="col">Descargar Boleta</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th scope="row"></th>
                            <th scope="row"></th>
                            <th scope="row"></th>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@section('scripts')
    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk="
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
    <script type="text/javascript">
        $('#boleta1').click(function(e) {
            e.preventDefault();
            var grado = document.getElementById('grados').value;
            var grupo = document.getElementById('grupos').value;
            var ciclo_escolar = document.getElementById('ciclos_escolares').value;
            $.ajax({
                type: 'POST',
                url: "{{ url('/Calificaciones') }}",
                data: {
                    grado: grado,
                    grupo: grupo,
                    ciclo_escolar: ciclo_escolar,
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    if (response !== null) {
                        $('#alumnos tbody tr').remove();
                        var cadena;
                        $.each(response, function(index, obj) {
                            let alumno = obj.id;
                            cadena = '<tr>';
                            cadena = cadena + '<td scope="row">' + `${index+1}` + '</td>';
                            cadena = cadena + '<td scope="row">' + obj.apellido_paterno +
                                ' ' + obj.apellido_materno + ' ' + obj.nombres + '</td>';
                            cadena = cadena + '<td>' +
                                '<button id="boleta" class="btn btn-primary" onclick="archivo(' +
                                alumno +
                                ')"><i class="fa fa-file-word-o" aria-hidden="true"></i> Descargar</button></td>';
                            $("#alumnos").append(cadena);
                        })

                    }
                }
            });

        });



        function archivo(alumno) {
            var grado = document.getElementById('grados').value;
            var grupo = document.getElementById('grupos').value;
            var ciclo_escolar = document.getElementById('ciclos_escolares').value;
            if (grado == 1) {
                var url = 'http://'+window.location.host+`/sistema_escuela/public/Kardexprimero/${alumno}/${grado}/${grupo}/${ciclo_escolar}/`
                window.open(url);
            } else if (grado == 2) {
                var url = 'http://'+window.location.host+`/sistema_escuela/public/Kardexsegundo/${alumno}/${grado}/${grupo}/${ciclo_escolar}/`
                window.open(url);
            } else if (grado == 3) {
                var url = 'http://'+window.location.host+`/sistema_escuela/public/Kardextercero/${alumno}/${grado}/${grupo}/${ciclo_escolar}/`
                window.open(url);
            }
        }
        $("#boletas").click(function (){
            var grado = document.getElementById('grados').value;
            var grupo = document.getElementById('grupos').value;
            var ciclo_escolar = document.getElementById('ciclos_escolares').value;
            var url = 'http://'+window.location.host+`/sistema_escuela/public/Kardex/${grado}/${grupo}/${ciclo_escolar}/`
            window.open(url);
        });

    </script>
@endsection
@endsection
