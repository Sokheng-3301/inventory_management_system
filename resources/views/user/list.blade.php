@extends('layout/master')

@section('title')
    <title> {{ __('nav.userList') }} | IMS</title>
@endsection

@section('css')
    <style>
        table.dataTable th.dt-type-numeric,
        table.dataTable th.dt-type-date,
        table.dataTable td.dt-type-numeric,
        table.dataTable td.dt-type-date {
            text-align: start;
        }

        #file-input {
            display: block;
            /* width: 100%; */
            height: 100%;
            position: absolute;

        }

        #profileImage {
            width: 50%;
        }
    </style>
@endsection


@section('content')
    <div class="content-wrapper">
        <div class="row">
            <div class="col-md-12 grid-margin">
                <div class="row">
                    <div class="col-12 col-xl-8 mb-4 mb-xl-0">
                        <h3 class="font-weight-bold"> {{ __('nav.userList') }} </h3>
                        <h6 class="font-weight-normal mb-0">{{ __('nav.manageUser') }} / <span class="text-primary"><a
                                    class="text-primary" href=""> {{ $name }}</a></span></h6>
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
                                            {{-- <div class="ui small icon buttons">
                                                <button class="ui button fw-normal" title="print" id="printButton"><i
                                                        class="print icon"></i>Print</button>
                                                <a href="{{ route('staff.export') }}" class="ui button fw-normal"
                                                    title="Excel"><i class="file excel icon"></i>Excel</a>
                                                <a href="{{ route('staff.exportPdf') }}" class="ui button fw-normal"
                                                    title=  "PDF"><i class="file pdf icon"></i>PDF</a>
                                            </div> --}}
                                        </div>

                                        <div class="col-4 col-sm-5 mb-2  col-md-5 text-end">
                                            <a href="{{ url('user/' . $id . '/' . $name . '/add') }}"
                                                class="ui button primary tiny"><span
                                                    class="mdi mdi-plus-circle icon"></span> {{ __('nav.addNew') }}
                                            </a>
                                        </div>
                                    </div>
                                @endif



                                <div class="table-responsive">
                                    <table id="myTable" class="display table table-striped">
                                        <thead>
                                            <tr>
                                                <th style="width: 10px;" class="text-start"> {{ __('home.no') }} </th>
                                                <th> {{ __('nav.img') }} </th>
                                                <th> {{ __('nav.staffId') }} </th>
                                                <th> {{ __('nav.fullNameKh') }} </th>
                                                <th> {{ __('nav.fullNameEn') }} </th>
                                                <th class="text-center">{{ __('nav.gender') }}</th>
                                                <th> {{ __('nav.username') }} </th>
                                                <th> {{ __('nav.createAt') }} </th>
                                                <th class="text-center"> {{ __('nav.status') }} </th>

                                                {{-- <th>Age</th>
                                            <th>Start date</th> --}}
                                                <th> {{ __('nav.actions') }} </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php
                                                $auto = 1;
                                            @endphp
                                            @foreach ($user as $item)
                                                <tr>
                                                    <td style="width: 10px" class="text-start <?php
                                                    if ($item->block_status == '0') {
                                                        echo 'text-danger';
                                                    }
                                                    ?>">
                                                        {{ $auto++ }}
                                                    </td>
                                                    <td>
                                                        @if ($item->profile == '')
                                                            <img src="{{ asset('images/draft-user.jpg') }}" alt="">
                                                        @else
                                                            <img src="{{ asset($item->profile) }}" alt="">
                                                        @endif
                                                    </td>
                                                    <td class="<?php
                                                    if ($item->block_status == '0') {
                                                        echo 'text-danger';
                                                    }
                                                    ?>">{{ $item->card_id }}
                                                    </td>

                                                    <td class="<?php
                                                    if ($item->block_status == '0') {
                                                        echo 'text-danger';
                                                    }
                                                    ?>">{{ $item->name_kh }}
                                                    </td>

                                                    <td class="<?php
                                                    if ($item->block_status == '0') {
                                                        echo 'text-danger';
                                                    }
                                                    ?>">{{ strtoupper($item->name_en) }}
                                                    </td>



                                                    <td class="<?php
                                                    if ($item->block_status == '0') {
                                                        echo 'text-danger';
                                                    }
                                                    ?> text-center">
                                                        @if ($item->gender == 'Male')
                                                            <span class="mdi mdi-gender-male text-primary"></span>
                                                        @else
                                                            <span class="mdi mdi-gender-female"
                                                                style="color: palevioletred"></span>
                                                        @endif
                                                        {{-- {{$item -> gender}} --}}
                                                    </td>
                                                    <td
                                                        class="{{ $item->block_status == '0' ? 'text-danger' : 'text-muted' }}">
                                                        {{ $item->email }}
                                                    </td>

                                                    <td class="<?php
                                                    if ($item->block_status == '0') {
                                                        echo 'text-danger';
                                                    }
                                                    ?>">
                                                        {{ Carbon\Carbon::parse($item->created_at)->format('d M Y h:i:s A') }}
                                                    </td>



                                                    <td class="<?php
                                                    if ($item->block_status == '0') {
                                                        echo 'text-danger';
                                                    }
                                                    ?> text-center">
                                                        @if ($item->block_status == '0')
                                                            <span>
                                                                <span class="mdi mdi-close-circle text-danger fs-6"></span>
                                                            </span>
                                                        @else
                                                            <span>
                                                                <span class="mdi mdi-check-circle text-success fs-6"></span>
                                                            </span>
                                                        @endif
                                                    </td>

                                                    <td>
                                                        <a href="{{ route('user.show', [$id,$item->id]) }}">
                                                            <span class="mdi mdi-eye-outline fs-5 text-primary" title="View detail"></span>
                                                        </a>
                                                        @if ($checkRole->role_name == 'admin' || $checkRole->role_name == 'Admin' || $action->action_edit == 1)
                                                            | <a type="button" id="resetPasswordButton"
                                                                data-id="{{ $item->id }}" title="Reset password">
                                                                <span
                                                                    class="mdi mdi mdi-lock-reset fs-5 text-primary"></span></a>
                                                            |

                                                            <a href="{{ url('user/' . $id . '/' . $item->id . '/edit') }}"><span
                                                                    class="mdi mdi-square-edit-outline fs-5 text-primary"
                                                                    title="Update data"></span></a> |
                                                        @endif

                                                        @if ($checkRole->role_name == 'admin' || $checkRole->role_name == 'Admin' || $action->action_delete == 1)
                                                            @if ($item->block_status == '0')
                                                                <a type="button" data-id="{{ $item->id }}" id="unblockButton">
                                                                    <span class="mdi mdi-backup-restore fw-bold text-success fs-5" title="Unblock user"></span>
                                                                </a>
                                                            @else
                                                                <a type="button" id="blockButton" data-id="{{ $item->id }}" >
                                                                    <span class="mdi mdi-account-cancel-outline text-danger fs-5" title="Block user"></span>
                                                                </a>
                                                            @endif
                                                        @endif
                                                    </td>
                                                </tr>



                                                <!-- Modal detail-->
                                                <div class="modal fade" id="updateForm{{ $item->id }}"
                                                    data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
                                                    aria-labelledby="updateForm{{ $item->id }}Label"
                                                    aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-centere modal-lg">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h1 class="modal-title fs-5"
                                                                    id="updateForm{{ $item->id }}"><span
                                                                        class="mdi mdi-book-open"></span>
                                                                    {{ __('nav.userDetail') }} </h1>
                                                                <button type="button" class="btn-close"
                                                                    data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="row">
                                                                    <div class="col-sm-12 col-md-4 ">
                                                                        <div class="bg-light p-3">
                                                                            <p class="fw-bold text-primary text-center">
                                                                                {{ __('home.userProfile') }} </p>
                                                                            <div id="proImg">
                                                                                @if ($item->profile != '')
                                                                                    <img id="profileImage"
                                                                                        src="{{ asset($item->profile) }}"
                                                                                        alt="User profile">
                                                                                @else
                                                                                    <img id="profileImage"
                                                                                        src="{{ asset('images/draft-user.jpg') }}"
                                                                                        alt="User profile">
                                                                                @endif
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-sm-12 col-md-8">
                                                                        <div class="bg-light p-3">
                                                                            <p class="fw-bold text-primary text-center">
                                                                                {{ __('nav.userInfo') }} </p>
                                                                            <div class="row mt-2">
                                                                                <div class="col-sm-12 col-md-3 col-l-3">
                                                                                    {{ __('nav.staffId') }}
                                                                                </div>
                                                                                <div class="col-sm-12 col-md-9 col-l-9">
                                                                                    {{ $item->card_id }}
                                                                                </div>
                                                                            </div>
                                                                            <div class="row mt-2">
                                                                                <div class="col-sm-12 col-md-3 col-l-3">
                                                                                    {{ __('nav.fullNameKh') }}
                                                                                </div>
                                                                                <div class="col-sm-12 col-md-9 col-l-9">
                                                                                    {{ $item->name_kh }}
                                                                                </div>
                                                                            </div>
                                                                            <div class="row mt-2">
                                                                                <div class="col-sm-12 col-md-3 col-l-3">
                                                                                    {{ __('nav.fullNameEn') }}
                                                                                </div>
                                                                                <div class="col-sm-12 col-md-9 col-l-9">
                                                                                    {{ $item->name_en }}
                                                                                </div>
                                                                            </div>
                                                                            <div class="row mt-2">
                                                                                <div class="col-sm-12 col-md-3 col-l-3">
                                                                                    {{ __('nav.username') }}
                                                                                </div>
                                                                                <div class="col-sm-12 col-md-9 col-l-9">
                                                                                    {{ $item->email }}
                                                                                    @if ($item->block_status == '1')
                                                                                        <span
                                                                                            class="ms-3 ui label tiny green"><span
                                                                                                class="mdi mdi-check-circle-outline"></span>
                                                                                            Active</span>
                                                                                    @else
                                                                                        <span
                                                                                            class="ms-3 ui label tiny red"><span
                                                                                                class="mdi mdi-account-cancel-outline"></span>
                                                                                            Blocked</span>
                                                                                    @endif


                                                                                </div>
                                                                            </div>
                                                                            <div class="row mt-2">
                                                                                <div class="col-sm-12 col-md-3 col-l-3">
                                                                                    {{ __('nav.userRole') }}
                                                                                </div>
                                                                                <div class="col-sm-12 col-md-9 col-l-9">
                                                                                    <p class="ui label mini teal">
                                                                                        {{ $item->role_name }}
                                                                                </div>
                                                                            </div>
                                                                            <div class="row mt-2">
                                                                                <div class="col-sm-12 col-md-3 col-l-3">
                                                                                    {{ __('nav.gender') }}
                                                                                </div>
                                                                                <div class="col-sm-12 col-md-9 col-l-9">
                                                                                    {{ $item->gender }}
                                                                                </div>
                                                                            </div>
                                                                            <div class="row mt-2">
                                                                                <div class="col-sm-12 col-md-3 col-l-3">

                                                                                    {{ __('nav.department') }}
                                                                                </div>
                                                                                <div class="col-sm-12 col-md-9 col-l-9">

                                                                                    @if (session('localization') == 'en')
                                                                                        {{ $item->dep_name_en }}
                                                                                    @else
                                                                                        {{ $item->dep_name_kh }}
                                                                                    @endif

                                                                                </div>
                                                                            </div>


                                                                            <div class="row mt-2">
                                                                                <div class="col-sm-12 col-md-3 col-l-3">
                                                                                    {{ __('nav.position') }}
                                                                                </div>
                                                                                <div class="col-sm-12 col-md-9 col-l-9">
                                                                                    {{ $item->position_name }}
                                                                                </div>
                                                                            </div>

                                                                            <div class="row mt-2">
                                                                                <div class="col-sm-12 col-md-3 col-l-3">
                                                                                    {{ __('nav.section') }}
                                                                                </div>
                                                                                <div class="col-sm-12 col-md-9 col-l-9">
                                                                                    @if (session('localization') == 'en')
                                                                                        {{ $item->section_en }}
                                                                                    @else
                                                                                        {{ $item->section_kh }}
                                                                                    @endif
                                                                                </div>
                                                                            </div>







                                                                            <div class="row mt-2">
                                                                                <div class="col-sm-12 col-md-3 col-l-3">
                                                                                    {{ __('nav.phoneNumber') }}
                                                                                </div>
                                                                                <div class="col-sm-12 col-md-9 col-l-9">
                                                                                    {{ $item->phone_number }}
                                                                                </div>
                                                                            </div>
                                                                            <div class="row mt-2">
                                                                                <div class="col-sm-12 col-md-3 col-l-3">
                                                                                    {{ __('nav.emailAddress') }}
                                                                                </div>
                                                                                <div class="col-sm-12 col-md-9 col-l-9">
                                                                                    {{ $item->email_address }}
                                                                                </div>
                                                                            </div>
                                                                            <div class="row mt-2 px-2">
                                                                                <div class="col-12 border-bottom">

                                                                                </div>
                                                                            </div>
                                                                            <div class="row mt-3">
                                                                                <div class="col-sm-12 col-md-3 col-l-3">
                                                                                    {{-- <p class="fw-bold">Email</p> --}}
                                                                                </div>
                                                                                <div class="col-sm-12 col-md-9 col-l-9">
                                                                                    <p> {{ __('nav.createAt') }} :
                                                                                        {{ $item->created_at }}</p>
                                                                                    <p> {{ __('nav.createBy') }} :
                                                                                        {{ $item->create_by }}</p>
                                                                                    @if ($item->block_status == '0')
                                                                                        <p class="text-danger">
                                                                                            {{ __('nav.blockAt') }} :
                                                                                            {{ $item->block_date }}</p>
                                                                                        <p class="text-danger">
                                                                                            {{ __('nav.blockBy') }} :
                                                                                            {{ $item->block_by }}</p>
                                                                                    @endif

                                                                                </div>
                                                                            </div>


                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="ui button mini grey"
                                                                    data-bs-dismiss="modal">
                                                                    <i class="x icon"></i> {{ __('nav.close') }}
                                                                </button>
                                                            </div>

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
    @if ($checkRole->role_name == 'admin' || $checkRole->role_name == 'Admin' || $action->action_edit == 1)
        {{-- modal reset password --}}
        <div class="modal fade" id="resetPassword" data-bs-backdrop="static">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">

                    <form action="{{ route('user.reset') }}" method="post" autocomplete="off">

                        <div class="modal-body">
                            @csrf

                            <input type="hidden" class="d-none" readonly name="userId" id="userId" value="">

                            <h2 class="ui icon header text-center w-100">
                                <i class="lock open icon"></i>
                                <div class="content mt-3">
                                    {{ __('nav.resetPass') }}
                                    {{-- <div class="sub header mt-2"> {{ __('nav.doYouWantToRestore') }} </div> --}}
                                </div>
                            </h2>
                            <label for="password">{{ __('nav.operatorPass') }} <span class="text-danger">*</span></label>
                            <input type="password" id="password" name="password" autofocus
                                class="form-control form-group-lg" placeholder="{{ __('nav.operatorPass') }}" required>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="ui button tiny" data-bs-dismiss="modal">
                                <span class="mdi mdi-close icon"></span>
                                {{ __('nav.cancel') }}
                            </button>
                            <button type="submit" class="ui button tiny blue">
                                <span class="mdi mdi-lock-reset icon"></span>
                                {{ __('nav.okay') }}
                            </button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    @endif

    @if ($checkRole->role_name == 'admin' || $checkRole->role_name == 'Admin' || $action->action_delete == 1)
        <!-- Modal block-->
        <div class="modal fade" id="blockModal">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <form action="{{ route('user.block') }}" method="post" autocomplete="off">
                        <div class="modal-body">
                            @csrf
                            <input type="hidden" class="d-none" name="userId" id="blockuserId" value="">

                            <h2 class="ui icon header text-center w-100">
                                <i class="question icon"></i>
                                <div class="content mt-3">
                                    {{ __('nav.blockUser') }}
                                    <div class="sub header mt-2"> {{ __('nav.doYouWantToBlock') }} </div>
                                </div>
                            </h2>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="ui button tiny" data-bs-dismiss="modal"><span
                                    class="mdi mdi-close icon"></span>{{ __('nav.cancel') }}</button>
                            <button type="submit" class="ui button tiny red">
                                <span class="mdi mdi-account-cancel icon"></span>
                                {{ __('nav.yesBlock') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Modal unblock-->
        <div class="modal fade" id="unblockModal">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <form action="{{ route('user.unblock') }}" method="post" autocomplete="off">
                        <div class="modal-body">
                            @csrf
                            <input type="hidden" class="d-none" name="userId" id="unblockuserId" value="">
                            <h2 class="ui icon header text-center w-100">
                                <i class="question icon"></i>
                                <div class="content mt-3">
                                    {{ __('nav.unblockUser') }}
                                    <div class="sub header mt-2"> {{ __('nav.doYouWantToUnblock') }} </div>
                                </div>
                            </h2>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="ui button tiny" data-bs-dismiss="modal"><span
                                    class="mdi mdi-close icon"></span>{{ __('nav.cancel') }}</button>
                            <button type="submit" class="ui button tiny blue">
                                <span class="mdi mdi-backup-restore icon"></span>
                                {{ __('nav.yesUnblock') }}
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
            $('#users').addClass('nav-item active');
            $('#tables').addClass('collapse show');


            // reset password work
            $(document).on('click', '#resetPasswordButton', function() {
                var userId = $(this).data('id');
                $('#resetPassword').modal('show');
                $('#userId').val(userId);
            });

            $(document).on('click', '#blockButton', function () {
                var userId = $(this).data('id');
                $('#blockModal').modal('show');
                $('#blockuserId').val(userId);
            });

            $(document).on('click', '#unblockButton', function () {
                var userId = $(this).data('id');
                $('#unblockModal').modal('show');
                $('#unblockuserId').val(userId);
            });
        });
    </script>
@endsection
