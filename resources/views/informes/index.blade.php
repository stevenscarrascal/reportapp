@extends('dashboard.dashboard')


@section('content')
    <div class="row mb-2">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <div style="width:100%;">
                        {!! $chartjs->render() !!}
                    </div>
                </div>
            </div>
        </div>

        <div class="col">
            <div class="card">
                <div class="card-body">
                    <div style="width:100%;">
                        {!! $chartjs2->render() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <div style="width:100%;">
                        {!! $chartjs2->render() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>

 @endsection
