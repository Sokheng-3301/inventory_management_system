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
            <div class="col-md-12 grid-margin">
                <div class="row">
                    <div class="col-12 col-xl-8 mb-4 mb-xl-0">
                        <h3 class="font-weight-bold">{{ __('nav.expenseReport') }} </h3>
                        <h6 class="font-weight-normal mb-0">{{ __('nav.expenseAll') }}</h6>
                    </div>
                </div>
                <div class="row mt-4">
                    <div class="col-md-12 grid-margin stretch-card">
                        <div class="card">
                            <div class="card-body">
                                <p class="card-title">{{ __('nav.searchExpenseReport') }}</p>
                                <form action="" method="get" autocomplete="off"
                                    class="ui form p-3 border border-1 border-light rounded-3">
                                    {{-- @csrf --}}
                                    <div class="row">
                                        <div class="col-md-4 field two d-block w-100">
                                            <label for="year" class="d-block"> {{ __('nav.year') }} </label>
                                            <select name="year" class="ui search dropdown d-block w-100" id="">
                                                @php
                                                    $year = DB::table('year')->orderBy('id', 'desc')->get();
                                                @endphp
                                                @foreach ($year as $y)
                                                    <option
                                                        @if (request('year')) {{ $y->year == request('year') ? 'selected' : '' }}
                                                @else
                                                    {{ $y->year == date('Y') ? 'selected' : '' }} @endif
                                                        value="{{ $y->year }}">{{ $y->year }}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="col-md-4 field d-block w-100">
                                            <label for="start_date" class="d-block"> {{ __('nav.startDate') }} </label>
                                            <div class="ui input d-block w-100">
                                                <div class="ui input icon">
                                                    <input type="text" name="start_date" class="d-block w-100"
                                                        id="start_date" placeholder="{{ __('nav.ddmmyy') }}"
                                                        value="{{ request('start_date') }}">
                                                    <i class="calendar icon"></i>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4 field d-block w-100">
                                            <label for="end_date" class="d-block"> {{ __('nav.endDate') }} </label>
                                            <div class="ui input d-block w-100">
                                                <div class="ui input icon">
                                                    <input type="text" name="end_date" class="d-block w-100"
                                                        id="end_date" placeholder="{{ __('nav.ddmmyy') }}"
                                                        value="{{ request('end_date') }}">
                                                    <i class="calendar icon"></i>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-12 field text-end">
                                            <a href="{{ route('expense.service.index') }}" class="ui button tiny"
                                                type="submit">
                                                <i class="icon x"></i>
                                                {{ __('nav.cancel') }}
                                            </a>
                                            <button class="ui button tiny black" type="submit">
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
                <div class="row mt-4">
                    <div class="col-sm-12 col-md-12 col-l-12 col-xl-12">
                        {{-- @include('layout.back-button') --}}
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
                                                <a href="{{ route('reports.exportExpenseExcel') }}" class="ui button fw-normal"
                                                    title="Excel"><i class="file excel icon"></i>Excel</a>
                                                <a href="{{ route('reports.exportExpensePdf') }}" class="ui button fw-normal"
                                                    title=  "PDF"><i class="file pdf icon"></i>PDF</a>
                                            </div>
                                        </div>
                                    @endif
                                </div>

                                <div class="table-responsive">
                                    <table id="myTable" class="display table table-striped table-hover">
                                        <thead>
                                            <tr>
                                                <th colspan="9" class="text-danger">1. {{ __('nav.ItePurchase') }}</th>
                                            </tr>
                                            <tr>
                                                <th style="width: 10px;" class="text-start">{{ __('home.no') }}</th>
                                                <th>{{ __('nav.img') }}</th>
                                                <th> {{ __('nav.aboutItem') }} </th>
                                                <th> {{ __('nav.category') }}</th>
                                                <th> {{ __('nav.equipment_type') }}</th>

                                                <th> {{ __('nav.expenseDate') }} </th>
                                                <th> {{ __('nav.createBy') }} </th>

                                                <th> {{ __('home.qty') }}</th>
                                                <th class="text-end"> {{ __('nav.price') }}</th>
                                                {{-- <th> {{ __('nav.actions') }} </th> --}}
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php
                                                $auto = 1;
                                                $total = 0;
                                            @endphp

                                            @foreach ($expenses as $item)
                                                @php
                                                    $total += $item->qty * $item->price;
                                                @endphp
                                                <tr id="detailTrButton">
                                                    <td style="width: 10px" class="text-start">
                                                        {{ $auto++ }}
                                                    </td>
                                                    <td>
                                                        @if ($item->pro_img == '')
                                                            <img src="{{ asset('images/draft-image.png') }}"
                                                                alt="">
                                                        @else
                                                            <img src="{{ asset($item->pro_img) }}" alt="">
                                                        @endif
                                                    </td>

                                                    <td class="text">
                                                        <p><span class="text-muted">Code :</span>
                                                            {{ $item->item_code ?? 'N/A' }}
                                                        </p>
                                                        <p><span class="text-muted">Name :</span>
                                                            {{ session('localization') == 'kh' ? $item->item_name_kh : $item->item_name_en }}
                                                        </p>
                                                        <p><span class="text-muted">Mod :</span>
                                                            {{ $item->model ?? 'N/A' }}</p>
                                                        <p><span class="text-muted">SN :</span>
                                                            {{ $item->serial_number ?? 'N/A' }}</p>
                                                        <p><span class="text-muted">FAC :</span>
                                                            {{ $item->fix_asset_code ?? 'N/A' }}</p>
                                                    </td>

                                                    <td>{{ $item->cat_name }}
                                                    </td>

                                                    <td class="{{ $item->delete_status == '0' ? 'text-danger' : '' }}">
                                                        @if ($item->equipment_type == 1)
                                                            {{ __('nav.equipment') }}
                                                        @elseif($item->equipment_type == 2)
                                                            {{ __('nav.accessories') }}
                                                        @else
                                                        @endif
                                                    </td>

                                                    <td class="text-muted">
                                                        {{ Carbon\Carbon::parse($item->expense_date)->format('d M Y h:i:s A') }}
                                                    </td>

                                                    <td class="text-muted">
                                                        {{ strtoupper($item->operator) }}
                                                    </td>

                                                    <td class="fw-bold text-center">
                                                        {{ $item->qty }}
                                                    </td>
                                                    <td class="text-end fw-bold">
                                                        $ {{ $item->price }}
                                                    </td>
                                                </tr>
                                            @endforeach
                                            <!-- Add more rows as needed -->
                                        </tbody>
                                        @if ($total != 0)
                                            <tbody>
                                                <tr>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td class="text-danger fw-bold fs-6"> {{ __('nav.total') }} </td>
                                                    <td class="text-end fw-bold fs-5"> <i class="dollar sign icon"></i>
                                                        {{ $total }} </td>
                                                    <td></td>
                                                </tr>
                                            </tbody>
                                        @endif

                                        {{-- ++++++++++++ SERVICE FEE +++++++++++++++ --}}
                                        {{-- <thead>
                                            <tr>
                                                <th colspan="9" class="text-danger">2. {{ __('nav.serviceFee') }}</th>
                                            </tr>
                                        </thead>

                                        <thead>
                                            <tr>
                                                <th style="width: 10px;" class="text-start">{{ __('home.no') }}</th>
                                                <th colspan="2"> {{ __('nav.aboutService') }} </th>
                                                <th colspan="2"> {{ __('nav.expenseDate') }} </th>
                                                <th colspan="2"> {{ __('nav.createBy') }} </th>
                                                <th colspan="2" class="text-end"> {{ __('nav.price') }}</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php
                                                $auto = 1;
                                                $total2 = 0;
                                            @endphp

                                            @foreach ($service_fees as $item)
                                                @php
                                                    $total2 += $item->price;
                                                @endphp
                                                <tr>
                                                    <td style="width: 10px" class="text-start">
                                                        {{ $auto++ }}
                                                    </td>

                                                    <td class="text" colspan="2">
                                                        <p class="text-break">{{ $item->note }}</p>
                                                    </td>



                                                    <td colspan="2">
                                                        {{ Carbon\Carbon::parse($item->date)->format('d M Y') }}
                                                    </td>

                                                    <td class="text-muted" colspan="2">
                                                        {{ strtoupper($item->add_by) }}
                                                    </td>

                                                    <td class="text-end fw-bold" colspan="2">
                                                        $ {{ $item->price }}
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                        @if ($total2 != 0)
                                            <tbody>
                                                <tr>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td class="text-danger fw-bold fs-6"> {{ __('nav.total') }} </td>
                                                    <td class="text-end fw-bold fs-5"> <i class="dollar sign icon"></i>
                                                        {{ $total2 }} </td>
                                                </tr>
                                            </tbody>
                                        @endif --}}
                                    </table>
                                </div>

                                <hr>

                                <div class="table-responsive">
                                    <table id="myTable1" class="display table table-striped table-hover">
                                        <thead>
                                            <tr>
                                                <th colspan="5" class="text-danger">2. {{__('nav.serviceFee')}}</th>
                                            </tr>
                                            <tr>
                                                <th style="width: 10px;" class="text-start">{{ __('home.no') }}</th>
                                                <th> {{ __('nav.aboutService') }} </th>
                                                <th> {{ __('nav.expenseDate') }} </th>
                                                <th> {{ __('nav.createBy') }} </th>
                                                <th class="text-end"> {{ __('nav.price') }}</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php
                                                $auto = 1;
                                                $total = 0;
                                            @endphp

                                            @foreach ($service_fees as $item)
                                                @php
                                                    $total += $item->price;
                                                @endphp
                                                <tr>
                                                    <td style="width: 10px" class="text-start">
                                                        {{ $auto++ }}
                                                    </td>

                                                    <td class="text">
                                                        <p class="text-break">{{ $item->note }}</p>
                                                    </td>



                                                    <td>
                                                        {{ Carbon\Carbon::parse($item->date)->format('d M Y') }}
                                                    </td>

                                                    <td class="text-muted">
                                                        {{ strtoupper($item->add_by) }}
                                                    </td>

                                                    <td class="text-end fw-bold">
                                                        $ {{ $item->price }}
                                                    </td>
                                                </tr>
                                            @endforeach
                                            <!-- Add more rows as needed -->
                                        </tbody>
                                        @if ($total != 0)
                                            <tbody>
                                                <tr>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td class="text-danger fw-bold fs-6"> {{ __('nav.total') }} </td>
                                                    <td class="text-end fw-bold fs-5"> <i class="dollar sign icon"></i>
                                                        {{ $total }} </td>
                                                </tr>
                                            </tbody>
                                        @endif
                                    </table>
                                </div>
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
            $('#inventory_list').addClass('nav-item active');
        });
    </script>
@endsection
