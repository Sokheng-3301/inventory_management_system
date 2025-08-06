@extends('layout/master')

@section('title')
<title> {{__('nav.returned')}} | IMS</title>
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

    .attchLabel{
        width: 100%;
        display: block;
    }
    .attch{
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
    .attch img.icon{
        width: 15%;
    }
    .attch img{
        width: 100%
    }
    .attachmentFile{
        display: none;
    }
    .give-btn:hover{
        background-color: #45942b;
        box-shadow: 1px 1px 6px rgb(88, 88, 88);
    }
    .img img{
        width: 20%;
    }
    .attachment{
        width: 100%;
    }
</style>
@endsection


@section('content')


<div class="content-wrapper">
    <div class="row">
        <div class="col-md-12 grid-margin">
            <div class="row">
                <div class="col-12 col-xl-8 mb-4 mb-xl-0">
                    <h3 class="font-weight-bold">{{__('nav.returned')}} </h3>
                    <h6 class="font-weight-normal mb-0">{{__('nav.product')}}  / <span class="text-primary"><a class="text-primary"
                                href="">{{__('nav.returned')}} </a></span></h6>
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
                    <div class="row mb-4 justify-content-start d-flex">
                        <div class="col-sm-5 col-dm-2 col-l-2 text-start">
                            <a href="
                               {{url()->previous()}}
                            " class="d-inline ms-auto btn btn-sm btn-outline-secondary back-btn">{{__('nav.back')}}  <span
                                    class="mdi mdi-arrow-u-left-top"></span></a>
                        </div>
                    </div>
                    <div class="card p-2">
                        <div class="card-body">
                            <div class="row d-flex align-items-center mb-3">


                                @php
                                $checkRole = DB::table('user_roles')
                                            ->where('id', @Auth::user()->role_id)
                                            ->get()->first();
                                @endphp 

                                @if (($checkRole->role_name == 'admin' || $checkRole->role_name == 'Admin') || $action->action_edit == 1) 
                                    <div class="col-6">
                                        {{-- <a href="{{route('product.form')}}" class="btn btn-sm btn-primary"><span
                                            class="mdi mdi-plus"></span> Add new</a> --}}
                                    </div>
                                    {{-- <div class="col-sm-7 mb-2 col-md-7 col-lg-7 bg-light d-flex align-items-center"> --}}
                                    <div class="col-6">
                                        <div class="control-button">
                                            <p class="pe-2">{{__('nav.export')}} </p>
                                            <a id="export-btn"><span class="mdi mdi-microsoft-excel"></span> Excel</a>
                                            {{-- <a id="export-btn-pdf" class="pdf"><span class="mdi mdi-file-pdf-box"></span> PDF</a> --}}
                                        </div>
                                    </div>
                                    {{-- </div> --}}
                                @endif

                            </div>
                            <hr>


                            <div class="table-responsive">                   
                                <table id="departmentTb" class="display table table-striped">
                                    <thead>
                                        <tr>
                                            <th style="width: 10px;" class="text-start">{{__('home.no')}}</th>
                                            <th>{{__('nav.img')}}</th>
                                            <th> {{__('nav.proCode')}} </th>
                                            <th> {{__('nav.proName')}} </th>

                                            <th>{{__('nav.model')}}</th>
                                            <th>{{__('nav.serial_number')}}</th>
                                            <th>{{__('nav.fix_asset_code')}}</th>

                                            <th> {{__('nav.category')}} </th>

                                            <th> {{__('nav.profile')}} </th>
                                            <th> {{__('nav.staffId')}} </th>
                                            <th> {{__('nav.name')}} </th>
                                            <th> {{__('home.Gender')}} </th>
                                            <th> {{__('home.qty')}} </th>
                                            <th> {{__('nav.givenDate')}} </th>
                                            <th> {{__('nav.returnDate')}} </th>
                                            <th>{{__('nav.actions')}}</th>

                                            {{-- <th colspan="2">{{__('nav.statusQty')}}</th> --}}
                                            {{-- <th></th> --}}
                                            {{-- <th> {{__('nav.createAt')}} </th> --}}
                                            {{-- <th>Age</th>
                                            <th>Start date</th> --}}
                                            {{-- <th>{{__('nav.give')}}</th> --}}
                                            {{-- <th class="text-center"> {{__('nav.actions')}} </th> --}}
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $auto = 1;
                                        @endphp
                                        @foreach ($product as $item)
                                            
                                            <tr>
                                                <td style="width: 10px" class="text-start <?php
                                                        if($item->delete_status == '0'){
                                                            echo 'text-danger';
                                                        }
                                                    ?>">{{$auto++}}
                                                </td>

                                                <td>
                                                    @if ($item->pro_img == '')
                                                        <img src="{{asset('images/draft-image.png')}}" alt="">
                                                    @else
                                                        <img src="{{asset( $item->pro_img)}}" alt="">
                                                    @endif
                                                </td>

                                                <td class="<?php
                                                        if($item->delete_status == '0'){
                                                            echo 'text-danger';
                                                        }
                                                    ?>">{{$item -> pro_code}}
                                                </td>
                                                <td class="<?php
                                                        if($item->delete_status == '0'){
                                                            echo 'text-danger';
                                                        }
                                                    ?>">{{$item -> pro_name_en}}
                                                </td>



                                                <td class="<?php
                                                        if($item->delete_status == '0'){
                                                            echo 'text-danger';
                                                        }
                                                    ?>">{{$item -> model}}
                                                </td>

                                                <td class="<?php
                                                        if($item->delete_status == '0'){
                                                            echo 'text-danger';
                                                        }
                                                    ?>">{{$item -> serial_number}}
                                                </td>
                                                <td class="<?php
                                                        if($item->delete_status == '0'){
                                                            echo 'text-danger';
                                                        }
                                                    ?>">{{$item -> fix_asset_code}}
                                                </td>



                                                <td class="<?php
                                                        if($item->delete_status == '0'){
                                                            echo 'text-danger';
                                                        }
                                                    ?>">{{$item -> cat_name}}
                                                </td>

                                                

                                                

                                                <td>
                                                    @if ($item->profile == '')
                                                        <img src="{{asset('images/draft-user.jpg')}}" alt="">
                                                    @else
                                                        <img src="{{asset( $item->profile)}}" alt="">
                                                    @endif
                                                </td>

                                                <td class="<?php
                                                        if($item->delete_status == '0'){
                                                            echo 'text-danger';
                                                        }
                                                    ?>">
                                                    {{$item->card_id}}
                                                </td>

                                                 <td class="<?php
                                                        if($item->delete_status == '0'){
                                                            echo 'text-danger';
                                                        }
                                                    ?>">
                                                    @if (session(['localization']) == 'en')
                                                        {{$item->name_en}}
                                                    @else
                                                        {{$item->name_kh}}
                                                    @endif
                                                </td>
                                                
                                                <td class="<?php
                                                        if($item->delete_status == '0'){
                                                            echo 'text-danger';
                                                        }
                                                    ?>">
                                                    @if ($item->gender == 'Male')
                                                        {{(__('nav.male'))}}
                                                    @else
                                                        {{(__('nav.female'))}}
                                                    @endif
                                                    {{-- {{$item->gender}} --}}
                                                </td>

                                                <td class="<?php
                                                        if($item->delete_status == '0'){
                                                            echo 'text-danger';
                                                        }
                                                    ?>">
                                                    <span class="badge badge-info">{{$item->qty}}</span>
                                                </td>

                                                <td class="<?php
                                                        if($item->delete_status == '0'){
                                                            echo 'text-danger';
                                                        }
                                                    ?>">
                                                    {{$item->date}}
                                                </td>
                                                <td class="<?php
                                                        if($item->delete_status == '0'){
                                                            echo 'text-danger';
                                                        }
                                                    ?>">
                                                    {{$item->returned_date}}
                                                </td>
                                                <td>
                                                    <a type="button" data-bs-toggle="modal" data-bs-target="#updateForm{{$item->giveId}}" ><span class="mdi mdi-eye-outline fs-5 text-primary" title="View detail"></span></a> 
                                                </td>

                                                                                               
                                                
                                               
                                                {{-- <td class="text-center">
                                                    <a type="button" data-bs-toggle="modal" data-bs-target="#updateForm{{$item->id}}" ><span class="mdi mdi-eye-outline fs-5 text-primary" title="View detail"></span></a> 

                                                    @if (($checkRole->role_name == 'admin' || $checkRole->role_name == 'Admin') || $action->action_edit == 1)
                                                        <a type="button" data-bs-toggle="modal" data-bs-target="#recoveryCategory{{$item->giveId}}" class="mdi mdi-inbox-arrow-down-outline fs-5 text-success" title="Return product"></span></a>
                                                    @endif

                                                    @if (($checkRole->role_name == 'admin' || $checkRole->role_name == 'Admin') || $action->action_delete == 1) 
                                                        |
                                                        @if ($item->delete_status == '0')
                                                            <a type="button" data-bs-toggle="modal" data-bs-target="#recoveryCategory{{$item->id}}"><span class="mdi mdi-backup-restore fw-bold text-success fs-5" title="Recovery data"></span></a>
                                                        
                                                        @else 
                                                            <a type="button" data-bs-toggle="modal" data-bs-target="#deleteVerify{{$item->id}}"><span class="mdi mdi-trash-can-outline text-danger fs-5" title="Delete data"></span></a>
                                                        @endif
                                                    @endif
                                                </td> --}}
                                            </tr>

                           

                                             <!-- Modal recovery-->
                                            <div class="modal fade" id="recoveryCategory{{$item->giveId}}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="recoveryCategory{{$item->giveId}}Label" aria-hidden="true">
                                                
                                                <div class="modal-dialog modal-dialog-centered">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h1 class="modal-title fs-5" id="recoveryCategory{{$item->giveId}}"> {{__('nav.productReturnTitle')}} </h1>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                                aria-label="Close"></button>
                                                        </div>
                                                        <form action="{{route('product.doReturn')}}" method="post" autocomplete="off">

                                                            <div class="modal-body">
                                                                @csrf
                                                                <input type="hidden" class="d-none" name="givenId" value="{{$item->giveId}}">
                                                                <input type="hidden" class="d-none" name="proId" value="{{$item->proId}}">
                                                                <input type="hidden" class="d-none" name="givenQty" value="{{$item->qty}}">

                                                                <label for=""> {{__('nav.productReturnQuestion')}} <span class="text-primary fw-bold">{{$item->pro_name_en}}</span>?</label>
                                                                {{-- <label for="categoryName">Category name </label>
                                                                <input type="text" id="categoryName" class="form-control" name="categoryName" placeholder="Category name" value="{{$item -> department_name}}"> --}}
                                                            </div>
                                                            <div class="modal-footer">
                                                                {{-- <button type="button" class="btn btn-secondary btn-sm"
                                                                    data-bs-dismiss="modal">Close</button> --}}
                                                                <button type="submit" class="btn btn-primary btn-sm">
                                                                    <span class="mdi mdi-check-circle-outline"></span> {{__('nav.yes')}}
                                                                </button>
                                                            </div>
                                                        </form>
                                                        
                                                    </div>
                                                </div>
                                            </div>



                                            <!-- Modal detail-->
                                            <div class="modal fade" id="updateForm{{$item->giveId}}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="updateForm{{$item->giveId}}Label" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centere modal-lg">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h1 class="modal-title fs-5" id="updateForm{{$item->giveId}}"><span class="mdi mdi-book-open"></span> {{__('nav.givenDetail')}}</h1>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                                aria-label="Close"></button>
                                                        </div>
                                                            <div class="modal-body">
                                                                <div class="row">
                                                                    <div class="col-sm-12 col-md-4 ">
                                                                        <div class="bg-light p-3">
                                                                            <p class="fw-bold text-center text-primary">{{__('nav.proImg')}}</p>
                                                                            <label for="productImg" id="proImg">
                                                                                <span class="mdi mdi-image"></span>
                                                                                {{-- <div class="bgCamera">
                                                                                    
                                                                                </div> --}}
                                                                                <img src="
                                                                                    @if ($item->pro_img != '')
                                                                                        {{asset($item->pro_img)}}
                                                                                    @endif
                                                                                " 
                                                                                @if ($item->pro_img != '')
                                                                                    style = "display: block"
                                                                                @endif
                                                                                id="file-input" alt="">
                                                                            </label>
                                                                            <small class="text-center d-block">{{__('nav.proImg')}}.</small>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-sm-12 col-md-8">
                                                                        <div class="bg-light p-3">
                                                                            <p class="fw-bold text-center text-primary">{{__('nav.givenInfo')}}</p>
                                                                            <div class="row d-flex align-items-center ">
                                                                                <div class="col-sm-12 col-md-3 col-l-3">
                                                                                    <label for="" class="fw-bold">{{__('nav.proCode')}} </label>
                                                                                </div>
                                                                                <div class="col-sm-12 col-md-9 col-l-9">
                                                                                    <p>{{$item->pro_code}}</p>
                                                                                </div>
                                                                                
                                                                            </div>
                                                                            <div class="row d-flex align-items-center mt-2">
                                                                                <div class="col-sm-12 col-md-3 col-l-3">
                                                                                    <label for="proNameKh" class="fw-bold">{{__('nav.proNameKh')}}</label>
                                                                                </div>
                                                                                <div class="col-sm-12 col-md-9 col-l-9">
                                                                                    <p>{{$item->pro_name_kh}}</p>
                                                                                </div>
                                                                            </div>
                                
                                                                            <div class="row d-flex align-items-center mt-2">
                                                                                <div class="col-sm-12 col-md-3 col-l-3">
                                                                                    <label for="proNameEn" class="fw-bold">{{__('nav.proNameEn')}}</label>
                                                                                </div>
                                                                                <div class="col-sm-12 col-md-9 col-l-9">
                                                                                    <p>{{$item->pro_name_en}}</p>
                                                                                </div>
                                                                            </div>



                                                                            <div class="row d-flex align-items-center mt-2">
                                                                                <div class="col-sm-12 col-md-3 col-l-3">
                                                                                    <label for="model" class="fw-bold"> {{__('nav.model')}} </label>
                                                                                </div>
                                                                                <div class="col-sm-12 col-md-9 col-l-9">
                                                                                    <p>{{$item->model}}</p>
                                                                                </div>
                                                                            </div>
                                                                            <div class="row d-flex align-items-center mt-2">
                                                                                <div class="col-sm-12 col-md-3 col-l-3">
                                                                                    <label for="serial_number" class="fw-bold"> {{__('nav.serial_number')}} </label>
                                                                                </div>
                                                                                <div class="col-sm-12 col-md-9 col-l-9">
                                                                                    <p>{{$item->serial_number}}</p>
                                                                                </div>
                                                                            </div>

                                                                            <div class="row d-flex align-items-center mt-2">
                                                                                <div class="col-sm-12 col-md-3 col-l-3">
                                                                                    <label for="fix_asset_code" class="fw-bold"> {{__('nav.fix_asset_code')}} </label>
                                                                                </div>
                                                                                <div class="col-sm-12 col-md-9 col-l-9">
                                                                                    <p>{{$item->fix_asset_code}}</p>
                                                                                </div>
                                                                            </div>



                                                                            <div class="row d-flex align-items-center mt-2">
                                                                                <div class="col-sm-12 col-md-3 col-l-3">
                                                                                    <label for="proNameEn" class="fw-bold">{{__('nav.category')}}</label>
                                                                                </div>
                                                                                <div class="col-sm-12 col-md-9 col-l-9">
                                                                                    <p>{{$item->cat_name}}</p>
                                                                                </div>
                                                                            </div>
                                                                            <hr>

                                                                            <div class="row d-flex align-items-center mt-2">
                                                                                <div class="col-sm-12 col-md-3 col-l-3">
                                                                                    <label for="proNameEn" class="fw-bold">{{__('nav.profile')}}</label>
                                                                                </div>
                                                                                <div class="col-sm-12 col-md-9 col-l-9">
                                                                                    {{-- <p>{{$item->name_en}}</p> --}}
                                                                                    <div class="img">
                                                                                        @if ($item->profile != '')
                                                                                            <img src="{{asset($item->profile)}}" alt="user-profile">
                                                                                        @else
                                                                                            <img src="{{asset('images/draft-user.jpg')}}" width="100%" alt="user-profile">
                                                                                        @endif
                                                                                    </div>
                                                                                </div>
                                                                            </div>

                                                                            <div class="row d-flex align-items-center mt-2">
                                                                                <div class="col-sm-12 col-md-3 col-l-3">
                                                                                    <label for="proNameEn" class="fw-bold">{{__('nav.name')}}</label>
                                                                                </div>
                                                                                <div class="col-sm-12 col-md-9 col-l-9">
                                                                                    <p>{{$item->name_kh}} - {{$item->name_en}}</p> 
                                                                                </div>
                                                                            </div>

                                                                            <div class="row d-flex align-items-center mt-2">
                                                                                <div class="col-sm-12 col-md-3 col-l-3">
                                                                                    <label for="proNameEn" class="fw-bold">{{__('nav.staffId')}}</label>
                                                                                </div>
                                                                                <div class="col-sm-12 col-md-9 col-l-9">
                                                                                    <p>{{$item->staff_id}}</p> 
                                                                                </div>
                                                                            </div>

                                                                            <div class="row d-flex align-items-center mt-2">
                                                                                <div class="col-sm-12 col-md-3 col-l-3">
                                                                                    <label for="proNameEn" class="fw-bold">{{__('nav.department')}}</label>
                                                                                </div>
                                                                                <div class="col-sm-12 col-md-9 col-l-9">
                                                                                    <p>{{$item->dep_name_en}}</p> 
                                                                                </div>
                                                                            </div>
                                
                                                                            <div class="row d-flex align-items-center mt-2">
                                                                                <div class="col-sm-12 col-md-3 col-l-3">
                                                                                    <label for="proNameEn" class="fw-bold">{{__('nav.position')}}</label>
                                                                                </div>
                                                                                <div class="col-sm-12 col-md-9 col-l-9">
                                                                                    <p>{{$item->position_name}}</p> 
                                                                                </div>
                                                                            </div>
                                                                            
                                                                            <div class="row d-flex align-items-center mt-2">
                                                                                <div class="col-sm-12 col-md-3 col-l-3">
                                                                                    <label for="proNameEn" class="fw-bold">{{__('nav.section')}}</label>
                                                                                </div>
                                                                                <div class="col-sm-12 col-md-9 col-l-9">
                                                                                    @if (session('localization') == 'en')
                                                                                        <p>{{$item->section_en}}</p> 
                                                                                    @else
                                                                                        <p>{{$item->section_kh}}</p> 
                                                                                    @endif
                                                                                </div>
                                                                            </div>
                                
                                
                                
                                                                            
                                
                                                                            <div class="row d-flex align-items-center mt-2">
                                                                                <div class="col-sm-12 col-md-3 col-l-3">
                                                                                    <label for="qty" class="fw-bold">{{__('home.qty')}} </label>
                                                                                </div>
                                                                                <div class="col-sm-12 col-md-9 col-l-9">
                                                                                    <p class="text-danger fw-bold">{{$item->qty}} 
                                                                                        {{-- @if ($item->stock_status == '0')
                                                                                            <small class="bg-rounded bg-danger ms-3 d-inline-block">
                                                                                                Outstock
                                                                                            </small>
                                                                                        @else
                                                                                            <small class="badge badge-primary ms-3 d-inline-block">
                                                                                                Instock
                                                                                            </small>
                                                                                        @endif     --}}
                                                                                    </p>

                                                                                </div>
                                                                            </div>
                                                                            <div class="row d-flex align-items-center mt-2">
                                                                                <div class="col-sm-12 col-md-3 col-l-3">
                                                                                    <label for="proNameEn" class="fw-bold">{{__('nav.givenDate')}}</label>
                                                                                </div>

                                                                                <div class="col-sm-12 col-md-9 col-l-9">
                                                                                    <p><span class="text-warning">{{$item->date}}</span></p>
                                                                                </div>
                                                                            </div>

                                                                            <div class="row d-flex align-items-center mt-2">
                                                                                <div class="col-sm-12 col-md-3 col-l-3">
                                                                                    <label for="proNameEn" class="fw-bold">{{__('nav.returnDate')}}</label>
                                                                                </div>

                                                                                <div class="col-sm-12 col-md-9 col-l-9">
                                                                                    <p><span class="text-warning">{{$item->returned_date}}</span></p>
                                                                                </div>
                                                                            </div>

                                                                            {{-- <div class="row d-flex align-items-center mt-2">
                                                                                <div class="col-sm-12 col-md-3 col-l-3">
                                                                                    <label for="proNameEn" class="fw-bold">Return date</label>
                                                                                </div>
                                                                                <div class="col-sm-12 col-md-9 col-l-9">
                                                                                    <p>{{$item->payback_date}}</p>
                                                                                </div>
                                                                            </div> --}}
                                
                                                                            
                                                                            <div class="row d-flex align-items-center mt-2">
                                                                                <div class="col-sm-12 col-md-3 col-l-3">
                                                                                    {{-- <label for="descript" class="fw-bold">Attachment <span class="text-danger"></span></label> --}}
                                                                                </div>
                                                                                <div class="col-sm-12 col-md-9 col-l-9">
                                                                                    @if ($item->attachment != '')
                                                                                        <img class="attachment" src="{{asset($item->attachment)}}" alt="Attachment file">
                                                                                    @else
                                                                                        <i class="text-danger">{{__('nav.nullAtt')}}</i>
                                                                                    @endif
                                                                                </div>
                                                                            </div>
                                                                            <div class="row">
                                                                                <div class="col-12">
                                                                                    <hr>
                                                                                </div>
                                                                            </div>

                                                                            <div class="row d-flex align-items-center mt-2">
                                                                                <div class="col-sm-12 col-md-3 col-l-3">
                                                                                    {{-- <label for="descript" class="fw-bold">Description <span class="text-danger"></span></label> --}}
                                                                                </div>
                                                                                <div class="col-sm-12 col-md-9 col-l-9">
                                                                                  
                                                                                    <p> {{__('nav.approveBy')}} : {{$item->add_by}}</p>
                                                                                    <p> {{__('nav.approveAt')}} : <span class="text-info">{{$item->date}}</span></p>
                                                                                </div>
                                                                            </div>
                                                                            
                                                                        </div>


                                                                        {{-- form request here  --}}

                                                                        {{-- <div class="bg-light p-3 mt-3">
                                                                            <div class="row">
                                                                                <div class="col-sm-12 col-md-3 col-lg-3">

                                                                                </div>
                                                                                <div class="col-sm-12 col-md-9 col-lg-9">
                                                                                    <h3 class="text-primary">
                                                                                        <span class="mdi mdi-cube-send text-primary"></span> Request form
                                                                                    </h3>
                                                                                    <div class="bg-white p-3">
                                                                                        <form action="{{route('request.save')}}" method="post" enctype="multipart/form-data" autocomplete="off">
                                                                                            @csrf
                                                                                            <label for="cardId">Card ID <span class="text-danger">*</span></label>
                                                                                            <input type="text" id="cardId" name="cardId" class="form-control" placeholder="Verify Card ID">
                                                                                            <input type="hidden" class="d-none" style="display: none;" name="proId" value="{{$item->borrow_id}}">
                                                                                            <label for="qty" class="mt-2">Quantity <span class="text-danger">*</span></label>
                                                                                            <div class="form-group">
                                                                                                <div class="input-group">
                                                                                                    <input type="number" name="qty" id="qty" class="form-control" min="0" max="{{$item->qty}}" placeholder="Requset quantity">
                                                                                                    <div class="input-group-prepend">
                                                                                                        <span class="input-group-text">
                                                                                                            / {{$item->qty}}
                                                                                                        </span>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                            <div class="row">
                                                                                                <div class="col-sm-6 col-6">
                                                                                                    <label for="borrowDate">Borrow date <span class="text-danger">*</span></label>
                                                                                                    <input type="date" name="borrowDate" id="borrowDate" class="form-control">
                                                                                                </div>
                                                                                                <div class="col-sm-6 col-6">
                                                                                                    <label for="returnDate">Return date <span class="text-danger">*</span></label>
                                                                                                    <input type="date" name="returnDate" id="returnDate" class="form-control">
                                                                                                    
                                                                                                </div>
                                                                                            </div>
                                                                                            <label for="purpose" class="mt-2">Request purpose <span class="text-danger">*</span></label>
                                                                                            <textarea name="purpose" id="purpose" class="form-control" cols="100" rows="12" placeholder="Requse purpose..."></textarea>
                                                                                           
                                                                                            <label for="attachment{{$item->borrow_id}}" class="mt-2 d-block w-100">Upload attachment <span class="text-danger">*</span></label>
                                                                                            <input type="file" name="attachment" id="attachment{{$item->borrow_id}}" style="display: none;" class="d-none attachment">
                                                                                            <label for="attachment{{$item->borrow_id}}" class="attchLabel">
                                                                                                <div class="attch">
                                                                                                    <img src="" alt="" class="attachmentFile" id="file-attach{{$item->borrow_id}}">
                                                                                                    
                                                                                                    <span class="mdi mdi-attachment-plus text-secondary fs-1" id="draft-img{{$item->borrow_id}}"></span>
                                                                                                </div>
                                                                                            </label>
                                                                                            <small class="text-danger">Fields are required.</small>

                                                                                            <button  @if ($item->delete_status == '1')
                                                                                                type="submit"
                                                                                                @else
                                                                                                type="button"
                                                                                                disabled
                                                                                            @endif class="btn btn-sm btn-primary text-end d-block ms-auto mt-2">
                                                                                                 <span class="mdi mdi-send"></span> Send</button>
                                                                                        </form>
                                                                                    </div>
                                                                                </div>
                                                                                
                                                                            </div>
                                                                        </div> --}}
                                                                        
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                {{-- <button type="button" class="btn btn-secondary btn-sm"
                                                                    data-bs-dismiss="modal">Close</button> --}}
                                                                {{-- <button type="button" class="btn btn-secondary btn-sm text-white" data-bs-dismiss="modal">
                                                                    <span class="mdi mdi-close-circle-outline text-white"></span> Close
                                                                </button> --}}
                                                            </div>
                                                        
                                                    </div>
                                                </div>
                                            </div>

                                        @endforeach
                                 
                                        <!-- Add more rows as needed -->
                                    </tbody>
                                </table>
                            </div>


                            <div class="table-responsive d-none" style="display: none;">                   
                                <table id="exportTB" class="display table table-striped">
                                    <thead>
                                        <tr>
                                            <th style="width: 10px;" class="text-start">{{__('home.no')}}</th>
                                            {{-- <th>{{__('nav.img')}}</th> --}}
                                            <th> {{__('nav.proCode')}} </th>
                                            <th> {{__('nav.proName')}} </th>

                                            <th>{{__('nav.model')}}</th>
                                            <th>{{__('nav.serial_number')}}</th>
                                            <th>{{__('nav.fix_asset_code')}}</th>

                                            <th> {{__('nav.category')}} </th>

                                            {{-- <th> {{__('nav.profile')}} </th> --}}
                                            <th> {{__('nav.staffId')}} </th>
                                            <th> {{__('nav.name')}} </th>
                                            <th> {{__('home.Gender')}} </th>
                                            <th> {{__('home.qty')}} </th>
                                            <th> {{__('nav.givenDate')}} </th>
                                            <th> {{__('nav.returnDate')}} </th>

                                            {{-- <th colspan="2">{{__('nav.statusQty')}}</th> --}}
                                            {{-- <th></th> --}}
                                            {{-- <th> {{__('nav.createAt')}} </th> --}}
                                            {{-- <th>Age</th>
                                            <th>Start date</th> --}}
                                            {{-- <th>{{__('nav.give')}}</th> --}}
                                            {{-- <th class="text-center"> {{__('nav.actions')}} </th> --}}
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $auto = 1;
                                        @endphp
                                        @foreach ($product as $item)
                                            
                                            <tr>
                                                <td style="width: 10px" class="text-start <?php
                                                        if($item->delete_status == '0'){
                                                            echo 'text-danger';
                                                        }
                                                    ?>">{{$auto++}}
                                                </td>

                                                

                                                <td class="<?php
                                                        if($item->delete_status == '0'){
                                                            echo 'text-danger';
                                                        }
                                                    ?>">{{$item -> pro_code}}
                                                </td>
                                                <td class="<?php
                                                        if($item->delete_status == '0'){
                                                            echo 'text-danger';
                                                        }
                                                    ?>">{{$item -> pro_name_en}}
                                                </td>

                                                <td class="<?php
                                                        if($item->delete_status == '0'){
                                                            echo 'text-danger';
                                                        }
                                                    ?>">{{$item -> model}}
                                                </td>

                                                <td class="<?php
                                                        if($item->delete_status == '0'){
                                                            echo 'text-danger';
                                                        }
                                                    ?>">{{$item -> serial_number}}
                                                </td>
                                                <td class="<?php
                                                        if($item->delete_status == '0'){
                                                            echo 'text-danger';
                                                        }
                                                    ?>">{{$item -> fix_asset_code}}
                                                </td>


                                                <td class="<?php
                                                        if($item->delete_status == '0'){
                                                            echo 'text-danger';
                                                        }
                                                    ?>">{{$item -> cat_name}}
                                                </td>

                                                

                                                

                                                
                                                <td class="<?php
                                                        if($item->delete_status == '0'){
                                                            echo 'text-danger';
                                                        }
                                                    ?>">
                                                    {{$item->card_id}}
                                                </td>

                                                 <td class="<?php
                                                        if($item->delete_status == '0'){
                                                            echo 'text-danger';
                                                        }
                                                    ?>">
                                                    @if (session(['localization']) == 'en')
                                                        {{$item->name_en}}
                                                    @else
                                                        {{$item->name_kh}}
                                                    @endif
                                                </td>
                                                
                                                <td class="<?php
                                                        if($item->delete_status == '0'){
                                                            echo 'text-danger';
                                                        }
                                                    ?>">
                                                    @if ($item->gender == 'Male')
                                                        {{(__('nav.male'))}}
                                                    @else
                                                        {{(__('nav.female'))}}
                                                    @endif
                                                    {{-- {{$item->gender}} --}}
                                                </td>

                                                <td class="<?php
                                                        if($item->delete_status == '0'){
                                                            echo 'text-danger';
                                                        }
                                                    ?>">
                                                    <span class="badge badge-info">{{$item->qty}}</span>
                                                </td>

                                                <td class="<?php
                                                        if($item->delete_status == '0'){
                                                            echo 'text-danger';
                                                        }
                                                    ?>">
                                                    {{$item->date}}
                                                </td>
                                                <td class="<?php
                                                        if($item->delete_status == '0'){
                                                            echo 'text-danger';
                                                        }
                                                    ?>">
                                                    {{$item->returned_date}}
                                                </td>
                                            </tr>                   
                                        @endforeach
                                 
                                        <!-- Add more rows as needed -->
                                    </tbody>
                                </table>
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
    @foreach ($product as $item)

        <script>
            document.getElementById('attachment{{$item->id}}').addEventListener('change', function(event) {
                const file = event.target.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        const preview = document.getElementById('file-attach{{$item->id}}');
                        const draftImg = document.getElementById('draft-img{{$item->id}}');
                        preview.src = e.target.result;
                        preview.style.display = 'block'; // Show the image
                        draftImg.style.display= 'none';
                    };
                    reader.readAsDataURL(file);
                }
            });
        </script>

    @endforeach
    <script>
        $(document).ready(function () {
            $('#departmentTb').DataTable();
            $('.selectpicker').selectpicker();
            // $("#chosen_select").selectpicker();

            // $('#attachment').on('change', function(event) {
            //     const file = event.target.files[0];
            //     if (file) {
            //         const reader = new FileReader();
            //         reader.onload = function(e) {
            //             $('#file-attach').attr('src', e.target.result).show();
            //         };
            //         reader.readAsDataURL(file);
            //     }
            // });
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
                        timer: 4000,
                        timerProgressBar: true,
                        didOpen: (toast) => {
                            toast.onmouseenter = Swal.stopTimer;
                            toast.onmouseleave = Swal.resumeTimer;
                        }
                        });
                        Toast.fire({
                        icon: "success",
                        title: "Product has returned."
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

    @if (session() -> has('error'))
        <script>
            const Toast = Swal.mixin({
                        toast: true,
                        position: "top-end",
                        showConfirmButton: false,
                        timer: 4000,
                        timerProgressBar: true,
                        didOpen: (toast) => {
                            toast.onmouseenter = Swal.stopTimer;
                            toast.onmouseleave = Swal.resumeTimer;
                        }
                        });
                        Toast.fire({
                        icon: "error",
                        title: "Operating unsuccessful."
                        });
        </script>
    @endif
    @if (session() -> has('requested'))
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
                        title: "Reqest has sent."
                        });
        </script>
    @endif

    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.17.0/xlsx.full.min.js"></script> --}}
    <script src="{{asset('jquery/xlsx.full.min.js')}}"></script>
    <script src="{{asset('jquery/jspdf.umd.min.js')}}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#export-btn').click(function() {
                // Get the table element
                var table = document.getElementById("exportTB");
                
                // Create a new workbook
                var wb = XLSX.utils.table_to_book(table, {sheet: "Sheet 1"});
                
                // Export the workbook to an Excel file
                XLSX.writeFile(wb, "product-returned.xlsx");
            });
        });
    </script>
<script>
    $(document).ready(function(){
        // $('#sidebar-menu li').remoeClass('active');
        // $('#sidebar-menu li ul li').remoeClass('active collapse');

        
        $('#givenAndReturned').addClass('nav-item active');
        $('#error').addClass('collapse show');

    });
</script>
    


@endsection