{{-- @use('App\Models\Flight') --}}
@extends('layout/master')

@section('title')
    <title> {{ __('nav.statistic') }} | IMS</title>
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
    </style>
@endsection
@section('content')
    <div class="content-wrapper">
        <div class="row">
            <div class="col-md-12 grid-margin">
                <div class="row">
                    <div class="col-12 col-xl-8 mb-4 mb-xl-0">
                        <h3 class="font-weight-bold">{{ __('nav.statistic') }} </h3>
                        <h6 class="font-weight-normal mb-0">{{ __('nav.product') }} / <span class="text-primary"><a
                                    class="text-primary" href="">{{ __('nav.statistic') }} </a></span></h6>
                    </div>
                </div>
                <div class="row mt-4">
                    <div class="col-sm-12 col-md-12 col-l-12 col-xl-12">
                        @include('layout.back-button')
                        <div class="card p-2">
                            <div class="card-body col-md-12 mx-auto">
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
                                                <a href="{{ route('product.exportStatistic') }}" class="ui button fw-normal"
                                                    title="Excel"><i class="file excel icon"></i>Excel</a>
                                                <a href="{{ route('product.exportStatisticPdf') }}"
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
                                                <th>{{ __('nav.proCode') }}</th>
                                                <th>{{ __('nav.proName') }}</th>
                                                <th> {{ __('home.qty') }} </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php
                                                $auto = 1;
                                            @endphp
                                            @foreach ($item_code_counts as $key => $item)
                                                <tr>
                                                    <td style="width: 10px"
                                                        class="text-start {{ $item->delete_status == '0' ? 'text-danger' : '' }}">
                                                        {{ $key + 1 }}
                                                    </td>
                                                    <td class="{{ $item->delete_status == '0' ? 'text-danger' : '' }}">
                                                        {{ $item->item_code }}
                                                    </td>
                                                    <td class="{{ $item->delete_status == '0' ? 'text-danger' : '' }}">
                                                        {{ session('localization') == 'kh' ? $item->item_name_kh : $item->item_name_en }}
                                                    </td>
                                                    <td
                                                        class="fw-bold {{ $item->delete_status == '0' ? 'text-danger' : '' }}">
                                                        {{ $item->total_qty }}
                                                    </td>
                                                </tr>
                                            @endforeach

                                        </tbody>
                                        <tbody>
                                            <tr>
                                                <td colspan="3">{{ __('nav.total') }}</td>
                                                <td>
                                                    <span class="fw-bold">
                                                        {{ $item_code_counts->sum('total_qty') }}
                                                    </span>
                                                </td>
                                            </tr>
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
@endsection
@section('js')
    <script>
        $(document).ready(function() {
            $('#product').addClass('nav-item active');
            $('#form-elements').addClass('collapse show');
        });
    </script>
@endsection
