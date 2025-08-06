@extends('layout/master')

@section('title')
    <title> {{ __('nav.Role') }} | IMS</title>
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
                        <h3 class="font-weight-bold"> {{ __('nav.Role') }}</h3>
                        <h6 class="font-weight-normal mb-0"> {{ __('nav.manageRole') }} / <span class="text-primary"><a
                                    class="text-primary" href=""> {{ __('nav.Role') }}</a></span></h6>
                    </div>
                </div>
                <div class="row mt-4">
                    <div class="col-sm-12 col-md-12 col-l-12 col-xl-12">
                        @include('layout.back-button')
                        <div class="card p-2">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-8 col-sm-7 mb-2  col-md-7"></div>
                                    <div class="col-4 col-sm-5 mb-2  col-md-5 text-end">
                                        <a type="button" data-bs-toggle="modal" data-bs-target="#addCategory"
                                            class="ui button primary tiny">
                                            <span class="mdi mdi-plus-circle icon"></span> {{ __('nav.addNew') }}
                                        </a>
                                    </div>
                                </div>

                                <!-- Modal -->
                                <div class="modal fade" id="addCategory" data-bs-backdrop="static" tabindex="-1"
                                    aria-labelledby="addCategoryLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5" id="addCategoryLabel"> {{ __('nav.addRole') }}
                                                </h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <form action="{{ route('role.save') }}" method="post" autocomplete="off">
                                                <div class="modal-body">
                                                    @csrf
                                                    <label for="roleName"> {{ __('nav.roleName') }} <span
                                                            class="text-danger">*</span></label>
                                                    <input type="text" id="roleName" class="form-control"
                                                        name="roleName" placeholder="{{ __('nav.roleName') }}">
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="submit" class="ui button tiny blue">
                                                        <span class="mdi mdi-check-circle icon"></span>
                                                        {{ __('nav.save') }}</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>

                                <div class="table-responsive">
                                    <table id="myTable" class="display table table-striped">
                                        <thead>
                                            <tr>
                                                <th style="width: 10px;" class="text-start"> {{ __('home.no') }} </th>
                                                <th> {{ __('nav.Role') }} </th>
                                                <th> {{ __('nav.createAt') }} </th>
                                                <th> {{ __('nav.createBy') }} </th>
                                                <th> {{ __('nav.deleteBy') }} </th>
                                                <th> {{ __('nav.deleteAt') }} </th>
                                                <th>{{ __('nav.actions') }}</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php
                                                $i = 1;
                                            @endphp
                                            @foreach ($role as $item)
                                                <tr>
                                                    <td style="width: 10px" class="text-start <?php
                                                    if ($item->delete_status == '0') {
                                                        echo 'text-danger';
                                                    }
                                                    ?>">
                                                        {{ $i++ }}</td>
                                                    <td class="<?php
                                                    if ($item->delete_status == '0') {
                                                        echo 'text-danger';
                                                    }
                                                    ?>">{{ $item->role_name }}</td>
                                                    <td class="<?php
                                                    if ($item->delete_status == '0') {
                                                        echo 'text-danger';
                                                    }
                                                    ?>">{{ Carbon\Carbon::parse($item->create_date)->format('d M Y h:i:s A') }}</td>
                                                    <td class="<?php
                                                    if ($item->delete_status == '0') {
                                                        echo 'text-danger';
                                                    }
                                                    ?>">
                                                        {{ $item->add_by ? strtoupper($item->add_by) : '' }}
                                                    </td>


                                                    <td class="<?php
                                                    if ($item->delete_status == '0') {
                                                        echo 'text-danger';
                                                    }
                                                    ?>">
                                                        {{ $item->delete_by ? strtoupper($item->delete_by) : '' }}
                                                    </td>


                                                    <td class="<?php
                                                    if ($item->delete_status == '0') {
                                                        echo 'text-danger';
                                                    }
                                                    ?>">
                                                        {{ $item->delete_date !== '0000-00-00' && $item->delete_date !== null ? Carbon\Carbon::parse($item->delete_date)->format('d M Y') : '' }}
                                                    </td>
                                                    <td>
                                                        <a type="button" data-bs-toggle="modal"
                                                            data-bs-target="#updateCategory{{ $item->id }}"><span
                                                                class="mdi mdi-square-edit-outline fs-5 text-primary"
                                                                title="Update data"></span></a> |

                                                        @if ($item->delete_status == '0')
                                                            <a type="button" data-id="{{ $item->id }}"
                                                                id="restoreButton"><span
                                                                    class="mdi mdi-backup-restore fw-bold text-success fs-5"
                                                                    title="Recovery data"></span></a>
                                                        @else
                                                            <a type="button" data-id="{{ $item->id }}"
                                                                id="deleteButton"><span
                                                                    class="mdi mdi-trash-can-outline text-danger fs-5"
                                                                    title="Delete data"></span></a>
                                                        @endif
                                                    </td>
                                                </tr>
                                                <!-- Modal Update-->
                                                <div class="modal fade" id="updateCategory{{ $item->id }}"
                                                    data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
                                                    aria-labelledby="updateCategory{{ $item->id }}Label"
                                                    aria-hidden="true">

                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h1 class="modal-title fs-5"
                                                                    id="updateCategory{{ $item->id }}">
                                                                    {{ __('nav.updateRole') }} </h1>
                                                                <button type="button" class="btn-close"
                                                                    data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <form action="{{ route('role.edit') }}" method="post"
                                                                autocomplete="off">

                                                                <div class="modal-body">
                                                                    @csrf
                                                                    <input type="hidden" name="roleId" class="d-none"
                                                                        value="{{ $item->id }}">
                                                                    <label for="roleName"> {{ __('nav.roleName') }} <span
                                                                            class="text-danger">*</span></label>
                                                                    <input type="text" id="roleName"
                                                                        class="form-control" name="roleName"
                                                                        placeholder="{{ __('nav.roleName') }}"
                                                                        value="{{ $item->role_name }}">
                                                                    <input type="hidden" id=""
                                                                        class="form-control d-none" style="display: none;"
                                                                        name="OldroleName" placeholder="Role name"
                                                                        value="{{ $item->role_name }}">

                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="submit" class="ui button tiny green">
                                                                        <span class="mdi mdi-check-circle icon"></span>
                                                                        {{ __('nav.update') }}
                                                                    </button>
                                                                </div>
                                                            </form>

                                                        </div>
                                                    </div>
                                                </div>
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

    <!-- Modal Delete-->
    <div class="modal fade" id="deleteVerify">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <form action="{{ route('role.delete') }}" method="post" autocomplete="off">
                    <div class="modal-body">
                        @csrf
                        <input type="hidden" class="d-none" name="roleId" id="deleteroleId" value="">

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
                <form action="{{ route('role.recovery') }}" method="post" autocomplete="off">
                    <div class="modal-body">
                        @csrf
                        <input type="hidden" class="d-none" name="roleId" id="restoreroleId" value="">
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
@endsection


@section('js')
    <script>
        $(document).ready(function() {
            $('#role').addClass('nav-item active');
            $('#icons').addClass('collapse show');

            $(document).on('click', '#deleteButton', function() {
                var id = $(this).data("id");
                $('#deleteVerify').modal('show');
                $('#deleteroleId').val(id);
            });

            $(document).on('click', '#restoreButton', function() {
                var id = $(this).data("id");
                $('#restoreModal').modal('show');
                $('#restoreroleId').val(id);
            });
        });
    </script>
@endsection
