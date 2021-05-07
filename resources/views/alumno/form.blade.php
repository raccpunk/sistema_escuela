<div class="form-group {{ $errors->has('foto:') ? 'has-error' : ''}}">
    <label for="foto:" class="control-label">{{ 'Foto:' }}</label>
    <input class="form-control" name="foto:" type="file" id="foto:" value="{{ isset($alumno->foto) ? $alumno->foto : ''}}" >
    {!! $errors->first('foto:', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('apellido_paterno') ? 'has-error' : ''}}">
    <label for="apellido_paterno" class="control-label">{{ 'Apellido Paterno' }}</label>
    <input class="form-control" name="apellido_paterno" type="text" id="apellido_paterno" value="{{ isset($alumno->apellido_paterno) ? $alumno->apellido_paterno : ''}}" >
    {!! $errors->first('apellido_paterno', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('apellido_materno') ? 'has-error' : ''}}">
    <label for="apellido_materno" class="control-label">{{ 'Apellido Materno' }}</label>
    <input class="form-control" name="apellido_materno" type="text" id="apellido_materno" value="{{ isset($alumno->apellido_materno) ? $alumno->apellido_materno : ''}}" >
    {!! $errors->first('apellido_materno', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('nombres') ? 'has-error' : ''}}">
    <label for="nombres" class="control-label">{{ 'Nombres' }}</label>
    <input class="form-control" name="nombres" type="text" id="nombres" value="{{ isset($alumno->nombres) ? $alumno->nombres : ''}}" >
    {!! $errors->first('nombres', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('edad') ? 'has-error' : ''}}">
    <label for="edad" class="control-label">{{ 'Edad' }}</label>
    <input class="form-control" name="edad" type="number" id="edad" value="{{ isset($alumno->edad) ? $alumno->edad : ''}}" >
    {!! $errors->first('edad', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('curp') ? 'has-error' : ''}}">
    <label for="curp" class="control-label">{{ 'Curp' }}</label>
    <input class="form-control" name="curp" type="text" id="curp" value="{{ isset($alumno->curp) ? $alumno->curp : ''}}" >
    {!! $errors->first('curp', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('sexo') ? 'has-error' : ''}}">
    <label for="sexo" class="control-label">{{ 'Sexo' }}</label>
    <input class="form-control" name="sexo" type="text" id="sexo" value="{{ isset($alumno->sexo) ? $alumno->sexo : ''}}" >
    {!! $errors->first('sexo', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('direccion') ? 'has-error' : ''}}">
    <label for="direccion" class="control-label">{{ 'Direccion' }}</label>
    <input class="form-control" name="direccion" type="text" id="direccion" value="{{ isset($alumno->direccion) ? $alumno->direccion : ''}}" >
    {!! $errors->first('direccion', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('telefono') ? 'has-error' : ''}}">
    <label for="telefono" class="control-label">{{ 'Telefono' }}</label>
    <input class="form-control" name="telefono" type="number" id="telefono" value="{{ isset($alumno->telefono) ? $alumno->telefono : ''}}" >
    {!! $errors->first('telefono', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('email') ? 'has-error' : ''}}">
    <label for="email" class="control-label">{{ 'Email' }}</label>
    <input class="form-control" name="email" type="email" id="email" value="{{ isset($alumno->email) ? $alumno->email : ''}}" >
    {!! $errors->first('email', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('otros') ? 'has-error' : ''}}">
    <label for="otros" class="control-label">{{ 'Otros' }}</label>
    <input class="form-control" name="otros" type="text" id="otros" value="{{ isset($alumno->otros) ? $alumno->otros : ''}}" >
    {!! $errors->first('otros', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('talla_polo') ? 'has-error' : ''}}">
    <label for="talla_polo" class="control-label">{{ 'Talla Polo' }}</label>
    <input class="form-control" name="talla_polo" type="text" id="talla_polo" value="{{ isset($alumno->talla_polo) ? $alumno->talla_polo : ''}}" >
    {!! $errors->first('talla_polo', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('beca') ? 'has-error' : ''}}">
    <label for="beca" class="control-label">{{ 'Beca' }}</label>
    <input class="form-control" name="beca" type="text" id="beca" value="{{ isset($alumno->beca) ? $alumno->beca : ''}}" >
    {!! $errors->first('beca', '<p class="help-block">:message</p>') !!}
</div>


<div class="form-group">
    <input class="btn btn-primary" type="submit" value="{{ $formMode === 'edit' ? 'Update' : 'Create' }}">
</div>
