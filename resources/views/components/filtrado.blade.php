<div>
    <div class="card shadow mb-1 ">
        <div class="card-body">
            @if ($personals)
                <div class="col">
                    <label for="personalMin">Personal
                        <select class="form-control" id="personalMin">
                            <option value="" selected>Seleccione el Personal</option>
                            @foreach ($personals as $personal)
                                <option value="{{ $personal->id }}">{{ $personal->nombres . ' ' . $personal->apellidos }}
                                </option>
                            @endforeach
                        </select>
                    </label>
                    <a class="btn btn-outline-primary px-2 " onclick="getDataMin()"><i class="fas fa-filter"></i></a>
                </div>
            @endif
        </div>
    </div>
</div>
