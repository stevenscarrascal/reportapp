@extends('dashboard.dashboard')

@section('content')
    <div class="card">
        <div class="card-body">
            @livewire('reporte-datatable')
        </div>
    </div>
@endsection
