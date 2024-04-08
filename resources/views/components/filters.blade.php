<div class="gap-1">
    <div class="card mb-3">
        <div class="card-body">
            <div class="row">
                @if ($personals)
                    <div class="col">
                        <label for="personal">Personal
                            <select class="form-control" id="personal">
                            <option disabled selected>Seleccione el Personal</option>
                                @foreach ($personals as $personal)
                                    <option value="{{ $personal->id }}">{{ $personal->nombres . ' ' . $personal->apellidos }}</option>
                                @endforeach
                            </select>
                        </label>
                        <label for="desde">Desde
                            <input type="date" id="desde" name="from" class="form-control" />
                        </label>
                        <label  for="hasta">Hasta
                            <input type="date" id="hasta" name="to" class="form-control" />
                        </label>
                        <input type="button" class="btn btn-primary" value="Filtrar" onclick="getData()" />
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
