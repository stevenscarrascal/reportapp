@extends('layouts.frontpage.app')

@section('content')
    <div class="mb-4 d-flex justify-content-end">
        <a href="{{ route('auditorias.index') }}" class="btn btn-primary btn-sm"> Regresar</a>
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
        <!-- Lightbox -->
        <div class="col-lg-12 layout-spacing layout-top-spacing">
            <div class="statbox widget box box-shadow">
                <div class="widget-header">
                    <div class="row">
                        <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                            <h4>Default</h4>
                        </div>
                    </div>
                </div>
                <div class="widget-content widget-content-area">
                    <div class="row">
                        @foreach (range(1, 6) as $i)
                        <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 mb-4">
                            <a href="{{ $reporte->{'foto' . $i} ? '/imagen/' . $reporte->{'foto' . $i} : '#' }}" class="defaultGlightbox glightbox-content">
                                <img src="{{ $reporte->{'foto' . $i} ? '/imagen/' . $reporte->{'foto' . $i} : '#' }}" alt="image" class="img-fluid" id="{{ 'fotoPreview' . $i }}" />
                            </a>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')

@endsection
