@extends('layouts.modernize')

@section('title', 'Main Dashboard')

@section('page', 'Main Dashboard')

@section('content')
    <div>
        <div class="card">
            <div id="monthly-chart"></div>
        </div>
    </div>
@endsection

@section('css')
    <style>
        #monthly-chart {
            width: 100%;
            height: 50vh;
            background-color: red;
        }
    </style>
@endsection

@section('js')

@endsection
