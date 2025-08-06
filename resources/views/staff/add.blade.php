@extends('layout/master')
@hasSection('link')
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.18/css/bootstrap-select.min.css"
        integrity="sha512-ARJR74swou2y0Q2V9k0GbzQ/5vJ2RBSoCWokg4zkfM29Fb3vZEQyv0iWBMW/yvKgyHSR/7D64pFMmU8nYmbRkg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
@endif
@section('title')
    <title> {{ __('nav.addUser') }} | IMS</title>
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

        #roleName {
            cursor: no-drop;
            user-select: none;
        }
    </style>
@endsection


@section('content')
    <div class="content-wrapper">
        <div class="row">
            <div class="col-md-12 grid-margin">
                <div class="row">
                    <div class="col-12 col-xl-8 mb-4 mb-xl-0">
                        <h3 class="font-weight-bold"> {{ $update ? __('nav.update') : __('nav.addNew') }}</h3>
                        <h6 class="font-weight-normal mb-0"> {{ __('nav.master') }} / <span class="text-primary"><a
                                    class="text-primary" href=""> {{ $update ? __('nav.updateStaff') : __('nav.addNewStaff') }}</a> </span></h6>
                    </div>
                </div>
                <div class="row mt-4">
                    <div class="col-sm-12 col-md-12 col-l-12 col-xl-12">
                        @include('layout.back-button')
                        <div class="card p-1">
                            <form action="{{ $update ? route('staff.update', $item->id) : route('staff.store') }}"
                                method="post" enctype="multipart/form-data" class="ui form" autocomplete="off">
                                @if ($update)
                                    @method('PUT')
                                @endif
                                @csrf

                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-sm-12 col-md-4 ">
                                            <div class="bg-light p-3">
                                                <p class="fw-bold text-center text-primary"> {{ __('home.userProfile') }}
                                                </p>
                                                <label for="productImg" id="proImg">
                                                    <span class="mdi mdi-image-plus"></span>
                                                    <div class="bgCamera">

                                                    </div>
                                                    <img src="{{ $update ? asset($item->profile) : '' }}" id="file-input"
                                                        alt="">
                                                </label>
                                                <input type="file" class="d-none" name="proImage" style="display: none;"
                                                    id="productImg" accept="image/*">
                                            </div>
                                        </div>
                                        <div class="col-sm-12 col-md-8">
                                            <div class="bg-light p-3">
                                                <p class="fw-bold text-center text-primary"> {{ __('nav.staffInfo') }} </p>
                                                <div class="row d-flex align-items-center mt-3">
                                                    <div class="col-sm-12 col-md-3 col-l-3">
                                                        <label for="cardId"> {{ __('nav.staffId') }} <span
                                                                class="text-danger"></span></label>
                                                    </div>
                                                    <div class="col-sm-12 col-md-9 col-l-9">
                                                        <div class="field">
                                                            <input type="text" class="form-control" id="cardId" autofocus
                                                            name="cardId" placeholder="{{ __('nav.staffId') }}"
                                                            value="{{ $update ? $item->card_id : old('cardId') }}">
                                                        </div>
                                                        @error('cardId')
                                                            <small
                                                                class="error-message text-danger">{{ $message }}</small>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <div class="row d-flex align-items-center mt-3">
                                                    <div class="col-sm-12 col-md-3 col-l-3">
                                                        <label for="name_kh"> {{ __('nav.fullNameKh') }} <span
                                                                class="text-danger">*</span></label>
                                                    </div>
                                                    <div class="col-sm-12 col-md-9 col-l-9">
                                                        <div class="field">
                                                            <input type="text" class="form-control" id="name_kh"
                                                                value="{{ $update ? $item->name_kh : old('name_kh') }}"
                                                                name="name_kh" placeholder="{{ __('nav.fullNameKh') }}">
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row d-flex align-items-center mt-3">
                                                    <div class="col-sm-12 col-md-3 col-l-3">
                                                        <label for="name_en">{{ __('nav.fullNameEn') }} <span
                                                                class="text-danger">*</span></label>
                                                    </div>
                                                    <div class="col-sm-12 col-md-9 col-l-9">
                                                        <div class="field">
                                                            <input type="text" class="form-control" id="name_en"
                                                                value="{{ $update ? $item->name_en : old('name_en') }}"
                                                                name="name_en" placeholder="{{ __('nav.fullNameEn') }}">
                                                        </div>
                                                    </div>
                                                </div>



                                                <div class="row d-flex align-items-center mt-3">
                                                    <div class="col-sm-12 col-md-3 col-l-3">
                                                        <label for="gender"> {{ __('nav.gender') }}<span
                                                                class="text-danger"> *</span></label>
                                                    </div>
                                                    <div class="col-sm-12 col-md-9 col-l-9">
                                                        {{-- <input type="text" class="form-control" id="proNameEn" name="proNameEn" placeholder="Product name EN"> --}}
                                                        <div class="field">
                                                            <select name="gender" id="gender"
                                                                class="ui search dropdown d-block w-100">
                                                                <option value="">{{ __('nav.seelctGender') }}
                                                                </option>
                                                                <option value="Female"
                                                                    @if ($update) {{ $item->gender == 'Female' ? 'selected' : '' }}
                                                                    @else
                                                                        {{ old('gender') == 'Female' ? 'selected' : '' }} @endif>
                                                                    {{ __('nav.female') }}</option>
                                                                <option value="Male"
                                                                    @if ($update) {{ $item->gender == 'Male' ? 'selected' : '' }}
                                                                    @else
                                                                        {{ old('gender') == 'Male' ? 'selected' : '' }} @endif>
                                                                    {{ __('nav.male') }}</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>


                                                <div class="row d-flex align-items-center mt-3">
                                                    <div class="col-sm-12 col-md-3 col-l-3">
                                                        <label for="position"> {{ __('nav.position') }} <span
                                                                class="text-danger">*</span></label>
                                                    </div>
                                                    <div class="col-sm-12 col-md-9 col-l-9">
                                                        <div class="field">
                                                            <select name="position" id="position"
                                                                class="ui search dropdown1 d-block w-100">
                                                                <option value="">{{ __('nav.selectPosition') }}
                                                                </option>
                                                                @foreach ($position as $c)
                                                                    <option value="{{ $c->post_id }}"
                                                                        @if ($update) {{ $item->position == $c->post_id ? 'selected' : '' }}
                                                                            @else
                                                                                {{ old('position') == $c->post_id ? 'selected' : '' }} @endif>
                                                                        {{ $c->position_name }}
                                                                        <span class="text-muted"> / Sect :
                                                                            {{ session('localization') == 'kh' ? $c->section_kh : $c->section_en }}</span>
                                                                        <span class="text-muted"> / Dept :
                                                                            {{ session('localization') == 'kh' ? $c->dep_name_kh : $c->dep_name_en }}</span>
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row d-flex align-items-center mt-3">
                                                    <div class="col-sm-12 col-md-3 col-l-3">
                                                        <label for="phoneNumber"> {{ __('nav.phoneNumber') }} <span
                                                                class="text-danger"></span></label>
                                                    </div>
                                                    <div class="col-sm-12 col-md-9 col-l-9">
                                                        <input type="tel" id="phoneNumber" class="form-control"
                                                            value="{{ $update ? $item->phone_number : old('phoneNumber') }}"
                                                            placeholder="{{ __('nav.phoneNumber') }}" name="phoneNumber">
                                                    </div>
                                                </div>

                                                {{-- <div class="row d-flex align-items-center mt-3">
                                                    <div class="col-sm-12 col-md-3 col-l-3">
                                                        <label for="emailAddress"> {{ __('nav.emailAddress') }} <span
                                                                class="text-danger"></span></label>
                                                    </div>
                                                    <div class="col-sm-12 col-md-9 col-l-9">
                                                        <input type="email" id="emailAddress" class="form-control"
                                                            value="{{ $update ? $item->email_address : old('email') }}"
                                                            placeholder="{{ __('nav.emailAddress') }}" name="email">
                                                    </div>
                                                </div> --}}

                                                <div class="row mt-4">
                                                    <div class="col-12 d-flex justify-content-end align-items-end">
                                                        @if(session('success') || $update)
                                                            <a href="{{ route('staff.index') }}" class="ui button small">
                                                                {{ __('nav.staffList') }} </a>
                                                        @endif

                                                        <button type="submit"
                                                            class="ui button {{ $update ? 'green' : 'primary' }} small"
                                                            style="width: fit-content;"><span
                                                                class="mdi {{ $update ? 'mdi-content-save-edit' : 'mdi-content-save-plus' }} icon"></span>
                                                            {{ $update ? __('nav.update') : __('nav.save') }}</button>
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
    <script type="text/javascript">
        $(document).ready(function() {
            $(document).on('change', '#productImg', function() {
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

            $('#master').addClass('nav-item active');
            $('#ui-basic').addClass('collapse show');
        });

        $('.ui.form')
            .form({
                fields: {
                    name_kh: {
                        identifier: 'name_kh',
                        rules: [{
                            type: 'empty',
                            prompt: 'Please enter your name'
                        }]
                    },
                    name_en: {
                        identifier: 'name_en',
                        rules: [{
                            type: 'empty',
                            prompt: 'Please enter your name'
                        }]
                    },
                    gender: {
                        identifier: 'gender',
                        rules: [{
                            type: 'empty',
                            prompt: 'Please enter your name'
                        }]
                    },

                    position: {
                        identifier: 'position',
                        rules: [{
                            type: 'empty',
                            prompt: 'Please enter your name'
                        }]
                    },
                }
            });
    </script>
@endsection
