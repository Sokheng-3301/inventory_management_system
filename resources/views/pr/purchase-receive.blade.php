@extends('layout/master')
@hasSection('link')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.18/css/bootstrap-select.min.css" integrity="sha512-ARJR74swou2y0Q2V9k0GbzQ/5vJ2RBSoCWokg4zkfM29Fb3vZEQyv0iWBMW/yvKgyHSR/7D64pFMmU8nYmbRkg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
@endif
@section('title')
<title> {{__('nav.purchaseReceive')}} | IMS</title>
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
                    <h3 class="font-weight-bold">{{__('nav.purchaseReceive')}}</h3>
                    <h6 class="font-weight-normal mb-0">{{__('nav.productPurchase')}} / <a class="text-primary" href="{{route('purchase.index')}}">{{__('nav.purchasing')}} </a> / 
                        <a class="text-primary" href="">{{__('nav.purchaseReceive')}} </a></h6>
                </div>
            </div>
            <div class="row mt-4">
                <div class="col-sm-12 col-md-12 col-l-12 col-xl-12">
                    <div class="row mb-4 justify-content-start d-flex">
                        <div class="col-sm-5 col-dm-2 col-l-2 text-start">
                            <a href="
                               {{url()->previous()}}
                            " class="d-inline ms-auto btn btn-sm btn-outline-secondary back-btn"> {{__('nav.back')}}  <span
                                    class="mdi mdi-arrow-u-left-top"></span></a>
                        </div>
                    </div>

                    <div class="card p-1">
                        <div class="p-3 mt-3">
                            <div class="row">
                                <div class="col-md-12">
                                    <h3 class="text-primary">
                                        {{__('nav.purchaseReceive')}}
                                    </h3>
                                    <div class="bg-white p-3">
                                        {{-- <form action="{{route('purchase.doedit', ['id' => $pr->id])}}" method="post" enctype="multipart/form-data" autocomplete="off" class="ui form">
                                            @csrf
                                            <label for="userGiven">{{__('nav.requester')}} <span class="text-danger">*</span></label>

                                            <select name="userAccount" id="userAccount" class="ui search dropdown d-block w-100 mb-2">
                                                <option selected>Select requester from users</option>
                                                @php
                                                    $no = 1;
                                                @endphp
                                                @foreach ($users as $user)
                                                    <option {{ $user->card_id == $pr->requester ? 'selected' : '' }} value="{{$user->card_id}}">{{ $user->card_id .' - '. $user->name_kh . '  ' . $user->name_en}}</option>
                                                @endforeach
                                            </select>
                                            
                                            <label for="pro_name_kh">{{__('nav.proName')}} <span class="text-danger">*</span></label>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <input type="text" name="pro_name_kh" id="pro_name_kh" class="mb-2"  value="{{ $pr->pro_name_kh }}" placeholder="Product name in Khmer">
                                                </div>
                                                <div class="col-md-6">
                                                    <input type="text" name="pro_name" id="pro_name" class="mb-2"  value="{{ $pr->pro_name }}" placeholder="Product name in English">
                                                </div>
                                            </div>


                                            <div class="row">
                                                <div class="col-md-6">
                                                    <label for="model">{{__('nav.model')}} <span class="text-danger">*</span></label>
                                                    <input type="text" name="model" id="model" class="mb-2"  value="{{ $pr->model }}" placeholder="Product model">
                                                </div>

                                                <div class="col-md-6">
                                                    
                                                   <div class="row">
                                                    <div class="col-md-6">
                                                        <label for="qty">{{__('home.qty')}} <span class="text-danger">*</span></label>
                                                        <div class="ui d-block w-100">
                                                            <input type="number" name="qty" id="qty" min="1" value="{{ $pr->qty }}" placeholder="Qty">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label for="price_unit">{{__('nav.price_unit')}} <span class="text-danger"></span></label>
                                                        <div class="ui left icon input d-block w-100">
                                                            <i class="dollar sign icon"></i>
                                                            <input type="number" name="price_unit" id="price_unit" min="0" value="{{ $pr->price_unit }}" placeholder="Price unit">
                                                        </div>
                                                    </div>
                                                   </div>
                                                </div>
                                            </div>

                                            <label for="category">{{__('nav.category')}} <span class="text-danger">*</span></label>
                                            <select name="category" id="category" class="ui search dropdown1 d-block w-100 mb-2">
                                                <option  >Select category</option>
                                                @php
                                                    $no = 1;
                                                @endphp
                                                @foreach ($categories as $c)
                                                    <option {{ $c->id == $pr->category ? 'selected' : '' }} value="{{ $c->id }}">{{ $c->cat_name}}</option>
                                                @endforeach
                                            </select>

                                            <div class="field">
                                                <label for="description">{{__('nav.Description')}} <span class="text-danger"></span></label>
                                                <textarea name="description" rows="5" id="description" placeholder="Product description...">{{ $pr->description }}</textarea>
                                            </div>


                                            <div class="field">
                                                <label for="purpose">{{__('nav.purpose')}} <span class="text-danger"></span></label>
                                                <textarea name="purpose" rows="5" id="purpose" placeholder="Purpose...">{{ $pr->purpose }}</textarea>
                                            </div>

                                           
                                            <label for="attachment" class="d-block w-100"> {{__('nav.uploadAtt')}} <span class="text-danger">*</span></label>
                                            <input type="file" name="attachment" id="attachment" style="display: none;" class="d-none attachment" accept="image/*">
                                            <label for="attachment" class="attchLabel">
                                                <div class="attch">
                                                    <img src="{{ asset($pr->att) }}" alt="" class="attachmentFile" id="file-attach" width="100%">
                                                    <span class="mdi mdi-image-plus text-secondary fs-1 d-none" id="draft-img"></span>
                                                </div>
                                                <input type="hidden" class="d-none" name="old_att" value="{{ $pr->att }}">
                                            </label>
                                            <small class="text-danger"> {{__('nav.requiredField')}} </small>
                                            <button type="submit" class="ui button green text-end d-block ms-auto mt-2">
                                            <span class="mdi mdi-content-save-check"></span> {{__('nav.update')}}</button>
                                        </form> --}}

                                        <div class="ui icon bg-light p-3 rounded-3">
                                            {{-- <i class="inbox icon"></i> --}}
                                            <div class="content">
                                                {{-- <div class="header mb-3 fw-bold">
                                                    {{ __('nav.requesterInfo') }}
                                                </div> --}}
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="row">
                                                            {{-- <div class="col-md-12 text-primary"><label for="">{{__("nav.requester")}}</label></div> --}}
                                                            {{-- <div class="col-md-1"><span class="mdi mdi-dots-vertical"></span></div> --}}
                                                            <div class="col-md-12">
                                                                <div class="row">
                                                                    <div class="col-md-3"> <label for="">{{ __("nav.staffId") }}</label> </div>
                                                                    <div class="col-md-9">{{ $pr->card_id}}</div>
                                                                    <div class="col-md-3"> <label for="">{{ __("nav.name") }}</label> </div>
                                                                    <div class="col-md-9">
                                                                        @if (session()->has('localization') && session('localization') == 'en')
                                                                            {{ $pr->name_en}}
                                                                        @else
                                                                            {{ $pr->name_kh}}
                                                                        @endif
                                                                    </div>
                                                                    <div class="col-md-3"> <label for="">{{ __("nav.gender") }}</label> </div>
                                                                    <div class="col-md-9">{{__("nav.$pr->gender") }}</div>
                                                                    <div class="col-md-3"> <label for="">{{ __("nav.department") }}</label> </div>
                                                                    <div class="col-md-9">
                                                                        @if (session()->has('localization') && session('localization') == 'en')
                                                                            {{ $pr->dep_name_en}}
                                                                        @else
                                                                            {{ $pr->dep_name_kh}}
                                                                        @endif
                                                                    </div>
                                                                    <div class="col-md-3"> <label for="">{{ __("nav.position") }}</label> </div>
                                                                    <div class="col-md-9">{{ $pr->position_name }}</div>
                                                                    <div class="col-md-3"> <label for="">{{ __('nav.phoneNumber')}}</label> </div>
                                                                    <div class="col-md-9">{{ $pr->phone_number }}</div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6">

                                                        <div class="row">
                                                            {{-- <div class="col-md-12 text-primary"><label for="">{{__("nav.productPurchase")}}</label></div> --}}
                                                            {{-- <div class="col-md-1"><span class="mdi mdi-dots-vertical"></span></div> --}}
                                                            <div class="col-md-12">
                                                                <div class="row">
                                                                    <div class="col-md-4"> <label for="">{{ __("nav.proName") }}</label> </div>
                                                                    <div class="col-md-8">
                                                                        @if (session()->has('localization') && session('localization') == 'en')
                                                                            {{ $pr->pro_name}}
                                                                        @else
                                                                            {{ $pr->pro_name_kh}}
                                                                        @endif
                                                                    </div>
                                                                    <div class="col-md-4"> <label for="">{{ __("nav.model") }}</label> </div>
                                                                    <div class="col-md-8">{{ $pr->model }}</div>
                                                                    <div class="col-md-4"> <label for="">{{ __('nav.category') }}</label> </div>
                                                                    <div class="col-md-8">{{ $pr->cat_name }}</div>

                                                                    <div class="col-md-4"> <label for="">{{ __('nav.Description') }}</label> </div>
                                                                    <div class="col-md-8">{{ $pr->description }}</div>
                                                                    <div class="col-md-4"> <label for="">{{ __('nav.purpose') }}</label> </div>
                                                                    <div class="col-md-8">{{ $pr->purpose }}</div>
                                                                    <div class="col-md-4"> <label for="">{{ __('nav.purchasedate') }}</label> </div>
                                                                    <div class="col-md-8">{{ $pr->pr_date }}</div>
                                                                    {{-- <div class="col-md-2"> <label for="">{{ __("home.qty") }}</label> </div>
                                                                    <div class="col-md-10">{{ $pr->qty }}</div>
                                                                    <div class="col-md-2"> <label for="">{{ __("nav.department") }}</label> </div>
                                                                    <div class="col-md-10">{{ $pr->dep_name_kh . ' - '. $pr->dep_name_en}}</div> --}}
                                                                </div>
                                                            </div>

                                                            
                                                        </div>
                                                    </div>

                                                   


                                                </div>

                                                <p class="ui horizontal divider">
                                                    <i class="ui dollar sign icon"></i>
                                                    {{ __('nav.productPrice') }}
                                                </p>

                                                <div class="row">
                                                    <div class="col-md-8 mx-auto bg-white p-3 border rounded-2 border-1 border-primary">
                                                        <form action="{{ route('purchase.saveReceive', ['id' => $pr->purchase_id]) }}" method="post" class="ui form">
                                                            @csrf
                                                            <div class="row">
                                                                <div class="col-md-5 field">
                                                                    <label>{{__('home.qty')}}</label>
                                                                    <input type="number" name="qty" id="qty" disabled placeholder="Qty" value="{{ $pr->qty }}">
                                                                </div>
                                                                {{-- <div class="col-md-1">
                                                                    <label for="">x</label>
                                                                </div> --}}
                                                                <div class="col-md-7 field">
                                                                    <label>{{__('nav.price_unit')}}</label>
                                                                    <div class="ui left icon input">
                                                                        <input type="number" min="1" id="price_unit" name="price_unit"  placeholder="{{__('nav.price_unit')}}...">
                                                                        <i class="dollar sign icon"></i>
                                                                    </div>
                                                                        {{-- <input type="number" name="qty" disabled placeholder="Qty" value="{{ $pr->qty }}"> --}}
                                                                </div>
                                                                <div class="col-md-5 field">
                                                                    <label>{{__('nav.total')}}</label>
                                                                    <div class="ui left icon input">
                                                                        <input type="number" min="0" value="0" disabled id="total" placeholder=" {{ __('nav.total') }} ...">
                                                                        <i class="dollar sign icon"></i>
                                                                    </div>
                                                                        {{-- <input type="number" name="qty" disabled placeholder="Qty" value="{{ $pr->qty }}"> --}}
                                                                </div>
                                                                <div class="col-md-4 field">
                                                                    <label for=""> &nbsp;  </label>
                                                                    <button class="ui primary button">
                                                                        <span class="mdi mdi-cart-plus"></span> {{ __('nav.receive') }}
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
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@if(session()->has('success'))
<div class="modal fade" id="addProductToStok" data-bs-backdrop="static" aria-hidden="true" aria-labelledby="exampleModalToggleLabel" tabindex="-1">
    <div class="modal-dialog modal-dialog-top modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalToggleLabel"> {{ __('nav.messageFromSystem') }} </h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <h1 class="ui icon header text-center d-block">
                    <span class="mdi mdi-store-plus-outline icon text-primary"></span>
                    <div class="content">
                        {{ __('nav.addProductToStock') }}
                        <div class="sub header"> {{ __('nav.questionAddTostock') }} </div>
                      </div>
                </h1>
                
            </div>
            <div class="modal-footer">
                <div class="ui buttons">
                    
                    <a href="{{ route('purchase.index') }}" class="ui button" type="button"> {{ __('nav.cancel') }} </a>
                    <div class="or"></div>
                    {{-- <form action="" method="post">
                        @csrf --}}
                        <a href="{{ route('purchase.addStock', ['id'=>$pr->purchase_id]) }}" class="ui blue button" > {{ __('nav.yes') }} </a>
                    {{-- </form> --}}
                  </div>
            </div>
        </div>
    </div>
