@extends('layout/master')

@section('title')
    <title>{{ __('nav.changePassword') }} | IMS</title>
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

        .img img {
            width: 20%;
        }

        .attachment {
            width: 100%;
        }

        #previewImg {
            display: none;
        }
    </style>
@endsection


@section('content')
    <div class="content-wrapper">
        <div class="row">
            <div class="col-md-12 grid-margin">
                <div class="row">
                    <div class="col-12 col-xl-8 mb-4 mb-xl-0">
                        <h3 class="font-weight-bold">{{ __('nav.changePassword') }}</h3>
                        <h6 class="font-weight-normal mb-0">{{ __('nav.account') }} / <span class="text-primary"><a
                                    class="text-primary" href="">{{ __('nav.changePassword') }}</a></span></h6>
                    </div>
                </div>
                <div class="row mt-4">
                    <div class="col-sm-12 col-md-12 col-l-12 col-xl-12">
                        @include('layout.back-button')
                        <div class="">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="row">
                                            <div class="col-sm-12 col-md-6 col-lg-6">
                                                <div class="bg-form p-3">
                                                    <form action="{{ route('account.save') }}" method="post"
                                                        autocomplete="off" class="ui form">
                                                        @csrf
                                                        <div class="field">
                                                            <label for="currentPass">{{ __('nav.currentPass') }} <span
                                                                    class="text-danger">*</span></label>
                                                            <input type="password" id="currentPass" name="password"
                                                                autofocus placeholder="{{ __('nav.currentPass') }}">
                                                        </div>

                                                        <div class="field">
                                                            <label for="newPass">{{ __('nav.newPassword') }} <span
                                                                    class="text-danger">*</span></label>
                                                            <input type="password" id="newPass" name="newPass"
                                                                placeholder="{{ __('nav.newPassword') }}">
                                                        </div>

                                                        <div class="field">
                                                            <label for="confimrNewPass">{{ __('nav.confirmNewPass') }} <span
                                                                    class="text-danger">*</span></label>
                                                            <input type="password" id="confimrNewPass" name="confimrNewPass"
                                                                placeholder="{{ __('nav.confirmNewPass') }}">
                                                        </div>
                                                        <div class="ui error message"></div>
                                                        <button type="submit" style="width: fit-content;"
                                                            class="ms-auto d-block ui button tiny blue">
                                                            <span class="mdi mdi-lock-check-outline icon"></span>
                                                            {{ __('nav.change') }}</button>
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
        </div>
    </div>
@endsection


@section('js')
    <script>
        $('.ui.form')
            .form({
                fields: {
                    password: {
                        identifier: 'password',
                        rules: [{
                            type: 'empty',
                            prompt: "{{ __('nav.enterCurrentPass') }}"
                        }]
                    },
                    newPass: {
                        identifier: 'newPass',
                        rules: [{
                            type: 'minLength[4]',
                            prompt: "{{ __('nav.enterNewPass') }}"
                        }]
                    },
                    confimrNewPass: {
                        identifier: 'confimrNewPass',
                        rules: [{
                            type: 'match[newPass]',
                            prompt: "{{ __('nav.enterConfirmPass') }}"
                        }]
                    }
                }
            });
    </script>
@endsection
