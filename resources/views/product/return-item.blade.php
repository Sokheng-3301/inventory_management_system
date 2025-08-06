@extends('layout/master')
@hasSection('link')
@endif
@section('title')
    <title> {{ __('nav.returnItem') }} | IMS</title>
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
        }
    </style>
@endsection

@section('content')
    <div class="content-wrapper">
        <div class="row">
            <div class="col-md-12 grid-margin">
                <div class="row">
                    <div class="col-12 mb-4 mb-xl-0">
                        <h3 class="font-weight-bold">{{ __('nav.returnItem') }}</h3>
                        <h6 class="font-weight-normal mb-0">{{ __('nav.givenAndReturned') }} /
                            <span class="text-primary"><a class="text-primary" href="{{ route('product.addGive') }}">{{ __('nav.returnItem') }} </a>
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
                                            {{ __('nav.returnForm') }}
                                        </h3>

                                        <div class="bg-white p-3">
                                            <form action="{{ route('product.doReturn') }}" method="post"
                                                enctype="multipart/form-data" autocomplete="off" class="ui form">
                                                @csrf
                                                <div class="field mt-4">
                                                    <label for="attachment" class="d-block w-100">
                                                        {{ __('nav.userReturnInfo') }}
                                                        <span class="text-danger">*</span></label>
                                                    <div class="row bg-light rounded-3 py-2">
                                                        <div class="col-md-6">
                                                            <div class="row">
                                                                <div class="col-4 col-sm-3 col-md-4">
                                                                    {{ __('nav.staffId') }}</div>
                                                                <div class="col-1">:</div>
                                                                <div class="col-6 col-sm-8 col-md-7">
                                                                    {{ $product->card_id ?? __('nav.newStaff') }}</div>

                                                                <div class="col-4 col-sm-3 col-md-4 mt-2">
                                                                    {{ __('nav.fullNameKh') }}</div>
                                                                <div class="col-1 mt-2">:</div>
                                                                <div class="col-6 col-sm-8 col-md-7 mt-2">
                                                                    {{ session('localization') == 'kh' ? $product->name_kh  : ($product->name_kh == '' ? strtoupper($product->name_en) : strtoupper($product->name_en)) }}
                                                                </div>

                                                                <div class="col-4 col-sm-3 col-md-4 mt-2">
                                                                    {{ __('nav.gender') }}</div>
                                                                <div class="col-1 mt-2">:</div>
                                                                <div class="col-6 col-sm-8 col-md-7 mt-2">
                                                                    {{ __('nav.' . strtolower($product->gender)) }}</div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="row">
                                                                <div class="col-4 col-sm-3 col-md-4">
                                                                    {{ __('nav.department') }}</div>
                                                                <div class="col-1">:</div>
                                                                <div class="col-6 col-sm-8 col-md-7">
                                                                    {{ session('localization') == 'kh' ? $product->dep_name_kh : $product->dep_name_en }}</div>

                                                                <div class="col-4 col-sm-3 col-md-4 mt-2">
                                                                    {{ __('nav.section') }}</div>
                                                                <div class="col-1 mt-2">:</div>
                                                                <div class="col-6 col-sm-8 col-md-7 mt-2">
                                                                    {{ session('localization') == 'kh' ? $product->section_kh : $product->section_en }}
                                                                </div>

                                                                <div class="col-4 col-sm-3 col-md-4 mt-2">
                                                                    {{ __('nav.position') }}</div>
                                                                <div class="col-1 mt-2">:</div>
                                                                <div class="col-6 col-sm-8 col-md-7 mt-2">
                                                                    {{ ucfirst($product->position_name) }}</div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="table-responsive border-1">
                                                    <table class="display table table-striped">
                                                        <thead>
                                                            <tr>
                                                                <th>Checks <span class="text-danger">*</span></th>
                                                                <th>{{ __('home.no') }}</th>
                                                                <th>{{ __('nav.img') }}</th>
                                                                <th>{{ __('nav.proCode') }}</th>
                                                                <th>{{ __('nav.proName') }}</th>
                                                                <th>{{ __('home.qty') }}</th>
                                                                <th>{{ __('nav.model') }}</th>
                                                                <th>{{ __('nav.serial_number') }}</th>
                                                                <th>{{ __('nav.fix_asset_code') }}</th>
                                                                <th>{{ __('nav.category') }}</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody id="product_return_list">
                                                            @foreach ($item_infos as $key => $item)
                                                                <tr>
                                                                    <td>
                                                                        <div class="ui checkbox">
                                                                            <input type="hidden" class="d-none"
                                                                                name="givenId"
                                                                                value="{{ $product->giveId }}">
                                                                            <input type="hidden" class="d-none"
                                                                                name="test" value="{{ $item->proId }}">
                                                                            <input type="checkbox" tabindex="0"
                                                                                class="hidden"
                                                                                id="check{{ $item->proId }}"
                                                                                name="returnProId[]"
                                                                                value="{{ $item->proId }}">
                                                                            <label for="check{{ $item->proId }}"></label>
                                                                        </div>
                                                                    </td>
                                                                    <td>{{ $key + 1 }}</td>
                                                                    <td><img src="{{ $item->pro_img ? asset($item->pro_img) : asset('images/draft-image.png') }}"
                                                                            alt=""></td>
                                                                    <td>{{ $item->item_code }}</td>
                                                                    <td>{{ session('localization') == 'kh' ? $item->item_name_kh : $item->item_name_en }}
                                                                    </td>
                                                                    <td>1</td>
                                                                    <td>{{ $item->model }}</td>
                                                                    <td>{{ $item->serial_number }}</td>
                                                                    <td>{{ $item->fix_asset_code }}</td>
                                                                    <td>{{ $item->cat_name }}</td>
                                                                </tr>
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>

                                                <div class="field mt-4">
                                                    <label for="attachment" class="d-block w-100">
                                                        {{ __('nav.uploadAtt') }}
                                                        <span class="text-danger">*</span></label>
                                                    <input type="file" name="attachment" id="attachment"
                                                        style="display: none;" class="d-none attachment" accept="image/*">
                                                    <label for="attachment" class="attchLabel">
                                                        <div class="attch">
                                                            <img src="" alt="" class="attachmentFile"
                                                                id="file-attach" width="100%">
                                                            <span class="mdi mdi-image-plus text-secondary fs-1"
                                                                id="draft-img"></span>
                                                            {{-- <img src="{{asset('images/draft-image.png')}}" alt="" id="draft-img" class="icon"> --}}
                                                        </div>
                                                    </label>
                                                </div>
                                                <small class="text-danger"> {{ __('nav.requiredField') }} </small>
                                                <button type="submit"
                                                    class="ui button primary text-end d-block ms-auto mt-2">
                                                    <span class="mdi mdi-content-save-check icon"></span>
                                                    {{ __('nav.submit') }}</button>
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
        });
    </script>
@endsection
