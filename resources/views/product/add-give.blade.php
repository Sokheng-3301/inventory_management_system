@extends('layout/master')
@hasSection('link')
@endif
@section('title')
    <title> {{ __('nav.addNewGive') }} | IMS</title>
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
                        <h3 class="font-weight-bold">{{ __('nav.addNewGive') }}</h3>
                        <h6 class="font-weight-normal mb-0">{{ __('nav.product') }} / {{ __('nav.givenAndReturned') }} /
                            <span class="text-primary"><a class="text-primary"
                                    href="{{ route('product.addGive') }}">{{ __('nav.addNewGive') }} </a>
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
                                            <span class="mdi mdi-cube-send text-primary"></span> {{ __('nav.giveForm') }}
                                        </h3>
                                        <div class="bg-white p-3">
                                            <form action="{{ route('product.given') }}" method="post"
                                                enctype="multipart/form-data" autocomplete="off" class="ui form">
                                                @csrf
                                                {{-- <input type="hidden" class="d-none" name="product_id" value="{{$item->id}}"> --}}
                                                <div class="two fields">
                                                    <div class="field">
                                                        <label for="userGiven">{{ __('nav.giveTo') }} <span
                                                                class="text-danger">*</span></label>

                                                        <select name="userAccount" id="userAccount"
                                                            class="ui search dropdown dropdown1 d-block w-100">
                                                            <option value="">{{ __('nav.selectStaff') }}</option>
                                                            @php
                                                                $no = 1;
                                                            @endphp
                                                            @foreach ($users as $user)
                                                                <option
                                                                    {{ old('userAccount') == $user->id ? 'selected' : '' }}
                                                                    value="{{ $user->id }}">
                                                                    <span
                                                                        class="text-danger">{{ $user->card_id ?? __('nav.newStaff') }}</span>

                                                                    {{ ' - ' . $user->name_kh . '  ( ' . strtoupper($user->name_en) . ' )' }}

                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="field">
                                                        <label for="giveDate"> {{ __('nav.date') }} <span
                                                                class="text-danger">*</span></label>
                                                        <div class="ui input icon">
                                                            <input type="text" name="giveDate" id="giveDate"
                                                                placeholder="{{ __('nav.ddmmyy') }}"
                                                                value="{{ old('giveDate') }}">
                                                            <i class="calendar icon"></i>
                                                        </div>
                                                    </div>
                                                </div>


                                                <div class="two fields">
                                                    <div class="field">
                                                        <label for="product">{{ __('nav.equipment') }}</label>
                                                        <select name="products[]" id="product" multiple
                                                            class="ui search dropdown1 d-block w-100">
                                                            <option value="">{{ __('nav.selectEquipment') }}</option>
                                                            @php
                                                                $no = 1;
                                                            @endphp
                                                            @foreach ($products_equipment as $product)
                                                                <option value="{{ $product->proId }}"> <img
                                                                        src="{{ asset($product->pro_img != '' ? $product->pro_img : 'images/draft-image.png') }}"
                                                                        alt="">
                                                                    {{ $product->item_name_en . '  ' . $product->model }}
                                                                    - <span class="text-primary">SN :
                                                                        {{ $product->serial_number != '' ? $product->serial_number : 'N/A' }}</span> <span>[x{{ $product->qty }}]</span>
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>

                                                    <div class="field">
                                                        <label for="product">{{ __('nav.accessories') }}</label>
                                                        <select name="products[]" id="product" multiple
                                                            class="ui search dropdown2 d-block w-100">
                                                            <option value="">{{ __('nav.selectAccessories') }}
                                                            </option>
                                                            @php
                                                                $no = 1;
                                                            @endphp
                                                            @foreach ($products_accessories as $product)
                                                                <option value="{{ $product->proId }}"> <img
                                                                        src="{{ asset($product->pro_img != '' ? $product->pro_img : 'images/draft-image.png') }}"
                                                                        alt="">
                                                                    {{ $product->item_name_en . '  ' . $product->model }}
                                                                    {{-- <span class="text-danger"> x {{ $product->qty }}</span> --}}
                                                                    - <span class="text-primary">SN :
                                                                        {{ $product->serial_number != '' ? $product->serial_number : 'N/A' }}</span> <span>[x{{ $product->qty }}]</span>
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>

                                                </div>


                                                <div class="field">
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
