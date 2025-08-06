@extends('layout/master')
@hasSection('link')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.18/css/bootstrap-select.min.css" integrity="sha512-ARJR74swou2y0Q2V9k0GbzQ/5vJ2RBSoCWokg4zkfM29Fb3vZEQyv0iWBMW/yvKgyHSR/7D64pFMmU8nYmbRkg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
@endif
@section('title')
<title> {{__('nav.editGiveProduct')}} | IMS</title>
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
        display: none; /* Hide the image initially */
        display: block;
        /* width: 100%; */
        height: 100%;
        position: absolute;
    }
    .attchLabel{
        width: 100%;
        /* padding: 15px 20px; */
        text-align: center;
        cursor: pointer;
        border: 2px dashed gray;
        padding: 10px;
        border-radius: 5px;
        background: #e6e6e6e0;
    }
    .attch{
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
                    <h3 class="font-weight-bold">{{__('nav.editGiveProduct')}}</h3>
                    <h6 class="font-weight-normal mb-0">{{__('nav.product')}}
                            / {{__('nav.givenAndReturned')}}
                            / <span class="text-primary">
                                <a class="text-primary" href="">{{__('nav.editGiveProduct')}} </a></span>
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
                                        <span class="mdi mdi-cube-send text-primary"></span> {{__('nav.giveForm')}}
                                    </h3>
                                    <div class="bg-white p-3">
                                        <form action="{{route('product.doEditGiven', ['id'=>$give_data->id])}}" method="post" enctype="multipart/form-data" autocomplete="off" class="ui form">
                                            @csrf
                                            {{-- <input type="hidden" class="d-none" name="product_id" value="{{$item->id}}"> --}}
                                            <div class="two fields">
                                                <div class="field">
                                                    <label for="userGiven">{{__('nav.giveTo')}} <span class="text-danger">*</span></label>
                                                    <select name="userAccount" id="userAccount" class="ui search dropdown dropdown1 d-block w-100">
                                                        <option value="">{{ __('nav.selectStaff') }}</option>
                                                        @php
                                                            $no = 1;
                                                        @endphp
                                                        @foreach ($users as $user)
                                                            <option {{ ($user->id == $give_data->staff_id) ? 'selected' : '' }}  value="{{$user->id}}">
                                                                <span class="text-danger">{{ $user->card_id ?? __('nav.newStaff') }}</span>
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
                                                            value="{{ Carbon\Carbon::parse($give_data->date)->format('m/d/Y') }}">
                                                        <i class="calendar icon"></i>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="two fields">
                                                <div class="field">
                                                    <label for="equipment">{{ __('nav.equipment') }}</label>
                                                    @php
                                                        $checkArray = strpos($give_data->product_id, ',') !== false;
                                                        $selectedProducts = $checkArray ? explode(',', $give_data->product_id) : [$give_data->product_id];
                                                    @endphp
                                                    <select name="products[]" disabled id="equipment" multiple class="ui search dropdown d-block w-100">

                                                        @foreach ($products_equipment as $product)
                                                            <option value="{{ $product->proId }}"
                                                                @if ($checkArray)
                                                                    {{ in_array($product->proId, $selectedProducts) ? 'selected' : '' }}
                                                                @else
                                                                    {{ $product->proId == $selectedProducts[0] ? 'selected' : '' }}
                                                                @endif
                                                            >
                                                                <img src="{{ $product->pro_img ? asset($product->pro_img) : asset('images/draft-image.png')  }}" alt="img">
                                                                {{-- {{ $product->id }}  {{ $product->item_name_en . '  ' . $product->model }} x <span>{{ $product->qty }}</span> --}}
                                                                {{ $product->item_name_en . '  ' . $product->model }}
                                                                    - <span class="text-primary">SN : {{ $product->serial_number != '' ? $product->serial_number : 'N/A' }}</span>
                                                                    <span>[x{{ $product->qty }}]</span>
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>

                                                <div class="field">
                                                    <label for="accessories">{{ __('nav.accessories') }}</label>
                                                    @php
                                                        $checkArray = strpos($give_data->product_id, ',') !== false;
                                                        $selectedProducts = $checkArray ? explode(',', $give_data->product_id) : [$give_data->product_id];
                                                    @endphp
                                                    <select name="products[]" disabled id="accessories" multiple class="ui search dropdown d-block w-100">
                                                        @foreach ($products_accessories as $product)
                                                            <option value="{{ $product->proId }}"
                                                                @if ($checkArray)
                                                                    {{ in_array($product->proId, $selectedProducts) ? 'selected' : '' }}
                                                                @else
                                                                    {{ $product->proId == $selectedProducts[0] ? 'selected' : '' }}
                                                                @endif
                                                            >
                                                                <img src="{{ $product->pro_img ? asset($product->pro_img) : asset('images/draft-image.png')  }}" alt="img">
                                                                {{ $product->item_name_en . '  ' . $product->model }}
                                                                    - <span class="text-primary">SN : {{ $product->serial_number != '' ? $product->serial_number : 'N/A' }}</span>
                                                                    <span>[x{{ $product->qty }}]</span>
                                                                {{-- {{ $product->id }}  {{ $product->pro_name_en . '  ' . $product->model }} x <span>{{ $product->qty }}</span> --}}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>


                                            <label for="attachment" class="d-block w-100"> {{__('nav.uploadAtt')}} <span class="text-danger">*</span></label>
                                            <input type="file" name="attachment" id="attachment" style="display: none;" class="d-none attachment" accept="image/*">
                                            <label for="attachment" class="attchLabel">
                                                <div class="attch">
                                                    <img src="{{ asset($give_data->attachment) }}" alt="" class="attachmentFile1" id="file-attach" width="100%">
                                                    <span class="mdi mdi-image-plus text-secondary fs-1 d-none" id="draft-img"></span>
                                                    {{-- <img src="{{asset('images/draft-image.png')}}" alt="" id="draft-img" class="icon"> --}}
                                                </div>
                                            </label>

                                            <input type="hidden" class="d-none" name="old_att" value="{{ $give_data->attachment }}">

                                            <small class="text-danger"> {{__('nav.requiredField')}} </small>
                                            <button type="submit" class="ui button green text-end d-block ms-auto mt-2">
                                            <span class="mdi mdi-content-save-check icon"></span> {{__('nav.update')}}</button>
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
                draftImg.style.display= 'none';
            };
            reader.readAsDataURL(file);
        }
    });

    $(document).ready(function(){
        $('#givenAndReturned').addClass('nav-item active');
        $('#error').addClass('collapse show');
    });
</script>
@endsection
