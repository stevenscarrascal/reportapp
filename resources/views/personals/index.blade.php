@extends('dashboard.dashboard')


@section('content')

<div class="card">
    <div class="card-body">
       @livewire('personal-datatable')
    </div>
</div>
@endsection

@section('scripts')

@endsection

