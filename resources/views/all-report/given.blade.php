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

        #hover:hover #detail_hover {
            width: 90%;
            height: 100%;
            background: red;
            position: absolute;
            display: block;
            z-index: 20000;
            top: 0;
            left: 0;
        }
    </style>
@endsection


@section('content')
    <div class="content-wrapper">
        <div class="row">
            @include('all-report.include')

            <div class="col-md-12 grid-margin">
                <div class="row">
                    <div class="col-12 col-xl-8 mb-4 mb-xl-0">
                        <h3 class="font-weight-bold">{{ __('nav.given') }} </h3>
                        <h6 class="font-weight-normal mb-0">{{ __('nav.product') }} / <span class="text-primary"><a
                                    class="text-primary" href="">{{ __('nav.given') }} </a></span></h6>
                    </div>
                </div>

                <div class="row mt-4">
                    <div class="col-sm-12 col-md-12 col-l-12 col-xl-12">
                        {{-- @include('layout.back-button') --}}
                        <div class="row">
                            <div class="col-md-12 grid-margin stretch-card">
                                <div class="card">
                                    <div class="card-body">
                                        <p class="card-title">{{ __('nav.searchGivenData') }}</p>
                                        <form action="" method="get"
                                            class="ui form p-3 border border-1 border-light rounded-3">
                                            {{-- @csrf --}}
                                            <div class="row">
                                                <div class="col-md-3 field d-block w-100">
                                                    <label for="year" class="d-block"> {{ __('nav.year') }} </label>
                                                    <select name="year" class="ui search dropdown4 d-block w-100"
                                                        id="">
                                                        {{-- <option value="">Select year</option> --}}
                                                        @php
                                                            $year = DB::table('year')->orderBy('id', 'desc')->get();
                                                        @endphp
                                                        @foreach ($year as $y)
                                                            <option {{ $y->year == date('Y') ? 'selected' : '' }}
                                                                value="{{ $y->year }}">{{ $y->year }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>

                                                <div class="col-md-3 field d-block w-100">
                                                    <label for="month" class="d-block"> {{ __('nav.month') }} </label>
                                                    <select class="ui fluid search dropdown d-block w-100" name="month"
                                                        id="month">
                                                        <option value=""> {{ __('nav.month') }} </option>
                                                        <option value="01" {{ @$month == '01' ? 'selected' : '' }}>
                                                            January</option>
                                                        <option value="02" {{ @$month == '02' ? 'selected' : '' }}>
                                                            February</option>
                                                        <option value="03" {{ @$month == '03' ? 'selected' : '' }}>
                                                            March</option>
                                                        <option value="04" {{ @$month == '04' ? 'selected' : '' }}>
                                                            April</option>
                                                        <option value="05" {{ @$month == '05' ? 'selected' : '' }}>May
                                                        </option>
                                                        <option value="06" {{ @$month == '06' ? 'selected' : '' }}>June
                                                        </option>
                                                        <option value="07" {{ @$month == '07' ? 'selected' : '' }}>July
                                                        </option>
                                                        <option value="08" {{ @$month == '08' ? 'selected' : '' }}>
                                                            August</option>
                                                        <option value="09" {{ @$month == '09' ? 'selected' : '' }}>
                                                            September</option>
                                                        <option value="10" {{ @$month == '10' ? 'selected' : '' }}>
                                                            October</option>
                                                        <option value="11" {{ @$month == '11' ? 'selected' : '' }}>
                                                            November</option>
                                                        <option value="12" {{ @$month == '12' ? 'selected' : '' }}>
                                                            December</option>
                                                    </select>
                                                </div>

                                                <div class="col-md-3 field d-block w-100">
                                                    <label for="week" class="d-block"> {{ __('nav.week') }} </label>
                                                    <select class="ui fluid search dropdown1 d-block w-100" name="week"
                                                        id="week">
                                                        <option value=""> {{ __('nav.week') }} </option>
                                                        <option value="1" {{ @$week == 1 ? 'selected' : '' }}>Week 1
                                                        </option>
                                                        <option value="2" {{ @$week == 2 ? 'selected' : '' }}>Week 2
                                                        </option>
                                                        <option value="3" {{ @$week == 3 ? 'selected' : '' }}>Week 3
                                                        </option>
                                                        <option value="4" {{ @$week == 4 ? 'selected' : '' }}>Week 4
                                                        </option>
                                                    </select>
                                                </div>

                                                <div class="col-md-3 field d-block w-100">
                                                    <label for="giveDate" class="d-block"> {{ __('nav.givenDate') }}
                                                    </label>
                                                    <div class="ui input d-block w-100">
                                                        <input type="text" name="giveDate" class="d-block w-100"
                                                            id="giveDate" value="{{ @$giveDate }}"
                                                            placeholder="{{ __('nav.ddmmyy') }}">
                                                    </div>
                                                </div>


                                                <div class="col-md-3 field d-block w-100">
                                                    <label for="department" class="d-block"> {{ __('nav.department') }}
                                                    </label>
                                                    <select class="ui fluid search dropdown2 d-block w-100"
                                                        name="department" id="department">
                                                        <option value=""> {{ __('nav.department') }} </option>
                                                        @php
                                                            $departments = DB::table('departments')
                                                                ->where('delete_status', 1)
                                                                ->orderBy('id', 'desc')
                                                                ->get();
                                                        @endphp
                                                        @foreach ($departments as $dep)
                                                            <option value="{{ $dep->id }}"
                                                                {{ @$department == $dep->id ? 'selected' : '' }}>
                                                                @if (session()->has('localization') && session('localization') == 'en')
                                                                    {{ $dep->dep_name_en }}
                                                                @else
                                                                    {{ $dep->dep_name_kh }}
                                                                @endif
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>


                                                <div class="col-md-3 field d-block w-100">
                                                    <label for="section" class="d-block"> {{ __('nav.section') }} </label>
                                                    <select class="ui fluid search dropdown3 d-block w-100" name="section"
                                                        id="section">
                                                        <option value=""> {{ __('nav.section') }} </option>
                                                        @php
                                                            $sections = DB::table('section')
                                                                ->where('delete_status', 1)
                                                                ->orderBy('id', 'desc')
                                                                ->get();
                                                        @endphp
                                                        @foreach ($sections as $sec)
                                                            <option value="{{ $sec->id }}"
                                                                {{ @$section == $sec->id ? 'selected' : '' }}>
                                                                @if (session()->has('localization') && session('localization') == 'en')
                                                                    {{ $sec->section_en }}
                                                                @else
                                                                    {{ $sec->section_kh }}
                                                                @endif
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>

                                                <div class="col-md-3 field d-block w-100">
                                                    <label for="position" class="d-block"> {{ __('nav.position') }}
                                                    </label>
                                                    <select class="ui fluid search dropdown5 d-block w-100" name="position"
                                                        id="position">
                                                        <option value=""> {{ __('nav.position') }} </option>

                                                        @php
                                                            $positions = DB::table('positions')
                                                                ->where('delete_status', 1)
                                                                ->orderBy('id', 'desc')
                                                                ->get();
                                                        @endphp

                                                        @foreach ($positions as $pos)
                                                            <option value="{{ $pos->id }}"
                                                                {{ @$position == $pos->id ? 'selected' : '' }}>

                                                                {{ $pos->position_name }}

                                                            </option>
                                                        @endforeach

                                                    </select>
                                                </div>

                                                <div class="col-md-3 field d-block w-100">
                                                    <label for="staff_id" class="d-block"> {{ __('nav.staffId') }} </label>
                                                    <div class="ui input d-block w-100">
                                                        <input type="text" name="staff_id" class="d-block w-100"
                                                            id="staff_id" value="{{ @$staff_id }}"
                                                            placeholder="{{ __('nav.staffId') }}">
                                                    </div>
                                                </div>

                                                <div class="col-md-12 field d-block w-100 text-right">
                                                    {{-- <label for="year" class="d-block"> &nbsp; </label> --}}
                                                    <a class="ui button tiny" href="{{ route('product.givenList') }}">
                                                        <i class="icon undo"></i>
                                                        {{ __('nav.reset') }}
                                                    </a>
                                                    <button class="ui button tiny blue" type="submit">
                                                        <i class="icon search"></i>
                                                        {{ __('nav.search') }}
                                                    </button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
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
                                                <a href="{{ route('product.givenExport', request()->all()) }}"
                                                    class="ui button fw-normal" title="Excel"><i
                                                        class="file excel icon"></i>Excel</a>
                                                <a href="{{ route('productGiven.pdf', request()->all()) }}"
                                                    class="ui button fw-normal" title=  "PDF"><i
                                                        class="file pdf icon"></i>PDF</a>
                                            </div>
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
                                                <th> {{ __('nav.itemInfo') }} </th>
                                                <th> {{ __('nav.givenInfo') }} </th>
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
                                                            <img src="{{ asset('images/draft-user.jpg') }}"
                                                                alt="">
                                                        @else
                                                            <img src="{{ asset($item->profile) }}" alt="">
                                                        @endif
                                                    </td>

                                                    <td class="text">
                                                        <p><span class="text-muted">ID : </span> {!! $item->card_id ?? '<span class="text-info">' . __('nav.newStaff') . '</span>' !!}
                                                        </p>
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
                                                        @php
                                                            $explodeProductId = explode(',', $item->product_id);
                                                        @endphp
                                                        @foreach ($explodeProductId as $id => $proID)
                                                            @php
                                                                $givenPro = DB::table('products')
                                                                    ->join(
                                                                        'item_codes',
                                                                        'products.pro_code',
                                                                        '=',
                                                                        'item_codes.id',
                                                                    )
                                                                    ->where('products.id', $proID)
                                                                    ->get()
                                                                    ->first();
                                                            @endphp
                                                            <p><span class="text-danger">{{ $id + 1 }}.</span>
                                                                {{ $givenPro->item_code }}</p>
                                                            <p class="ps-4">{{ $givenPro->item_name_en }}
                                                                {{ $givenPro->item_name_kh ? ' - ' . $givenPro->item_name_kh : '' }}
                                                            </p>
                                                            @if ($givenPro->serial_number)
                                                                <p class="ps-4"><span class="text-muted">SN.</span>
                                                                    {{ $givenPro->serial_number }}</p>
                                                            @endif
                                                            @if ($givenPro->fix_asset_code)
                                                                <p class="ps-4"><span class="text-muted">FAC.</span>
                                                                    {{ $givenPro->fix_asset_code }}</p>
                                                            @endif
                                                            @if ($givenPro->model)
                                                                <p class="ps-4"><span class="text-muted">Mod.</span>
                                                                    {{ $givenPro->model }}</p>
                                                            @endif
                                                            @if ($givenPro->pro_description)
                                                                <p class="ps-4"><span class="text-muted">Note.</span>
                                                                    {{ $givenPro->pro_description }}</p>
                                                            @endif
                                                        @endforeach
                                                    </td>


                                                    <td class="text">
                                                        <p class="text-uppercase"><span
                                                                class="text-muted text-capitalize">Given By : </span>
                                                            {{ $item->operator }}</p>
                                                        <p><span class="text-muted">Given Date : </span>
                                                            {{ Carbon\Carbon::parse($item->date)->format('d M Y') }}</p>
                                                    </td>


                                                    <td class="text-center">
                                                        <a type="button" id="detailButton"
                                                            data-id="{{ $item->giveId }}"><span
                                                                class="mdi mdi-eye-outline fs-5 text-muted"
                                                                title="View detail"></span></a>
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
    <div class="modal fade" id="detailGivenProduct">
        <div class="modal-dialog modal-lg modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="updateForm"><span class="mdi mdi-book-open"></span>
                        {{ __('nav.givenDetail') }}
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
                                        <h5>{{ __('nav.receiveBy') }}</h5>
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

                                    <div class="col-4">
                                        <label for="">{{ __('nav.emailAddress') }}</label>
                                    </div>
                                    <div class="col-8">
                                        <span class="pe-3">:</span>
                                        <span id="email_address" class="text-break"></span>
                                    </div>


                                    <div class="col-12 mt-3">
                                        <h5>{{ __('nav.giveBy') }}</h5>
                                        <hr>
                                    </div>

                                    <div class="col-4">
                                        <label for="">{{ __('nav.name') }}</label>
                                    </div>
                                    <div class="col-8">
                                        <span class="pe-3">:</span>
                                        <span id="add_by"></span>
                                    </div>

                                    <div class="col-4">
                                        <label for="">{{ __('nav.givenDate') }}</label>
                                    </div>
                                    <div class="col-8">
                                        <span class="pe-3">:</span>
                                        <span id="given_date"></span>
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
                                                <th>{{ __('nav.img') }}</th>
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
                                    <label for="proNameEn" class="fw-bold">{{ __('nav.evidence') }}</label>
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
                    <button type="button" class="ui button mini" data-bs-dismiss="modal">
                        <span class="mdi mdi-close icon"></span>
                        {{ __('nav.close') }}</button>
                </div> --}}
            </div>
        </div>
    </div>
