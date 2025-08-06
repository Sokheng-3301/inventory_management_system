@extends('layout/master')

@section('title')
    <title>{{ __('nav.editPosition') }} | IMS</title>
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
            <div class="col-md-12 grid-margin">
                <div class="row">
                    <div class="col-12 col-xl-8 mb-4 mb-xl-0">
                        <h3 class="font-weight-bold">{{ __('nav.editPosition') }}</h3>
                        <h6 class="font-weight-normal mb-0">{{ __('nav.master') }} / <span class="text-primary"><a
                                    class="text-primary"
                                    href="{{ route('position.list') }}">{{ __('nav.position') }}</a></span></h6>
                    </div>
                </div>
                <div class="row mt-4">
                    <div class="col-md-7">
                        @include('layout.back-button')
                        <div class="card p-2">
                            <div class="card-body">

                                @php
                                    $checkRole = DB::table('user_roles')
                                        ->where('id', @Auth::user()->role_id)
                                        ->get()
                                        ->first();
                                @endphp

                                <form action="{{ route('position.update') }}" method="post" autocomplete="off"
                                    class="ui form">
                                    <div class="modal-body">
                                        @csrf
                                        <input type="hidden" class="d-none" name="posId" value="{{ $item->id }}">

                                        <div class="field">
                                            <label for="positionName"> {{ __('nav.positionName') }} <span
                                                    class="text-danger">*</span></label>
                                            <input type="text" id="positionName" class="form-control mb-3"
                                                name="positionName" placeholder="{{ __('nav.positionName') }}"
                                                value="{{ $item->position_name }}">
                                        </div>

                                        <div class="field">
                                            <label for="departmentName" class="d-block"> {{ __('nav.section') }} <span
                                                    class="text-danger">*</span></label>
                                            <select name="section" class="ui search dropdown d-block w-100"
                                                data-live-search="true">
                                                <option value="">{{__('nav.section')}}</option>
                                                @php
                                                    $i = 1;
                                                @endphp
                                                @foreach ($section as $d)
                                                    <option @if ($item->section_id == $d->id) selected @endif
                                                        value="{{ $d->id }}">{{ $d->section_en }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="field text-end">
                                            <a href="{{ route('position.list') }}" class="ui button tiny grey">
                                                <i class="ui x icon"></i> {{ __('nav.cancel') }}
                                            </a>
                                            <button type="submit" class="ui button tiny green">
                                                <span class="mdi mdi-check-circle icon"></span> {{ __('nav.update') }}
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


@section('js')
    <script>
        $(document).ready(function() {
            $('#master').addClass('nav-item active');
            $('#ui-basic').addClass('collapse show');
        });
        $('.ui.form')
            .form({
                fields: {
                    positionName: {
                        identifier: 'positionName',
                        rules: [{
                            type: 'empty',
                            prompt: 'Please enter your name'
                        }]
                    },
                    section: {
                        identifier: 'section',
                        rules: [{
                            type: 'empty',
                            prompt: 'Please enter your name'
                        }]
                    }
                }
            });
    </script>
@endsection
