@extends('layout/master')

@section('title')
    <title>{{ __('nav.department') }} | IMS</title>
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
                        <h3 class="font-weight-bold">{{ __('nav.department') }}</h3>
                        <h6 class="font-weight-normal mb-0"> {{ __('nav.master') }} / <span class="text-primary"><a
                                    class="text-primary"
                                    href="{{ route('department.list') }}">{{ __('nav.department') }}</a></span></h6>
                    </div>
                </div>
                <div class="row mt-4">
                    <div class="col-sm-12 col-md-12 col-l-12 col-xl-12">
                        {{-- --back button  --}}
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
                                                <a href="{{ route('department.export') }}" class="ui button fw-normal"
                                                    title="Excel"><i class="file excel icon"></i>Excel</a>
                                                <a href="{{ route('department.exportPdf') }}" class="ui button fw-normal"
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
                                                        {{ __('nav.addDepartment') }} </h1>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <form action="{{ route('department.add') }}" method="post" class="ui form"
                                                    autocomplete="off" id="formDepartment">
                                                    <div class="modal-body">
                                                        @csrf
                                                        <div class="field">
                                                            <label for="departmentCode">{{ __('nav.depCode') }}</label>
                                                            <input type="text" id="departmentCode" name="departmentCode"
                                                                value="{{ old('departmentCode') }}"
                                                                placeholder="{{ __('nav.depCode') }}">
                                                        </div>
                                                        @if ($errors->has('departmentCode'))
                                                            <div class="ui error mb-2 text-danger">
                                                                <p>{{__('nav.codeUnique')}}</p>
                                                            </div>
                                                        @endif

                                                        <div class="field">
                                                            <label for="departmentNameKh"> {{ __('nav.depNameKh') }} <span
                                                                    class="text-danger">*</span></label>
                                                            <input type="text" id="departmentNameKh"
                                                                name="departmentNameKh"
                                                                value="{{ old('departmentNameKh') }}"
                                                                placeholder="{{ __('nav.depNameKh') }}">
                                                        </div>

                                                        <div class="field">
                                                            <label for="departmentNameEn"> {{ __('nav.depNameEn') }} <span
                                                                    class="text-danger">*</span></label>
                                                            <input type="text" id="departmentNameEn"
                                                                name="departmentNameEn"
                                                                value="{{ old('departmentNameEn') }}"
                                                                placeholder="{{ __('nav.depNameEn') }}">
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="ui button tiny grey"
                                                            data-bs-dismiss="modal"><i
                                                                class="ui x icon"></i>{{ __('nav.cancel') }}</button>
                                                        <button type="submit" class="ui button tiny primary" id="saveButton">
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
                                                <th>{{ __('nav.depCode') }}</th>
                                                <th>{{ __('nav.depNameKh') }}</th>
                                                <th>{{ __('nav.depNameEn') }}</th>
                                                <th>{{ __('nav.createBy') }}</th>
                                                <th>{{ __('nav.createAt') }}</th>
                                                <th>{{ __('nav.deleteBy') }}</th>
                                                <th>{{ __('nav.deleteAt') }}</th>

                                                <th> {{ __('nav.actions') }} </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php
                                                $i = 1;
                                            @endphp
                                            @foreach ($department as $item)
                                                <tr>
                                                    <td style="width: 10px" class="text-start <?php
                                                    if ($item->delete_status == '0') {
                                                        echo 'text-danger';
                                                    }
                                                    ?>">
                                                        {{ $i++ }}
                                                    </td>
                                                    <td class="<?php
                                                    if ($item->delete_status == '0') {
                                                        echo 'text-danger';
                                                    }
                                                    ?>">{{ $item->department_code }}
                                                    </td>
                                                    <td class="<?php
                                                    if ($item->delete_status == '0') {
                                                        echo 'text-danger';
                                                    }
                                                    ?>">{{ $item->dep_name_kh }}
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
                                                        {{ $item->delete_date ? Carbon\Carbon::parse($item->delete_date)->format('d M Y h:i:s A') : '' }}
                                                    </td>
                                                    <td>
                                                        @if ($checkRole->role_name == 'admin' || $checkRole->role_name == 'Admin' || $action->action_edit == 1)
                                                            {{-- <a type="button" data-bs-toggle="modal"
                                                                data-bs-target="#updateForm{{ $item->id }}"><span
                                                                    class="mdi mdi-square-edit-outline fs-5 text-primary"
                                                                    title="Update data"></span></a> --}}

                                                            <a type="button" data-id="{{ $item->id }}" id="updateForm">
                                                                <span class="mdi mdi-square-edit-outline fs-5 text-primary"  title="Update data"></span>
                                                            </a>
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
                    <form action="{{ route('department.delete') }}" method="post" autocomplete="off">
                        <div class="modal-body">
                            @csrf
                            <input type="hidden" class="d-none" name="depId" id="deleteProID" value="">

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
                    <form action="{{ route('department.recovery') }}" method="post" autocomplete="off">
                        <div class="modal-body">
                            @csrf
                            <input type="hidden" class="d-none" name="depId" id="restoreProID" value="">
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
            @error('departmentCode')
                $('#addForm').modal('show');
            @enderror


            $(document).on('click', '#updateForm', function () {
                var id = $(this).data('id');
                var url = "{{ route('department.getData', ':id') }}".replace(':id', id);
                var urlUpdate = "{{ route('department.update', ':id') }}".replace(':id', id);

                $.ajax({
                    type: 'GET',
                    url: url,
                    dataType: 'json',
                    success: function (response) {
                        $('#addForm').modal('show');
                        $('#addFormLabel').text("{{ __('nav.update') }}");
                        $('#formDepartment').attr('action', urlUpdate);
                        $('#saveButton').removeClass('primary').addClass('green');

                        $('#departmentCode').val(response.data.department_code);
                        $('#departmentNameKh').val(response.data.dep_name_kh);
                        $('#departmentNameEn').val(response.data.dep_name_en);
                    }
                });
            });
        });

        $('.ui.form')
            .form({
                fields: {
                    departmentNameKh: {
                        identifier: 'departmentNameKh',
                        rules: [{
                            type: 'empty',
                            prompt: 'Please enter your name'
                        }]
                    },
                    departmentNameEn: {
                        identifier: 'departmentNameEn',
                        rules: [{
                            type: 'empty',
                            prompt: 'Please enter your name'
                        }]
                    }
                }
            });
    </script>
@endsection
