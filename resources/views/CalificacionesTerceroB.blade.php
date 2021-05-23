@extends('layout')
@section('content')
<div class="modal-body" style="padding:100px; margin-left: 8em;">
<form action='{{ url('KardexTercero')}}' method='POST'>
    @csrf
    <div class="form-group">
        <h1>Kardex Tercer Grado Grupo B</h1>
        <br>
        <p>Seleccionar Alumno</p>
        <div class="form-group">
            <select class="form-control" name="alumno_id">
                @foreach($tercero as $item)
                <option value='{{$item->id}}'>{{$item->apellido_paterno .' ' . $item->apellido_materno. ' ' .$item->nombres}}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="modal-footer">
        {{-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button> --}}
        <button type="sumbit"  class="btn btn-success btn-lg btn-block"><i class="fa fa-floppy-o"></i> Descargar</button>
    </div>
</form>
</div>
@endsection