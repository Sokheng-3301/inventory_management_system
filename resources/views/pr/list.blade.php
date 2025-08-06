@extends('layout/master')

@section('title')
<title> {{__('nav.purchasing')}} | IMS</title>
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
</style>
@endsection


@section('content')


<div class="content-wrapper">
    <div class="row">
        <div class="col-md-12 grid-margin">
            <div class="row">
                <div class="col-12 col-xl-8 mb-4 mb-xl-0">
                    <h3 class="font-weight-bold">{{__('nav.productPurchase')}} </h3>
                    <h6 class="font-weight-normal mb-0">{{__('nav.purchasing')}}  / <span class="text-primary"><a class="text-primary"
                                href="">{{__('nav.list')}} </a></span></h6>
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
                                        <a href="{{route('purchase.request')}}" class="btn btn-sm btn-primary"><span
                                            class="mdi mdi-plus"></span> {{__('nav.addNew')}}</a>
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
                                            
                                            <th> {{__('nav.requester')}} </th>
                                            <th> {{__('nav.department')}}</th>
                                            <th>{{__('nav.proName')}}</th>
                                            <th>{{__('nav.model')}}</th>
                                            <th> {{__('home.qty')}}</th>
                                            <th> {{__('nav.price_unit')}}</th>
                                            <th> {{__('nav.category')}}</th>
                                            <th> {{__('nav.status')}}</th>
                                            <th>{{__('nav.Description')}}</th>
                                            <th> {{__('nav.purpose')}}</th>
                                            <th> {{__('nav.purchasedate')}} </th>
                                            <th> {{ __('nav.deleteAt') }} </th>
                                            <th> {{ __('nav.deleteBy') }} </th>
                                            <th> {{__('nav.actions')}} </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $auto = 1;
                                        @endphp
                                        @foreach ($purchasings as $item)
                                            
                                            <tr>
                                                <td style="width: 10px" class="text-start <?php
                                                        if($item->pr_delete_status == '0'){
                                                            echo 'text-danger';
                                                        }
                                                    ?>">{{$auto++}}
                                                </td>
                                                
                                                <td class="<?php
                                                        if($item->pr_delete_status == '0'){
                                                            echo 'text-danger';
                                                        }
                                                    ?>">
                                                    @if ((session()->has('localization')) && (session('localization') == 'en'))
                                                        {{ $item->name_en }}
                                                    @else
                                                        {{ $item->name_kh }}
                                                    @endif
                                                </td>
                                                <td class="<?php
                                                        if($item->pr_delete_status == '0'){
                                                            echo 'text-danger';
                                                        }
                                                    ?>"> @if ((session()->has('localization')) && (session('localization') == 'en'))
                                                        {{ $item->dep_name_en }}
                                                    @else
                                                        {{ $item->dep_name_kh }}
                                                    @endif
                                                </td>

                                                <td class="<?php
                                                        if($item->pr_delete_status == '0'){
                                                            echo 'text-danger';
                                                        }
                                                    ?>">
                                                    @if ((session()->has('localization')) && (session('localization') == 'en'))
                                                        {{ $item->pro_name }}
                                                    @else
                                                        {{ $item->pro_name_kh }}
                                                    @endif
                                                </td>

                                                <td class="<?php
                                                        if($item->pr_delete_status == '0'){
                                                            echo 'text-danger';
                                                        }
                                                    ?>">{{$item -> model}}
                                                </td>
                                                
                                                


                                                <td class="<?php
                                                        if($item->pr_delete_status == '0'){
                                                            echo 'text-danger';
                                                        }
                                                    ?>">{{$item -> qty}}
                                                </td>

                                                
                                                
                                                <td class="<?php
                                                        if($item->pr_delete_status == '0'){
                                                            echo 'text-danger';
                                                        }
                                                    ?>"> {{$item -> price_unit}}
                                                </td>



                                                <td class="<?php
                                                        if($item->pr_delete_status == '0'){
                                                            echo 'text-danger';
                                                        }
                                                    ?>"> {{$item -> cat_name}}
                                                </td>

                                                <td class="<?php
                                                    if($item->pr_delete_status == '0'){
                                                            echo 'text-danger';
                                                        }
                                                    ?>">
                                                    @if ($item->purchase_status == '0')
                                                        <span class="badge badge-warning"> {{ __('nav.purchasing') }} </span>
                                                    @else
                                                        <span class="badge badge-success">{{ __('nav.donePurchase') }}</span>
                                                    @endif
                                                </td>


                                                <td class="<?php
                                                        if($item->pr_delete_status == '0'){
                                                            echo 'text-danger';
                                                        }
                                                    ?>">{{$item -> description}}
                                                </td>


                                                <td class="<?php
                                                        if($item->pr_delete_status == '0'){
                                                            echo 'text-danger';
                                                        }
                                                    ?>"> {{$item -> purpose}}
                                                </td>


                                                <td class="<?php
                                                        if($item->pr_delete_status == '0'){
                                                            echo 'text-danger';
                                                        }
                                                    ?>">
                                                    {{$item->pr_date}}
                                                </td>
                                                

                                                <td class="<?php
                                                        if($item->pr_delete_status == '0'){
                                                            echo 'text-danger';
                                                        }
                                                    ?>">
                                                    {{$item->pr_delete_date}}
                                                </td>

                                                <td class="<?php
                                                        if($item->pr_delete_status == '0'){
                                                            echo 'text-danger';
                                                        }
                                                    ?>">
                                                    {{$item->pr_delete_by}}
                                                </td>
                                                {{-- @if(strtolower($checkRole->role_name) == 'admin' || strtolower($checkRole->role_name) == 'super-admin')
                                                    <td class="<php
                                                            if($item->pr_delete_status == '0'){
                                                                echo 'text-danger';
                                                            }
                                                        ?>"> <span type="button" data-bs-toggle="modal" data-bs-target="#giveForm{{$item->id}}" class="badge badge-success give-btn" style="cursor: pointer;">
                                                                <span class="mdi mdi-hand-coin"></span> {{__('nav.give')}}
                                                            </span>
                                                    </td>
                                                @endif --}}

                                                    
                                               
                                                
                                               
                                                <td>
                                                    <a type="button" data-bs-toggle="modal" data-bs-target="#updateForm{{$item->purchase_id}}" ><span class="mdi mdi-eye-outline fs-5 text-primary" title="View detail"></span></a> 

                                                    @if (($checkRole->role_name == 'admin' || $checkRole->role_name == 'Admin') || $action->action_edit == 1)
                                                        | <a href="{{route('purchase.receive', $item->purchase_id)}}"><span class="mdi mdi-cart-arrow-down fs-5 text-primary" title="Receive product"></span></a>
                                                    @endif
                                                    
                                                    @if (($checkRole->role_name == 'admin' || $checkRole->role_name == 'Admin') || $action->action_edit == 1)
                                                        | <a href="{{route('purchase.edit', $item->purchase_id)}}"><span class="mdi mdi-square-edit-outline fs-5 text-success" title="Update data"></span></a>
                                                    @endif



                                                    @if (($checkRole->role_name == 'admin' || $checkRole->role_name == 'Admin') || $action->action_delete == 1) 
                                                        |
                                                        @if ($item->pr_delete_status == '0')
                                                            <a type="button" data-bs-toggle="modal" data-bs-target="#recoveryCategory{{$item->purchase_id}}"><span class="mdi mdi-backup-restore fw-bold text-success fs-5" title="Recovery data"></span></a>
                                                        
                                                        @else 
                                                            <a type="button" data-bs-toggle="modal" data-bs-target="#deleteVerify{{$item->purchase_id}}"><span class="mdi mdi-trash-can-outline text-danger fs-5" title="Delete data"></span></a>
                                                        @endif
                                                    @endif
                                                </td>
                                            </tr>




                                            {{-- @if(strtolower($checkRole->role_name) == 'admin' || strtolower($checkRole->role_name) == 'super-admin') 

                                                <div class="modal fade" id="giveForm{{$item->id}}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="giveForm{{$item->id}}Label" aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-centere modal-lg">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h1 class="modal-title fs-5" id="giveForm{{$item->id}}"><span class="mdi mdi-book-open"></span> {{__('nav.giveForm')}}</h1>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                                    aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="row">
                                                                    <div class="col-sm-12 col-md-4 ">
                                                                        <div class="bg-light p-3">
                                                                            <p class="fw-bold text-center text-primary"> {{__('nav.proImg')}} </p>
                                                                            <label for="productImg" id="proImg">
                                                                                <span class="mdi mdi-image"></span>
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
                                                                            <small class="text-center d-block"> {{__('nav.proImg')}}.</small>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-sm-12 col-md-8">
                                                                        <div class="bg-light p-3">
                                                                            <p class="fw-bold text-center text-primary">{{__('nav.proInfo')}}</p>
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
                                                                                    <label for="proNameKh" class="fw-bold"> {{__('nav.proNameKh')}} </label>
                                                                                </div>
                                                                                <div class="col-sm-12 col-md-9 col-l-9">
                                                                                    <p>{{$item->pro_name_kh}}</p>
                                                                                </div>
                                                                            </div>
                                
                                                                            <div class="row d-flex align-items-center mt-2">
                                                                                <div class="col-sm-12 col-md-3 col-l-3">
                                                                                    <label for="proNameEn" class="fw-bold"> {{__('nav.proNameEn')}} </label>
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
                                                                                    <label for="proNameEn" class="fw-bold"> {{__('nav.categoryName')}} </label>
                                                                                </div>
                                                                                <div class="col-sm-12 col-md-9 col-l-9">
                                                                                    <p>{{$item->cat_name}}</p>
                                                                                </div>
                                                                            </div>
                                
                                                                            
                                
                                                                            <div class="row d-flex align-items-center mt-2">
                                                                                <div class="col-sm-12 col-md-3 col-l-3">
                                                                                    <label for="qty" class="fw-bold"> {{__("home.qty")}} </label>
                                                                                </div>
                                                                                <div class="col-sm-12 col-md-9 col-l-9">
                                                                                    <p>{{$item->qty}} 
                                                                                        @if ($item->stock_status == '0')
                                                                                            <small class="badge bg-danger ms-3 d-inline-block">
                                                                                                {{__('nav.Outstock')}}
                                                                                            </small>
                                                                                        @else
                                                                                            <small class="badge badge-primary ms-3 d-inline-block">
                                                                                                {{__('nav.Instock')}}
                                                                                            </small>
                                                                                        @endif    
                                                                                    </p>

                                                                                </div>
                                                                            </div>
                                


                                                                            <div class="row d-flex align-items-center mt-2">
                                                                                <div class="col-sm-12 col-md-3 col-l-3">
                                                                                    <label for="descript" class="fw-bold"> {{__('nav.Description')}} <span class="text-danger"></span></label>
                                                                                </div>
                                                                                <div class="col-sm-12 col-md-9 col-l-9">
                                                                                    <p>{{$item->pro_description}}</p>
                                                                                </div>
                                                                            </div>
                                                                            <div class="row">
                                                                                <div class="col-12">
                                                                                    <hr>
                                                                                </div>
                                                                            </div>

                                                                            <div class="row d-flex align-items-center mt-2">
                                                                                <div class="col-sm-12 col-md-3 col-l-3">
                                                                                </div>
                                                                                <div class="col-sm-12 col-md-9 col-l-9">
                                                                                    <p> {{__('nav.createAt')}} : {{$item->create_date}}</p>
                                                                                    <p> {{__('nav.createBy')}} : {{$item->add_by}}</p>

                                                                                    @if ($item->pr_delete_status == 0)
                                                                                    <p class="text-danger"> {{__('nav.deleteAt')}} : {{$item->delete_date}}</p>
                                                                                    <p class="text-danger"> {{__('nav.deleteBy')}} : {{$item->delete_by}}</p>
                                                                                    @endif
                                                                                </div>
                                                                            </div>
                                                                            
                                                                        </div>



                                                                        <div class="bg-light p-3 mt-3">
                                                                            <div class="row">
                                                                                <div class="col-sm-12 col-md-3 col-lg-3">

                                                                                </div>
                                                                                <div class="col-sm-12 col-md-9 col-lg-9">
                                                                                    <h3 class="text-primary">
                                                                                        <span class="mdi mdi-cube-send text-primary"></span> {{__('nav.giveForm')}}
                                                                                    </h3>
                                                                                    <div class="bg-white p-3">
                                                                                        <form action="{{route('product.given')}}" method="post" enctype="multipart/form-data" autocomplete="off" class="ui form">
                                                                                            @csrf
                                                                                            <input type="hidden" class="d-none" name="product_id" value="{{$item->id}}">
                                                                                            <label for="userGiven">{{__('nav.giveTo')}} <span class="text-danger">*</span></label>

                                                                                            <select name="userAccount" id="userAccount" class="ui search dropdown d-block w-100">
                                                                                                <option selected>Select user</option>
                                                                                                @php
                                                                                                    $no = 1;
                                                                                                @endphp
                                                                                                @foreach ($users as $user)
                                                                                                    <option value="{{$user->id}}">{{$no++.  '. ID: '. $user->card_id .' - '. $user->name_en}}</option>
                                                                                                @endforeach
                                                                                            </select>
                                                                                            <label for="qty" class="mt-2"> {{__('home.qty')}} <span class="text-danger">*</span></label>

                                                                                            <div class="form-group">
                                                                                                <div class="input-group">
                                                                                                    <input type="number" name="qty" id="qty" class="form-control" min="0" max="{{$item->qty}}" placeholder="{{__('home.qty')}}">
                                                                                                    <div class="input-group-prepend">
                                                                                                        <span class="input-group-text">
                                                                                                            / {{$item->qty}}
                                                                                                        </span>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                            <div class="row">
                                                                                                <div class="col-sm-12 col-12">
                                                                                                    <label for="giveDate"> {{__('nav.date')}} <span class="text-danger">*</span></label>
                                                                                                    <input type="date" name="giveDate" id="giveDate" class="form-control">
                                                                                                </div>
                                                                                                
                                                                                            </div>
                                                                                            
                                                                                            <label for="attachment{{$item->id}}" class="mt-2 d-block w-100"> {{__('nav.uploadAtt')}} <span class="text-danger">*</span></label>
                                                                                            <input type="file" name="attachment" id="attachment{{$item->id}}" style="display: none;" class="d-none attachment" accept="image/*">
                                                                                            <label for="attachment{{$item->id}}" class="attchLabel">
                                                                                                <div class="attch">
                                                                                                    <img src="" alt="" class="attachmentFile" id="file-attach{{$item->id}}">
                                                                                                    
                                                                                                    <span class="mdi mdi-attachment-plus text-secondary fs-1" id="draft-img{{$item->id}}"></span>
                                                                                                </div>
                                                                                            </label>
                                                                                            <small class="text-danger"> {{__('nav.requiredField')}} </small>

                                                                                            <button  @if (($item->pr_delete_status == '1') && ($item->stock_status == '1'))
                                                                                                type="submit"
                                                                                                @else
                                                                                                type="button"
                                                                                                disabled
                                                                                            @endif class="btn btn-sm btn-primary text-end d-block ms-auto mt-2">
                                                                                                <span class="mdi mdi-content-save-check"></span> {{__('nav.submit')}}</button>
                                                                                        </form>
                                                                                    </div>
                                                                                </div>
                                                                                
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary btn-sm"
                                                                    data-bs-dismiss="modal">Close</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                            @endif --}}


                                                            
                                            <!-- Modal Delete-->

                                            <div class="modal fade" id="deleteVerify{{$item->purchase_id}}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="deleteVerify{{$item->purchase_id}}Label" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-top">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h1 class="modal-title fs-5" id="deleteVerify{{$item->purchase_id}}"> {{__('nav.warning')}} </h1>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                                aria-label="Close"></button>
                                                        </div>
                                                        <form action="{{route('purchase.delete', ['id' => $item->purchase_id])}}" method="post" autocomplete="off">
                                                            <div class="modal-body">
                                                                @csrf
                                                                <input type="hidden" class="d-none" name="proId" value="{{$item->id}}">
                                                                <label for="" class="fs-5"> {{__('nav.deleteQuestion')}} <span class="text-danger fw-bold">{{$item->name_kh . ' - ' . $item->name_en}}</span>?</label>
                                                                {{-- <label for="categoryName">Category name </label>
                                                                <input type="text" id="categoryName" class="form-control" name="categoryName" placeholder="Category name" value="{{$item -> department_name}}"> --}}
                                                            </div>
                                                            <div class="modal-footer">
                                                                {{-- <button type="button" class="btn btn-secondary btn-sm"
                                                                    data-bs-dismiss="modal">Close</button> --}}
                                                                <button type="submit" class="ui button red">
                                                                    <span class="mdi mdi-check-circle-outline"></span> {{__('nav.delete')}}
                                                                </button>
                                                            </div>
                                                        </form>
                                                        
                                                    </div>
                                                </div>
                                            </div>

                           

                                             <!-- Modal recovery-->
                                            <div class="modal fade" id="recoveryCategory{{$item->purchase_id}}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="recoveryCategory{{$item->purchase_id}}Label" aria-hidden="true">
                                                
                                                <div class="modal-dialog modal-dialog-top">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h1 class="modal-title fs-5" id="recoveryCategory{{$item->purchase_id}}"> {{__('nav.reoveryTitle')}} </h1>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                                aria-label="Close"></button>
                                                        </div>
                                                        <form action="{{route('purchase.recovery', ['id'=>$item->purchase_id])}}" method="post" autocomplete="off">

                                                            <div class="modal-body">
                                                                @csrf
                                                                <input type="hidden" class="d-none" name="proId" value="{{$item->id}}">
                                                                <label for="" class="fs-5"> {{__('nav.recoveryQuest')}} <span class="text-primary fw-bold">{{$item->name_kh . ' - ' . $item->name_en}}</span>?</label>
                                                                {{-- <label for="categoryName">Category name </label>
                                                                <input type="text" id="categoryName" class="form-control" name="categoryName" placeholder="Category name" value="{{$item -> department_name}}"> --}}
                                                            </div>
                                                            <div class="modal-footer">
                                                                {{-- <button type="button" class="btn btn-secondary btn-sm"
                                                                    data-bs-dismiss="modal">Close</button> --}}
                                                                <button type="submit" class="ui button primary">
                                                                    <span class="mdi mdi-backup-restore"></span> {{__('nav.recovery')}}
                                                                </button>
                                                            </div>
                                                        </form>
                                                        
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                 
                                        <!-- Add more rows as needed -->
                                    </tbody>
                                </table>
                            </div>

                            @foreach ($purchasings as $item)
                                <!-- Modal detail-->
                                <div class="modal fade" id="updateForm{{$item->purchase_id}}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="updateForm{{$item->purchase_id}}Label" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5" id="updateForm{{$item->purchase_id}}"><span class="mdi mdi-book-open"></span> {{__('nav.purchaseRequestDetail')}}</h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>

                                            <div class="modal-body">
                                                <div class="row">
                                                    <div class="col-sm-12 col-md-5 mb-3 mx-auto">
                                                        <div class="bg-light p-3">
                                                            {{-- <p class="fw-bold text-center text-primary">{{__('nav.userDetail')}}</p> --}}
                                                            <div class="col-4 mx-auto">
                                                                @if ($item->profile == '')
                                                                        <img src="{{asset('images/draft-user.jpg')}}" alt="" width="100%">
                                                                    @else
                                                                        <img src="{{asset( $item->profile)}}" alt="" width="100%">
                                                                    @endif
                                                            </div>
                                                            <div class="row mt-4">
                                                                <div class="col-4">
                                                                    <label for="">{{__('nav.name')}}</label>
                                                                </div>
                                                                <div class="col-8">
                                                                    <span class="pe-3">:</span>
                                                                    {{$item->name_kh}} - {{$item->name_en}}
                                                                </div>

                                                                <div class="col-4">
                                                                    <label for="">{{__('nav.staffId')}}</label>
                                                                </div>
                                                                <div class="col-8">
                                                                    <span class="pe-3">:</span>
                                                                    {{$item->card_id}}
                                                                </div>

                                                                <div class="col-4">
                                                                    <label for="">{{__('nav.gender')}}</label>
                                                                </div>
                                                                <div class="col-8">
                                                                    <span class="pe-3">:</span>
                                                                    {{$item->gender}}
                                                                </div>

                                                                <div class="col-4">
                                                                    <label for="">{{__('nav.department')}}</label>
                                                                </div>
                                                                <div class="col-8">
                                                                    <span class="pe-3">:</span>
                                                                    @if (session(['localization']) !== 'kh')
                                                                        {{$item->dep_name_en}}
                                                                    @else
                                                                        {{$item->dep_name_kh}}
                                                                    @endif
                                                                </div>

                                                                <div class="col-4">
                                                                    <label for="">{{__('nav.position')}}</label>
                                                                </div>
                                                                <div class="col-8">
                                                                    <span class="pe-3">:</span>
                                                                    {{$item->position_name}}
                                                                </div>


                                                                <div class="col-4">
                                                                    <label for="">{{__('nav.section')}}</label>
                                                                </div>
                                                                <div class="col-8">
                                                                    <span class="pe-3">:</span>
                                                                    @if (session('localization') == 'en')
                                                                        {{$item->section_en}}
                                                                    @else
                                                                        {{$item->section_kh}}
                                                                    @endif
                                                                </div>
                                                                <div class="col-4">
                                                                    <label for="">{{__('nav.phoneNumber')}}</label>
                                                                </div>
                                                                <div class="col-8">
                                                                    <span class="pe-3">:</span>
                                                                    {{$item->phone_number}}
                                                                </div>

                                                                <div class="col-4">
                                                                    <label for="">{{__('nav.emailAddress')}}</label>
                                                                </div>
                                                                <div class="col-8">
                                                                    <span class="pe-3">:</span>
                                                                    {{$item->email_address}}
                                                                </div>

                                                                <hr>

                                                               

                                                                <div class="col-4">
                                                                    <label for="">{{__('nav.createBy')}}</label>
                                                                </div>
                                                                <div class="col-8">
                                                                    <span class="pe-3">:</span>
                                                                    {{$item->purchaser}}
                                                                </div>

                                                                <div class="col-4">
                                                                    <label for="">{{__('nav.purchasedate')}}</label>
                                                                </div>
                                                                <div class="col-8">
                                                                    <span class="pe-3">:</span>
                                                                    {{$item->pr_date}}
                                                                </div>
                                                                
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-sm-12 col-md-7">
                                                        <div class="bg-light p-3">
                                                            <div class="col-sm-12 p-0">
                                                                <label class="fw-bold">{{__('nav.product')}}</label>
                                                            </div>
                                                            <div class="table-responsive">
                                                                <table class="display table table-striped">
                                                                    <thead>
                                                                        <tr>
                                                                            <th>{{__("nav.proNameKh")}}</th>
                                                                            <th>{{__("nav.proName")}}</th>
                                                                            <th>{{__("nav.model")}}</th>
                                                                            <th>{{__("home.qty")}}</th>
                                                                            <th>{{__("nav.category")}}</th>
                                                                    </thead>
                                                                    <tbody>
                                                                        <tr>
                                                                            <td>{{ $item->pro_name_kh }}</td>
                                                                            <td>{{ $item->pro_name }}</td>
                                                                            <td>{{ $item->model }}</td>
                                                                            <td>{{ $item->qty }}</td>
                                                                            <td>{{ $item->cat_name }}</td>
                                                                        </tr>
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                            <div class="row my-4">
                                                                <div class="col-md-3">
                                                                    <label for="">{{ __("nav.Description") }}</label>
                                                                </div>
                                                                <div class="col-md-9">
                                                                    {{ $item->description }}
                                                                </div>
    
                                                                <div class="col-md-3">
                                                                    <label for="">{{ __("nav.purpose") }}</label>
                                                                </div>
                                                                <div class="col-md-9">
                                                                    {{ $item->purpose }}
                                                                </div>
                                                            </div>

                                                            <hr>

                                                            
                                                            
                                                                {{-- <div class="row d-flex align-items-center mt-2">
                                                                    <div class="col-sm-12 col-md-3 col-l-3">
                                                                        <label for="proNameEn" class="fw-bold">{{__('nav.givenDate')}}</label>
                                                                    </div>

                                                                    <div class="col-sm-12 col-md-9 col-l-9">
                                                                        <p><span class="text-warning">{{$item->date}}</span></p>
                                                                    </div>
                                                                </div> --}}


                                                                
                                                            <div class="col-sm-12 mt-5 p-0">
                                                                <label for="proNameEn" class="fw-bold">{{__('nav.evidence')}}</label>
                                                            </div>
                                                            <div class="row d-flex align-items-center mt-2">
                                                                <div class="col-sm-12 col-md-12">
                                                                    @if ($item->att != '')
                                                                        @php
                                                                            $explodeImage = explode(',', $item->att);
                                                                        @endphp
                                                                        @foreach ($explodeImage as $exImage) 
                                                                            <img class="attachment" src="{{asset($exImage)}}" alt="Attachment file" width="100%">
                                                                        @endforeach

                                                                    @else
                                                                        <i class="text-danger">{{__('nav.nullAtt')}}</i>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                                
                                                                
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="modal-footer">
                                                <button type="button" class="ui button mini grey"
                                                    data-bs-dismiss="modal"><span class="mdi mdi-close"></span> {{ __('nav.close') }} </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach


                            <div class="table-responsive d-none" style="display: none;">                   

                                <table id="exportTB" class="display table table-striped">
                                    <thead>
                                        <tr>
                                            <th style="width: 10px;" class="text-start">{{__('home.no')}}</th>
                                            
                                            <th> {{__('nav.requester')}} </th>
                                            <th> {{__('nav.department')}}</th>
                                            <th>{{__('nav.proName')}}</th>
                                            <th>{{__('nav.model')}}</th>
                                            <th> {{__('home.qty')}}</th>
                                            <th> {{__('nav.price_unit')}}</th>
                                            <th> {{__('nav.category')}}</th>
                                            <th> {{__('nav.status')}}</th>
                                            <th>{{__('nav.Description')}}</th>
                                            <th> {{__('nav.purpose')}}</th>
                                            <th> {{__('nav.purchasedate')}} </th>
                                            <th> {{ __('nav.deleteAt') }} </th>
                                            <th> {{ __('nav.deleteBy') }} </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $auto = 1;
                                        @endphp
                                        @foreach ($purchasings as $item)
                                            
                                            <tr>
                                                <td style="width: 10px" class="text-start <?php
                                                        if($item->pr_delete_status == '0'){
                                                            echo 'text-danger';
                                                        }
                                                    ?>">{{$auto++}}
                                                </td>
                                                
                                                <td class="<?php
                                                        if($item->pr_delete_status == '0'){
                                                            echo 'text-danger';
                                                        }
                                                    ?>">
                                                    @if ((session()->has('localization')) && (session('localization') == 'en'))
                                                        {{ $item->name_en }}
                                                    @else
                                                        {{ $item->name_kh }}
                                                    @endif
                                                </td>
                                                <td class="<?php
                                                        if($item->pr_delete_status == '0'){
                                                            echo 'text-danger';
                                                        }
                                                    ?>"> @if ((session()->has('localization')) && (session('localization') == 'en'))
                                                        {{ $item->dep_name_en }}
                                                    @else
                                                        {{ $item->dep_name_kh }}
                                                    @endif
                                                </td>

                                                <td class="<?php
                                                        if($item->pr_delete_status == '0'){
                                                            echo 'text-danger';
                                                        }
                                                    ?>">
                                                    @if ((session()->has('localization')) && (session('localization') == 'en'))
                                                        {{ $item->pro_name }}
                                                    @else
                                                        {{ $item->pro_name_kh }}
                                                    @endif
                                                </td>

                                                <td class="<?php
                                                        if($item->pr_delete_status == '0'){
                                                            echo 'text-danger';
                                                        }
                                                    ?>">{{$item -> model}}
                                                </td>
                                                
                                                


                                                <td class="<?php
                                                        if($item->pr_delete_status == '0'){
                                                            echo 'text-danger';
                                                        }
                                                    ?>">{{$item -> qty}}
                                                </td>

                                                
                                                
                                                <td class="<?php
                                                        if($item->pr_delete_status == '0'){
                                                            echo 'text-danger';
                                                        }
                                                    ?>"> {{$item -> price_unit}}
                                                </td>



                                                <td class="<?php
                                                        if($item->pr_delete_status == '0'){
                                                            echo 'text-danger';
                                                        }
                                                    ?>"> {{$item -> cat_name}}
                                                </td>

                                                <td class="<?php
                                                    if($item->pr_delete_status == '0'){
                                                            echo 'text-danger';
                                                        }
                                                    ?>">
                                                    @if ($item->purchase_status == '0')
                                                        <span class="badge badge-warning"> {{ __('nav.purchasing') }} </span>
                                                    @else
                                                        <span class="badge badge-success">{{ __('nav.donePurchase') }}</span>
                                                    @endif
                                                </td>


                                                <td class="<?php
                                                        if($item->pr_delete_status == '0'){
                                                            echo 'text-danger';
                                                        }
                                                    ?>">{{$item -> description}}
                                                </td>


                                                <td class="<?php
                                                        if($item->pr_delete_status == '0'){
                                                            echo 'text-danger';
                                                        }
                                                    ?>"> {{$item -> purpose}}
                                                </td>


                                                <td class="<?php
                                                        if($item->pr_delete_status == '0'){
                                                            echo 'text-danger';
                                                        }
                                                    ?>">
                                                    {{$item->pr_date}}
                                                </td>
                                                

                                                <td class="<?php
                                                        if($item->pr_delete_status == '0'){
                                                            echo 'text-danger';
                                                        }
                                                    ?>">
                                                    {{$item->pr_delete_date}}
                                                </td>

                                                <td class="<?php
                                                        if($item->pr_delete_status == '0'){
                                                            echo 'text-danger';
                                                        }
                                                    ?>">
                                                    {{$item->pr_delete_by}}
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

    {{-- @foreach ($product as $item)
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

    @foreach ($product as $item)

        <script>
            document.getElementById('attachmentRequest{{$item->id}}').addEventListener('change', function(event) {
                const file = event.target.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        const preview = document.getElementById('file-attachRequest{{$item->id}}');
                        const draftImg = document.getElementById('draft-imgRequest{{$item->id}}');
                        preview.src = e.target.result;
                        preview.style.display = 'block'; // Show the image
                        draftImg.style.display= 'none';
                    };
                    reader.readAsDataURL(file);
                }
            });
        </script>

    @endforeach --}}


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
                        title: "Operating successfully."
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
                XLSX.writeFile(wb, "purchase-request.xlsx");
            });
        });
    </script>
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

    <script>
        $(document).ready(function(){
            // $('#sidebar-menu li').remoeClass('active');
            // $('#sidebar-menu li ul li').remoeClass('active collapse');

            
        });
    </script>



@endsection