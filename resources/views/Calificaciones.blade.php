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
    </div>
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
            <button class="btn btn-success"><i class="fa fa-download" aria-hidden="true"></i>
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
            var grado = document.getElementById('grados').value;
            var grupo = document.getElementById('grupos').value;
            var ciclo_escolar = document.getElementById('ciclos_escolares').value;
        $('#boleta1').click(function(e) {
            e.preventDefault();
            var button =
                '<th scope="row"><button id="boleta" class="btn btn-primary"><i class="fa fa-file-word-o" aria-hidden="true"></i></button></th>'

            $.ajax({
                type: 'POST',
                url: "{{ url('/Fetch') }}",
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
                            cadena = '<tr>';
                            cadena = cadena + '<th scope="row">' + `${index+1}` + '</th>';
                            cadena = cadena + '<th scope="row">' + obj.nombres + ' ' + obj
                                .apellido_paterno +
                                ' ' + obj.apellido_materno + '</th>';
                            cadena = cadena + button + '</tr>';
                            $("#alumnos").append(cadena);
                        })
                    }
                }
            });

        });
        $("#boleta").click(function() {
            $.ajax({
                type: 'POST',
                url: "{{ url('/Kardex') }}",
                data: {
                    grado: grado,
                    grupo: grupo,
                    ciclo_escolar: ciclo_escolar,
                    alumno: alumno,
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    //Todo: add functionality to download kardex document
                    })
                }
            });
        })

    </script>
@endsection
@endsection
