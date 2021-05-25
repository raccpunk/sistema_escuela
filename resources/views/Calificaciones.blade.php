@extends('layout')
@section('content')
    <style>
        select.form-control {
            display: inline-block
        }

        body {
            background-color: #cacfdc;
        }

    </style>

    <div class="row">
        <div class="float-right col-12" style=" background-color: #ecedf2;position:fixed;margin-top:3.1em;margin-left: 5.9em;padding-bottom: 8px;">
            <h6 style="text-align: left">GENERADOR DE BOLETAS DE CALIFICACIONES</h6>
        </div>
    </div>
    <div class="card"  style="width: 100%; margin-left: 6.5em; margin-top:6em;position:relative;">
        <div class="card-title bg-light text-dark">
            <p><i class="fa fa-cog" aria-hidden="true" style="margin-left:5px; margin-right: 5px;"></i>Opciones</p>
        </div>
        <div class="card-body">
            <form action='{{ url('FetchAlumnos') }}' method='POST'>
                @csrf
                <div class="form-group">
                    <label for="grados">GRADO</label>
                    <select class="form-inline form-control col-md-2" name="grado" id="grados">
                        @foreach ($grados as $item)
                            <option value='{{ $item->id }}'>
                                {{ $item->nombre_largo }}
                            </option>
                        @endforeach
                    </select>
                    <label for="grupos">GRUPO</label>
                    <select class="form-inline form-control col-md-2" name="grado" id="grupos">
                        @foreach ($grupos as $item)
                            <option value='{{ $item->id }}'>
                                {{ $item->nombre }}
                            </option>
                        @endforeach
                    </select>
                    <label for="ciclos_escolares">CICLO ESCOLAR</label>
                    <select class="form-inline form-control col-md-4" name="ciclo_escolar" id="ciclos_escolares">
                        @foreach ($ciclo_escolar as $item)
                            <option value='{{ $item->id }}'>
                                {{ $item->nombre }}
                            </option>
                        @endforeach
                    </select>
                </div>
                {{-- <button class="btn btn-success"><i class="fa fa-download" aria-hidden="true"></i>
                Descargar</button> --}}
            </form>

        </div>
    </div>
@section('scripts')
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
@endsection
@endsection
