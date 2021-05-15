<link rel="dns-prefetch" href="//fonts.gstatic.com">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"
    integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
<div class="card-header">Calificaiones</div>
<ul class="navbar-nav ml-auto">
    <div class="card-body">
        <blockquote class="blockquote">
            <p>Boletas de calificaciones.</p>
    </div>
    <div class="container">
        <div class="row">
            <div class="col text-center">
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#primeros"
                    data-whatever="@mdo">Primeros Grados</button>
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#segundos"
                    data-whatever="@mdo">Segundos Grados</button><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#terceros"
                    data-whatever="@mdo">Terceros Grados</button>
                <input type="button" class="btn btn-primary" onclick="history.back()" name="volver atrás"
                    value="volver atrás">
            </div>
        </div>
        <div class="modal fade" id="primeros" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">New message</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action='{{ url('KardexPrimero')}}' method='POST'>
                        @csrf
                        <div class="form-group">
                            <div class="form-group">
                                <select class="form-control" name="alumno_id">
                                    @foreach($primero as $item)
                                    <option value='{{$item->id}}'>{{$item->nombres . ' ' . $item->apellido_paterno .' ' . $item->apellido_materno}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="sumbit"  class="btn btn-primary">Descargar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="segundos" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">New message</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action='{{ url('KardexSegundo')}}' method='POST'>
                        @csrf
                        <div class="form-group">
                            <div class="form-group">
                                <select class="form-control" name="alumno_id">
                                    @foreach($segundo as $item)
                                    <option value='{{$item->id}}'>{{$item->nombres . ' ' . $item->apellido_paterno .' ' . $item->apellido_materno}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="sumbit"  class="btn btn-primary">Descargar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="terceros" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">New message</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action='{{ url('KardexTercero')}}' method='POST'>
                        @csrf
                        <div class="form-group">
                            <div class="form-group">
                                <select class="form-control" name="alumno_id">
                                    @foreach($tercero as $item)
                                    <option value='{{$item->id}}'>{{$item->nombres . ' ' . $item->apellido_paterno .' ' . $item->apellido_materno}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="sumbit"  class="btn btn-primary">Descargar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
            <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
                integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
                crossorigin="anonymous"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"
                integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49"
                crossorigin="anonymous"></script>
            <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"
                integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy"
                crossorigin="anonymous"></script>
            <script type="text/javascript">
                $('#primeros').on('show.bs.modal', function(event) {
                    var button = $(event.relatedTarget) // Button that triggered the modal
                    var modal = $(this)
                    modal.find('.modal-title').text('Selecciona el alumno')
                })

            </script>
