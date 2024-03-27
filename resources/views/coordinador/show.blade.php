@extends('dashboard.dashboard')

@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title text-center">Informacion de Lectura</h3>
            @if ($reporte->estado == 6)<a href="{{route('coordinador.index')}}" class="btn btn-outline-primary btn-sm float-end ">Regresar</a>@endif
        </div>
        <div class="card-body">
            <div class="row">
                <div>
                    <p class="card-text text-center mb-4">Direccion: {{ $reporte->direccion }}</p>
                </div>
                <div class="col-md-6 text-center">
                    <p class="card-text mb-2">Numero de contrato: {{ $reporte->contrato }}</p>
                    <p class="card-text mb-2 ">Numero de Lectura: {{ $reporte->lectura }}</p>
                    <div class="">
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
                        Fotografias
                    </button>
                    <!-- Button trigger modal video -->
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#video">
                        Video
                    </button>
                </div>
            </div>
            <!-- Modal video -->
            <div class="modal fade" id="video" tabindex="-1" aria-labelledby="videolabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="w-full">
                                <video style="max-width: 100%;" controls>
                                    <source src="{{ asset('video/' . $reporte['video']) }}" type="video/mp4">
                                    Tu navegador no soporta el elemento de video.
                                </video>
                            </div>
                        </div>
                    </div>
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
                        <div class="modal-body">
                            <div class="container-fluid gap-1 ">
                                <div class="row mb-2">
                                    <div class="col-md-4 ms-auto position-relative">
                                        <label for="foto1"
                                            class="position-absolute top-0 start-50 translate-middle-x text-light ">Foto del
                                            inmueble</label>
                                        <img src="/imagen/{{ $reporte->{'foto1'} }}" alt="" id="foto1"
                                            style="max-width: 100%;">
                                    </div>
                                    <div class="col-md-4 ms-auto position-relative">
                                        <label for="foto2"
                                            class="position-absolute top-0 start-50 translate-middle-x text-light ">Numero
                                            del Serial</label>
                                        <img src="/imagen/{{ $reporte->{'foto2'} }}" alt="" id="foto2"
                                            style="max-width: 100%;">
                                    </div>
                                    <div class="col-md-4 ms-auto position-relative">
                                        <label for="foto3"
                                            class="position-absolute top-0 start-50 translate-middle-x text-light ">Numero
                                            de Lectura</label>
                                        <img src="/imagen/{{ $reporte->{'foto3'} }}" alt="" id="foto3"
                                            style="max-width: 100%;">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4 ms-auto position-relative">
                                        <label for="foto4"
                                            class="position-absolute top-0 start-50 translate-middle-x text-light ">Numero
                                            del Medidor</label>
                                        <img src="/imagen/{{ $reporte->{'foto4'} }}" alt="" id="foto4"
                                            style="max-width: 100%;">
                                    </div>
                                    <div class="col-md-4 ms-auto position-relative">
                                        <label for="foto5"
                                            class="position-absolute top-0 start-50 translate-middle-x text-light ">Estado
                                            del Medidor</label>
                                        <img src="/imagen/{{ $reporte->{'foto5'} }}" alt="" id="foto5"
                                            style="max-width: 100%;">
                                    </div>
                                    <div class="col-md-4 ms-auto position-relative">
                                        <label for="foto6"
                                            class="position-absolute top-0 start-50 translate-middle-x text-light ">Opcional</label>
                                        <img src="/imagen/{{ $reporte->{'foto6'} }}" alt="" id="foto6"
                                            style="max-width: 100%;">
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        </div>
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
                <button type="submit" class=" float-end btn btn-primary btn-sm">Guardar</button>
            </form>
        </div>
        @endif

    @endsection

    @section('js')
    @endsection
