<div class="form-group {{ $errors->has('calificacionA:') ? 'has-error' : ''}}">
    <label for="calificacionA:" class="control-label">{{ 'Calificaciona:' }}</label>
    <input class="form-control" name="calificacionA:" type="number" id="calificacionA:" value="{{ isset($calificaciones_periodo->calificacionA:) ? $calificaciones_periodo->calificacionA: : ''}}" >
    {!! $errors->first('calificacionA:', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('calificacionB') ? 'has-error' : ''}}">
    <label for="calificacionB" class="control-label">{{ 'Calificacionb' }}</label>
    <input class="form-control" name="calificacionB" type="number" id="calificacionB" value="{{ isset($calificaciones_periodo->calificacionB) ? $calificaciones_periodo->calificacionB : ''}}" >
    {!! $errors->first('calificacionB', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('promedio') ? 'has-error' : ''}}">
    <label for="promedio" class="control-label">{{ 'Promedio' }}</label>
    <input class="form-control" name="promedio" type="number" id="promedio" value="{{ isset($calificaciones_periodo->promedio) ? $calificaciones_periodo->promedio : ''}}" >
    {!! $errors->first('promedio', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('faltas') ? 'has-error' : ''}}">
    <label for="faltas" class="control-label">{{ 'Faltas' }}</label>
    <div class="radio">
    <label><input name="faltas" type="radio" value="1" {{ (isset($calificaciones_periodo) && 1 == $calificaciones_periodo->faltas) ? 'checked' : '' }}> Yes</label>
</div>
<div class="radio">
    <label><input name="faltas" type="radio" value="0" @if (isset($calificaciones_periodo)) {{ (0 == $calificaciones_periodo->faltas) ? 'checked' : '' }} @else {{ 'checked' }} @endif> No</label>
</div>
    {!! $errors->first('faltas', '<p class="help-block">:message</p>') !!}
</div>


<div class="form-group">
    <input class="btn btn-primary" type="submit" value="{{ $formMode === 'edit' ? 'Update' : 'Create' }}">
</div>
