@extends('dashboard.dashboard')


@section('content')
    <div class="row gap-1 mb-2">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <div style="width:50%;">
                        <canvas id="conteomes" style="width:100%;"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <div class="col">
            <div class="card">
                <div class="card-body">
                    <div style="width:100%;">
                        <canvas id="conteodias" style="width:100%;"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row gap-1 ">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <div style="width:80%;">
                        <canvas id="anomaliasXmes" style="width:100%;"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <div class="col">
            <div class="card">
                <div class="card-body">
                    <div style="width:80%;">
                        <canvas id="conteoxpersonal" style="width:100%;"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('graficos/reporteslecturames.js') }}"></script>
    <script src="{{ asset('graficos/reporteslecturadia.js') }}"></script>
    <script src="{{ asset('graficos/reporteanomaliasdia.js') }}"></script>
    <script src="{{ asset('graficos/reportelecturapersonaldia.js') }}"></script>
@endsection
