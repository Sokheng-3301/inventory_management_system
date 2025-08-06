@extends('layout/master')

@section('title')
    <title> {{ __('nav.staffList') }} | IMS</title>
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
                        <h3 class="font-weight-bold"> {{ __('nav.staffList') }} </h3>
                        <h6 class="font-weight-normal mb-0">{{ __('nav.master') }} / <span class="text-primary"><a
                                    class="text-primary" href=""> {{ __('nav.staffList') }}</a></span></h6>
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

                                @if (
                                    $checkRole->role_name == 'admin' ||
                                        $checkRole->role_name == 'Admin' ||
                                        $checkRole->role_name == 'Super Admin' ||
                                        $action->action_edit == 1)
                                    <div class="row">
                                        <div class="col-8 col-sm-7 mb-2  col-md-7">
                                            <div class="ui small icon buttons">
                                                <button class="ui button fw-normal" title="print" id="printButton"><i
                                                        class="print icon"></i>Print</button>
                                                <a href="{{ route('staff.export') }}" class="ui button fw-normal"
                                                    title="Excel"><i class="file excel icon"></i>Excel</a>
                                                <a href="{{ route('staff.exportPdf') }}" class="ui button fw-normal"
                                                    title=  "PDF"><i class="file pdf icon"></i>PDF</a>
                                            </div>
                                        </div>

                                        <div class="col-4 col-sm-5 mb-2  col-md-5 text-end">
                                            <a href="{{ route('staff.create') }}" class="ui button primary tiny"><span
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
                                                <th> {{ __('nav.staffInfo') }} </th>
                                                <th> {{ __('nav.position') }} </th>
                                                <th class="text-center">{{ __('nav.gender') }}</th>
                                                <th class="text-start"> {{ __('nav.createAt') }} </th>
                                                <th class="text-center"> {{ __('nav.actions') }} </th>
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
                                                    <td class="text <?php
                                                    if ($item->block_status == '0') {
                                                        echo 'text-danger';
                                                    }
                                                    ?>">
                                                        <p><span class="text-muted">ID :</span> {!! $item->card_id ?? '<span class="text-primary">' . __('nav.newStaff') . '</span>' !!}</p>
                                                        <p>{{ $item->gender == 'Male' ? __('nav.Mr') : __('nav.Miss') }}
                                                            {{ session('localization') == 'kh' ? $item->name_kh : strtoupper($item->name_en) }}</p>
                                                        
                                                    </td>
                                                    <td class="text <?php
                                                    if ($item->block_status == '0') {
                                                        echo 'text-danger';
                                                    }
                                                    ?>">
                                                        <p><span class="text-muted">Dept : </span><span
                                                                class="text-uppercase">{{ session('localization') == 'kh' ? $item->dep_name_kh : $item->dep_name_en }}</span>
                                                        </p>
                                                        <p><span class="text-muted">Sect : </span><span
                                                                class="text-uppercase">{{ session('localization') == 'kh' ? $item->section_kh : $item->section_en }}</span>
                                                        </p>
                                                        <p><span class="text-muted">Post :
                                                            </span>{{ strtoupper($item->position_name) }}</p>
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
                                                    </td>


                                                    <td
                                                        class="text-start text {{ $item->block_status == '0' ? 'text-danger' : '' }}">
                                                        <p class="text-uppercase">{{ $item->create_by }}</p>
                                                        <p class="text-muted">
                                                            {{ Carbon\Carbon::parse($item->created_at)->format('d M Y h:i:s A') }}
                                                        </p>
                                                    </td>

                                                    <td class="text-center">
                                                        <a type="button" data-id="{{ $item->id }}"
                                                            id="detailButton"><span
                                                                class="mdi mdi-eye-outline fs-5 text-primary"
                                                                title="View detail"></span></a>

                                                        @if ($checkRole->role_name == 'admin' || $checkRole->role_name == 'Admin' || $checkRole->role_name == 'Super Admin' || $action->action_edit == 1)
                                                            | <a href="{{ route('staff.edit', $item->id) }}" class="text-success"><span
                                                                    class="mdi mdi-square-edit-outline fs-5 text-success"
                                                                    title="Update data"></span></a>
                                                        @endif

                                                        {{-- @if ($checkRole->role_name == 'admin' || $checkRole->role_name == 'Admin' || $action->action_delete == 1)
                                                        |
                                                            @if ($item->block_status == '0')
                                                                <a type="button" data-bs-toggle="modal"
                                                                    data-bs-target="#recoveryCategory{{ $item->id }}"><span
                                                                        class="mdi mdi-backup-restore fw-bold text-success fs-5"
                                                                        title="Recovery user"></span></a>
                                                            @else
                                                                <a type="button" data-bs-toggle="modal"
                                                                    data-bs-target="#deleteVerify{{ $item->id }}"><span
                                                                        class="mdi mdi-account-cancel-outline text-danger fs-5"
                                                                        title="Block user"></span></a>
                                                            @endif
                                                        @endif --}}
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

    {{-- modal detail staff info  --}}
    <div class="modal fade" id="staffInfoModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="updateForm"><span class="mdi mdi-book-open"></span>
                        {{ __('nav.staffInfo') }} </h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-sm-12 ">
                            <div class="p-1">
                                <div id="proImg">
                                    <img id="profileImage" src="{{ asset('images/draft-user.jpg') }}"
                                        alt="User profile">
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-12 p-1">
                            <div class="p-0">
                                <p class="fw-bold text-primary text-center"> {{ __('nav.staffInfo') }} </p>
                                <div class="row mt-4">
                                    <div class="col-4 col-md-4">
                                        {{ __('nav.staffId') }}
                                    </div>
                                    <div class="col-1">:</div>
                                    <div class="col-6 col-md-7" id="card_id"></div>
                                </div>
                                <div class="row mt-2">
                                    <div class="col-4 col-md-4">
                                        {{ __('nav.fullNameKh') }}
                                    </div>
                                    <div class="col-1">:</div>
                                    <div class="col-6 col-md-7" id="name_kh"></div>
                                </div>
                                <div class="row mt-2">
                                    <div class="col-4 col-md-4">
                                        {{ __('nav.fullNameEn') }}
                                    </div>
                                    <div class="col-1">:</div>
                                    <div class="text-uppercase col-6 col-md-7" id="name_en"></div>
                                </div>

                                <div class="row mt-2">
                                    <div class="col-4 col-md-4">
                                        {{ __('nav.gender') }}
                                    </div>
                                    <div class="col-1">:</div>
                                    <div class="col-6 col-md-7" id="gender"></div>
                                </div>

                                <div class="row mt-2">
                                    <div class="col-4 col-md-4">
                                        {{ __('nav.department') }}
                                    </div>
                                    <div class="col-1">:</div>
                                    <div class="col-6 col-md-7 text-uppercase" id="department"></div>
                                </div>

                                <div class="row mt-2">
                                    <div class="col-4 col-md-4">
                                        {{ __('nav.position') }}
                                    </div>
                                    <div class="col-1">:</div>
                                    <div class="col-6 col-md-7 text-uppercase" id="position"></div>
                                </div>


                                <div class="row mt-2">
                                    <div class="col-4 col-md-4">
                                        {{ __('nav.section') }}
                                    </div>
                                    <div class="col-1">:</div>
                                    <div class="col-6 col-md-7 text-uppercase" id="section"></div>
                                </div>

                                <div class="row mt-2">
                                    <div class="col-4 col-md-4">
                                        {{ __('nav.phoneNumber') }}
                                    </div>
                                    <div class="col-1">:</div>
                                    <div class="col-6 col-md-7" id="phone_number"></div>
                                </div>

                                {{-- <div class="row mt-2">
                                    <div class="col-4 col-md-4">
                                        {{ __('nav.emailAddress') }}
                                    </div>
                                    <div class="col-1">:</div>
                                    <div class="col-6 col-md-7 text-break" id="email_address"></div>
                                </div> --}}





                                <div class="row mt-4 mx-auto">
                                    <div class="col-12 border-bottom"></div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col-sm-12 col-md-12 text-center text-muted">
                                        <p class="m-0"> {{ __('nav.createAt') }} : <span id="created_at"></span></p>
                                        <p class="m-0"> {{ __('nav.createBy') }} : <span id="create_by" class="text-uppercase"></span></p>

                                        {{-- @if ($item->block_status == '0')
                                            <p class="text-danger"> {{ __('nav.blockAt') }} : {{ $item->block_date }}</p>
                                            <p class="text-danger"> {{ __('nav.blockBy') }} : {{ $item->block_by }}</p>
                                        @endif 
                                        <div class="m-0" id="delete_info"></div>
                                        --}}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- <div class="modal-footer">
                    <button type="button" class="ui button mini grey" data-bs-dismiss="modal">
                        <i class="x icon"></i> {{ __('nav.close') }}
                    </button>
                </div> --}}

            </div>
        </div>
    </div>
