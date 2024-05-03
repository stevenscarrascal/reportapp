@extends('layouts.frontpage.app')

@section('content')
    <div class="mb-4 d-flex justify-content-end">
        <a href="{{ route('coordinador.index') }}" class="btn btn-primary btn-sm"> Regresar</a>
    </div>

    <div class="row mb-4">
        <div class="col">
            <div class="card border-primary" style="height: 100%;">
                <div class="card-header card-title text-bg-primary text-center">
                    <span class="text-card">Contrato Numero: {{ $reporte->contrato }}</span>
                </div>
                <div class="card-body">
                    <ul>
                        @if ($validate === null)
                            <div class="alert alert-danger" role="alert">
                                <span>Contrato No REGISTRA en base de datos</span>
                            </div>
                        @endif
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
                            @if ($reporte->nuevo_comercio)
                                <span class="text-card text-sm"> Comercio: {{ $reporte->nuevo_comercio }}</span>
                            @endif
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
                            <li>
                                <span class="text-card text-sm">Medidor Encontrado: {{ $reporte->medidor_anomalia }}</span>
                            </li>
                    </ul>

                </div>
            </div>
        </div>
        <div class="col">
            <div class="card border-info " style="height: 100%;">
                <div class="card-header card-title text-bg-info text-center">
                    <span class="text-card">Comentarios del Lector</span>
                </div>
                <div class="card-body ">
                    <div class="text-card text-sm">{{ $reporte->comentarios }}</div>
                </div>
            </div>
        </div>

    </div>

    <div class="row">
        <div class="col-xl-6">
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
                            <textarea id="editor" rows="10" name="observaciones" class="form-control mb-3"
                                placeholder="Escriba Sus Observaciones" required {{ $reporte->estado == '6' ? 'readonly' : '' }}>   {{ $reporte->estado == '6' ? $reporte->observaciones : '' }}</textarea>
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
                                <div class="spinner-border ms-auto" aria-hidden="true"></div>
                                <span class="text-sm">Guardando Cambios Porfavor Espere.....</span>
                            </div>
                            @if ($reporte->estado != '6')
                                <div class=" d-flex justify-content-end">
                                    <button type="submit" id="submitButtonObservacion"
                                        class="btn btn-success">Guardar</button>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <div class="col-xl-6">

            <div class="row">
                <div id="flStackForm" class="col-lg-12 layout-spacing layout-top-spacing">
                    <div class="statbox widget box box-shadow">
                        <div class="widget-header">
                            <div class="row">
                                <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                                        <a class="btn btn-success  btn-sm mt-2" data-bs-toggle="modal" href="#modalevidencias"
                                            role="button">Vista Previa</a>
                                </div>
                            </div>
                        </div>
                        <div class="widget-content widget-content-area">

                            <form action="{{ route('coordinador.store') }}" method="POST" enctype="multipart/form-data" id="evidencias">
                                @csrf
                                <input type="text" name="id" value="{{ $reporte->id }}" hidden>

                                    <div class="card-body">
                                        <div class="">
                                            <div class="input-group">
                                                <input class="form-control" type="file" id="video" name="video"
                                                    accept="video/mp4">
                                                    <span class="input-group-text" id="video">video</span>
                                            </div>
                                            <hr>
                                            <div class="input-group">
                                                <input type="file" class="form-control" id="foto1" name="foto1"
                                                    accept="image/jpeg">
                                                    <span class="input-group-text" id="foto1">Inmueble</span>
                                            </div>
                                            <div class="input-group mb-2">
                                                <input type="file" class="form-control" id="foto2" name="foto2"
                                                    accept="image/jpeg">
                                                <label class="input-group-text" for="foto2">Numero Serial</label>
                                            </div>
                                            <div class="input-group">
                                                <input type="file" class="form-control" id="foto3" name="foto3"
                                                    accept="image/jpeg">
                                                <label class="input-group-text" for="foto3">Numero Lectura</label>
                                            </div>
                                            <div class="input-group">
                                                <input type="file" class="form-control" id="foto4" name="foto4"
                                                    accept="image/jpeg">
                                                <label class="input-group-text" for="foto4">Numero Medidor</label>
                                            </div>
                                            <div class="input-group">
                                                <input type="file" class="form-control" id="foto5" name="foto5"
                                                    accept="image/jpeg">
                                                <label class="input-group-text" for="foto5">Estado Medidor</label>
                                            </div>
                                            <div class="input-group">
                                                <input type="file" class="form-control" id="foto6" name="foto6"
                                                    accept="image/jpeg">
                                                <label class="input-group-text" for="foto6">Opcional</label>
                                            </div>

                                            <div class="alert alert-success d-none alert-evidencia" role="alert" id="alert">
                                            </div>
                                            <div class="alert alert-warning d-none" role="alert" id="progressBarEvidencias">
                                                <div class="spinner-border ms-auto" aria-hidden="true"></div>
                                                <span class="text-sm">Cargando Archivos Porfavor Espere.....</span>
                                            </div>
                                            <div class="card-footer">
                                                <div class="d-flex justify-content-end">
                                                    <button type="submit" id="submitButtonEvidencias" class="btn btn-success">Guardar</button>
                                                </div>
                                            </div>

                                        </div>
                                    </div>

                            </form>


                        </div>
                    </div>
                </div>
            </div>
            {{-- <form action="{{ route('coordinador.store') }}" method="POST" enctype="multipart/form-data" id="evidencias">
                @csrf
                <input type="text" name="id" value="{{ $reporte->id }}" hidden>
                <div class="card border-success" style="height: 500px;">
                    <div class="card-header card-title text-bg-success text-center">
                        <span class="text-card">Evidencias</span>
                        <div class=" d-flex justify-content-end ">
                            <a class="btn btn-outline-light  btn-sm" data-bs-toggle="modal" href="#modalevidencias"
                                role="button">Vista Previa</a>
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="">
                            <div class="input-group">
                                <input class="form-control" type="file" id="video" name="video"
                                    accept="video/mp4">
                                <label for="video" class="input-group-text">Video</label>
                            </div>
                            <hr>
                            <div class="input-group">
                                <input type="file" class="form-control" id="foto1" name="foto1"
                                    accept="image/jpeg">
                                <label class="input-group-text" for="foto1">Inmueble</label>
                            </div>
                            <div class="input-group mb-2">
                                <input type="file" class="form-control" id="foto2" name="foto2"
                                    accept="image/jpeg">
                                <label class="input-group-text" for="foto2">Numero Serial</label>
                            </div>
                            <div class="input-group">
                                <input type="file" class="form-control" id="foto3" name="foto3"
                                    accept="image/jpeg">
                                <label class="input-group-text" for="foto3">Numero Lectura</label>
                            </div>
                            <div class="input-group">
                                <input type="file" class="form-control" id="foto4" name="foto4"
                                    accept="image/jpeg">
                                <label class="input-group-text" for="foto4">Numero Medidor</label>
                            </div>
                            <div class="input-group">
                                <input type="file" class="form-control" id="foto5" name="foto5"
                                    accept="image/jpeg">
                                <label class="input-group-text" for="foto5">Estado Medidor</label>
                            </div>
                            <div class="input-group">
                                <input type="file" class="form-control" id="foto6" name="foto6"
                                    accept="image/jpeg">
                                <label class="input-group-text" for="foto6">Opcional</label>
                            </div>

                            <div class="alert alert-success d-none alert-evidencia" role="alert" id="alert">
                            </div>
                            <div class="alert alert-warning d-none" role="alert" id="progressBarEvidencias">
                                <div class="spinner-border ms-auto" aria-hidden="true"></div>
                                <span class="text-sm">Cargando Archivos Porfavor Espere.....</span>
                            </div>
                            <div class="card-footer">
                                <div class="d-flex justify-content-end">
                                    <button type="submit" id="submitButtonEvidencias" class="btn btn-success">Guardar</button>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </form> --}}
        </div>
    </div>

    {{-- Modal --}}
    <div class="modal fade" id="modalevidencias" aria-hidden="true" aria-labelledby="exampleModalToggleLabel"
        tabindex="-1">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalToggleLabel">Contrato:<span class="text-danger">
                            {{ $reporte->contrato }}</span> Medidor:<span class="text-danger">
                            {{ $reporte->medidor }}</span> Lectura:<span class="text-danger">
                            {{ $reporte->lectura }}</span></h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="container text-center">
                        <div class="row">
                            @foreach (range(1, 6) as $i)
                                <div class="col-md-4 mb-2  ">
                                    <img src="{{ $reporte->{'foto' . $i} ? '/imagen/' . $reporte->{'foto' . $i} : '#' }}"
                                        id="{{ 'fotoPreview' . $i }}" class="rounded float-start"
                                        style="max-width: 100%;" alt=''>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-primary" data-bs-target="#exampleModalToggle2" data-bs-toggle="modal"> Ver
                        Video</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="exampleModalToggle2" aria-hidden="true" aria-labelledby="exampleModalToggleLabel2"
        tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalToggleLabel2">Evidencia Video</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <video id="videoPreview" style="max-width: 100%;" controls>
                        <source src="{{ $reporte->video ? asset('video/' . $reporte->video) : '#' }}" type="video/mp4">
                        Tu navegador no soporta el elemento de video.
                    </video>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-primary" data-bs-target="#exampleModalToggle" data-bs-toggle="modal">Regresar
                        a las Fotos</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        document.getElementById("video").addEventListener("change", function() {
            var reader = new FileReader();

            reader.onload = function(e) {
                document.getElementById('videoPreview').src = e.target.result;
            }

            reader.readAsDataURL(this.files[0]);
        });
    </script>
    <script>
        for (let i = 1; i <= 6; i++) {
            document.getElementById("foto" + i).addEventListener("change", function() {
                var reader = new FileReader();

                reader.onload = function(e) {
                    document.getElementById('fotoPreview' + i).src = e.target.result;
                }

                reader.readAsDataURL(this.files[0]);
            });
        }
    </script>
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
