@extends('layout/master')

@section('title')
    <title> {{ __('nav.report') }} | IMS</title>
@endsection

@section('css')
    <style>
        table.dataTable th.dt-type-numeric,
        table.dataTable th.dt-type-date,
        table.dataTable td.dt-type-numeric,
        table.dataTable td.dt-type-date {
            text-align: start;
        }
    </style>
@endsection


@section('content')
    <div class="content-wrapper">
        <div class="row">
            @include('all-report.include')
        </div>
    </div>
@endsection


@section('js')
    <script>
        $(document).ready(function() {
            $('#inventory_list').addClass('nav-item active');
        });
    </script>
@endsection
