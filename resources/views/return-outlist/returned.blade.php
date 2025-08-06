@extends('layout/master')

@section('title')
    <title> {{ __('nav.returnOutlist') }} | IMS</title>
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

        .attchLabel {
            width: 100%;
            display: block;
        }

        .attch {
            width: 100%;
            height: auto;
            /* display: flex; */
            align-items: center;
            text-align: center;
            cursor: pointer;
            display: block;
            border: 1.8px dashed #d0d4d9;
            padding: 10px;
            border-radius: 5px;
        }

        .attch img.icon {
            width: 15%;
        }

        .attch img {
            width: 100%
        }

        .attachmentFile {
            display: none;
        }

        .give-btn:hover {
            background-color: #45942b;
            box-shadow: 1px 1px 6px rgb(88, 88, 88);
        }

        .img img {
            width: 20%;
        }

        .attachment {
            width: 100%;
        }
    </style>
@endsection


@section('content')
    <div class="content-wrapper">
        <div class="row">
            <div class="col-md-12 grid-margin">
                <div class="row">
                    <div class="col-12 col-xl-8 mb-4 mb-xl-0">
                        <h3 class="font-weight-bold">{{ __('nav.returnOutlist') }} </h3>
                        <h6 class="font-weight-normal mb-0">{{ __('nav.product') }} / <span class="text-primary"><a
                                    class="text-primary" href="">{{ __('nav.returnOutlist') }} </a></span></h6>
                    </div>
                </div>
                <div class="row mt-4">
                    <div class="col-sm-12 col-md-12 col-l-12 col-xl-12">
                        @include('layout.back-button')
                        <div class="card p-2">
                            <div class="card-body">
                                <div class="row d-flex align-items-center mb-3">
                                    @php
                                        $checkRole = DB::table('user_roles')
                                            ->where('id', @Auth::user()->role_id)
                                            ->get()
                                            ->first();
                                    @endphp

                                    @if ($checkRole->role_name == 'admin' || $checkRole->role_name == 'Admin' || $action->action_edit == 1)
                                        <div class="col-8 col-sm-7 mb-2  col-md-7">
                                            <div class="ui small icon buttons">
                                                <button class="ui button fw-normal" title="print" id="printButton"><i
                                                        class="print icon"></i>Print</button>
                                                <a href="{{ route('returnOutList.exportExcel') }}"
                                                    class="ui button fw-normal" title="Excel"><i
                                                        class="file excel icon"></i>Excel</a>
                                                <a href="{{ route('returnOutList.exportPdf') }}" class="ui button fw-normal"
                                                    title= "PDF"><i class="file pdf icon"></i>PDF</a>
                                            </div>
                                        </div>
                                        <div class="col-4 col-sm-5 mb-2  col-md-5 text-end">
                                            <a href="{{ route('returnOutList.create') }}"
                                                class="ui button primary tiny"><span
                                                    class="mdi mdi-plus-circle icon"></span> {{ __('nav.addNew') }}
                                            </a>
                                        </div>
                                    @endif
                                </div>

                                <div class="table-responsive">
                                    <table id="myTable" class="display table table-striped">
                                        <thead>
                                            <tr>
                                                <th style="width: 10px;" class="text-start">{{ __('home.no') }}</th>
                                                <th> {{ __('nav.profile') }} </th>
                                                <th> {{ __('nav.staffInfo') }} </th>
                                                <th> {{ __('nav.itemReturn') }} </th>
                                                <th> {{ __('nav.status') }} </th>
                                                <th> {{ __('nav.returnDate') }} </th>
                                                <th class="text-center"> {{ __('nav.actions') }} </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php
                                                $auto = 1;
                                            @endphp
                                            @foreach ($product as $item)
                                                <tr>
                                                    <td style="width: 10px" class="text-start ">
                                                        {{ $auto++ }}
                                                    </td>

                                                    <td>
                                                        @if ($item->profile == '')
                                                            <img src="{{ asset('images/draft-user.jpg') }}" alt="">
                                                        @else
                                                            <img src="{{ asset($item->profile) }}" alt="">
                                                        @endif
                                                    </td>

                                                    <td class="text">
                                                        <p><span class="text-muted">ID : </span> {!! $item->card_id ?? '<span class="text-info">' . __('nav.newStaff') . '</span>' !!}</p>
                                                        <p class="text-capitalize"><span
                                                                class="text-muted">{{ $item->gender == 'Male' ? __('nav.Mr') : __('nav.Miss') }}</span>
                                                            {{ session('localization') == 'kh' ? $item->name_kh : strtoupper($item->name_en) }}</p>
                                                        <p><span class="text-muted">Dept : </span>
                                                            {{ session('localization') == 'kh' ? $item->dep_name_kh : strtoupper($item->dep_name_en) }}</p>
                                                        <p><span class="text-muted">Sect : </span>
                                                            {{ session('localization') == 'kh' ? $item->section_kh : strtoupper($item->section_en) }}</p>
                                                        <p><span class="text-muted">Post : </span>
                                                            {{ strtoupper($item->position_name) }}</p>
                                                    </td>

                                                    <td class="text">
                                                        <p>
                                                            <span class="text-muted">Code.</span>
                                                            {{ $item->item_code ?? 'N/A' }}
                                                        </p>
                                                        <p>
                                                            <span class="text-muted">Item.</span>
                                                            {{ session('localization') == 'kh' ? $item->item_name_kh : $item->item_name_en }}
                                                        </p>
                                                        <p>
                                                            <span class="text-muted">SN.</span>
                                                            {{ $item->serial_number ?? 'N/A' }}
                                                        </p>
                                                        <p>
                                                            <span class="text-muted">FAC.</span>
                                                            {{ $item->fix_asset_code ?? 'N/A' }}
                                                        </p>
                                                        <p>
                                                            <span class="text-muted">Mod.</span>
                                                            {{ $item->model ?? 'N/A' }}
                                                        </p>
                                                    </td>

                                                    <td class="text-break">
                                                        {{ $item->item_status }}
                                                    </td>

                                                    <td class="text-muted">
                                                        {{ Carbon\Carbon::parse($item->returned_date)->format('d M Y h:i:s A') }}
                                                    </td>
                                                    <td class="text-center">
                                                        <a type="button" id="detailButton"
                                                            data-id="{{ $item->returned_id }}"><span
                                                                class="mdi mdi-eye-outline fs-5 text-primary"
                                                                title="View detail"></span></a>

                                                        @if ($checkRole->role_name == 'admin' || $checkRole->role_name == 'Admin' || $action->action_edit == 1)
                                                            | <a href="{{ route('returnOutList.edit', $item->returned_id) }}"
                                                                class="mdi mdi-square-edit-outline fs-5 text-muted"
                                                                title="Edit give product"></span></a>
                                                        @endif
                                                    </td>
                                                </tr>
                                            @endforeach
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

    <!-- Modal detail-->
    {{-- <div class="modal fade" id="updateForm{{$item->giveId}}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="updateForm{{$item->giveId}}Label" aria-hidden="true"> --}}
    <div class="modal fade" id="detailGivenProduct" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="updateFormLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="updateForm"><span class="mdi mdi-book-open"></span>
                        {{ __('nav.returnDetail') }}
                    </h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-sm-12 col-md-5 mb-3 mx-auto">
                            <div class="bg-light p-3">
                                <div class="col-4 mx-auto">
                                    <img src="{{ asset('images/draft-user.jpg') }}" id="profile_img" alt=""
                                        width="100%">
                                </div>
                                <div class="row mt-4">
                                    <div class="col-12">
                                        <h5 class="text-primary">{{ __('nav.returnBy') }}</h5>
                                        <hr>
                                    </div>

                                    <div class="col-4">
                                        <label for="">{{ __('nav.staffId') }}</label>
                                    </div>
                                    <div class="col-8">
                                        <span class="pe-3">:</span>
                                        <span id="card_id"></span>
                                    </div>

                                    <div class="col-4">
                                        <label for="">{{ __('nav.name') }}</label>
                                    </div>
                                    <div class="col-8">
                                        <span class="pe-3">:</span>
                                        <span id="fullname"></span>
                                    </div>

                                    <div class="col-4">
                                        <label for="">{{ __('nav.gender') }}</label>
                                    </div>
                                    <div class="col-8">
                                        <span class="pe-3">:</span>
                                        <span id="gender"></span>
                                    </div>

                                    <div class="col-4">
                                        <label for="">{{ __('nav.department') }}</label>
                                    </div>
                                    <div class="col-8">
                                        <span class="pe-3">:</span>
                                        <span id="department_name"></span>
                                    </div>

                                    <div class="col-4">
                                        <label for="">{{ __('nav.position') }}</label>
                                    </div>
                                    <div class="col-8">
                                        <span class="pe-3">:</span>
                                        <span id="position_name"></span>
                                    </div>


                                    <div class="col-4">
                                        <label for="">{{ __('nav.section') }}</label>
                                    </div>
                                    <div class="col-8">
                                        <span class="pe-3">:</span>
                                        <span id="section_name"></span>
                                    </div>
                                    <div class="col-4">
                                        <label for="">{{ __('nav.phoneNumber') }}</label>
                                    </div>
                                    <div class="col-8">
                                        <span class="pe-3">:</span>
                                        <span id="phone_number"></span>
                                    </div>

                                    {{-- <div class="col-4">
                                        <label for="">{{ __('nav.emailAddress') }}</label>
                                    </div>
                                    <div class="col-8">
                                        <span class="pe-3">:</span>
                                        <span id="email_address"></span>
                                    </div> --}}


                                    <div class="col-12 mt-3">
                                        <h5 class="text-primary">{{ __('nav.receiveBy') }}</h5>
                                        <hr>
                                    </div>

                                    <div class="col-4">
                                        <label for="">{{ __('nav.name') }}</label>
                                    </div>
                                    <div class="col-8">
                                        <span class="pe-3">:</span>
                                        <span id="add_by"></span>
                                    </div>

                                    {{-- <div class="col-4">
                                        <label for="">{{ __('nav.givenDate') }}</label>
                                    </div>
                                    <div class="col-8">
                                        <span class="pe-3">:</span>
                                        <span id="given_date"></span>
                                    </div> --}}

                                    <div class="col-4">
                                        <label for="">{{ __('nav.returnDate') }}</label>
                                    </div>
                                    <div class="col-8">
                                        <span class="pe-3">:</span>
                                        <span id="returned_date"></span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- given product detail --}}
                        <div class="col-sm-12 col-md-7">
                            <div class="bg-light p-3">
                                <div class="col-sm-12 p-0">
                                    <label class="fw-bold">{{ __('nav.product') }}</label>
                                </div>
                                <div class="table-responsive">
                                    <table class="display table table-striped">
                                        <thead>
                                            <tr>
                                                <th>{{ __('home.no') }}</th>

                                                {{-- <th>{{ __('nav.img') }}</th> --}}
                                                {{-- <td>
                                                    <img src="${data.pro_img ? "{{ asset('') }}" + data.pro_img : "{{ asset('images/draft-image.png') }}"}" alt="">
                                                </td> --}}

                                                <th>{{ __('nav.proCode') }}</th>
                                                <th>{{ __('nav.proName') }}</th>
                                                <th>{{ __('home.qty') }}</th>
                                                <th>{{ __('nav.model') }}</th>
                                                <th>{{ __('nav.serial_number') }}</th>
                                                <th>{{ __('nav.fix_asset_code') }}</th>
                                                <th>{{ __('nav.category') }}</th>
                                            </tr>
                                        </thead>
                                        <tbody id="product_table_data"></tbody>
                                    </table>
                                </div>

                                <div class="col-sm-12 mt-5 p-0">
                                    <label for="proNameEn" class="fw-bold">{{ __('nav.returnAtt') }}</label>
                                </div>
                                <div class="row d-flex align-items-center mt-2">
                                    <div class="col-sm-12 col-md-12" id="hover">
                                        <div id="attachment"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- <div class="modal-footer">
                    <button type="button" class="ui button mini grey" data-bs-dismiss="modal"><span
                            class="mdi mdi-close"></span>
                        {{ __('nav.close') }}</button>
                </div> --}}
            </div>
        </div>
    </div>