</div>
@endif



{{-- <div class="modal fade" id="formAddProductToStock"  data-bs-backdrop="static" aria-hidden="true" aria-labelledby="formAddProductToStock" tabindex="-1">
    <div class="modal-dialog modal-dialog-top">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="formAddProductToStock">Modal 2</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Hide this modal and show the first with the button below.
            </div>
            <div class="modal-footer">
                <button class="ui button primary" data-bs-target="#exampleModalToggle" data-bs-toggle="modal">Back to first</button>
            </div>
        </div>
    </div>
</div> --}}

  {{-- <button class="btn btn-primary" data-bs-target="#exampleModalToggle" data-bs-toggle="modal">Open first modal</button> --}}


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
    </script>

    {{-- <script>
        $(document).ready(function () {
            $('#departmentTb').DataTable();
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
    </script> --}}

    @if (session() -> has('empty'))
        <script>
        const Toast = Swal.mixin({
                        toast: true,
                        position: "top-end",
                        showConfirmButton: false,
                        timer: 3000,
                        timerProgressBar: true,
                        didOpen: (toast) => {
                            toast.onmouseenter = Swal.stopTimer;
                            toast.onmouseleave = Swal.resumeTimer;
                        }
                        });
                        Toast.fire({
                        icon: "error",
                        title: "Field is required!"
                        });
        </script>
    @endif
    @if (session() -> has('success'))
        <script>
        const Toast = Swal.mixin({
                        toast: true,
                        position: "top-end",
                        showConfirmButton: false,
                        timer: 3000,
                        timerProgressBar: true,
                        didOpen: (toast) => {
                            toast.onmouseenter = Swal.stopTimer;
                            toast.onmouseleave = Swal.resumeTimer;
                        }
                        });
                        Toast.fire({
                        icon: "success",
                        title: "Product has received successfully."
                        });
        </script>
    @endif
    @if (session() -> has('error'))
        <script>
        const Toast = Swal.mixin({
                        toast: true,
                        position: "top-end",
                        showConfirmButton: false,
                        timer: 3000,
                        timerProgressBar: true,
                        didOpen: (toast) => {
                            toast.onmouseenter = Swal.stopTimer;
                            toast.onmouseleave = Swal.resumeTimer;
                        }
                        });
                        Toast.fire({
                        icon: "error",
                        title: "Operating unsuccessfully."
                        });
        </script>
    @endif
    @if (session() -> has('deleted'))
        <script>
        const Toast = Swal.mixin({
                        toast: true,
                        position: "top-end",
                        showConfirmButton: false,
                        timer: 3000,
                        timerProgressBar: true,
                        didOpen: (toast) => {
                            toast.onmouseenter = Swal.stopTimer;
                            toast.onmouseleave = Swal.resumeTimer;
                        }
                        });
                        Toast.fire({
                        icon: "success",
                        title: "Data has deleted."
                        });
        </script>
    @endif

    @if (session() -> has('exist'))
        <script>
        const Toast = Swal.mixin({
                        toast: true,
                        position: "top-end",
                        showConfirmButton: false,
                        timer: 3000,
                        timerProgressBar: true,
                        didOpen: (toast) => {
                            toast.onmouseenter = Swal.stopTimer;
                            toast.onmouseleave = Swal.resumeTimer;
                        }
                        });
                        Toast.fire({
                        icon: "error",
                        title: "Data has existed already."
                        });
        </script>
    @endif

    <script>
        $(document).ready(function(){
            // $('#sidebar-menu li').remoeClass('active');
            // $('#sidebar-menu li ul li').remoeClass('active collapse');

            $('#purchaseRequest').addClass('nav-item active');
            $('#purchasePr').addClass('collapse show');



            $('#price_unit').on('input', function(){
                let qty = $('#qty').val();
                let priceUnint = $(this).val();
                $('#total').val(qty * priceUnint);
            });

            $('#addProductToStok').modal('show');
            // $("#master3").addClass('active');
            // $("#ui-basic3").addClass('collapse show');
        });
    </script>
@endsection