@endsection


@section('js')
    <script type="text/javascript">
        $(document).ready(function() {
            $('#master').addClass('nav-item active');
            $('#ui-basic').addClass('collapse show');

            $(document).on('click', '#detailButton', function() {
                var id = $(this).data('id');
                var url = "{{ route('staff.show', ':id') }}".replace(':id', id);
                $.ajax({
                    type: "GET",
                    url: url,
                    dataType: "json",
                    success: function(response) {
                        $('#staffInfoModal').modal('show');

                        $('#profileImage').attr('src', response.data.profile ?
                            "{{ asset('') }}" + response.data.profile :
                            "{{ asset('images/draft-user.jpg') }}");

                        $('#card_id').text(response.card_id);
                        $('#name_kh').text(response.data.name_kh);
                        $('#name_en').text(response.data.name_en);

                        $('#gender').text(response.gender);
                        $('#department').text(response.department);
                        $('#position').text(response.data.position_name);
                        $('#section').text(response.section);
                        $('#phone_number').text(response.data.phone_number);
                        $('#email_address').text(response.data.email_address ? response.data
                            .email_address : 'N/A'); // Fixed here

                        $('#created_at').text(response.created_at);
                        $('#create_by').text(response.data.create_by);




                    }
                });
            });
        });
    </script>
@endsection
