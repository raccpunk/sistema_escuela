<div class="form-group {{ $errors->has('nombre:') ? 'has-error' : ''}}">
    <label for="nombre:" class="control-label">{{ 'Nombre:' }}</label>
    <input class="form-control" name="nombre:" type="text" id="nombre:" value="{{ isset($asignatura->nombre:) ? $asignatura->nombre: : ''}}" >
    {!! $errors->first('nombre:', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('creditos:') ? 'has-error' : ''}}">
    <label for="creditos:" class="control-label">{{ 'Creditos:' }}</label>
    <input class="form-control" name="creditos:" type="number" id="creditos:" value="{{ isset($asignatura->creditos:) ? $asignatura->creditos: : ''}}" >
    {!! $errors->first('creditos:', '<p class="help-block">:message</p>') !!}
</div>


<div class="form-group">
    <input class="btn btn-primary" type="submit" value="{{ $formMode === 'edit' ? 'Update' : 'Create' }}">
</div>
