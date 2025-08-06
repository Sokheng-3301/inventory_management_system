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
                                    class="text-primary"
                                    href="{{ route('expense.service.index') }}">{{ __('nav.serviceFee') }}
                                </a>
                                / <a class="text-primary" href="">
                                    {{ $update ? __('nav.update') : __('nav.addNew') }} </a></span></h6>
                    </div>
                </div>
                <div class="row mt-4">
                    <div class="col-sm-12 col-md-12 col-l-12 col-xl-12">
                        @include('layout.back-button')
                        <div class="card p-1">
                            <form
                                action="{{ $update ? route('expense.service.update', $item->id) : route('expense.service.store') }}"
                                method="post" enctype="multipart/form-data" autocomplete="off" class="ui form">
                                @if ($update)
                                    @method('PUT')
                                @endif
                                @csrf
                                <div class="card-body">
                                    <div class="row">
                                        {{-- <div class="col-sm-12 col-md-4 ">
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
                                        </div> --}}
                                        <div class="col-sm-12 col-md-7">
                                            <p class="fw-bold text-center text-primary fs-6">
                                                {{ __('nav.serviceFeeForm') }}
                                            </p>

                                            <input type="hidden" class="d-none" value="{{ $update ? $queryString : '' }}" name="query_string">

                                            <div class="field">
                                                <label for="date"> {{ __('nav.date') }} <span
                                                        class="text-danger">*</span></label>
                                                <div class="ui input icon">
                                                    <input type="text" class="form-control" id="date" name="date"
                                                        placeholder="{{ __('nav.ddmmyy') }}"
                                                        value="{{ $update ? Carbon\Carbon::parse($item->date)->format('m/d/Y') : old('date') }}">
                                                    <i class="calendar icon"></i>
                                                </div>
                                            </div>

                                            <div class="field">
                                                <label for="price"> {{ __('nav.price') }} <span
                                                        class="text-danger">*</span></label>
                                                <div class="ui labeled input">
                                                    <label for="price" class="ui label">$</label>
                                                    <input type="number" class="form-control" id="price" name="price"
                                                        placeholder="{{ __('nav.price') }}" step="0.001" min="1"
                                                        value="{{ $update ? $item->price : old('price') }}">
                                                </div>
                                            </div>

                                            <div class="field">
                                                <label for="attachment">{{ __('nav.uploadAtt') }} <span
                                                        class="text-danger">*</span></label>
                                                <input type="file" name="attachment" id="attachment" accept="image/*">
                                            </div>

                                            <div class="field">
                                                <label for="note"> {{ __('nav.noted') }}
                                                    <span class="text-danger">*</span></label>
                                                <textarea name="note" id="note" cols="30" rows="5" class="form-control"
                                                    placeholder="{{ __('nav.noted') }}...">{{ $update ? $item->note : old('note') }}</textarea>
                                            </div>

                                            <div class="field text-end">
                                                @if ($update || session('success'))
                                                    <a href="{{ route('expense.service.index') }}" class="ui button small">
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
                                        <div class="col-md-12 text-center mt-3">
                                            <img class="border border-light" src="{{ $update ? asset($item->attachment) : '' }}" id="image-preview"
                                                alt="" width="100%">
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
    {{-- <script>
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
    </script> --}}
    <script>
        $(document).ready(function() {
            $('#attachment').on('change', function(event) {
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

                    date: {
                        identifier: 'date',
                        rules: [{
                            type: 'empty',
                            prompt: 'Please enter your name'
                        }]
                    },

                    @if (!$update)
                        attachment: {
                            identifier: 'attachment',
                            rules: [{
                                type: 'empty',
                                prompt: 'Please enter your name'
                            }]
                        },
                    @endif

                    note: {
                        identifier: 'note',
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
    </script>
@endsection
