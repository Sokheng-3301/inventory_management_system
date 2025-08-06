@extends('layout/master')
@hasSection('link')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.18/css/bootstrap-select.min.css" integrity="sha512-ARJR74swou2y0Q2V9k0GbzQ/5vJ2RBSoCWokg4zkfM29Fb3vZEQyv0iWBMW/yvKgyHSR/7D64pFMmU8nYmbRkg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
@endif
@section('title')
<title> {{__('nav.updateProduct')}} | IMS</title>
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

</style>
@endsection

@section('content')


<div class="content-wrapper">
    <div class="row">
        <div class="col-md-12 grid-margin">
            <div class="row">
                <div class="col-12 col-xl-8 mb-4 mb-xl-0">
                    <h3 class="font-weight-bold">{{__('nav.updateProduct')}}</h3>
                    <h6 class="font-weight-normal mb-0">{{__('nav.product')}} / <span class="text-primary"><a class="text-primary"
                                href="{{route('product.instock')}}">{{__('nav.proList')}} </a> / <a class="text-primary" href="">{{__('nav.updateProduct')}}</a></span></h6>
                </div>
            </div>

            <div class="row mt-4">
                <div class="col-sm-12 col-md-12 col-l-12 col-xl-12">
                    @include('layout.back-button')
                    <div class="card p-1">
                        <form action="{{url('product/edit/save')}}" method="post" enctype="multipart/form-data" class="ui form">
                            @csrf
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-sm-12 col-md-4 ">
                                        <div class="bg-light p-3">
                                            <p class="fw-bold text-center text-primary">{{__('nav.proImg')}}</p>
                                            <label for="productImg" id="proImg">
                                                <span class="mdi mdi-image-plus"></span>
                                                <div class="bgCamera">

                                                </div>

                                                    <img src="@if ($product -> pro_img != '')
                                                        {{asset($product->pro_img)}}
                                                        @endif"
                                                        @if ($product -> pro_img != '')
                                                            style = "d-block"
                                                        @endif
                                                        id="file-input" alt="">

                                            </label>
                                            <small class="text-center d-block">{{__('nav.uploadProImg')}}</small>
                                            <input type="file" class="d-none" name="proImage" style="display: none;" id="productImg" accept="image/*">
                                            <input type="hidden" class="d-none" name="oldImg" value="{{$product->pro_img}}">
                                            <input type="hidden" class="d-none" name="proId" value="{{$product->id}}">
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-8">
                                        <div class="bg-light p-3">
                                            <p class="fw-bold text-center text-primary">{{__('nav.proInfo')}}</p>
                                            <div class="row d-flex align-items-center">
                                                <div class="col-sm-12 col-md-3 col-l-3">
                                                    <label for="productCode">{{__('nav.proCode')}}</label>
                                                </div>
                                                <div class="col-sm-12 col-md-9 col-l-9">
                                                    <input type="text" id="productCode" class="form-control" name="proCode" placeholder="{{__('nav.proCode')}}" value="{{$product->pro_code}}">
                                                </div>
                                            </div>

                                            <div class="row d-flex align-items-center mt-3">
                                                <div class="col-sm-12 col-md-3 col-l-3">
                                                    <label for="proNameKh">{{__('nav.proNameKh')}} </label>
                                                </div>
                                                <div class="col-sm-12 col-md-9 col-l-9">
                                                    <input type="text" class="form-control" id="proNameKh" name="proNameKh" placeholder="{{__('nav.proNameKh')}}"  value="{{$product->pro_name_kh}}">
                                                </div>
                                            </div>
                                            <div class="row d-flex align-items-center mt-3">
                                                <div class="col-sm-12 col-md-3 col-l-3">
                                                    <label for="proNameEn">{{__('nav.proNameEn')}} <span class="text-danger">*</span></label>
                                                </div>
                                                <div class="col-sm-12 col-md-9 col-l-9">
                                                    <div class="field">
                                                        <input type="text" class="form-control" id="proNameEn" name="proNameEn" placeholder="{{__('nav.proNameEn')}}"  value="{{$product->pro_name_en}}">
                                                    </div>
                                                </div>
                                            </div>


                                            <div class="row d-flex align-items-center mt-3">
                                                <div class="col-sm-12 col-md-3 col-l-3">
                                                    <label for="model"> {{__('nav.model')}} </label>
                                                </div>
                                                <div class="col-sm-12 col-md-9 col-l-9">
                                                    <input type="text" class="form-control" id="model" name="model" placeholder=" {{__('nav.model')}} " value="{{$product->model}}">
                                                </div>
                                            </div>

                                            <div class="row d-flex align-items-center mt-3">
                                                <div class="col-sm-12 col-md-3 col-l-3">
                                                    <label for="serial_number"> {{__('nav.serial_number')}} </label>
                                                </div>
                                                <div class="col-sm-12 col-md-9 col-l-9">
                                                    <input type="text" class="form-control" id="serial_number" name="serial_number" placeholder=" {{__('nav.serial_number')}} " value="{{$product->serial_number}}">
                                                </div>
                                            </div>


                                            <div class="row d-flex align-items-center mt-3">
                                                <div class="col-sm-12 col-md-3 col-l-3">
                                                    <label for="fix_asset_code"> {{__('nav.fix_asset_code')}} </label>
                                                </div>
                                                <div class="col-sm-12 col-md-9 col-l-9">
                                                    <input type="text" class="form-control" id="fix_asset_code" name="fix_asset_code" placeholder=" {{__('nav.fix_asset_code')}} " value="{{$product->fix_asset_code}}">
                                                </div>
                                            </div>


                                            <div class="row d-flex align-items-center mt-3">
                                                <div class="col-sm-12 col-md-3 col-l-3">
                                                    <label for="">{{__('nav.category')}} <span class="text-danger">*</span></label>
                                                </div>
                                                <div class="col-sm-12 col-md-9 col-l-9">
                                                    <div class="field">
                                                        <select name="catId" id="category" class="ui search dropdown d-block w-100">
                                                            @php
                                                                $inc = 1;
                                                            @endphp
                                                            @foreach ($category as $c)
                                                                <option
                                                                    @if ($c->id == $product->cat_id)
                                                                        selected
                                                                    @endif
                                                                value="{{$c->id}}">{{$c->cat_name}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row d-flex align-items-center mt-3">
                                                <div class="col-sm-12 col-md-3 col-l-3">
                                                    <label for="qty">{{__('home.qty')}} <span class="text-danger">*</span></label>
                                                </div>
                                                <div class="col-sm-12 col-md-9 col-l-9">
                                                    <div class="field">
                                                        <input type="number" class="form-control" id="qty" name="qty" placeholder="{{__('home.qty')}}" min="0" value="{{$product->qty}}">
                                                    </div>
                                                </div>
                                            </div>

                                            {{-- <div class="row d-flex align-items-center mt-3">
                                                <div class="col-sm-12 col-md-3 col-l-3">
                                                    <label for="qty">{{__('home.qty')}} <span class="text-danger">*</span></label>
                                                </div>
                                                <div class="col-sm-12 col-md-9 col-l-9">
                                                    <div class="field">
                                                        <input type="number" class="form-control" id="qty" name="qty" placeholder="{{__('home.qty')}}" min="0" value="{{$product->qty}}">
                                                    </div>
                                                </div>
                                            </div> --}}

                                            <div class="row d-flex align-items-center mt-3">
                                                <div class="col-sm-12 col-md-3 col-l-3">
                                                    <label for="equipment_type"> {{__('nav.equipment_type')}}  <span class="text-danger">*</span></label>
                                                </div>
                                                <div class="col-sm-12 col-md-9 col-l-9">
                                                    <div class="field">
                                                        <select name="equipment_type" id="equipment_type" class="ui search dropdown1 d-block w-100">
                                                            <option value="">{{__("nav.selectQuipmentType")}}</option>
                                                            <option {{ $product->equipment_type == '1' ? 'selected' : '' }} value="1">{{__("nav.equipment")}}</option>
                                                            <option {{ $product->equipment_type == '2' ? 'selected' : '' }} value="2">{{__("nav.accessories")}}</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row d-flex align-items-center mt-3">
                                                <div class="col-sm-12 col-md-3 col-l-3">
                                                    <label for="descript">{{__('nav.noted')}} <span class="text-danger"></span></label>
                                                </div>
                                                <div class="col-sm-12 col-md-9 col-l-9">
                                                    <textarea name="descript" id="descript" cols="30" rows="5" class="form-control" placeholder="{{__('nav.noted')}}">{{$product->pro_description}}</textarea>
                                                </div>
                                            </div>
                                            <div class="row mt-3">
                                                <div class="col-12 d-flex justify-content-end align-items-end">
                                                    <button type="submit" class="ui button tiny green" style="width: fit-content;"><span class="mdi mdi-check-circle icon"></span> {{__('nav.update')}}</button>
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
<script>
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
</script>
<script>
    $(document).ready(function () {
        $('#file-input').on('change', function(event) {
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

    $(document).ready(function(){
        $('#product').addClass('nav-item active');
        $('#form-elements').addClass('collapse show');
    });

    $('.ui.form')
    .form({
        fields: {
            proNameEn: {
                identifier: 'proNameEn',
                rules: [
                {
                    type   : 'empty',
                    prompt : 'Please enter your name'
                }
                ]
            },
            catId: {
                identifier: 'catId',
                rules: [
                {
                    type   : 'empty',
                    prompt : 'Please enter your name'
                }
                ]
            },
            qty: {
                identifier: 'qty',
                rules: [
                {
                    type   : 'empty',
                    prompt : 'Please enter your name'
                }
                ]
            },
            equipment_type: {
                identifier: 'equipment_type',
                rules: [
                {
                    type   : 'empty',
                    prompt : 'Please enter your name'
                }
                ]
            },
        }
    });
</script>
@endsection
