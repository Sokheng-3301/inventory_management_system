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
                        <h3 class="font-weight-bold">{{ __('nav.inventory_list') }} </h3>
                        <h6 class="font-weight-normal mb-0">{{ __('nav.all_inventory_list') }}</h6>
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
                                                <a href="{{ route('inventory.exportExcel') }}" class="ui button fw-normal"
                                                    title="Excel"><i class="file excel icon"></i>Excel</a>
                                                <a href="{{ route('inventory.exportPdf') }}"
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
                                                <th>{{ __('nav.img') }}</th>
                                                <th> {{ __('nav.proCode') }}</th>
                                                <th> {{ __('nav.proName') }}</th>
                                                <th>{{ __('nav.model') }}</th>
                                                <th>{{ __('nav.serial_number') }}</th>
                                                <th>{{ __('nav.fix_asset_code') }}</th>
                                                <th> {{ __('nav.category') }}</th>
                                                <th> {{ __('nav.equipment_type') }}</th>
                                                <th>{{ __('home.qty') }}</th>
                                                <th> {{ __('nav.actions') }} </th>
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
                                                        @if ($item->pro_img == '')
                                                            <img src="{{ asset('images/draft-image.png') }}"
                                                                alt="">
                                                        @else
                                                            <img src="{{ asset($item->pro_img) }}" alt="">
                                                        @endif
                                                    </td>

                                                    <td class="">{{ $item->item_code }}</td>
                                                    <td class="">{{ session('localization') == 'kh' ? $item->item_name_kh : $item->item_name_en }}</td>

                                                    <td class="">{{ $item->model }}
                                                    </td>

                                                    <td class="">{{ $item->serial_number }}
                                                    </td>
                                                    <td class="">{{ $item->fix_asset_code }}
                                                    </td>

                                                    <td class="">{{ $item->cat_name }}
                                                    </td>

                                                    <td class="">
                                                        @if ($item->equipment_type == 1)
                                                            {{__("nav.equipment")}}
                                                        @elseif($item->equipment_type == 2)
                                                            {{__("nav.accessories")}}
                                                        @else

                                                        @endif
                                                    </td>


                                                    <td class="text-info fw-bold">
                                                        {{ $item->fix_qty }}
                                                    </td>

                                                    <td class="text-center">
                                                        <a href="{{ route('product.show', $item->proId) }}"><span
                                                                class="mdi mdi-eye-outline fs-5 text-primary"
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
@endsection


@section('js')
    <script>
        $(document).ready(function() {
            $('#inventory_list').addClass('nav-item active');
        });
    </script>
@endsection