@endsection


@section('js')
    <script>
        $(document).ready(function() {
            $('#givenAndReturned').addClass('nav-item active');
            $('#error').addClass('collapse show');

            $(document).on('click', '#detailButton', function() {
                var id = $(this).data('id');
                var url = "{{ route('returnOutList.show', ':id') }}".replace(':id', id);

                $('#detailGivenProduct').modal('show');
                $.ajax({
                    type: "GET",
                    url: url,
                    dataType: "json",
                    success: function(response) {
                        // Check if response and data exist
                        if (response.data) {
                            // Update the profile image
                            if (response.data.profile) {
                                $('#profile_img').attr('src', "{{ asset('') }}" + response
                                    .data.profile);
                            }

                            $('#card_id').text(response.data.card_id);
                            $('#fullname').text(response.data.name_kh + ' - ' +
                                response.data.name_en);
                            $('#gender').text(response.gender);
                            $('#department_name').text(response.department);
                            $('#section_name').text(response.section);

                            // Set additional text fields
                            $('#position_name').text(response.data.position_name);
                            $('#phone_number').text(response.data.phone_number);
                            // $('#email_address').text(response.data.email_address);
                            $('#add_by').text(response.data.recieve_by);
                            // $('#given_date').text(response.data.giveDate);
                            $('#returned_date').text(response.returnDate);

                            // Clear previous product table data
                            $('#product_table_data').empty();

                            // Loop through related products and append rows
                            // response.data.relatedProducts.forEach((product, index) => {
                            $('#product_table_data').append(`
                                <tr>
                                    <td>1</td>
                                    <td>${response.data.item_code}</td>
                                    <td>${response.data.item_name_en}</td>
                                    <td>1</td>
                                    <td>${response.data.model}</td>
                                    <td>${response.data.serial_number}</td>
                                    <td>${response.data.fix_asset_code}</td>
                                    <td>${response.data.cat_name}</td>
                                </tr>
                            `);
                            // });

                            if (response.data.attachment) {
                                $('#attachment').html(`
                                    <img src="${response.data.attachment ? '{{ asset('') }}' + response.data.attachment : '{{ asset('images/draft-image.png') }}'}" alt="" width="100%">
                                `);
                            } else {
                                $('#attachment').html(`
                                <p>No attachment available.</p>
                            `);
                            }
                        } else {
                            console.error("No product data found.");
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error("AJAX request failed:", status, error);
                    }
                });
            });
        });
    </script>
@endsection
