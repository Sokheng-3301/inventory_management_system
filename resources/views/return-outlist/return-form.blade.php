@extends('layout/master')
@hasSection('link')
@endif
@section('title')
    <title> {{ __('nav.addNewReturn') }} | IMS</title>
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

        .attchLabel {
            width: 100%;
            /* padding: 15px 20px; */
            text-align: center;
            cursor: pointer;
            border: 2px dashed gray;
            padding: 10px;
            border-radius: 5px;
            background: #e6e6e6e0;
        }

        .attch {
            background: rgb(255, 255, 255);
            padding: 20px;
            /* display: flex;
                                                                                                                        justify-content: center;
                                                                                                                        align-items: center; */

        }
    </style>
@endsection

@section('content')
    <div class="content-wrapper">
        <div class="row">
            <div class="col-md-12 grid-margin">
                <div class="row">
                    <div class="col-12 mb-4 mb-xl-0">
                        <h3 class="font-weight-bold">{{ __('nav.addNewReturn') }}</h3>
                        <h6 class="font-weight-normal mb-0">{{ __('nav.product') }} / {{ __('nav.givenAndReturned') }} /
                            <span class="text-primary"><a class="text-primary" href="">{{ __('nav.addNewReturn') }} </a>
                        </h6>
                    </div>
                </div>
                <div class="row mt-4">
                    <div class="col-sm-12 col-md-12 col-l-12 col-xl-12">
                        @include('layout.back-button')
                        <div class="card p-1">
                            <div class="p-3 mt-3">
                                <div class="row">
                                    <div class="col-md-12">
                                        <h3 class="text-primary">
                                            {{ __('nav.returnOutlistForm') }}
                                        </h3>
                                        <div class="bg-white">
                                            <form
                                                action="{{ $update ? route('returnOutList.update', $item->returnOutlist_id) : route('returnOutList.store') }}"
                                                id="formReturn" method="post" enctype="multipart/form-data"
                                                autocomplete="off" class="ui form">
                                                @if ($update)
                                                    @method('PUT')
                                                @endif
                                                @csrf
                                                <div class="row">
                                                    <div class="col-md-6 field">
                                                        <input type="hidden" class="d-none" id="add_status"
                                                            name="add_status" value="1">

                                                        <label for="userGiven">{{ __('nav.returnBy') }} <span
                                                                class="text-danger">*</span></label>
                                                        <select name="userAccount" id="userAccount"
                                                            class="ui search dropdown d-block w-100">
                                                            <option value="">{{ __('nav.selectStaff') }}</option>
                                                            @foreach ($users as $user)
                                                                <option
                                                                    @if ($update) {{ $item->staff_id == $user->id ? 'selected' : '' }}
                                                                    @else
                                                                        {{ old('userAccount') == $user->id ? 'selected' : '' }} @endif
                                                                    value="{{ $user->id }}">
                                                                    <span
                                                                        class="text-danger">{{ $user->card_id ?? __('nav.newStaff') }}</span>
                                                                    {{ ' - ' . $user->name_kh . '  ( ' . strtoupper($user->name_en) . ' )' }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>

                                                    <div class="col-md-6 field">
                                                        <label for="proCode">{{ __('nav.proCode') }} <span
                                                                class="text-danger">*</span></label>
                                                        <select name="proCode" id="proCode"
                                                            class="ui search fluid dropdown1">
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


                                                    <div class="col-md-6 field">
                                                        <label for="proname"> {{ __('nav.proNameKh') }} <span
                                                                class="text-danger">*</span></label>
                                                        <div class="ui input">
                                                            <input readonly type="text" class="form-control"
                                                                id="proNameKh"
                                                                value="{{ $update ? $item->item_name_kh : old('proNameKh') }}"
                                                                name="proNameKh" placeholder="{{ __('nav.proNameKh') }}">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 field">
                                                        <label for="proNameEn"> {{ __('nav.proNameEn') }} <span
                                                                class="text-danger">*</span></label>
                                                        <div class="ui input">
                                                            <input readonly type="text" class="form-control"
                                                                id="proNameEn"
                                                                value="{{ $update ? $item->item_name_en : old('proNameEn') }}"
                                                                name="proNameEn" placeholder="{{ __('nav.proNameEn') }}">
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6 field">
                                                        <label for="category"> {{ __('nav.category') }} <span
                                                                class="text-danger">*</span></label>
                                                        <div class="ui input">
                                                            <input readonly type="text" class="form-control"
                                                                id="category"
                                                                value="{{ $update ? $item->cat_name : old('category') }}"
                                                                name="category" placeholder="{{ __('nav.category') }}">
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6 field">
                                                        <label for="equipment_type"> {{ __('nav.equipment_type') }} <span
                                                                class="text-danger">*</span></label>
                                                        <div class="ui input">
                                                            <input readonly type="text" class="form-control"
                                                                id="equipment_type"
                                                                value="@if($update){{ $item->equipment_type == 1 ? __('nav.equipment') : __('nav.accessories') }}
                                                                    @else
                                                                    {{ old('equipment_type') }} @endif"
                                                                name="equipment_type"
                                                                placeholder="{{ __('nav.equipment_type') }}">
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6 field">
                                                        <label for="model"> {{ __('nav.model') }} </label>
                                                        <div class="ui input">
                                                            <input type="text" name="model" id="model"
                                                                placeholder="{{ __('nav.proCode') }}"
                                                                value="{{ $update ? $item->model : old('model') }}">
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6 field">
                                                        <label for="serial_number"> {{ __('nav.serial_number') }} </label>
                                                        <div class="ui input">
                                                            <input type="text" name="serial_number" id="serial_number"
                                                                placeholder="{{ __('nav.proCode') }}"
                                                                value="{{ $update ? $item->serial_number : old('serial_number') }}">
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6 field">
                                                        <label for="fix_asset_code"> {{ __('nav.fix_asset_code') }}
                                                        </label>
                                                        <div class="ui input">
                                                            <input type="text" name="fix_asset_code"
                                                                id="fix_asset_code" placeholder="{{ __('nav.proCode') }}"
                                                                value="{{ $update ? $item->fix_asset_code : old('fix_asset_code') }}">
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6 field">
                                                        <label for="status">{{ __('nav.itemStatus') }}</label>
                                                        <textarea name="status" id="status" placeholder="{{ __('nav.itemStatus') }}..." rows="1">{{ $update ? $item->item_status : old('status') }}</textarea>

                                                    </div>
                                                </div>


                                                <div class="field mt-3">
                                                    <label for="attachment" class="d-block w-100">
                                                        {{ __('nav.uploadAtt') }}
                                                        <span class="text-danger">*</span></label>
                                                    <input type="file" name="attachment" id="attachment"
                                                        style="display: none;" class="d-none attachment"
                                                        accept="image/*">
                                                    <label for="attachment" class="attchLabel">
                                                        <div class="attch">
                                                            <img src="{{ $update ? asset($item->attachment) : '' }}" alt="" class="attachmentFile"
                                                                id="file-attach" width="100%">
                                                            <span class="mdi mdi-image-plus text-secondary fs-1 {{ $update ? 'd-none' : '' }}"
                                                                id="draft-img"></span>
                                                            {{-- <img src="{{asset('images/draft-image.png')}}" alt="" id="draft-img" class="icon"> --}}
                                                        </div>
                                                    </label>
                                                </div>

                                                {{-- <input type="text" name="attachment" value="{{ old('attachment') }}"> --}}
                                                <div class="field text-end">
                                                    @if ($update || session('success'))
                                                        <a href="{{ route('returnOutList.index') }}"
                                                            class="ui button small "><span
                                                                class="mdi mdi-format-list-bulleted icon">
                                                                {{ __('nav.backToList') }}</a>
                                                    @endif

                                                    {{-- @if (!session('confirmSubmit'))
                                                        <button type="submit" id="submitConfirm"
                                                            class="ui button small {{ $update ? 'green' : 'primary' }}">
                                                            <span class="mdi mdi-check-circle icon"></span>
                                                            {{ $update ? __('nav.update') : __('nav.save') }}</button>
                                                    @endif --}}

                                                    <button type="submit" id="addOnlyReturn"
                                                        class="ui button small {{ $update ? 'green' : 'orange' }}"><span
                                                            class="mdi mdi-check-circle icon"></span>{{ $update ? __('nav.update') : __('nav.save') }}</button>
                                                    @if (!$update)
                                                        <button type="submit" id="addReturnAndStock"
                                                            class="ui button small blue">
                                                            <span
                                                                class="mdi mdi-check-circle icon"></span>{{ __('nav.saveAndStock') }}
                                                        </button>
                                                    @endif

                                                </div>
                                                @if (session('confirmSubmit'))
                                                    <!-- Modal Confirm submit -->
                                                    <div class="modal fade" id="confirmSubmitModal"
                                                        data-bs-backdrop="static">
                                                        <div class="modal-dialog modal-dialog-centered">
                                                            <div class="modal-content">
                                                                <div class="modal-body">
                                                                    <h2 class="ui icon header text-center w-100">
                                                                        <i class="question icon"></i>
                                                                        <div class="content mt-3">
                                                                            {{ __('nav.messageFromSystem') }}
                                                                            <div class="sub header mt-2">
                                                                                {{ __('nav.doYouWantToAddInStock') }}
                                                                            </div>
                                                                        </div>
                                                                    </h2>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="submit" id="addOnlyReturn"
                                                                        class="ui button tiny orange"><span
                                                                            class="mdi mdi-check-circle icon"></span>{{ __('nav.onlySave') }}</button>
                                                                    <button type="submit" id="addReturnAndStock"
                                                                        class="ui button tiny blue">
                                                                        <span
                                                                            class="mdi mdi-check-circle icon"></span>{{ __('nav.yesAddtoStock') }}
                                                                    </button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endif
                                            </form>
                                        </div>
                                    </div>
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
        document.getElementById('attachment').addEventListener('change', function(event) {
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const preview = document.getElementById('file-attach');
                    const draftImg = document.getElementById('draft-img');
                    preview.src = e.target.result;
                    // preview.removeClass('d-none');
                    preview.style.display = 'block'; // Show the image
                    draftImg.style.display = 'none';
                };
                reader.readAsDataURL(file);
            }
        });

        $(document).ready(function() {
            $('#givenAndReturned').addClass('nav-item active');
            $('#error').addClass('collapse show');

            $('.ui.form').form({
                fields: {
                    userAccount: {
                        identifier: 'userAccount',
                        rules: [{
                            type: 'empty',
                            prompt: 'Please enter your name'
                        }]
                    },
                    proCode: {
                        identifier: 'proCode',
                        rules: [{
                            type: 'empty',
                            prompt: 'Please select a category'
                        }]
                    },
                    category: {
                        identifier: 'category',
                        rules: [{
                            type: 'empty',
                            prompt: 'Please select a category'
                        }]
                    },
                    proNameKh: {
                        identifier: 'proNameKh',
                        rules: [{
                            type: 'empty',
                            prompt: 'Please select a category'
                        }]
                    },

                    proNameEn: {
                        identifier: 'proNameEn',
                        rules: [{
                            type: 'empty',
                            prompt: 'Please select a category'
                        }]
                    },


                    equipment_type: {
                        identifier: 'equipment_type',
                        rules: [{
                            type: 'empty',
                            prompt: 'Please enter equipment type'
                        }]
                    },
                    @if (!$update)
                    attachment: {
                        identifier: 'attachment',
                        rules: [{
                            type: 'empty',
                            prompt: 'Please enter equipment type'
                        }]
                    },
                    @endif
                }
            });

            @if (session('confirmSubmit'))
                $('#confirmSubmitModal').modal('show');
            @endif

            $(document).on('click', '#addOnlyReturn', function() {
                $('#add_status').val(1);
            });
            $(document).on('click', '#addReturnAndStock', function() {
                $('#add_status').val(2);
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
        });
    </script>
@endsection
