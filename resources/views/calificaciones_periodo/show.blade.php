@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            @include('admin.sidebar')

            <div class="col-md-9">
                <div class="card">
                    <div class="card-header">calificaciones_periodo {{ $calificaciones_periodo->id }}</div>
                    <div class="card-body">

                        <a href="{{ url('/calificaciones_periodo') }}" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                        <a href="{{ url('/calificaciones_periodo/' . $calificaciones_periodo->id . '/edit') }}" title="Edit calificaciones_periodo"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>

                        <form method="POST" action="{{ url('calificaciones_periodo' . '/' . $calificaciones_periodo->id) }}" accept-charset="UTF-8" style="display:inline">
                            {{ method_field('DELETE') }}
                            {{ csrf_field() }}
                            <button type="submit" class="btn btn-danger btn-sm" title="Delete calificaciones_periodo" onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</button>
                        </form>
                        <br/>
                        <br/>

                        <div class="table-responsive">
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <th>ID</th><td>{{ $calificaciones_periodo->id }}</td>
                                    </tr>
                                    <tr><th> CalificacionA: </th><td> {{ $calificaciones_periodo->calificacionA: }} </td></tr><tr><th> CalificacionB </th><td> {{ $calificaciones_periodo->calificacionB }} </td></tr><tr><th> Promedio </th><td> {{ $calificaciones_periodo->promedio }} </td></tr>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
