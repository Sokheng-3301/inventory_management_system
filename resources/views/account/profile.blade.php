@extends('layout/master')

@section('title')
    <title>{{ __('nav.profile') }} | IMS</title>
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
                        <h3 class="font-weight-bold">{{ __('nav.profile') }}</h3>
                        <h6 class="font-weight-normal mb-0">{{ __('nav.account') }} / <span class="text-primary"><a
                                    class="text-primary" href="">{{ __('nav.profile') }}</a></span></h6>
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
                                                        <a type="button" data-bs-toggle="modal"
                                                            data-bs-target="#staticBackdrop"
                                                            class="badge badge-light d-inline-block"><span
                                                                class="mdi mdi-pencil-outline fs-6"></span>
                                                            {{ __('nav.changProfile') }}</a>
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
                                                                {{-- <div class="col-1">
                                                                :
                                                            </div> --}}
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
                                                                {{-- <div class="col-1">
                                                                :
                                                            </div> --}}
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
                                                                {{-- <div class="col-1">
                                                                :
                                                            </div> --}}
                                                                <div class="col-7">
                                                                    {{ $profile->phone_number }}
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <p class="mt-4 text-center">
                                                    <a href="{{ route('account.change-password') }}">
                                                        <span class="mdi mdi-lock-open-outline"></span>
                                                        {{ __('nav.changePassword') }}</a>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <!-- Modal -->
                        <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false"
                            tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <form action="{{ route('account.change') }}" method="post" autocomplete="off"
                                        enctype="multipart/form-data">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="staticBackdropLabel">
                                                {{ __('nav.changProfile') }}</h1>

                                        </div>
                                        <div class="modal-body">
                                            @csrf
                                            <label for="pro_img" class="pro_img">
                                                <span class="mdi mdi-image-plus" id="icon"></span>
                                                <img src="" alt="" id="previewImg">
                                            </label>
                                            <input type="file" class="d-none" style="display: none;" id="pro_img"
                                                name="pro_img" accept="image/*">
                                            <input type="hidden" class="d-none" style="display: none;" name="oldImg"
                                                value="{{ $profile->profile }}">
                                        </div>
                                        <div class="modal-footer">
                                            {{-- <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Close</button> --}}
                                            <button type="button" data-bs-dismiss="modal" class="ui button tiny"><i
                                                    class="x icon"></i> {{ __('nav.cancel') }}</button>
                                            <button type="submit" class="ui button tiny blue"><i class="check icon"></i>
                                                {{ __('nav.save') }}</button>
                                        </div>
                                    </form>
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
        document.getElementById('pro_img').addEventListener('change', function(event) {
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const preview = document.getElementById('previewImg');
                    const icon = document.getElementById('icon');
                    preview.src = e.target.result;
                    preview.style.display = 'block'; // Show the image
                    icon.style.display = 'none';
                };
                reader.readAsDataURL(file);
            }
        });
    </script>
@endsection
