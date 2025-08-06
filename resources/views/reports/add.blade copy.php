@extends('layout/master')
@hasSection('link')
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.18/css/bootstrap-select.min.css"
        integrity="sha512-ARJR74swou2y0Q2V9k0GbzQ/5vJ2RBSoCWokg4zkfM29Fb3vZEQyv0iWBMW/yvKgyHSR/7D64pFMmU8nYmbRkg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
@endif
@section('title')
    <title> {{ __('nav.expenseReport') }} | IMS</title>
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
            display: none;
            /* Hide the image initially */
            display: block;
            /* width: 100%; */
            height: 100%;
            position: absolute;
        }
    </style>
@endsection

@section('content')
    <div class="content-wrapper">
        <div class="row">
            <div class="col-md-12 grid-margin">
                <div class="row">
                    <div class="col-12 col-xl-8 mb-4 mb-xl-0">
                        <h3 class="font-weight-bold">
                            {{ $update ? __('nav.editExpenseReport') : __('nav.addExpenseReport') }}</h3>
                        <h6 class="font-weight-normal mb-0">{{ __('nav.expenseReport') }} / <span class="text-primary">
                                <a class="text-primary" href=""> {{ $update ? __('nav.update') : __('nav.addNew') }}
                                </a></span></h6>
                    </div>
                </div>
                <div class="row mt-4">
                    <div class="col-sm-12 col-md-12 col-l-12 col-xl-12">
                        @include('layout.back-button')
                        <div class="card p-1">
                            <form action="{{ $update ? route('expense.update', $item->id) : route('expense.save') }}"
                                method="post" enctype="multipart/form-data" autocomplete="off" class="ui form">
                                @csrf
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-sm-12 col-md-12">
                                            <div class="p-3">
                                                <div class="field">
                                                    <h3 class="ui header medium">{{ __('nav.completeExpeseForm') }}</h3>
                                                </div>
                                                <input type="hidden" class="d-none" readonly id="countItemForm"
                                                    name="countItemForm" value="{{ old('countItemForm') }}">
                                                <div class="row" id="appendContent">
                                                    @if (old('countItemForm'))
                                                        @for ($i = 1; $i <= old('countItemForm'); $i++)
                                                            <div class="col-md-6 mb-3 count_row">
                                                                <div class="card bg-light overflow-hidden rounded-3">
                                                                    <div class="card-header fw-bold bg-primary text-white">
                                                                        {{ __('nav.itemNo') }} 1
                                                                    </div>
                                                                    <div class="card-body">
                                                                        <div class="field">
                                                                            <label
                                                                                for="productCode_{{ $i }}">{{ __('nav.proCode') }}</label>
                                                                            <input type="text" class="form-control"
                                                                                autofocus value="{{ old('proCode_' . $i) }}"
                                                                                id="productCode_{{ $i }}"
                                                                                name="proCode_{{ $i }}"
                                                                                placeholder="{{ __('nav.proCode') }}">
                                                                        </div>

                                                                        <div class="field">
                                                                            <label
                                                                                for="proname_{{ $i }}">{{ __('nav.proName') }}
                                                                                <span class="text-danger">*</span></label>
                                                                            <input type="text" class="form-control"
                                                                                required value="{{ old('proname_' . $i) }}"
                                                                                id="proname_{{ $i }}"
                                                                                name="proname_{{ $i }}"
                                                                                placeholder="{{ __('nav.proName') }}">
                                                                        </div>

                                                                        <div class="field">
                                                                            <label
                                                                                for="model_{{ $i }}">{{ __('nav.model') }}</label>
                                                                            <input type="text" class="form-control"
                                                                                value="{{ old('model_' . $i) }}"
                                                                                id="model_{{ $i }}"
                                                                                name="model_{{ $i }}"
                                                                                placeholder="{{ __('nav.model') }}">
                                                                        </div>

                                                                        <div class="field">
                                                                            <label
                                                                                for="serial_number_{{ $i }}">{{ __('nav.serial_number') }}</label>
                                                                            <input type="text" class="form-control"
                                                                                value="{{ old('serial_number_' . $i) }}"
                                                                                id="serial_number_{{ $i }}"
                                                                                name="serial_number_{{ $i }}"
                                                                                placeholder="{{ __('nav.serial_number') }}">
                                                                        </div>

                                                                        <div class="field">
                                                                            <label
                                                                                for="fix_asset_code_{{ $i }}">{{ __('nav.fix_asset_code') }}</label>
                                                                            <input type="text" class="form-control"
                                                                                value="{{ old('fix_asset_code_' . $i) }}"
                                                                                id="fix_asset_code_{{ $i }}"
                                                                                name="fix_asset_code_{{ $i }}"
                                                                                placeholder="{{ __('nav.fix_asset_code') }}">
                                                                        </div>

                                                                        <div class="field">
                                                                            <label
                                                                                for="category_{{ $i }}">{{ __('nav.category') }}
                                                                                <span class="text-danger">*</span></label>
                                                                            <select name="category_{{ $i }}"
                                                                                id="category" required class="ui  search">
                                                                                <option value="">
                                                                                    {{ __('nav.selectCategory') }}</option>
                                                                                @foreach ($categories as $c)
                                                                                    <option value="{{ $c->id }}"
                                                                                        {{ old('category_' . $i) == $c->id ? 'selected' : '' }}>
                                                                                        {{ $c->cat_name }}</option>
                                                                                @endforeach
                                                                            </select>
                                                                        </div>

                                                                        <div class="field">
                                                                            <label
                                                                                for="equipment_type_{{ $i }}">{{ __('nav.equipment_type') }}
                                                                                <span class="text-danger">*</span></label>
                                                                            <select
                                                                                name="equipment_type_{{ $i }}"
                                                                                id="equipment_type" required
                                                                                class="ui  search">
                                                                                <option value="">
                                                                                    {{ __('nav.selectQuipmentType') }}
                                                                                </option>
                                                                                <option value="1"
                                                                                    {{ old('equipment_type_' . $i) == 1 ? 'selected' : '' }}>
                                                                                    {{ __('nav.equipment') }}
                                                                                </option>
                                                                                <option value="2"
                                                                                    {{ old('equipment_type_' . $i) == 2 ? 'selected' : '' }}>
                                                                                    {{ __('nav.accessories') }}
                                                                                </option>
                                                                            </select>
                                                                        </div>

                                                                        <div class="field">
                                                                            <label
                                                                                for="qty_{{ $i }}">{{ __('home.qty') }}
                                                                                <span class="text-danger">*</span></label>
                                                                            <input type="number" min="1"
                                                                                class="form-control" readonly
                                                                                value="{{ old('qty_' . $i) ?? 1 }}"
                                                                                id="qty_{{ $i }}"
                                                                                name="qty_{{ $i }}"
                                                                                placeholder="{{ __('home.qty') }}">
                                                                        </div>

                                                                        <div class="field">
                                                                            <label
                                                                                for="unit_price_{{ $i }}">{{ __('nav.unit_price') }}
                                                                                <span class="text-danger">*</span></label>
                                                                            <div class="ui labeled input">
                                                                                <label
                                                                                    for="unit_price_{{ $i }}"
                                                                                    class="ui label">$</label>
                                                                                <input type="number" step="0.001"
                                                                                    required
                                                                                    value="{{ old('unit_price_' . $i) }}"
                                                                                    id="unit_price_{{ $i }}"
                                                                                    name="unit_price_{{ $i }}"
                                                                                    placeholder="{{ __('nav.unit_price') }}">
                                                                            </div>
                                                                        </div>

                                                                        <div class="field">
                                                                            <label
                                                                                for="descript_{{ $i }}">{{ __('nav.noted') }}</label>
                                                                            <textarea name="descript_{{ $i }}" id="descript_{{ $i }}" cols="30" rows="4"
                                                                                class="form-control" placeholder="{{ __('nav.noted') }}...">{{ old('descript_' . $i) }}</textarea>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        @endfor
                                                    @else
                                                        <div class="{{ $update ? 'col-md-8' : 'col-md-6' }} mb-3 count_row">
                                                            <div class="card bg-light overflow-hidden rounded-3">
                                                                @if (!$update)
                                                                    <div class="card-header fw-bold bg-primary text-white">
                                                                        {{ __('nav.itemNo') }} 1
                                                                    </div>
                                                                @endif
                                                                <input type="hidden" class="d-none" name="queryString" value="{{ @$queryString ? @$queryString : session('queryString') }}">

                                                                <div class="card-body">
                                                                    <div class="field">
                                                                        <label
                                                                            for="productCode_1">{{ __('nav.proCode') }}</label>
                                                                        <input type="text" class="form-control"
                                                                            autofocus
                                                                            value="{{ $update ? $item->pro_code : '' }}"
                                                                            id="productCode_1" name="proCode_1"
                                                                            placeholder="{{ __('nav.proCode') }}">
                                                                    </div>

                                                                    <div class="field">
                                                                        <label for="proname_1">{{ __('nav.proName') }}
                                                                            <span class="text-danger">*</span></label>
                                                                        <input type="text" class="form-control"
                                                                            required
                                                                            value="{{ $update ? $item->pro_name_en : '' }}"
                                                                            id="proname_1" name="proname_1"
                                                                            placeholder="{{ __('nav.proName') }}">
                                                                    </div>

                                                                    <div class="field">
                                                                        <label
                                                                            for="model_1">{{ __('nav.model') }}</label>
                                                                        <input type="text" class="form-control"
                                                                            value="{{ $update ? $item->model : '' }}"
                                                                            id="model_1" name="model_1"
                                                                            placeholder="{{ __('nav.model') }}">
                                                                    </div>

                                                                    <div class="field">
                                                                        <label
                                                                            for="serial_number_1">{{ __('nav.serial_number') }}</label>
                                                                        <input type="text" class="form-control"
                                                                            value="{{ $update ? $item->serial_number : '' }}"
                                                                            id="serial_number_1" name="serial_number_1"
                                                                            placeholder="{{ __('nav.serial_number') }}">
                                                                    </div>

                                                                    <div class="field">
                                                                        <label
                                                                            for="fix_asset_code_1">{{ __('nav.fix_asset_code') }}</label>
                                                                        <input type="text" class="form-control"
                                                                            value="{{ $update ? $item->fix_asset_code : '' }}"
                                                                            id="fix_asset_code_1" name="fix_asset_code_1"
                                                                            placeholder="{{ __('nav.fix_asset_code') }}">
                                                                    </div>

                                                                    <div class="field">
                                                                        <label for="category_1">{{ __('nav.category') }}
                                                                            <span class="text-danger">*</span></label>
                                                                        <select name="category_1" id="category" required
                                                                            class="ui {{ $update ? 'dropdown1' : '' }} search">
                                                                            <option value="">
                                                                                {{ __('nav.selectCategory') }}</option>
                                                                            @foreach ($categories as $c)
                                                                                <option value="{{ $c->id }}"
                                                                                    @if ($update) {{ $item->cat_id == $c->id ? 'selected' : '' }} @endif>
                                                                                    {{ $c->cat_name }}</option>
                                                                            @endforeach
                                                                        </select>
                                                                    </div>

                                                                    <div class="field">
                                                                        <label
                                                                            for="equipment_type_1">{{ __('nav.equipment_type') }}
                                                                            <span class="text-danger">*</span></label>
                                                                        <select name="equipment_type_1"
                                                                            id="equipment_type" required
                                                                            class="ui {{ $update ? 'dropdown2' : '' }} search">
                                                                            <option value="">
                                                                                {{ __('nav.selectQuipmentType') }}</option>
                                                                            <option value="1"
                                                                                @if ($update) {{ $item->equipment_type == 1 ? 'selected' : '' }} @endif>
                                                                                {{ __('nav.equipment') }}
                                                                            </option>
                                                                            <option value="2" @if ($update) {{ $item->equipment_type == 2 ? 'selected' : '' }} @endif>
                                                                                {{ __('nav.accessories') }}
                                                                            </option>
                                                                        </select>
                                                                    </div>

                                                                    <div class="field">
                                                                        <label for="qty_1">{{ __('home.qty') }} <span
                                                                                class="text-danger">*</span></label>
                                                                        <input type="number" min="1"
                                                                            class="form-control" readonly
                                                                            value="{{ $update ? $item->qty : 1 }}" id="qty_1"
                                                                            name="qty_1"
                                                                            placeholder="{{ __('home.qty') }}">
                                                                    </div>

                                                                    <div class="field">
                                                                        <label
                                                                            for="unit_price_1">{{ __('nav.unit_price') }}
                                                                            <span class="text-danger">*</span></label>
                                                                        <div class="ui right labeled input">
                                                                            <label for="unit_price_1"
                                                                                class="ui label">$</label>
                                                                            <input type="number" step="0.001"
                                                                                class="form-control" required
                                                                                value="{{ $update ? $item->price : '' }}"
                                                                                id="unit_price_1" name="unit_price_1"
                                                                                placeholder="{{ __('nav.unit_price') }}">
                                                                        </div>
                                                                    </div>

                                                                    <div class="field">
                                                                        <label
                                                                            for="descript_1">{{ __('nav.noted') }}</label>
                                                                        <textarea name="descript_1" id="descript_1" cols="30" rows="4" class="form-control"
                                                                            placeholder="{{ __('nav.noted') }}...">{{ $update ? $item->pro_description : '' }}</textarea>
                                                                    </div>

                                                                    @if ($update)
                                                                        <div class="field text-end">
                                                                            <button type="submit"
                                                                                class="ui button tiny green">
                                                                                <span
                                                                                    class="mdi mdi-check-circle icon"></span>
                                                                                {{ __('nav.update') }}
                                                                            </button>
                                                                        </div>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endif

                                                </div>

                                                @if (!$update)
                                                    <div class="row mt-3 mb-3">
                                                        <div class="col-4 col-sm-4 col-md-2">
                                                            <div class="mini ui buttons">
                                                                <button type="button" id="minusButton" class="ui button"
                                                                    title="Remove row"><i
                                                                        class="minus icon me-0 pe-0"></i></button>
                                                                <button type="button" id="addButton" class="ui button"
                                                                    title="Add row"><i
                                                                        class="plus icon me-0 pe-0"></i></button>
                                                            </div>
                                                        </div>

                                                    </div>

                                                    <div class="row mt-3">
                                                        <div class="col-12 d-flex justify-content-end align-items-end">
                                                            <button type="submit" class="ui button tiny blue"
                                                                style="width: fit-content;"><span
                                                                    class="mdi mdi-check-circle icon"></span>
                                                                {{ __('nav.save') }} </button>
                                                        </div>
                                                    </div>
                                                @endif

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        document.getElementById('productImg').addEventListener('change', function(event) {
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const preview = document.getElementById('file-input');
                    preview.src = e.target.result;
                    preview.style.display = 'block'; // Show the image
                };
                reader.readAsDataURL(file);
            }
        });
    </script>
    <script>
        $(document).ready(function() {
            $('#file-input').on('change', function(event) {
                const file = event.target.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        $('#image-preview').attr('src', e.target.result).show();
                    };
                    reader.readAsDataURL(file);
                }
            });
        });

        $(document).ready(function() {
            $('#expense_report').addClass('nav-item active');
            var cardRowCount = $('.count_row').length;
            $('#countItemForm').val(cardRowCount);

            if (cardRowCount <= 1) {
                $('#minusButton').addClass('disabled');
            }

            $(document).on('click', '#addButton', function() {
                $('#minusButton').removeClass('disabled');
                const itemCount = $('.count_row').length + 1;

                $('#countItemForm').val(itemCount);

                $('#appendContent').append(`
                    <div class="col-md-6 mb-3 count_row">
                        <div class="card bg-light overflow-hidden rounded-3">
                            <div class="card-header fw-bold bg-primary text-white">
                                {{ __('nav.itemNo') }} ${itemCount}
                            </div>
                            <div class="card-body">
                                <div class="field">
                                    <label for="productCode_${itemCount}">{{ __('nav.proCode') }}</label>
                                    <input type="text" class="form-control" autofocus
                                        value="{{ old('proCode') }}" id="productCode_${itemCount}"
                                        name="proCode_${itemCount}"
                                        placeholder="{{ __('nav.proCode') }}">
                                </div>

                                <div class="field">
                                    <label for="proname_${itemCount}">{{ __('nav.proName') }} <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" required
                                        value="{{ old('proname') }}" id="proname_${itemCount}"
                                        name="proname_${itemCount}"
                                        placeholder="{{ __('nav.proName') }}">
                                </div>

                                <div class="field">
                                    <label for="model_${itemCount}">{{ __('nav.model') }}</label>
                                    <input type="text" class="form-control"
                                        value="{{ old('model') }}" id="model_${itemCount}"
                                        name="model_${itemCount}" placeholder="{{ __('nav.model') }}">
                                </div>

                                <div class="field">
                                    <label for="serial_number_${itemCount}">{{ __('nav.serial_number') }}</label>
                                    <input type="text" class="form-control"
                                        value="{{ old('serial_number') }}"
                                        id="serial_number_${itemCount}" name="serial_number_${itemCount}"
                                        placeholder="{{ __('nav.serial_number') }}">
                                </div>

                                <div class="field">
                                    <label for="fix_asset_code_${itemCount}">{{ __('nav.fix_asset_code') }}</label>
                                    <input type="text" class="form-control"
                                        value="{{ old('fix_asset_code') }}"
                                        id="fix_asset_code_${itemCount}" name="fix_asset_code_${itemCount}"
                                        placeholder="{{ __('nav.fix_asset_code') }}">
                                </div>

                                <div class="field">
                                    <label for="category_${itemCount}">{{ __('nav.category') }} <span class="text-danger">*</span></label>
                                    <select name="category_${itemCount}" required id="category_${itemCount}" class="ui dropdown${itemCount+1} search">
                                        <option value="">{{ __('nav.selectCategory') }}</option>
                                        @foreach ($categories as $c)
                                            <option value="{{ $c->id }}">{{ $c->cat_name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="field">
                                    <label for="equipment_type_${itemCount}">{{ __('nav.equipment_type') }} <span class="text-danger">*</span></label>
                                    <select name="equipment_type_${itemCount}" required id="equipment_type_${itemCount}" class="ui dropdown${itemCount+2} search">
                                        <option value="">{{ __('nav.selectQuipmentType') }}</option>
                                        <option value="1">{{ __('nav.equipment') }}</option>
                                        <option value="2">{{ __('nav.accessories') }}</option>
                                    </select>
                                </div>

                                <div class="field">
                                    <label for="qty_${itemCount}">{{ __('home.qty') }} <span class="text-danger">*</span></label>
                                    <input type="number" min="1"
                                        class="form-control" value="{{ old('qty') ?? 1 }}" required readonly
                                        id="qty_${itemCount}" name="qty_${itemCount}"
                                        placeholder="{{ __('home.qty') }}">
                                </div>

                                <div class="field">
                                    <label for="unit_price_${itemCount}">{{ __('nav.unit_price') }} <span class="text-danger">*</span></label>
                                    <div class="ui right labeled input">
                                        <label for="unit_price_${itemCount}" class="ui label">$</label>
                                        <input type="number" step="0.001" class="form-control" required
                                            value="{{ old('unit_price') }}" id="unit_price_${itemCount}"
                                            name="unit_price_${itemCount}"
                                            placeholder="{{ __('nav.unit_price') }}">
                                    </div>
                                </div>

                                <div class="field">
                                    <label for="descript_${itemCount}">{{ __('nav.noted') }}</label>
                                    <textarea name="descript_${itemCount}" id="descript_${itemCount}" cols="30" rows="4" class="form-control"
                                        placeholder="{{ __('nav.noted') }}...">{{ old('descript') }}</textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                `);

                // Initialize dropdowns after appending
                $('#category_' + itemCount).dropdown();
                $('#equipment_type_' + itemCount).dropdown();
            });

            $(document).on('click', '#minusButton', function() {
                const lastRow = $('.count_row').last(); // Select the last count_row
                if (lastRow.length) {
                    lastRow.remove(); // Remove it if it exists
                }

                // Optionally, disable the minus button if there are no more rows
                if ($('.count_row').length === 1) {
                    $('#minusButton').addClass('disabled');
                }

                var cardRowCount = $('.count_row').length;
                $('#countItemForm').val(cardRowCount);
            });
        });

        for (var i = 1; i <= 100; i++) {
            $('#category_' + i).dropdown();
            $('#equipment_type_' + i).dropdown();
        }

        $('.ui.form').form({
            fields: {
                proNameEn: {
                    identifier: 'proNameEn',
                    rules: [{
                        type: 'empty',
                        prompt: 'Please enter your name'
                    }]
                },
                catId: {
                    identifier: 'catId',
                    rules: [{
                        type: 'empty',
                        prompt: 'Please enter your name'
                    }]
                },
                qty: {
                    identifier: 'qty',
                    rules: [{
                        type: 'empty',
                        prompt: 'Please enter your name'
                    }]
                },
                equipment_type: {
                    identifier: 'equipment_type',
                    rules: [{
                        type: 'empty',
                        prompt: 'Please enter your name'
                    }]
                },
            }
        });
    </script>
@endsection
