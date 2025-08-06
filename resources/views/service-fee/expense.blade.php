@extends('layout/master')

@section('title')
    <title> {{ __('nav.serviceFee') }} | IMS </title>
@endsection
@section('css')
    <style>
        .category-total:nth-child() {
            background: red;
        }
    </style>
@endsection

@section('content')
    <div class="content-wrapper">
        <div class="row">
            <div class="col-md-12 grid-margin mb-4">
                <div class="row">
                    <div class="col-12 col-md-8">
                        <h3 class="font-weight-bold">{{ __('nav.serviceFee') }}</h3>
                        <h6 class="font-weight-normal mb-0">{{ __('nav.serviceFee') }}
                            / <span class="text-primary">{{ __('nav.report') }}</span>
                        </h6>
                    </div>
                </div>
            </div>
        </div>

        @include('layout.back-button')
        <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <p class="card-title">{{ __('nav.searchExpenseReport') }}</p>
                        <form action="" method="get" class="ui form p-3 border border-1 border-light rounded-3">
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
                                            <input type="text" name="start_date" class="d-block w-100" id="start_date"
                                                placeholder="{{ __('nav.ddmmyy') }}" value="{{ request('start_date') }}">
                                            <i class="calendar icon"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4 field d-block w-100">
                                    <label for="end_date" class="d-block"> {{ __('nav.endDate') }} </label>
                                    <div class="ui input d-block w-100">
                                        <div class="ui input icon">
                                            <input type="text" name="end_date" class="d-block w-100" id="end_date"
                                                placeholder="{{ __('nav.ddmmyy') }}" value="{{ request('end_date') }}">
                                            <i class="calendar icon"></i>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12 field text-end">
                                    <a href="{{ route('expense.service.index') }}" class="ui button tiny" type="submit">
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


        <div class="row">
            <div class="col-md-12 grid-margin">
                <div class="row">
                    <div class="col-12 col-xl-8 mb-4 mb-xl-0">
                        <h3 class="font-weight-bold">{{ __('nav.reportListInYear') . ' ' . date('Y') }} </h3>
                    </div>
                </div>
            </div>
        </div>




        <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
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
                                        <a href="{{ route('expense.service.exportExcel', request()->all()) }}"
                                            class="ui button fw-normal" title="Excel"><i
                                                class="file excel icon"></i>Excel</a>
                                        <a href="{{ route('expense.service.exportPdf', request()->all()) }}"
                                            class="ui button fw-normal" title=  "PDF"><i class="file pdf icon"></i>PDF</a>
                                    </div>
                                </div>

                                <div class="col-4 col-sm-5 mb-2  col-md-5 text-end">
                                    <a href="{{ route('expense.service.create') }}" class="ui button primary tiny"><span
                                            class="mdi mdi-plus-circle icon"></span> {{ __('nav.addNew') }}
                                    </a>
                                </div>
                            </div>
                        @endif


                        <div class="table-responsive">
                            <table id="myTable" class="display table table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th style="width: 10px;" class="text-start">{{ __('home.no') }}</th>
                                        <th> {{ __('nav.aboutService') }} </th>
                                        <th> {{ __('nav.expenseDate') }} </th>
                                        <th> {{ __('nav.createBy') }} </th>
                                        <th> {{ __('nav.price') }}</th>
                                        <th class="text-end"> {{ __('nav.actions') }} </th>
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


                                            <td class="text-end text-muted">
                                                <a type="button" data-id="{{ $item->id }}" id="detailButton"
                                                    title="View letter refer" class="item">
                                                    <span class="mdi mdi-file-document-outline fs-5"></span>
                                                </a>
                                                @if ($checkRole->role_name == 'admin' || $checkRole->role_name == 'Admin' || $action->action_edit == 1)
                                                    | <a href="{{ route('expense.service.edit', $item->id) }}"><span
                                                            class="mdi mdi-square-edit-outline fs-5 text-muted"
                                                            title="Update data"></span></a>
                                                @endif
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
                                            <td></td>
                                            <td></td>
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

    <!-- Modal -->
    <div class="modal fade" id="documentDetailModal">
        <div class="modal-dialog modal-dialog-scrollable modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">{{ __('nav.attRefer') }}</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body text-center" id="bodyModal">
                    {{-- <img src="" id="attRefer" alt=""> --}}
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        $(document).ready(function() {
            // $('#expense_report').addClass('nav-item active');
            $('#expenseReportMain').addClass('nav-item active');
            $('#expenseReport').addClass('collapse show');


            $(document).on('click', '#detailButton', function() {
                $('#documentDetailModal').modal('show');
                var id = $(this).data('id');
                var url = "{{ route('expense.service.show', ':id') }}".replace(':id', id);
                // alert(url);

                $.ajax({
                    type: "GET",
                    url: url,
                    dataType: "json",
                    success: function(response) {
                        // Ensure the response contains the expected data
                        if (response && response.data && response.data.attachment) {
                            // $('#attRefer').attr('src', asset(response.data.attachment));
                            $('#bodyModal').html(`
                                <img src="${response.data.attachment ? '{{ asset('') }}' + response.data.attachment : '{{ asset('images/draft-image.png') }}'}" alt="" width="90%" class="m-auto">
                            `)
                        }
                         else {
                            console.error("Unexpected response structure:", response);
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
