@extends('layout/master')

@section('title')
    <title>{{ __('nav.position') }} | IMS</title>
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
                        <h3 class="font-weight-bold">{{ __('nav.position') }}</h3>
                        <h6 class="font-weight-normal mb-0">{{ __('nav.master') }} / <span class="text-primary">
                            <a class="text-primary" href="{{ route('position.list') }}">{{ __('nav.position') }}</a></span>
                        </h6>
                    </div>
                </div>
                <div class="row mt-4">
                    <div class="col-sm-12 col-md-12 col-l-12 col-xl-12">
                        @include('layout.back-button')
                        <div class="card p-2">
                            <div class="card-body">
                                @php
                                    $checkRole = DB::table('user_roles')
                                        ->where('id', @Auth::user()->role_id)
                                        ->get()
                                        ->first();
                                @endphp
                                @if ($checkRole->role_name == 'admin' || $checkRole->role_name == 'Admin' || $action->action_edit == 1)
                                    <div class="row">
                                        <div class="col-8 col-sm-7 mb-2  col-md-7">
                                            <div class="ui small icon buttons">
                                                <button class="ui button fw-normal" title="print" id="printButton"><i
                                                        class="print icon"></i>Print</button>
                                                <a href="{{ route('position.export') }}" class="ui button fw-normal"
                                                    title="Excel"><i class="file excel icon"></i>Excel</a>
                                                <a href="{{ route('position.exportPdf') }}" class="ui button fw-normal"
                                                    title=  "PDF"><i class="file pdf icon"></i>PDF</a>
                                            </div>
                                        </div>
                                        <div class="col-4 col-sm-5 mb-2  col-md-5 text-end">
                                            <a type="button" class="ui button primary tiny" data-bs-toggle="modal"
                                                data-bs-target="#addForm"><span class="mdi mdi-plus-circle icon"></span>
                                                {{ __('nav.addNew') }}
                                            </a>
                                        </div>
                                    </div>

                                    <!-- Modal add-->
                                    <div class="modal fade" id="addForm" data-bs-backdrop="static" tabindex="-1"
                                        aria-labelledby="addFormLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h1 class="modal-title fs-5" id="addFormLabel">
                                                        {{ __('nav.addPosition') }}</h1>
                                                </div>
                                                <form action="{{ route('position.add') }}" method="post" autocomplete="off"
                                                    class="ui form">
                                                    <div class="modal-body">
                                                        @csrf
                                                        <div class="field">
                                                            <label for="positionName">{{ __('nav.positionName') }}
                                                                <span class="text-danger">*</span></label>
                                                            <input type="text" id="positionName" name="positionName"
                                                                placeholder="{{ __('nav.positionName') }}">
                                                        </div>

                                                        <div class="field">
                                                            <label for="departmentName"
                                                                class="d-block">{{ __('nav.section') }} <span
                                                                    class="text-danger">*</span></label>
                                                            <select name="section" class="ui search dropdown w-100"
                                                                data-live-search="true">
                                                                <option value="">{{ __('nav.section') }}</option>
                                                                @foreach ($section as $d)
                                                                    <option value="{{ $d->id }}">
                                                                        {{ session('localization') == 'kh' ? $d->section_kh : $d->section_en }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="ui button tiny grey"
                                                            data-bs-dismiss="modal">
                                                            <i class="ui x icon"></i>
                                                            {{ __('nav.close') }}
                                                        </button>
                                                        <button type="submit" class="ui button tiny primary">
                                                            <span class="mdi mdi-check-circle icon"></span>
                                                            {{ __('nav.save') }}</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                @endif


                                <div class="table-responsive">
                                    <table id="myTable" class="display table table-striped">
                                        <thead>
                                            <tr>
                                                <th style="width: 10px;" class="text-start">{{ __('home.no') }}</th>
                                                <th>{{ __('nav.position') }}</th>
                                                <th>{{ __('nav.section') }}</th>
                                                <th>{{ __('nav.department') }}</th>
                                                <th>{{ __('nav.createBy') }}</th>
                                                <th>{{ __('nav.createAt') }}</th>
                                                <th>{{ __('nav.deleteBy') }}</th>
                                                <th>{{ __('nav.deleteAt') }}</th>
                                                <th>{{ __('nav.actions') }}</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php
                                                $auto = 1;
                                            @endphp
                                            @foreach ($position as $item)
                                                <tr>
                                                    <td style="width: 10px" class="text-start <?php
                                                    if ($item->delete_status == '0') {
                                                        echo 'text-danger';
                                                    }
                                                    ?>">
                                                        {{ $auto++ }}
                                                    </td>
                                                    <td class="<?php
                                                    if ($item->delete_status == '0') {
                                                        echo 'text-danger';
                                                    }
                                                    ?>">{{ $item->position_name }}
                                                    </td>
                                                    <td class="<?php
                                                    if ($item->delete_status == '0') {
                                                        echo 'text-danger';
                                                    }
                                                    ?>">{{ $item->section_en }}
                                                    </td>
                                                    <td class="<?php
                                                    if ($item->delete_status == '0') {
                                                        echo 'text-danger';
                                                    }
                                                    ?>">{{ $item->dep_name_en }}
                                                    </td>

                                                    <td class="<?php
                                                    if ($item->delete_status == '0') {
                                                        echo 'text-danger';
                                                    }
                                                    ?>">{{ $item->add_by }}
                                                    </td>

                                                    <td class="<?php
                                                    if ($item->delete_status == '0') {
                                                        echo 'text-danger';
                                                    }
                                                    ?>">
                                                        {{ Carbon\Carbon::parse($item->create_date)->format('d M Y h:i:s A') }}
                                                    </td>
                                                    <td class="<?php
                                                    if ($item->delete_status == '0') {
                                                        echo 'text-danger';
                                                    }
                                                    ?>">
                                                        @if ($item->delete_by)
                                                            {{ $item->delete_by }}
                                                        @endif
                                                    </td>

                                                    <td class="<?php
                                                    if ($item->delete_status == '0') {
                                                        echo 'text-danger';
                                                    }
                                                    ?>">
                                                        @if ($item->delete_date !== '0000-00-00' && $item->delete_date !== null)
                                                            {{ Carbon\Carbon::parse($item->delete_date)->format('d M Y') }}
                                                        @endif
                                                    </td>
                                                    <td>
                                                        @if ($checkRole->role_name == 'admin' || $checkRole->role_name == 'Admin' || $action->action_edit == 1)
                                                            {{-- <a type="button" data-bs-toggle="modal" data-bs-target="#updateForm{{$item->id}}" ><span class="mdi mdi-square-edit-outline fs-5 text-primary" title="Update data"></span></a> --}}
                                                            <a href="{{ route('position.edit', ['id' => $item->id]) }}"><span
                                                                    class="mdi mdi-square-edit-outline fs-5 text-primary"
                                                                    title="Update data"></span></a>
                                                        @endif

                                                        @if ($checkRole->role_name == 'admin' || $checkRole->role_name == 'Admin' || $action->action_delete == 1)
                                                            @include('layout.action-master-layout')
                                                        @endif
                                                    </td>
                                                </tr>
                                            @endforeach
                                            <!-- Add more rows as needed -->
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @if ($checkRole->role_name == 'admin' || $checkRole->role_name == 'Admin' || $action->action_delete == 1)
        <!-- Modal Delete-->
        <div class="modal fade" id="deleteVerify">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <form action="{{ route('position.delete') }}" method="post" autocomplete="off">
                        <div class="modal-body">
                            @csrf
                            <input type="hidden" class="d-none" name="posId" id="deleteProID" value="">

                            <h2 class="ui icon header text-center w-100">
                                <i class="question icon"></i>
                                <div class="content mt-3">
                                    {{ __('nav.deleteData') }}
                                    <div class="sub header mt-2"> {{ __('nav.doYouWantToDelete') }} </div>
                                </div>
                            </h2>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="ui button tiny" data-bs-dismiss="modal"><span
                                    class="mdi mdi-close icon"></span>{{ __('nav.cancel') }}</button>
                            <button type="submit" class="ui button tiny red">
                                <span class="mdi mdi-trash-can-outline icon"></span>
                                {{ __('nav.yesDelete') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Modal recovery-->
        <div class="modal fade" id="restoreModal">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <form action="{{ route('position.recovery') }}" method="post" autocomplete="off">
                        <div class="modal-body">
                            @csrf
                            <input type="hidden" class="d-none" name="posId" id="restoreProID" value="">
                            <h2 class="ui icon header text-center w-100">
                                <i class="question icon"></i>
                                <div class="content mt-3">
                                    {{ __('nav.restoreData') }}
                                    <div class="sub header mt-2"> {{ __('nav.doYouWantToRestore') }} </div>
                                </div>
                            </h2>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="ui button tiny" data-bs-dismiss="modal"><span
                                    class="mdi mdi-close icon"></span>{{ __('nav.cancel') }}</button>
                            <button type="submit" class="ui button tiny blue">
                                <span class="mdi mdi-trash-restore icon"></span>
                                {{ __('nav.yesRestore') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endif
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
