@extends('dashboard.dashboard')

@section('content')
    <div class="row mb-4">
        <div class="col">
            <div class="card border-primary" style="height: 100%;">
                <div class="card-header card-title text-bg-primary text-center">
                    <span class="text-card">Contrato Numero: {{ $reporte->contrato }}</span>
                </div>
                <div class="card-body">
                    <ul>
                        <li>
                            <span class="text-card text-sm"> Direccion: {{ $reporte->direccion }}</span>
                        </li>
                        <li>
                            <span class="text-card text-sm"> Numero del Medidor: {{ $reporte->medidor }}</span>
                        </li>
                        <li>
                            <span class="text-card text-sm"> Numero de Lectura: {{ $reporte->lectura }}</span>
                        </li>
                        <li>
                            <span class="text-card text-sm"> Tipo de Comercio:
                                {{ $reporte->ComercioReporte->nombre }}</span>
                        </li>
                    </ul>

                </div>
            </div>
        </div>
        <div class="col">
            <div class="card border-warning" style="height: 100%;">
                <div class="card-header card-title text-bg-warning text-center">
                    <span class="text-card">Imposibilidades</span>
                </div>
                <div class="card-body">
                    <ul>
                        <li>
                            <span class="text-card text-sm">{{ $reporte->imposibilidadReporte->nombre }}</span>
                        </li>
                    </ul>

                </div>
            </div>
        </div>
        <div class="col">
            <div class="card border-danger" style="height: 100%;">
                <div class="card-header card-title text-bg-danger text-center">
                    <span class="text-card">Anomalias</span>
                </div>
                <div class="card-body">
                    <ul>
                        @foreach ($anomalias as $anomalia)
                            <li>
                                <span class="text-card text-sm">{{ $anomalia->nombre }}</span>
                            </li>
                        @endforeach
                    </ul>

                </div>
            </div>
        </div>
        <div class="col">
            <div class="card border-info" style="height: 100%;">
                <div class="card-header card-title text-bg-info text-center">
                    <span class="text-card">Comentarios del Lector</span>
                </div>
                <div class="card-body">
                    <span class="text-card text-sm">{{ $reporte->comentarios }}</span>

                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col">
            <form action="{{ route('coordinador.update', $reporte->id) }}" method="post" id="observacion"
                enctype="multipart/form-data">
                @method('PUT')
                @csrf
                <div class="card border-success" style="height: 500px;">
                    <div class="card-header card-title text-bg-success text-center">
                        <span class="text-card">Observaciones</span>
                    </div>
                    <div class="card-body">
                        <div class="card p-3">
                            <textarea id="editor" rows="10" name="observaciones" class="form-control mb-3" placeholder="Escriba Sus Observaciones" required {{ $reporte->estado == '6' ? 'readonly' : '' }}>   {{ $reporte->estado == '6' ? $reporte->observaciones : '' }}</textarea>
                            @if ($reporte->estado != '6')
                                <div class="mb-2">
                                    <div class="form-check form-check-inline">
                                        <label class="form-check-label" for="inlineRadio1">
                                            <span class="badge badge-success">Revisado</span>
                                            <input class="form-check-input" type="radio" name="estado" id="inlineRadio1"
                                                value="6">
                                        </label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <label class="form-check-label" for="inlineRadio2">
                                            <span class="badge badge-danger">Rechazado</span>
                                            <input class="form-check-input" type="radio" name="estado" id="inlineRadio2"
                                                value="7">
                                        </label>
                                    </div>
                                </div>
                            @endif
                            <div class="alert alert-warning d-none" role="alert" id="progressBarObservacion">
                                <span class="text-sm">Guardando Cambios Porfavor Espere.....</span>
                            </div>
                            @if ($reporte->estado != '6')
                            <div class=" d-flex justify-content-end">
                                <button type="submit" id="submitButtonObservacion" class="btn btn-success">Guardar</button>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <div class="col">
            <form action="{{ route('coordinador.store') }}" method="POST" enctype="multipart/form-data" id="evidencias">
                @csrf
                <input type="text" name="id" value="{{ $reporte->id }}" hidden>
                <div class="card border-success" style="height: 500px;">
                    <div class="card-header card-title text-bg-success text-center">
                        <span class="text-card">Evidencias</span>
                    </div>
                    <div class="card-body">
                        <div class="input-group mb-2">
                            <input class="form-control" type="file" id="video" name="video" accept="video/mp4">
                            <label for="video" class="input-group-text">Video</label>
                        </div>
                        <hr>
                        <div class="input-group mb-2">
                            <input type="file" class="form-control" id="foto1" name="foto1" accept="image/jpeg">
                            <label class="input-group-text" for="foto1">Inmueble</label>
                        </div>
                        <div class="input-group mb-2">
                            <input type="file" class="form-control" id="foto2" name="foto2"
                                accept="image/jpeg">
                            <label class="input-group-text" for="foto2">Numero Serial</label>
                        </div>
                        <div class="input-group mb-2">
                            <input type="file" class="form-control" id="foto3" name="foto3"
                                accept="image/jpeg">
                            <label class="input-group-text" for="foto3">Numero Lectura</label>
                        </div>
                        <div class="input-group mb-2">
                            <input type="file" class="form-control" id="foto4" name="foto4"
                                accept="image/jpeg">
                            <label class="input-group-text" for="foto4">Numero Medidor</label>
                        </div>
                        <div class="input-group mb-2">
                            <input type="file" class="form-control" id="foto5" name="foto5"
                                accept="image/jpeg">
                            <label class="input-group-text" for="foto5">Estado Medidor</label>
                        </div>
                        <div class="input-group mb-2">
                            <input type="file" class="form-control" id="foto6" name="foto6"
                                accept="image/jpeg">
                            <label class="input-group-text" for="foto6">Opcional</label>
                        </div>
                        <div class="alert alert-success d-none alert-evidencia" role="alert" id="alert">
                        </div>
                        <div class="alert alert-warning d-none" role="alert" id="progressBarEvidencias">
                            <span class="text-sm">Cargando Archivos Porfavor Espere.....</span>
                        </div>
                        <div class="d-flex justify-content-end">
                            <button type="submit" id="submitButtonEvidencias" class="btn btn-success">Guardar</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $(document).ready(function() {
            $('#observacion').submit(function() {
                $('#submitButtonObservacion').addClass('d-none');
                $('#progressBarObservacion').removeClass('d-none');
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            $('#evidencias').submit(function(e) {

                e.preventDefault();
                $('#submitButtonEvidencias').addClass('d-none');
                $('#progressBarEvidencias').removeClass('d-none');

                var formData = new FormData($('#evidencias')[0]);

                $.ajax({
                    url: "{{ route('coordinador.store') }}",
                    type: 'post',
                    data: formData,
                    processData: false,
                    contentType: false,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        $('#alert').removeClass('d-none');
                        $('.alert-evidencia').text(response.success).show();
                        $('#progressBarEvidencias').addClass('d-none');

                        // $('#evidencias')[0].reset();
                    }
                });
            });
        });
    </script>
@endsection
