@extends('layouts.app')
@section('title', 'Emsa SubNormales')
@section('content')
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="https://code.highcharts.com/modules/data.js"></script>
    <script src="https://code.highcharts.com/modules/drilldown.js"></script>
    <script src="https://code.highcharts.com/modules/exporting.js"></script>
    <script src="https://code.highcharts.com/modules/export-data.js"></script>
    <script src="https://code.highcharts.com/modules/accessibility.js"></script>
    <script src="https://code.highcharts.com/modules/pareto.js"></script>

    <div class="container-xxl flex-grow-1 container-p-y">
        @livewire('home.show')
    </div>
@endsection
