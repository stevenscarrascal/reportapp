@extends('dashboard.dashboard')

@section('content')
    <div class="card">
        <div class="card-body">
            @livewire('datatable-component')
        </div>
    </div>
@endsection
