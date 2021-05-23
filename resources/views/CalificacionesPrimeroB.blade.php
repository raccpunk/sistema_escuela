@extends('layout')
@section('content')
    <div class="modal-body" style="padding:100px; margin-left: 8em;">
        <h1>Kardex Primer Grado Grupo B</h1>
        <form action='{{ url('KardexPrimero') }}' method='POST'>
            @csrf
            <div class="form-group">
                <div class="form-group">
                    <br>
                    <p> seleccona un alumno</p>
                    <select class="form-control" name="alumno_id" class="form-control">
                        @foreach ($primero as $item)
                            <option value='{{ $item->id }}'>
                                {{ $item->apellido_paterno . ' ' . $item->apellido_materno . ' ' . $item->nombres }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="modal-footer">
                <button type="sumbit" class="btn btn-success btn-lg btn-block"><i class="fa fa-floppy-o"></i>
                    Descargar</button>
            </div>
        </form>

    </div>
@section('scripts')
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
@endsection
@endsection
