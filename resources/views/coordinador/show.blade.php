@extends('dashboard.dashboard')

@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title text-center">Informacion de Lectura</h3>
            @if ($reporte->estado == 6)
                <a href="{{ route('coordinador.index') }}" class="btn btn-outline-primary btn-sm float-end ">Regresar</a>
            @endif
        </div>
        <div class="card-body">
            <div class="row gap-1">
                <div class="col">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div>
                                    <p class="card-text text-center mb-4">Direccion: {{ $reporte->direccion }}</p>
                                </div>
                                <div class="col-md-6 text-center">
                                    <p class="card-text mb-2">Numero de contrato: {{ $reporte->contrato }}</p>
                                    <p class="card-text mb-2 ">Numero de Lectura: {{ $reporte->lectura }}</p>
                                    <div class="card">
                                        <p class="card-text">Anomalia Detectada</p>
                                        <ul>
                                            @foreach ($anomalias as $anomalia)
                                                <li>{{ $anomalia->nombre }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                                <div class="col-md-6 text-center">
                                    <p class="card-text mb-2 ">Numero de Medidor: {{ $reporte->medidor }}</p>
                                    <p class="card-text mb-2">Tipo de Comercio: {{ $reporte->ComercioReporte->nombre }}</p>
                                    <p class="card-text">Imposibilidad: {{ $reporte->imposibilidadReporte->nombre }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col">
                    @if ($reporte->comentarios)
                        <div class="card">
                            <div class="card-body">
                                <p class="card-title text-center mb-2">Observaciones Lector</p>
                                <p class="card-text mb-2">{{ $reporte->comentarios }}</p>
                            </div>
                        </div>
                    @endif
                </div>

            </div>

            @if ($reporte->observaciones)
                <div class="card mt-3 ">
                    <div class="card-header">
                        <h3 class="card-title text-center">Observaciones</h3>
                        <div class="card-body">
                            <p class="card-text text-center">{{ $reporte->observaciones }}</p>
                        </div>
                    </div>
            @endif
        </div>
        <div class="m-4">
            <hr>
            <h5 class="card-title text-center "> EVIDENCIAS</h5>
            <hr>
            <div class="d-flex justify-content-center">
                <div class="btn-group" role="group" aria-label="">
                    <!-- Button trigger modal fotografias -->
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#fotos">
                        Subir Fotos y video
                    </button>

                </div>
            </div>
            <!-- Modal fotografias -->
            <div class="modal fade" id="fotos" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
                aria-labelledby="fotoslabel" aria-hidden="true">
                <div class="modal-dialog modal-xl">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form action="{{ route('coordinador.store') }}" method="POST" enctype="multipart/form-data"
                            id="myForm">
                            @csrf
                            <input type="text" value="{{ $reporte->id }}" name="id" hidden>
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col">
                                        <div class="input-group">
                                            <label class="input-group-text" for="video">Video Anomalia</label>
                                            <input type="file" class="form-control" id="video" accept="video/*"
                                                name="video">
                                        </div>
                                    </div>
                                </div>

                                <div class="row mt-3">
                                    <span class=" text-card text-center mb-2">Fotos Evidencias</span>
                                    <div class="col">
                                        <div class="input-group mb-2">
                                            <label class="input-group-text" for="fotos">Inmueble</label>
                                            <input type="file" class="form-control" id="fotos" accept="image/*"
                                                name="foto1" multiple>
                                        </div>
                                        <div class="input-group mb-2">
                                            <label class="input-group-text" for="fotos">Numero del Serial</label>
                                            <input type="file" class="form-control" id="fotos" accept="image/*"
                                                name="foto2" multiple>
                                        </div>
                                        <div class="input-group mb-2">
                                            <label class="input-group-text" for="fotos">Numero de Lectura</label>
                                            <input type="file" class="form-control" id="fotos" accept="image/*"
                                                name="foto3" multiple>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="input-group mb-2">
                                            <label class="input-group-text" for="fotos">Numero del Medidor</label>
                                            <input type="file" class="form-control" id="fotos" accept="image/*"
                                                name="foto4" multiple>
                                        </div>
                                        <div class="input-group mb-2">
                                            <label class="input-group-text" for="fotos">Estado del Medidor</label>
                                            <input type="file" class="form-control" id="fotos" accept="image/*"
                                                name="foto5" multiple>
                                        </div>
                                        <div class="input-group mb-2">
                                            <label class="input-group-text" for="fotos">Opcional</label>
                                            <input type="file" class="form-control" id="fotos" accept="image/*"
                                                name="foto6" multiple>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <span id="progressBar" style="display: none;" class='text-md font-weight-bold text-success'>
                                        Cargando Archivos Porfavor Espere.....
                                    </span>
                                    <button type="submit" class="btn btn-primary" id="submitButton">Guardar</button>
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        @if ($reporte->estado != 6)
            <div class="m-4">
                <form action="{{ route('coordinador.update', $reporte->id) }}" method="post">
                    @csrf
                    @method('PUT')
                    <div class="mt-4">
                        <label for="observaciones" class="form-label">Observaciones</label>
                        <textarea class="form-control" id="observaciones" name="observaciones" rows="5"></textarea>
                    </div>
                    <div class="form-check mt-3 ">
                        <input class="form-check-input" type="radio" name="estado" id="revisado" value="6">
                        <x-input-error for="revisado" />
                        <label class="form-check-label" for="revisado">
                            <span class="badge badge-success">Revisado</span>
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="estado" id="rechazado" value="7">
                        <label class="form-check-label" for="rechazado">
                            <span class="badge badge-danger">Rechazado</span>
                        </label>
                    </div>
                    @error('rechazado')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                    <button type="submit" class=" float-end btn btn-primary btn-sm">Guardar</button>
                </form>
            </div>
        @endif
    @endsection

    @section('js')
        <script>
            $(document).ready(function() {
                $('#myForm').submit(function() {
                    $('#submitButton').prop('disabled', true);
                    $('#submitButton').removeClass('btn-primary').addClass('btn-secondary');
                    $('#progressBar').css('display', 'block');
                });
            });
        </script>

        <script>
            document.addEventListener("DOMContentLoaded", function() {
                @if (Session::has('success'))
                    Swal.fire({
                        icon: 'success',
                        title: '{{ Session::get('title') }}',
                        text: '{{ Session::get('success') }}',
                        showConfirmButton: false,
                        timer: 1500
                    });
                @endif
            });
        </script>
    @endsection
