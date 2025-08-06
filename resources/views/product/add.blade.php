@extends('layout/master')
@hasSection('link')
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.18/css/bootstrap-select.min.css"
        integrity="sha512-ARJR74swou2y0Q2V9k0GbzQ/5vJ2RBSoCWokg4zkfM29Fb3vZEQyv0iWBMW/yvKgyHSR/7D64pFMmU8nYmbRkg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
@endif
@section('title')
    <title> {{ $update_stock ? __('nav.updateProduct') : __('nav.addProduct') }} | IMS</title>
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
                        <h3 class="font-weight-bold">{{ __('nav.addProduct') }}</h3>
                        <h6 class="font-weight-normal mb-0">{{ __('nav.product') }} / <span class="text-primary"><a
                                    class="text-primary" href="{{ route('product.instock') }}">{{ __('nav.proList') }} </a>
                                / <a class="text-primary" href="">
                                    {{ $update_stock ? __('nav.updateProduct') : __('nav.addProduct') }} </a></span></h6>
                    </div>
                </div>
                <div class="row mt-4">
                    <div class="col-sm-12 col-md-12 col-l-12 col-xl-12">
                        @include('layout.back-button')
                        <div class="card p-1">
                            <form action="{{ $update_stock ? route('product.editSave', $item->id) : route('product.save') }}"
                                method="post" enctype="multipart/form-data" autocomplete="off" class="ui form">
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
                                                    <img src="{{ $update_stock ? asset($item->pro_img) : '' }}" id="file-input" alt="">
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
                                                                <option  @if ($update_stock)
                                                                    {{ $item->pro_code == $item_code->id ? 'selected' : '' }}
                                                                @else
                                                                    {{ old('proCode') == $item_code->id ? 'selected' : '' }}
                                                                @endif
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
                                                        <input readonly type="text" class="form-control" id="proNameKh"
                                                            value="{{ $code_info ? $code_info->item_name_kh : old('proNameKh') }}" name="proNameKh"
                                                            placeholder="{{ __('nav.proNameKh') }}">
                                                    </div>
                                                </div>

                                                <div class="row d-flex align-items-center field">
                                                    <div class="col-sm-12 col-md-3 col-l-3">
                                                        <label for="proNameEn"> {{ __('nav.proNameEn') }} <span
                                                                class="text-danger">*</span></label>
                                                    </div>
                                                    <div class="col-sm-12 col-md-9 col-l-9">
                                                        <input readonly type="text" class="form-control" id="proNameEn"
                                                            value="{{ $code_info ? $code_info->item_name_en : old('proNameEn') }}" name="proNameEn"
                                                            placeholder="{{ __('nav.proNameEn') }}">
                                                    </div>
                                                </div>


                                                <div class="row d-flex align-items-center field">
                                                    <div class="col-sm-12 col-md-3 col-l-3">
                                                        <label for="category"> {{ __('nav.category') }} <span
                                                                class="text-danger">*</span></label>
                                                    </div>
                                                    <div class="col-sm-12 col-md-9 col-l-9">
                                                        <input readonly type="text" class="form-control" id="category"
                                                            value="{{ $code_info ? $code_info->cat_name : old('category') }}" name="category"
                                                            placeholder="{{ __('nav.category') }}">
                                                    </div>
                                                </div>

                                                <div class="row d-flex align-items-center field">
                                                    <div class="col-sm-12 col-md-3 col-l-3">
                                                        <label for="equipment_type"> {{ __('nav.equipment_type') }} <span
                                                                class="text-danger">*</span></label>
                                                    </div>
                                                    <div class="col-sm-12 col-md-9 col-l-9">
                                                        <input readonly type="text" class="form-control"
                                                            id="equipment_type" value="@if($code_info) {{ $code_info->equipment_type == 1 ? __('nav.equipment') : __("nav.accessories") }}
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
                                                        <input type="text" class="form-control" id="model"
                                                            name="model" placeholder=" {{ __('nav.model') }} "
                                                            value="{{ $update_stock ? $item->model : old('model') }}">
                                                    </div>
                                                </div>

                                                <div class="row d-flex align-items-center field">
                                                    <div class="col-sm-12 col-md-3 col-l-3">
                                                        <label for="serial_number"> {{ __('nav.serial_number') }} </label>
                                                    </div>
                                                    <div class="col-sm-12 col-md-9 col-l-9">
                                                        <input type="text" class="form-control"
                                                            value="{{ $update_stock ? $item->serial_number : old('serial_number') }}" id="serial_number"
                                                            name="serial_number"
                                                            placeholder=" {{ __('nav.serial_number') }} ">
                                                    </div>
                                                </div>

                                                <div class="row d-flex align-items-center field">
                                                    <div class="col-sm-12 col-md-3 col-l-3">
                                                        <label for="fix_asset_code">
                                                            {{ __('nav.fix_asset_code') }}</label>
                                                    </div>
                                                    <div class="col-sm-12 col-md-9 col-l-9">
                                                        <input type="text" class="form-control" id="fix_asset_code"
                                                            value="{{ $update_stock ? $item->fix_asset_code : old('fix_asset_code') }}" name="fix_asset_code"
                                                            placeholder=" {{ __('nav.fix_asset_code') }} ">
                                                    </div>
                                                </div>

                                                <div class="row d-flex align-items-center field">
                                                    <div class="col-sm-12 col-md-3 col-l-3">
                                                        <label for="qty"> {{ __('home.qty') }} <span
                                                                class="text-danger">*</span></label>
                                                    </div>
                                                    <div class="col-sm-12 col-md-9 col-l-9">
                                                        <input type="number" class="form-control" id="qty" {{ $update_stock ? 'readonly' : '' }}
                                                            name="qty" placeholder="{{ __('home.qty') }}"
                                                            min="0" value="{{ $update_stock ? $item->qty : old('qty') }}">
                                                    </div>
                                                </div>

                                                @if($update_stock)
                                                    <div class="row d-flex align-items-center field">
                                                        <div class="col-sm-12 col-md-3 col-l-3">
                                                            <label for="add_new_stock"> {{ __('nav.add_new_stock') }}</label>
                                                        </div>
                                                        <div class="col-sm-12 col-md-9 col-l-9">
                                                            <input type="number" class="form-control" id="add_new_stock"
                                                                name="add_new_stock" placeholder="{{ __('nav.add_new_stock') }}"
                                                                min="1" value="">
                                                        </div>
                                                    </div>
                                                @endif


                                                @if($update_stock)
                                                    <div class="row d-flex align-items-center field">
                                                        <div class="col-sm-12 col-md-3 col-l-3">
                                                            <label for="fix_qty"> {{ __('nav.fix_qty') }} <span
                                                                    class="text-danger">*</span></label>
                                                        </div>
                                                        <div class="col-sm-12 col-md-9 col-l-9">
                                                            <input type="number" class="form-control" id="fix_qty" readonly
                                                                name="fix_qty" placeholder="{{ __('nav.fix_qty') }}"
                                                                min="0" value="{{ $update_stock ? $item->fix_qty : old('fix_qty') }}">
                                                        </div>
                                                    </div>
                                                @endif

                                                <div class="row d-flex align-items-center field">
                                                    <div class="col-sm-12 col-md-3 col-l-3">
                                                        <label for="descript"> {{ __('nav.noted') }} <span
                                                                class="text-danger"></span></label>
                                                    </div>
                                                    <div class="col-sm-12 col-md-9 col-l-9">
                                                        <textarea name="descript" id="descript" cols="30" rows="5" class="form-control"
                                                            placeholder="{{ __('nav.noted') }}...">{{  $update_stock ? $item->pro_description : old('descript') }}</textarea>
                                                    </div>
                                                </div>
                                                <div class="row field">
                                                    <div class="col-12 d-flex justify-content-end align-items-end">
                                                        @if ($update_stock || session('success'))
                                                            <a href="{{ route('product.instock') }}" class="ui button tiny">
                                                                <span class="mdi mdi-format-list-bulleted icon"></span>
                                                                {{ __('nav.backToList') }}
                                                            </a>
                                                        @endif
                                                        <button type="submit" class="ui button tiny {{ $update_stock ? 'green' : 'blue' }}">
                                                            <span class="mdi mdi-check-circle icon"></span>
                                                            {{ $update_stock ? __("nav.update") : __('nav.save') }}
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
            $('#product').addClass('nav-item active');
            $('#form-elements').addClass('collapse show');
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

        @if ($update_stock)
            $(document).on('input', '#add_new_stock', function () {

                var old_qty = "{{ $item->qty }}";
                var fix_qty = "{{ $item->fix_qty }}";
                var add_new_stock = $(this).val();
                var sum_old_qty = '';
                var sum_fix_qty = '';

                if(add_new_stock >= 1){
                    sum_old_qty = parseInt(old_qty) + parseInt(add_new_stock);
                    sum_fix_qty = parseInt(fix_qty) + parseInt(add_new_stock);
                }else{
                    sum_old_qty = old_qty;
                    sum_fix_qty = fix_qty;
                }

                if (!isNaN(sum_old_qty) && !isNaN(sum_fix_qty)) {
                    $('#qty').val(sum_old_qty);
                    $('#fix_qty').val(sum_fix_qty);
                } else {
                    $('#qty').val("{{ $item->qty }}");
                    $('#fix_qty').val("{{ $item->fix_qty }}");
                }
            });
        @endif

    </script>
@endsection
