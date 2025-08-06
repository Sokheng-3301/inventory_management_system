@extends('layout/master')
@hasSection('link')
@endif
@section('title')
    <title> {{ __('nav.itemDetail') }} | IMS</title>
@endsection

@section('css')
@endsection

@section('content')
    <div class="content-wrapper">
        <div class="row">
            <div class="col-md-12 grid-margin">
                <div class="row">
                    <div class="col-12 mb-4 mb-xl-0">
                        <h3 class="font-weight-bold">{{ __('nav.itemDetail') }}</h3>
                        <h6 class="font-weight-normal mb-0">{{ __('nav.product') }} /
                            <span class="text-primary"><a class="text-primary"
                                    href="{{ route('product.addGive') }}">{{ __('nav.itemDetail') }} </a>
                        </h6>
                    </div>
                </div>
                <div class="row mt-4">
                    <div class="col-sm-12 col-md-12 col-l-12 col-xl-12">
                        @include('layout.back-button')
                        <div class="card p-1">
                            <div class="p-3 mt-3">
                                <div class="row">
                                    <div class="col-sm-12 col-md-4">
                                        <div class="bg-light p-3">
                                            <p class="fw-bold text-center text-primary fs-6">
                                                {{ __('nav.proImg') }}</p>
                                            <label for="productImg" id="proImg">
                                                <span class="mdi mdi-image d-none"></span>
                                                <img src="{{ $item->pro_img ? asset($item->pro_img) : asset('images/draft-image.png') }}"
                                                    style="display: block" id="file-input" alt="Item Image" width="90%">
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-8">
                                        <div class="bg-light p-3">
                                            <p class="fw-bold text-center text-primary fs-6">
                                                {{ __('nav.proInfo') }}</p>
                                            @foreach ([
                                                        ['label' => __('nav.proCode'), 'value' => $item->item_code],
                                                        ['label' => __('nav.proNameKh'), 'value' => $item->item_name_kh],
                                                        ['label' => __('nav.proNameEn'), 'value' => $item->item_name_en],
                                                        ['label' => __('nav.model'), 'value' => $item->model],
                                                        ['label' => __('nav.categoryName'), 'value' => $item->cat_name],
                                                        ['label' => __('nav.equipment_type'), 'value' => $item->equipment_type == 1 ? __('nav.equipment') : __('nav.accessories')], // Added empty value
                                                        ['label' => __('nav.serial_number'), 'value' => $item->serial_number],
                                                        ['label' => __('nav.fix_asset_code'), 'value' => $item->fix_asset_code],

                                                        ['label' => __('home.qty'), 'value' => $item->qty . ' <span class="text-danger">/ '. $item->fix_qty .'</span>'],
                                                        ['label' => __('nav.status'), 'value' => $item->stock_status == 1 ? __('nav.Instock') : __('nav.Outstock')],

                                                        ['label' => __('nav.noted'), 'value' => $item->pro_description],
                                                    ] as $field)
                                                <div class="row d-flex align-items-center mt-2">
                                                    <div class="col-5 col-md-3">
                                                        <label class="fw-bold">{{ $field['label'] }}</label>
                                                    </div>
                                                    <div class="col-7 col-md-9 text-break">
                                                        {!! $field['value'] !!}
                                                    </div>
                                                </div>
                                            @endforeach
                                            <div class="row mt-1">
                                                <div class="col-12 text-end text-muted">
                                                    <p class="p-0 m-0">{{ __('nav.createBy') }}:
                                                        {{ strtoupper($item->operator) }} </p>
                                                    <p class="p-0 m-0">{{ __('nav.createAt') }}:
                                                        {{ Carbon\Carbon::parse($item->create_date)->format('d M Y') }}</p>
                                                    @if ($item->delete_status == 0)
                                                        <p class="p-0 m-0">{{ __('nav.deleteBy') }}:
                                                            {{ $item->delete_by }}</p>
                                                        <p class="p-0 m-0">{{ __('nav.deleteAt') }}:
                                                            {{ Carbon\Carbon::parse($item->delete_date)->format('d M Y') }}
                                                        </p>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @php
                                        $logRecordGiven = DB::table('product_locks')
                                            ->join('users', 'product_locks.give_user', '=', 'users.id')
                                            ->where('product_locks.product_id', $item->id)
                                            ->orderBy('product_locks.give_date', 'desc')
                                            ->get();
                                    @endphp
                                    @if ($logRecordGiven != '')
                                        <div class="col-md-4"></div>
                                        <div class="col-md-8">
                                            <div class="p-3">
                                                <p class="fw-bold text-start text-primary fs-6"><span
                                                        class="mdi mdi-clipboard-text-clock icon"></span>
                                                    {{ __('nav.givenLog') }}</p>

                                                <div class="ui bulleted list">
                                                    @foreach ($logRecordGiven as $record)
                                                        <div class="item">
                                                            <small><span
                                                                    class="text-danger">{{ $record->card_id ?? __('nav.newStaff') }}</span>
                                                                {{ strtoupper($record->name_kh) . ' - ' . strtoupper($record->name_en) }}
                                                                [
                                                                <span class="text-muted">
                                                                    {{ strtoupper($record->give_by) }},
                                                                    <span class="mdi mdi-calendar-month-outline"></span>
                                                                    {{ \Carbon\Carbon::parse($record->give_date)->format('d M Y h:i:s A') }}
                                                                </span>
                                                                ]
                                                            </small>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                    @else
                                    @endif
                                    @php
                                        $logRecordReturn = DB::table('product_locks')
                                            ->join('users', 'product_locks.return_by', '=', 'users.id')
                                            ->where('product_locks.return_status', 1)
                                            ->where('product_locks.product_id', $item->id)
                                            ->orderBy('product_locks.return_date', 'desc')
                                            ->get();
                                    @endphp
                                    @if ($logRecordReturn != '')
                                        <div class="col-md-4"></div>
                                        <div class="col-md-8">
                                            <div class="p-3">
                                                <p class="fw-bold text-start text-primary fs-6"><span
                                                        class="mdi mdi-clipboard-text-clock icon"></span>
                                                    {{ __('nav.returnedLog') }}</p>
                                                <div class="ui bulleted list">
                                                    @foreach ($logRecordReturn as $record)
                                                        <div class="item">
                                                            <small><span
                                                                    class="text-danger">{{ $record->card_id ?? __('nav.newStaff') }}</span>
                                                                {{ strtoupper($record->name_kh) . ' - ' . strtoupper($record->name_en) }}
                                                                [
                                                                <span class="text-muted">
                                                                    {{ strtoupper($record->recieve_user) }},
                                                                    <span class="mdi mdi-calendar-month-outline"></span>
                                                                    {{ \Carbon\Carbon::parse($record->give_date)->format('d M Y h:i:s A') }}
                                                                </span>
                                                                ]
                                                            </small>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                    @else
                                    @endif
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
        @if ($item_instock)
            $('#product').addClass('nav-item active');
            $('#form-elements').addClass('collapse show');
        @else
            $(document).ready(function() {
                $('#inventory_list').addClass('nav-item active');
            });
        @endif
    </script>
@endsection
