@extends('layout/master')

@section('title')
    <title>{{ __('nav.itemCode') }} | IMS</title>
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
            <div class="col-md-12 grid-margin">
                <div class="row">
                    <div class="col-12 col-xl-8 mb-4 mb-xl-0">
                        <h3 class="font-weight-bold">{{ __('nav.itemCode') }}</h3>
                        <h6 class="font-weight-normal mb-0"> {{ __('nav.master') }} / {{ __('nav.itemCode') }} /<span
                                class="text-primary"><a class="text-primary"
                                    href="">{{ $update ? __('nav.update') : __('nav.addNew') }}</a></span></h6>
                    </div>
                </div>
                <div class="row mt-4">
                    <div class="col-md-7">
                        @include('layout.back-button')
                        <div class="card p-2">
                            <div class="card-body">
                                <form
                                    action="{{ $update ? route('item_code.update', $item->item_code_id) : route('item_code.store') }}"
                                    method="post" autocomplete="off" class="ui form">
                                    @if ($update)
                                        @method('PUT')
                                    @endif
                                    @csrf
                                    <div class="modal-body">
                                        <h3 class="ui header medium">{{ $update ? __('nav.update') : __('nav.addNew') }}
                                        </h3>
                                        <div class="field">
                                            <label for="item_code">{{ __('nav.itemCode') }} <span
                                                    class="text-danger">*</span></label>
                                            <input type="text" id="item_code" class="form-control" name="item_code"
                                                placeholder="{{ __('nav.itemCode') }}" autofocus
                                                value="{{ $update ? $item->item_code : old('item_code') }}">

                                            @error('item_code')
                                                <small class="text-danger fw-normal">{{ $message }}</small>
                                            @enderror
                                        </div>

                                        <div class="field">
                                            <label for="item_name_kh"> {{ __('nav.proNameKh') }} <span
                                                    class="text-danger">*</span></label>
                                            <input type="text" id="item_name_kh" class="form-control" name="item_name_kh"
                                                placeholder="{{ __('nav.proNameKh') }}"
                                                value="{{ $update ? $item->item_name_kh : old('item_name_kh') }}">
                                        </div>

                                        <div class="field">

                                            <label for="item_name_en"> {{ __('nav.proNameEn') }} <span
                                                    class="text-danger">*</span></label>
                                            <input type="text" id="item_name_en" class="form-control" name="item_name_en"
                                                placeholder="{{ __('nav.proNameEn') }}"
                                                value="{{ $update ? $item->item_name_en : old('item_name_en') }}">
                                        </div>

                                        <div class="field">
                                            <label for="item_cat"> {{ __('nav.category') }} <span
                                                    class="text-danger">*</span></label>
                                            <select name="item_cat" id="item_cat" class="ui fluid search dropdown">
                                                <option value="">{{ __('nav.selectCategory') }}</option>

                                                @foreach ($categorys as $cat)
                                                    <option
                                                        @if ($update) {{ $item->item_cat == $cat->id ? 'selected' : '' }}
                                                    @else
                                                    {{ old('item_cat') == $cat->id ? 'selected' : '' }} @endif
                                                        value="{{ $cat->id }}">{{ $cat->cat_name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="field">
                                            <label for="equipment_type"> {{ __('nav.equipment_type') }} <span
                                                    class="text-danger">*</span></label>
                                            <select name="equipment_type" id="equipment_type" class="ui fluid search dropdown1">
                                                <option value="">{{ __('nav.selectQuipmentType') }}</option>
                                                <option value="1"
                                                    @if ($update)
                                                        {{ $item->equipment_type == 1 ? 'selected' : '' }}
                                                    @else
                                                        {{ old('equipment_type') == 1 ? 'selected' : '' }}
                                                    @endif
                                                >{{ __('nav.equipment') }}</option>
                                                <option value="2"
                                                    @if ($update)
                                                        {{ $item->equipment_type == 2 ? 'selected' : '' }}
                                                    @else
                                                        {{ old('equipment_type') == 2 ? 'selected' : '' }}
                                                    @endif
                                                >{{ __('nav.accessories') }}</option>
                                            </select>
                                        </div>
                                        <div class="field text-end">
                                            @if (session('success') || $update)
                                                <a href="{{ route('item_code.index') }}" class="ui button tiny">
                                                    <span class="mdi mdi-format-list-bulleted icon"></span>
                                                    {{ __('nav.backToList') }}
                                                </a>
                                            @endif

                                            <button type="submit" class="ui button tiny {{ $update ? 'green' : 'blue' }}">
                                                <span class="mdi mdi-check-circle icon"></span>
                                                {{ $update ? __('nav.update') : __('nav.save') }}
                                            </button>
                                        </div>
                                    </div>
                                </form>
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
            $('#master').addClass('nav-item active');
            $('#ui-basic').addClass('collapse show');
        });

        $('.ui.form')
            .form({
                fields: {
                    item_code: {
                        identifier: 'item_code',
                        rules: [{
                            type: 'empty',
                        }]
                    },
                    item_name_kh: {
                        identifier: 'item_name_kh',
                        rules: [{
                            type: 'empty',
                        }]
                    },
                    item_name_en: {
                        identifier: 'item_name_en',
                        rules: [{
                            type: 'empty',
                        }]
                    },

                    item_cat: {
                        identifier: 'item_cat',
                        rules: [{
                            type: 'empty',
                        }]
                    },

                    equipment_type: {
                        identifier: 'equipment_type',
                        rules: [{
                            type: 'empty',
                        }]
                    },
                }
            });
    </script>
@endsection
