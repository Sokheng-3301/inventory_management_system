@extends('layout/master')
@hasSection('link')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.18/css/bootstrap-select.min.css" integrity="sha512-ARJR74swou2y0Q2V9k0GbzQ/5vJ2RBSoCWokg4zkfM29Fb3vZEQyv0iWBMW/yvKgyHSR/7D64pFMmU8nYmbRkg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
@endif
@section('title')
<title> {{__('nav.updateUser')}} | IMS</title>
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
    #roleName, #cardId{
        /* cursor: no-drop; */
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
                    <h3 class="font-weight-bold">{{__('nav.updateUser')}} </h3>
                    <h6 class="font-weight-normal mb-0"> {{__( 'nav.manageUser')}} / {{$name->role_name}} /<span class="text-primary"><a class="text-primary"
                                href=""> {{__('nav.updateUser')}}</a> </span></h6>
                </div>
            </div>
            <div class="row mt-4">
                <div class="col-sm-12 col-md-12 col-l-12 col-xl-12">
                    @include('layout.back-button')
                    <div class="card p-1">
                        <form action="{{route('user.doEdit')}}" method="post" enctype="multipart/form-data" autocomplete="off">
                            @csrf
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-sm-12 col-md-4 ">
                                        <div class="bg-light p-3">
                                            <p class="fw-bold text-center text-primary">{{__('home.userProfile')}}</p>
                                            <label for="productImg" id="proImg">
                                                <span class="mdi mdi-image-plus"></span>
                                                <div class="bgCamera">

                                                </div>
                                                {{-- <img src="" id="file-input" alt=""> --}}
                                                <img src="@if ($query -> profile != '')
                                                {{asset($query->profile)}}
                                                @endif"
                                                @if ($query -> profile != '')
                                                    style = "d-block"
                                                @endif
                                                id="file-input" alt="">

                                            </label>
                                            <small class="text-center d-block">{{__('home.uploadUserProfile')}}.</small>
                                            <input type="file" class="d-none" name="proImage" style="display: none;" id="productImg" accept="image/*">
                                            <input type="hidden" class="w-100 d-none" style="display: none;" name="oldProfile" value="{{$query->profile}}">
                                            <input type="hidden" class="w-100 d-none" style="display: none;" name="id" value="{{$query->id}}">
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-8">
                                        <div class="bg-light p-3">
                                            <p class="fw-bold text-center text-primary">{{__('nav.userInfo')}}</p>
                                            <div class="row d-flex align-items-center">
                                                <div class="col-sm-12 col-md-3 col-l-3">
                                                    <label for="name_kh">{{__('nav.fullNameKh')}} <span class="text-danger">*</span></label>
                                                </div>
                                                <div class="col-sm-12 col-md-9 col-l-9">
                                                    <input type="text" id="name_kh" class="form-control" name="name_kh" placeholder="{{__('nav.fullNameKh')}}" value="{{$query->name_kh}}">
                                                </div>
                                            </div>

                                            <div class="row d-flex align-items-center mt-3">
                                                <div class="col-sm-12 col-md-3 col-l-3">
                                                    <label for="name_en">{{__('nav.fullNameEn')}} <span class="text-danger">*</span></label>
                                                </div>
                                                <div class="col-sm-12 col-md-9 col-l-9">
                                                    <input type="text" class="form-control" id="name_en" name="name_en" placeholder="{{__('nav.fullNameEn')}}" value="{{$query->name_en}}">
                                                </div>
                                            </div>

                                            <div class="row d-flex align-items-center mt-3">
                                                <div class="col-sm-12 col-md-3 col-l-3">
                                                    <label for="cardId">{{__('nav.staffId')}}<span class="text-danger"></span></label>
                                                </div>
                                                <div class="col-sm-12 col-md-9 col-l-9">
                                                    <input type="text" class="form-control" id="cardId" placeholder="{{__('nav.staffId')}}" value="{{$query->card_id}}" name="cardId">
                                                    {{-- <input type="hidden" class="form-control d-none" style="display: none;" id="cardId" name="cardId" placeholder="Card ID" value="{{$query->card_id}}" > --}}
                                                </div>
                                            </div>

                                            <div class="row d-flex align-items-center mt-3">
                                                <div class="col-sm-12 col-md-3 col-l-3">
                                                    <label for="gender">{{__('nav.gender')}}<span class="text-danger">*</span></label>
                                                </div>
                                                <div class="col-sm-12 col-md-9 col-l-9">
                                                    {{-- <input type="text" class="form-control" id="proNameEn" name="proNameEn" placeholder="Product name EN"> --}}
                                                    <select name="gender" id="gender" class="ui search dropdown d-block w-100">
                                                        <option selected disabled>Please select gender</option>
                                                        <option
                                                            @if ($query->gender == 'Female')
                                                                selected
                                                            @endif
                                                         value="Female">Female</option>
                                                        <option
                                                        @if ($query->gender == 'Male')
                                                                selected
                                                        @endif
                                                        value="Male">Male</option>
                                                    </select>
                                                </div>
                                            </div>


                                            <div class="row d-flex align-items-center mt-3">
                                                <div class="col-sm-12 col-md-3 col-l-3">
                                                    <label for="position">{{__('nav.position')}} <span class="text-danger">*</span></label>
                                                </div>
                                                <div class="col-sm-12 col-md-9 col-l-9">
                                                    <select name="position" id="position" class="ui search dropdown1 d-block w-100">
                                                        <option disabled selected>Please select position</option>
                                                        @php
                                                            $inc = 1;
                                                        @endphp
                                                        @foreach ($positions as $c)
                                                            <option
                                                                @if ($query->position == $c->id)
                                                                    selected
                                                                @endif
                                                                value="{{$c->id}}">{{ $c->position_name}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>


                                            <div class="row d-flex align-items-center mt-3">
                                                <div class="col-sm-12 col-md-3 col-l-3">
                                                    <label for="username">{{__('nav.username')}} <span class="text-danger"></span></label>
                                                </div>
                                                <div class="col-sm-12 col-md-9 col-l-9">
                                                    <input type="text" class="form-control" id="username" placeholder="{{__('nav.username')}}" name="username" value="{{$query->email}}">
                                                </div>
                                            </div>

                                            {{-- <div class="row d-flex align-items-center mt-3">
                                                <div class="col-sm-12 col-md-3 col-l-3">
                                                    <label for="password">Password <span class="text-danger"></span></label>
                                                </div>
                                                <div class="col-sm-12 col-md-9 col-l-9">
                                                    <input type="password" id="password" class="form-control" placeholder="Password" name="password">
                                                </div>
                                            </div>


                                            <div class="row d-flex align-items-center mt-3">
                                                <div class="col-sm-12 col-md-3 col-l-3">
                                                    <label for="confirmPassword">Confirm password <span class="text-danger"></span></label>
                                                </div>
                                                <div class="col-sm-12 col-md-9 col-l-9">
                                                    <input type="password" id="confirmPassword" class="form-control" placeholder="Confirm password" name="confirmPassword">
                                                </div>
                                            </div> --}}

                                            <div class="row d-flex align-items-center mt-3">
                                                <div class="col-sm-12 col-md-3 col-l-3">
                                                    <label for="confirmPassword">{{__('nav.Role')}}</label>
                                                </div>
                                                <div class="col-sm-12 col-md-9 col-l-9">
                                                    {{-- <p id="roleName" class="form-control">  </p> --}}
                                                    <input disabled type="text" id="roleName" class="form-control" placeholder="{{__('nav.Role')}}" value="{{$name->role_name}}">
                                                    <input type="hidden" name="roleId" class="d-none" style="display: none;" value="{{$name->id}}">
                                                </div>
                                            </div>

                                            <div class="row d-flex align-items-center mt-3">
                                                <div class="col-sm-12 col-md-3 col-l-3">
                                                    <label for="phoneNumber"> {{__('nav.phoneNumber')}}<span class="text-danger"></span></label>
                                                </div>
                                                <div class="col-sm-12 col-md-9 col-l-9">
                                                    <input type="tel" id="phoneNumber" class="form-control" placeholder=" {{__('nav.phoneNumber')}}" name="phoneNumber" value="{{$query->phone_number}}">
                                                </div>
                                            </div>

                                            <div class="row d-flex align-items-center mt-3">
                                                <div class="col-sm-12 col-md-3 col-l-3">
                                                    <label for="emailAddress">{{__('nav.emailAddress')}} <span class="text-danger"></span></label>
                                                </div>
                                                <div class="col-sm-12 col-md-9 col-l-9">
                                                    <input type="email" id="emailAddress" class="form-control" placeholder="{{__('nav.emailAddress')}} " name="email" value="{{$query->email_address}}">
                                                </div>
                                            </div>


                                            {{-- <div class="row d-flex align-items-center mt-3">
                                                <div class="col-sm-12 col-md-3 col-l-3">
                                                    <label for="descript">Description <span class="text-danger"></span></label>
                                                </div>
                                                <div class="col-sm-12 col-md-9 col-l-9">
                                                    <textarea name="descript" id="descript" cols="30" rows="10" class="form-control" placeholder="Description about product"></textarea>
                                                </div>
                                            </div> --}}
                                            <div class="row mt-3">
                                                <div class="col-12 d-flex justify-content-end align-items-end">
                                                    <button type="submit" class="ui button green tiny" style="width: fit-content;"><span class="mdi mdi-check-circle icon"></span> {{__('nav.update')}}</button>
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
        $('#departmentTb').DataTable();

        $('#category').selectpicker();
        // $("#chosen_select").selectpicker();


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
</script>


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
@if (session() -> has('password'))
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
                    title: "Password and Confirm password not match."
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

{{-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.18/js/i18n/defaults-am_ET.min.js" integrity="sha512-u/Wb9n1d9DcM1ZspB5sZTIdct4ODkcf0ksSVTaBPkyK7caV7avu0YuceQ+i9975pconz6HQvafwYbrVPqla/Jw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script> --}}
<script>
    $(document).ready(function(){
        // $('#sidebar-menu li').remoeClass('active');
        // $('#sidebar-menu li ul li').remoeClass('active collapse');

        $('#users').addClass('nav-item active');
        $('#tables').addClass('collapse show');

    });
</script>
@endsection
