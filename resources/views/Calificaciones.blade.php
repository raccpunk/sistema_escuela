@extends('layout')
@section('content')
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
            <form action='{{ url('Fetch') }}' method='POST'>
                @csrf
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
                <button class="btn btn-success"><i class="fa fa-download" aria-hidden="true"></i>
                    Descargar Una Boleta Especifíca</button>
                <button class="btn btn-success"><i class="fa fa-download" aria-hidden="true"></i>
                    Descargar Todas Las Boletas</button>
            </form>
            <br>
            <div class="table-responsive">
                <table class="table table-striped">
                    <caption>Lista de Alumnos</caption>
                    <thead class="thead-light">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Alumno</th>
                            <th scope="col">Descargar Boleta</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($alumnos as $alumno)
                            <tr>
                                <th scope="row">{{ array_search($alumno, $alumnos) + 1 }}</th>
                                <th scope="row">
                                    {{ $alumno->nombres . ' ' . $alumno->apellido_paterno . ' ' . $alumno->apellido_materno }}
                                </th>
                                <th scope="row">
                                    <form action="{{url('KardexPrimero')}}" method="post">
                                        <input type="hidden" name="alumno_id" value="{{$alumno->id}}">
                                        <input type="hidden" name="grupo_id" value="{{$alumno->id}}">
                                        <input type="hidden" name="grado_id" value="{{$alumno->id}}">
                                        <input type="hidden" name="ciclo_escolar_id" value="{{$alumno->id}}">
                                    <button class="btn btn-primary" type="submit">
                                        <i class="fa fa-file-word-o" aria-hidden="true">

                                        </i>
                                        </button>
                                    </form>
                                </th>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@section('scripts')
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
@endsection
@endsection
