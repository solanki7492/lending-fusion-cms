@extends('layouts.app') {{-- Replace with your actual layout --}}
@section('content')

<div class="col-sm-6 col-xl-4">
        <div class="card text-white bg-primary">
        <div class="card-body pb-0 d-flex justify-content-between align-items-start">
            <div>
                <div class="fs-4 fw-semibold">Termsheet Counts</div>
                <h4>{{$termsheetSum}}</h4>
            </div>
        </div>
        <div class="c-chart-wrapper mt-3 mx-3" style="height:70px;">
            <canvas class="chart" id="card-chart1" height="70"></canvas>
        </div>
        </div>
    </div>
@endsection