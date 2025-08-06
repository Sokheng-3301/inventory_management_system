@extends('layout/master')

@section('title')
    <title>{{ __('nav.aboutUser') }} | IMS</title>
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
                        <h3 class="font-weight-bold">{{ __('nav.aboutUser') }}</h3>
                        <h6 class="font-weight-normal mb-0">{{ __('nav.manageUser') }} / <span class="text-primary"><a
                                    class="text-primary" href="">{{ __('nav.aboutUser') }}</a></span></h6>
                    </div>
                    {{-- <div class="col-12 col-xl-4">
                    <div class="justify-content-end d-flex">
                        <div class="dropdown flex-md-grow-1 flex-xl-grow-0">
                            <button class="btn btn-sm btn-light bg-white dropdown-toggle" type="button"
                                id="dropdownMenuDate2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                <i class="mdi mdi-calendar"></i> Today (10 Jan 2021)
                            </button>
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuDate2">
                                <a class="dropdown-item" href="#">January - March</a>
                                <a class="dropdown-item" href="#">March - June</a>
                                <a class="dropdown-item" href="#">June - August</a>
                                <a class="dropdown-item" href="#">August - November</a>
                            </div>
                        </div>
                    </div>
                </div> --}}
                </div>
                <div class="row mt-4">
                    <div class="col-sm-12 col-md-12 col-l-12 col-xl-12">
                        @include('layout.back-button')
                        <div class="">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="row">
                                            <div class="col-sm-12 col-md-8 col-lg-8 profile-contain">
                                                <div class="profile-circle">
                                                    @if ($profile->profile != '')
                                                        <img src="{{ asset($profile->profile) }}" alt="user profile">
                                                    @else
                                                        <img src="{{ asset('images/draft-user.jpg') }}" alt="user profile">
                                                    @endif
                                                </div>
                                                <div class="row mt-2">
                                                    <div class="col-12 text-center">
                                                        {{-- <a type="button" data-bs-toggle="modal"
                                                            data-bs-target="#staticBackdrop"
                                                            class="badge badge-light d-inline-block"><span
                                                                class="mdi mdi-pencil-outline fs-6"></span>
                                                            {{ __('nav.changProfile') }}</a> --}}
                                                        <h4 class="mt-3 mb-0 text-uppercase">
                                                            {{ $profile->gender == 'Male' ? __('nav.Mr') : __('nav.Miss') }}
                                                            {{ $profile->name_kh }} - {{ $profile->name_en }}
                                                        </h4>
                                                        <p class="my-2 p-0">{{ $profile->email_address }}</p>
                                                        <p> {{ __('nav.gender') }} :
                                                            {{ $profile->gender == 'Male' ? __('nav.male') : __('nav.female') }}
                                                        </p>
                                                        <div class="ui label blue tiny">
                                                            <i class="user icon"></i> {{ $profile->role_name }}
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row mt-4">
                                                    <div class="col-12 col-md-10 col-lg-10  m-auto">
                                                        <div class="bg-light py-1 p-3">
                                                            <div class="row mb-2">
                                                                <div class="col-5">
                                                                    <span class="mdi mdi-badge-account-outline"></span>
                                                                    <b>{{ __('nav.staffId') }}</b>
                                                                </div>
                                                                {{-- <div class="col-1">
                                                                :
                                                            </div> --}}
                                                                <div class="col-7">
                                                                    {{ $profile->card_id }}
                                                                </div>
                                                            </div>
                                                            <div class="row mb-2">
                                                                <div class="col-5">
                                                                    <span class="mdi mdi-account-network-outline"></span>
                                                                    <b>{{ __('nav.position') }}</b>
                                                                </div>
                                                                {{-- <div class="col-1">
                                                                :
                                                            </div> --}}
                                                                <div class="col-7">
                                                                    {{ $profile->position_name }}
                                                                </div>
                                                            </div>
                                                            <div class="row mb-2">
                                                                <div class="col-5">
                                                                    <span class="mdi mdi-briefcase-account-outline"></span>
                                                                    <b>{{ __('nav.section') }}</b>
                                                                </div>

                                                                <div class="col-7">
                                                                    @if (session('localization') == 'en')
                                                                        {{ $profile->section_en }}
                                                                    @else
                                                                        {{ $profile->section_kh }}
                                                                    @endif
                                                                </div>
                                                            </div>
                                                            <div class="row mb-2">
                                                                <div class="col-5">
                                                                    <span class="mdi mdi-sitemap-outline"></span>
                                                                    <b>{{ __('nav.department') }}</b>
                                                                </div>

                                                                <div class="col-7">
                                                                    @if (session('localization') == 'en')
                                                                        {{ $profile->dep_name_en }}
                                                                    @else
                                                                        {{ $profile->dep_name_kh }}
                                                                    @endif
                                                                </div>
                                                            </div>
                                                            <div class="row mb-2">
                                                                <div class="col-5">
                                                                    <span class="mdi mdi-phone"></span>
                                                                    <b>{{ __('nav.phoneNumber') }}</b>
                                                                </div>
                                                                <div class="col-7">
                                                                    {{ $profile->phone_number }}
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
                </div>
            </div>
        </div>
    </div>
@endsection


@section('js')
    <script>
        $(document).ready(function() {
            $('#users').addClass('nav-item active');
            $('#tables').addClass('collapse show');
        });
    </script>
@endsection
