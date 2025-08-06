@extends('layout/master')
@hasSection('link')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.18/css/bootstrap-select.min.css" integrity="sha512-ARJR74swou2y0Q2V9k0GbzQ/5vJ2RBSoCWokg4zkfM29Fb3vZEQyv0iWBMW/yvKgyHSR/7D64pFMmU8nYmbRkg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
@endif
@section('title')
<title> {{__('nav.addNewPurchase')}} | IMS</title>
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
    #preview {
        display: flex;
        flex-wrap: wrap;
        gap: 10px;
    }
    .preview-container {
        position: relative;
    }
    .preview-image {
        width: 310px;
        height: 450px;
        /* object-fit: cover; */
        border: 1px solid #ccc;
    }
    .delete-button {
        position: absolute;
        top: 0;
        right: 0;
        background: rgb(206, 0, 0);
        color: white;
        border: none;
        cursor: pointer;
        padding: 2px 5px;
    }
</style>
@endsection

@section('content')


<div class="content-wrapper">
    <div class="row">
        <div class="col-md-8 grid-margin">
            <div class="row">
                <div class="col-12 mb-4 mb-xl-0">
                    <h3 class="font-weight-bold">{{__('nav.addNewPurchase')}}</h3>
                    <h6 class="font-weight-normal mb-0">{{__('nav.productPurchase')}} / <a class="text-primary" href="{{route('purchase.index')}}">{{__('nav.purchasing')}} </a> / 
                        <a class="text-primary" href="">{{__('nav.addNewPurchase')}} </a></h6>
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
                                        {{__('nav.purchaseForm')}}
                                    </h3>
                                    <div class="bg-white p-3">
                                        <form action="{{route('purchase.save')}}" method="post" enctype="multipart/form-data" autocomplete="off" class="ui form">
                                            @csrf
                                            {{-- <input type="hidden" class="d-none" name="product_id" value="{{$item->id}}"> --}}
                                            <label for="userGiven">{{__('nav.requester')}} <span class="text-danger">*</span></label>

                                            <select name="userAccount" id="userAccount" class="ui search dropdown d-block w-100 mb-2">
                                                <option selected>Select requester from users</option>
                                                @php
                                                    $no = 1;
                                                @endphp
                                                @foreach ($users as $user)
                                                    <option value="{{$user->id}}">{{ $user->card_id .' - '. $user->name_kh . '  ' . $user->name_en}}</option>
                                                @endforeach
                                            </select>
                                            
                                            <label for="pro_name_kh">{{__('nav.proName')}} <span class="text-danger">*</span></label>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <input type="text" name="pro_name_kh" id="pro_name_kh" class="mb-2"  value="{{ old('pro_name_kh') }}" placeholder="{{ __("nav.proNameKh") }}">
                                                </div>
                                                <div class="col-md-6">
                                                    <input type="text" name="pro_name" id="pro_name" class="mb-2"  value="{{ old('pro_name') }}" placeholder=" {{ __("nav.proNameEn") }} ">
                                                </div>
                                            </div>


                                            <div class="row">
                                                <div class="col-md-6">
                                                    <label for="model">{{__('nav.model')}} <span class="text-danger">*</span></label>
                                                    <input type="text" name="model" id="model" class="mb-2"  value="{{ old('model') }}" placeholder="{{__('nav.model')}}">
                                                </div>

                                                <div class="col-md-6">
                                                    <label for="qty">{{__('home.qty')}} <span class="text-danger">*</span></label>
                                                    {{-- <input type="number" name="qty" id="qty" min="0" value="{{ old('qty') }}" placeholder="Product price unit"> --}}
                                                    <div class="ui d-block w-100">
                                                        {{-- <i class="dollar sign icon"></i> --}}
                                                        <input type="number" name="qty" id="qty" min="1" value="{{ old('qty') }}" placeholder="{{__('home.qty')}}">
                                                    </div>
                                                   {{-- <div class="row">
                                                        <div class="col-md-6">
                                                            <label for="price_unit">{{__('nav.price_unit')}} <span class="text-danger"></span></label>
                                                            <div class="ui left icon input d-block w-100">
                                                                <i class="dollar sign icon"></i>
                                                                <input type="number" name="price_unit" id="price_unit" min="0" value="{{ old('price_unit') }}" placeholder="Price unit">
                                                            </div>
                                                        </div>
                                                   </div> --}}
                                                </div>
                                            </div>



                                            <label for="category">{{__('nav.category')}} <span class="text-danger">*</span></label>
                                            <select name="category" id="category" class="ui search dropdown1 d-block w-100 mb-2">
                                                <option  value="">Select category</option>
                                                @php
                                                    $no = 1;
                                                @endphp
                                                @foreach ($categories as $c)
                                                    <option value="{{ $c->id }}">{{ $c->cat_name}}</option>
                                                @endforeach
                                            </select>

                                            <div class="field">
                                                <label for="description">{{__('nav.Description')}} <span class="text-danger"></span></label>
                                                <textarea name="description" rows="5" id="description" placeholder="{{__('nav.Description')}}...">{{old('description')}}</textarea>
                                            </div>


                                            <div class="field">
                                                <label for="purpose">{{__('nav.purpose')}} <span class="text-danger"></span></label>
                                                <textarea name="purpose" rows="5" id="purpose" placeholder="{{__('nav.purpose')}}...">{{old('purpose')}}</textarea>
                                            </div>

                                           
                                            <label for="attachment" class="d-block w-100"> {{__('nav.uploadAtt')}} (x 2) <span class="text-danger">*</span></label>
                                            <input type="file" name="attachment[]" id="attachment" style="display: none;" class="d-none attachment" accept="image/*" multiple>
                                            {{-- <label for="attachment" class="attchLabel">
                                                <div class="attch">
                                                    <img src="" alt="" class="attachmentFile" id="file-attach" width="100%">
                                                    <span class="mdi mdi-image-plus text-secondary fs-1" id="draft-img"></span>
                                                </div>
                                            </label> --}}
                                            <div class="ui placeholder segment" style="cursor: unset;">
                                                <div class="ui icon header">
                                                    <i class="file image outline icon"></i>
                                                    {{ __("nav.selectImage") }}
                                                </div>
                                                <label for="attachment" class="ui primary button"> {{ __('nav.browseToImage') }} </label>
                                            </div>
                                            
                                            <div id="preview"></div>
                                            <small class="text-danger"> {{__('nav.requiredField')}} </small>
                                            <button type="submit" class="ui button primary text-end d-block ms-auto mt-2">
                                            <span class="mdi mdi-content-save-check"></span> {{__('nav.submit')}}</button>
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

        const fileInput = document.getElementById('attachment');
        const preview = document.getElementById('preview');

        let filesArray = [];

        fileInput.addEventListener('change', function(event) {
        preview.classList.add('mt-3', 'border', 'rounded-2', 'bg-white', 'p-3');

            const files = Array.from(event.target.files);
            filesArray = [...filesArray, ...files]; // Combine previous files with new ones
            updatePreview();

            // alert('hi');
        });

      
        function updatePreview() {
            preview.innerHTML = ''; // Clear previous previews

            filesArray.forEach((file, index) => {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const container = document.createElement('div');
                    container.classList.add('preview-container');

                    const img = document.createElement('img');
                    img.src = e.target.result;
                    img.classList.add('preview-image');
                    container.appendChild(img);

                    const deleteButton = document.createElement('button');
                    deleteButton.textContent = 'X';
                    deleteButton.classList.add('delete-button');
                    deleteButton.onclick = function() {
                        filesArray.splice(index, 1); // Remove the file from the array
                        updatePreview(); // Refresh the preview
                    };
                    container.appendChild(deleteButton);
                    preview.appendChild(container);
                }
                reader.readAsDataURL(file);
            });
        }

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
                        title: "Data has saved."
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

            
            // $("#master3").addClass('active');
            // $("#ui-basic3").addClass('collapse show');
        });
    </script>
@endsection