@extends('layouts.dashboard')

@section('content')
    <div class="block rounded-lg bg-white p-6 text-surface shadow-secondary-1 px-6">
        @livewire('datatable-component')
    </div>
@endsection