@endsection

@section('js')
    {{-- auto complete search box using Ajax. --}}
    <script>
        $(document).ready(function() {
            $('#inventory_list').addClass('nav-item active');


            $('#department').change(function() {
                var department = $(this).val();
                if (department) {
                    $.ajax({
                        url: '/get-section/' + department,
                        type: 'get',
                        dataType: 'json',
                        // dataType: {rolId: rolId},
                        success: function(data) {
                            //$('#tableFunction').html('<p>' + data.description + '</p>'); // Customize as needed
                            $('#section').html(data); // Customize as needed
                            // alert('True' + roleID);
                        },
                        error: function(html) {
                            // alert('Hello'+ roleID);
                            $('#section').html(html);
                        }
                    });
                }
                // else {
                //     $('#tableFunction').empty();
                // }
            });

            $('#section').change(function() {
                var section = $(this).val();
                if (section) {
                    $.ajax({
                        url: '/get-position/' + section,
                        type: 'get',
                        dataType: 'json',
                        // dataType: {rolId: rolId},
                        success: function(data) {
                            //$('#tableFunction').html('<p>' + data.description + '</p>'); // Customize as needed
                            // alert('1');
                            $('#position').html(data); // Customize as needed
                            // alert('True' + roleID);
                        },
                        error: function(html) {

                            // alert('Hello'+ roleID);
                            $('#position').html(html);
                        }
                    });
                }
                // else {
                //     $('#tableFunction').empty();
                // }
            });

            $(document).on('click', '#detailButton', function() {
                var id = $(this).data('id');
                var url = "{{ route('product.givenDetail', ':id') }}".replace(':id', id);

                $('#detailGivenProduct').modal('show');
                // alert(url);
                $.ajax({
                    type: "GET",
                    url: url,
                    dataType: "json",
                    success: function(response) {
                        // Check if response and data exist
                        if (response.data.productGiven) {
                            // Update the profile image
                            if (response.data.productGiven.profile) {
                                $('#profile_img').attr('src', "{{ asset('') }}" + response
                                    .data.productGiven.profile);
                            }

                            $('#card_id').text(response.data.card_id);
                            $('#fullname').text(response.data.productGiven.name_kh + ' - ' +
                                response.data.productGiven.name_en);
                            $('#gender').text(response.data.gender);
                            $('#department_name').text(response.data.department);
                            $('#section_name').text(response.data.section);

                            // Set additional text fields
                            $('#position_name').text(response.data.productGiven.position_name);
                            $('#phone_number').text(response.data.productGiven.phone_number);
                            $('#email_address').text(response.data.productGiven.email_address);
                            $('#add_by').text(response.data.productGiven.operator);
                            $('#given_date').text(response.data.returnDate);

                            // Clear previous product table data
                            $('#product_table_data').empty();

                            // Loop through related products and append rows
                            response.data.relatedProducts.forEach((product, index) => {
                                $('#product_table_data').append(`
                                    <tr>
                                        <td>${index + 1}</td>
                                        <td>
                                            <img src="${product.pro_img ? "{{ asset('') }}" + product.pro_img : "{{ asset('images/draft-image.png') }}"}" alt="">
                                        </td>
                                        <td>${product.item_code}</td>
                                        <td>${product.item_name_kh + '-'+ product.item_name_en}</td>
                                        <td>1</td>
                                        <td>${product.model}</td>
                                        <td>${product.serial_number}</td>
                                        <td>${product.fix_asset_code}</td>
                                        <td>${product.cat_name}</td>
                                    </tr>
                                `);
                            });

                            if (response.data.productGiven.attachment) {
                                $('#attachment').html(`
                                    <img src="${response.data.productGiven.attachment ? '{{ asset('') }}' + response.data.productGiven.attachment : '{{ asset('images/draft-image.png') }}'}" alt="" width="100%">
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
