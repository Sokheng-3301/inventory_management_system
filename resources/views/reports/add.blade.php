@extends('layout/master')
@hasSection('link')
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.18/css/bootstrap-select.min.css"
        integrity="sha512-ARJR74swou2y0Q2V9k0GbzQ/5vJ2RBSoCWokg4zkfM29Fb3vZEQyv0iWBMW/yvKgyHSR/7D64pFMmU8nYmbRkg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
@endif
@section('title')
    <title> {{ $update ? __('nav.updateExportReport') : __('nav.addExpenseReport') }} | IMS</title>
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
                            {{ $update ? __('nav.updateExportReport') : __('nav.addExpenseReport') }}</h3>
                        <h6 class="font-weight-normal mb-0">{{ __('nav.expenseReport') }} / <span class="text-primary"><a
                                    class="text-primary" href="{{ route('expense.purchase.index') }}">{{ __('nav.ItePurchase') }}
                                </a>
                                / <a class="text-primary" href="">
                                    {{ $update ? __('nav.update') : __('nav.addNew') }} </a></span></h6>
                    </div>
                </div>
                <div class="row mt-4">
                    <div class="col-sm-12 col-md-12 col-l-12 col-xl-12">
                        @include('layout.back-button')
                        <div class="card p-1">
                            <form action="{{ $update ? route('expense.purchase.update', $item->proId) : route('expense.purchase.store') }}"
                                method="post" enctype="multipart/form-data" autocomplete="off" class="ui form">
                                @if ($update)
                                    @method('PUT')
                                @endif
                                @csrf
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-sm-12 col-md-4 ">
                                            <div class="bg-light p-3">
                                                <p class="fw-bold text-center text-primary"> {{ __('nav.proImg') }} </p>
                                                <label for="productImg" id="proImg">
                                                    <span class="mdi mdi-image-plus"></span>
                                                    <div class="bgCamera">

                                                    </div>
                                                    <img src="{{ $update ? asset($item->pro_img) : '' }}" id="file-input"
                                                        alt="">
                                                </label>
                                                <small class="text-center d-block">{{ __('nav.uploadProImg') }}</small>
                                                <input type="file" class="d-none" name="proImage" style="display: none;"
                                                    id="productImg" accept="image/*">
                                            </div>
                                        </div>
                                        <div class="col-sm-12 col-md-8">
                                            <div class="bg-light p-3">
                                                <p class="fw-bold text-center text-primary"> {{ __('nav.proInfo') }} </p>
                                                <div class="row d-flex align-items-center field">
                                                    <div class="col-sm-12 col-md-3 col-l-3">
                                                        <label for="productCode">{{ __('nav.proCode') }} <span
                                                                class="text-danger">*</span></label>
                                                    </div>
                                                    <div class="col-sm-12 col-md-9 col-l-9">
                                                        <select name="proCode" id="proCode"
                                                            class="ui search fluid dropdown">
                                                            <option value="">{{ __('nav.selectItemCode') }}
                                                            </option>
                                                            @foreach ($item_codes as $item_code)
                                                                <option
                                                                    @if ($update) {{ $item->pro_code == $item_code->id ? 'selected' : '' }}
                                                                @else
                                                                    {{ old('proCode') == $item_code->id ? 'selected' : '' }} @endif
                                                                    value="{{ $item_code->id }}">
                                                                    {{ $item_code->item_code }}
                                                                    <span class="text-muted">(
                                                                        {{ $item_code->item_name_en }} )</span>
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="row d-flex align-items-center field">
                                                    <div class="col-sm-12 col-md-3 col-l-3">
                                                        <label for="proNameKh">{{ __('nav.proNameKh') }} <span
                                                                class="text-danger">*</span></label>
                                                    </div>
                                                    <div class="col-sm-12 col-md-9 col-l-9">
                                                        <input readonly type="text"  id="proNameKh"
                                                            value="{{ $update ? $item->item_name_kh : old('proNameKh') }}"
                                                            name="proNameKh" placeholder="{{ __('nav.proNameKh') }}">
                                                    </div>
                                                </div>

                                                <div class="row d-flex align-items-center field">
                                                    <div class="col-sm-12 col-md-3 col-l-3">
                                                        <label for="proNameEn"> {{ __('nav.proNameEn') }} <span
                                                                class="text-danger">*</span></label>
                                                    </div>
                                                    <div class="col-sm-12 col-md-9 col-l-9">
                                                        <input readonly type="text"  id="proNameEn"
                                                            value="{{ $update ? $item->item_name_en : old('proNameEn') }}"
                                                            name="proNameEn" placeholder="{{ __('nav.proNameEn') }}">
                                                    </div>
                                                </div>


                                                <div class="row d-flex align-items-center field">
                                                    <div class="col-sm-12 col-md-3 col-l-3">
                                                        <label for="category"> {{ __('nav.category') }} <span
                                                                class="text-danger">*</span></label>
                                                    </div>
                                                    <div class="col-sm-12 col-md-9 col-l-9">
                                                        <input readonly type="text"  id="category"
                                                            value="{{ $update ? $item->cat_name : old('category') }}"
                                                            name="category" placeholder="{{ __('nav.category') }}">
                                                    </div>
                                                </div>

                                                <div class="row d-flex align-items-center field">
                                                    <div class="col-sm-12 col-md-3 col-l-3">
                                                        <label for="equipment_type"> {{ __('nav.equipment_type') }} <span
                                                                class="text-danger">*</span></label>
                                                    </div>
                                                    <div class="col-sm-12 col-md-9 col-l-9">
                                                        <input readonly type="text" 
                                                            id="equipment_type"
                                                            value="@if($update){{ $item->equipment_type == 1 ? __('nav.equipment') : __('nav.accessories') }}
                                                            @else{{ old('equipment_type') }}@endif"
                                                            name="equipment_type"
                                                            placeholder="{{ __('nav.equipment_type') }}">
                                                    </div>
                                                </div>

                                                <div class="row d-flex align-items-center field">
                                                    <div class="col-sm-12 col-md-3 col-l-3">
                                                        <label for="model"> {{ __('nav.model') }}</label>
                                                    </div>
                                                    <div class="col-sm-12 col-md-9 col-l-9">
                                                        <input type="text"  id="model"
                                                            name="model" placeholder=" {{ __('nav.model') }} "
                                                            value="{{ $update ? $item->model : old('model') }}">
                                                    </div>
                                                </div>

                                                <div class="row d-flex align-items-center field">
                                                    <div class="col-sm-12 col-md-3 col-l-3">
                                                        <label for="serial_number"> {{ __('nav.serial_number') }} </label>
                                                    </div>
                                                    <div class="col-sm-12 col-md-9 col-l-9">
                                                        <input type="text" 
                                                            value="{{ $update ? $item->serial_number : old('serial_number') }}"
                                                            id="serial_number" name="serial_number"
                                                            placeholder=" {{ __('nav.serial_number') }} ">
                                                    </div>
                                                </div>

                                                {{-- <div class="row d-flex align-items-center field">
                                                    <div class="col-sm-12 col-md-3 col-l-3">
                                                        <label for="fix_asset_code">
                                                            {{ __('nav.fix_asset_code') }}</label>
                                                    </div>
                                                    <div class="col-sm-12 col-md-9 col-l-9">
                                                        <input type="text"  id="fix_asset_code"
                                                            value="{{ $update ? $item->fix_asset_code : old('fix_asset_code') }}" name="fix_asset_code"
                                                            placeholder=" {{ __('nav.fix_asset_code') }} ">
                                                    </div>
                                                </div> --}}

                                                <div class="row d-flex align-items-center field">
                                                    <div class="col-sm-12 col-md-3 col-l-3">
                                                        <label for="qty"> {{ __('home.qty') }} <span
                                                                class="text-danger">*</span></label>
                                                    </div>
                                                    <div class="col-sm-12 col-md-9 col-l-9">
                                                        <input type="number"  id="qty"
                                                            name="qty" placeholder="{{ __('home.qty') }}"
                                                            min="1" value="{{ $update ? $item->qty : old('qty')}}">
                                                    </div>
                                                </div>

                                                <div class="row field">
                                                    <div class="col-sm-12 col-md-3 col-l-3">
                                                        <label for="price"> {{ __('nav.price') }} <span
                                                                class="text-danger">*</span></label>
                                                    </div>
                                                    <div class="col-sm-12 col-md-9 col-l-9">
                                                        <div class="ui labeled input">
                                                            <label for="price"
                                                                class="ui label">$</label>
                                                            <input type="number"  id="price"
                                                                name="price" placeholder="{{ __('nav.price') }}"
                                                                step="0.001" min="1"
                                                                value="{{ $update ? $item->price : old('price') }}">
                                                        </div>
                                                    </div>
                                                </div>


                                                <div class="row d-flex align-items-center field">
                                                    <div class="col-sm-12 col-md-3 col-l-3">
                                                        <label for="descript"> {{ __('nav.noted') }} <span
                                                                class="text-danger"></span></label>
                                                    </div>
                                                    <div class="col-sm-12 col-md-9 col-l-9">
                                                        <textarea name="descript" id="descript" cols="30" rows="5" 
                                                            placeholder="{{ __('nav.noted') }}...">{{ $update ? $item->pro_description : old('descript') }}</textarea>
                                                    </div>
                                                </div>


                                                <div class="row field">
                                                    <div class="col-12 d-flex justify-content-end align-items-end">
                                                        @if ($update || session('success'))
                                                            <a href="{{ route('expense.purchase.index') }}"
                                                                class="ui button small">
                                                                <span class="mdi mdi-format-list-bulleted icon"></span>
                                                                {{ __('nav.backToList') }}
                                                            </a>
                                                        @endif
                                                        <button type="submit" id="save"
                                                            class="ui button small {{ $update ? 'green' : 'blue' }}">
                                                            <span class="mdi mdi-check-circle icon"></span>
                                                            {{ $update ? __('nav.update') : __('nav.save') }}
                                                        </button>

                                                    </div>
                                                </div>
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
            $('#expenseReportMain').addClass('nav-item active');
            $('#expenseReport').addClass('collapse show');
        });

        $('.ui.form')
            .form({
                fields: {

                    proCode: {
                        identifier: 'proCode',
                        rules: [{
                            type: 'empty',
                            prompt: 'Please enter your name'
                        }]
                    },

                    proNameEn: {
                        identifier: 'proNameEn',
                        rules: [{
                            type: 'empty',
                            prompt: 'Please enter your name'
                        }]
                    },
                    proNameKh: {
                        identifier: 'proNameKh',
                        rules: [{
                            type: 'empty',
                            prompt: 'Please enter your name'
                        }]
                    },

                    category: {
                        identifier: 'category',
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
                    price: {
                        identifier: 'price',
                        rules: [{
                            type: 'empty',
                            prompt: 'Please enter your name'
                        }]
                    },
                }
            });

        $(document).on('change', '#proCode', function() {
            var proCodeId = $(this).val();
            var url = "{{ route('product.getData', ':id') }}".replace(':id', proCodeId);
            // alert(proCodeId);

            $.ajax({
                type: "GET",
                url: url,
                dataType: "json",
                success: function(response) {
                    $('#proNameKh').val(response.data.item_name_kh);
                    $('#proNameEn').val(response.data.item_name_en);
                    $('#category').val(response.data.cat_name);
                    $('#equipment_type').val(response.equipment_type);
                }
            });

        });
    </script>
@endsection
