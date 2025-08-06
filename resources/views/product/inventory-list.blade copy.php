@extends('layout/master')

@section('title')
<title> {{__('nav.inventory_list')}} | IMS</title>
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
                    <h3 class="font-weight-bold">{{__('nav.inventory_list')}} </h3>
                    <h6 class="font-weight-normal mb-0">{{__('nav.all_inventory_list')}}</h6>
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
                                            class="mdi mdi-plus"></span> {{__('nav.addNew')}}</a> --}}
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
                                            {{-- <th> {{__('nav.proCode')}} </th> --}}
                                            <th> {{__('nav.proName')}}</th>

                                            <th>{{__('nav.model')}}</th>
                                            <th>{{__('nav.serial_number')}}</th>
                                            <th>{{__('nav.fix_asset_code')}}</th>

                                            <th> {{__('nav.category')}}</th>
                                            <th>{{__('home.qty')}}</th>
                                            {{-- <th></th> --}}
                                            {{-- <th> {{__('nav.createAt')}} </th> --}}
                                            {{-- <th>Age</th>
                                            <th>Start date</th> --}}

                                            {{-- @php
                                                $checkRole = DB::table('users')
                                                                ->select('users.role_id', 'user_roles.role_name')
                                                                ->join('user_roles', 'users.role_id', '=', 'user_roles.id')
                                                                ->where('users.role_id', @Auth::user()->role_id)
                                                                ->get()->first();
                                                @endphp
                                                @if(strtolower($checkRole->role_name) == 'admin' || strtolower($checkRole->role_name) == 'super-admin')
                                                    <th>{{__('nav.give')}}</th>
                                                @endif --}}
                                                
                                          


                                            <th> {{__('nav.actions')}} </th>
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
                                                {{-- <td class="<php
                                                        if($item->delete_status == '0'){
                                                            echo 'text-danger';
                                                        }
                                                    ?>">{{$item -> pro_code}}
                                                </td> --}}
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


                                                 <td class="">
                                                    <span  class="ui tiny orange label">
                                                        {{-- <i class="shopping bag icon"></i>  --}}
                                                        {{$item->fix_qty}}
                                                    </span>
                                                </td>
                                               
                                                <td>
                                                    <a type="button" data-bs-toggle="modal" data-bs-target="#updateForm{{$item->id}}" ><span class="mdi mdi-eye-outline fs-5 text-primary" title="View detail"></span></a> 

                                                    {{-- @if (($checkRole->role_name == 'admin' || $checkRole->role_name == 'Admin') || $action->action_edit == 1)
                                                        | <a href="{{route('product.edit', $item->id)}}"><span class="mdi mdi-square-edit-outline fs-5 text-primary" title="Update data"></span></a>
                                                    @endif

                                                    @if (($checkRole->role_name == 'admin' || $checkRole->role_name == 'Admin') || $action->action_delete == 1) 
                                                        |
                                                        @if ($item->delete_status == '0')
                                                            <a type="button" data-bs-toggle="modal" data-bs-target="#recoveryCategory{{$item->id}}"><span class="mdi mdi-backup-restore fw-bold text-success fs-5" title="Recovery data"></span></a>
                                                        
                                                        @else 
                                                            <a type="button" data-bs-toggle="modal" data-bs-target="#deleteVerify{{$item->id}}"><span class="mdi mdi-trash-can-outline text-danger fs-5" title="Delete data"></span></a>
                                                        @endif
                                                    @endif --}}
                                                </td>
                                            </tr>

                                           
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>

                            @foreach ($product as $item)
                                 <!-- Modal detail-->
                                 <div class="modal fade" id="updateForm{{$item->id}}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="updateForm{{$item->id}}Label" aria-hidden="true">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5" id="updateForm{{$item->id}}"><span class="mdi mdi-book-open"></span> {{__('nav.proDetail')}}</h1>
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
                                                                    {{-- <p> --}}
                                                                        <div class="ui tiny orange label">
                                                                            {{$item->fix_qty}} 
                                                                          </div>
                                                                        {{-- @if ($item->stock_status == '0')
                                                                            <small class="badge bg-danger ms-3 d-inline-block">
                                                                                {{__('nav.Outstock')}}
                                                                            </small>
                                                                        @else
                                                                            <small class="badge badge-primary ms-3 d-inline-block">
                                                                                {{__('nav.Instock')}}
                                                                            </small>
                                                                        @endif     --}}
                                                                    {{-- </p> --}}

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
                                                                    {{-- <label for="descript" class="fw-bold">Description <span class="text-danger"></span></label> --}}
                                                                </div>
                                                                <div class="col-sm-12 col-md-9 col-l-9">
                                                                    <p> {{__('nav.createAt')}} : {{$item->create_date}}</p>
                                                                    <p> {{__('nav.createBy')}} : {{$item->add_by}}</p>

                                                                    @if ($item->delete_status == 0)
                                                                    <p class="text-danger"> {{__('nav.deleteAt')}} : {{$item->delete_date}}</p>
                                                                    <p class="text-danger"> {{__('nav.deleteBy')}} : {{$item->delete_by}}</p>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                            
                                                        </div>


                                                        {{-- @php
                                                           $checkgiveProduct = DB::table('give_table')->pluck('product_id');
                                                        @endphp

                                                        @foreach ($checkgiveProduct as $productId) 
                                                            @php
                                                                $explodeProId = explode(',', $productId);

                                                                if (in_array($item->id, $explodeProId)) {
                                                                    $givenCheck = DB::table('give_table')
                                                                                ->select('give_table.*', 'give_table.id as giveId', 'give_table.return_any_product', 'products.pro_img', 'products.pro_name_en', 
                                                                                        'products.pro_name_kh', 'products.pro_code', 'products.id as proId',
                                                                                        'products.model', 'products.fix_asset_code', 'products.serial_number',
                                                                                        'users.*', 'staff_users.*', 'positions.*', 'section.*', 'departments.*',
                                                                                        'categories.*')
                                                                                ->where('give_table.return_status', 1)
                                                                                ->where('products.id', $explodeProId)
                                                                                // ->where('give_table.year', date('Y'))
                                                                                ->join('products', 'give_table.product_id', '=', 'products.id')
                                                                                ->join('categories', 'products.cat_id', 'categories.id')
                                                                                ->join('users', 'give_table.staff_id', '=', 'users.id')
                                                                                ->join('staff_users', 'users.card_id', '=', 'staff_users.card_id')
                                                                                ->join('positions', 'positions.id', '=', 'staff_users.position')
                                                                                ->join('section', 'positions.section_id', '=', 'section.id')
                                                                                ->join('departments', 'departments.id', 'section.department_id')
                                                                                ->orderBy('give_table.id', 'desc')
                                                                                ->get();
                                                                }
                                                            @endphp

                                                            @if ( !empty($givenCheck))
                                                                <div class="bg-light p-3 mt-3">
                                                                    <div class="row">
                                                                        <div class="col-sm-12 col-md-9 col-lg-12">
                                                                            <h3 class="text-primary">
                                                                                <span class="mdi mdi-hand-coin text-primary fs-4"></span> {{__('nav.givenDescription')}}
                                                                            </h3>
                                                                            <div class="bg-white p-3">
                                                                                <p class="fw-bold">{{__('nav.descriptionTitle')}}</p>
                                                                                <div class="table-responsive">                   
                                                                                    <table id="departmentTb" class="display table table-striped">
                                                                                        <thead>
                                                                                            <tr>
                                                                                                <th style="width: 10px;" class="text-start">{{__('home.no')}}</th>
                                                                                                 <th> {{__('nav.profile')}} </th>
                                                                                                <th> {{__('nav.staffId')}} </th>
                                                                                                <th> {{__('nav.name')}} </th>
                                                                                                <th> {{__('home.Gender')}} </th>
                                                                                                <th> {{__('nav.department')}} </th>
                                                                                                <th> {{__('nav.section')}} </th>
                                                                                                <th> {{__('nav.position')}} </th>
                                                                                                <th> {{__('nav.givenDate')}} </th>
                                                                                            </tr>
                                                                                        </thead>
                                                                                        <tbody>
                                                                                            @php
                                                                                                $auto = 1;
                                                                                            @endphp
                                                                                            @foreach ($givenCheck as $checkGiven)
                                                                                                
                                                                                                <tr>
                                                                                                    <td style="width: 10px" class="text-start <?php
                                                                                                            if($checkGiven->delete_status == '0'){
                                                                                                                echo 'text-danger';
                                                                                                            }
                                                                                                        ?>">{{$auto++}}
                                                                                                    </td>
                                                    
                                                                                                    <td>
                                                                                                        @if ($checkGiven->profile == '')
                                                                                                            <img src="{{asset('images/draft-user.jpg')}}" alt="">
                                                                                                        @else
                                                                                                            <img src="{{asset( $checkGiven->profile)}}" alt="">
                                                                                                        @endif
                                                                                                    </td>
                                                    
                                                                                                    <td class="<?php
                                                                                                            if($checkGiven->delete_status == '0'){
                                                                                                                echo 'text-danger';
                                                                                                            }
                                                                                                        ?>">
                                                                                                        {{$checkGiven->card_id}}
                                                                                                    </td>
                                                    
                                                                                                    <td class="<?php
                                                                                                            if($checkGiven->delete_status == '0'){
                                                                                                                echo 'text-danger';
                                                                                                            }
                                                                                                        ?>">
                                                                                                        @if (session(['localization']) == 'en')
                                                                                                            {{$checkGiven->name_en}}
                                                                                                        @else
                                                                                                            {{$checkGiven->name_kh}}
                                                                                                        @endif
                                                                                                    </td>
                                                                                                    
                                                                                                    <td class="<?php
                                                                                                            if($checkGiven->delete_status == '0'){
                                                                                                                echo 'text-danger';
                                                                                                            }
                                                                                                        ?>">
                                                                                                        {{$checkGiven->gender}}
                                                                                                    </td>
                                                    
                                                                                                    <td class="<?php
                                                                                                            if($checkGiven->delete_status == '0'){
                                                                                                                echo 'text-danger';
                                                                                                            }
                                                                                                        ?>">
                                                                                                        @if (session(['localization']) !== 'kh')
                                                                                                            {{$checkGiven->dep_name_en}}
                                                                                                        @else
                                                                                                            {{$checkGiven->dep_name_kh}}
                                                                                                        @endif
                                                                                                    </td>
                                                    
                                                    
                                                                                                    <td class="<?php
                                                                                                            if($checkGiven->delete_status == '0'){
                                                                                                                echo 'text-danger';
                                                                                                            }
                                                                                                        ?>">
                                                                                                        @if (session(['localization']) == 'en')
                                                                                                            {{$checkGiven->section_en}}
                                                                                                        @else
                                                                                                            {{$checkGiven->section_kh}}
                                                                                                        @endif
                                                                                                    </td>
                                                                                                    
                                                    
                                                                                                    <td class="<?php
                                                                                                            if($checkGiven->delete_status == '0'){
                                                                                                                echo 'text-danger';
                                                                                                            }
                                                                                                        ?>">
                                                                                                        {{$checkGiven->position_name}}
                                                                                                    </td>
                                                    
                                                                                                    <td class="<?php
                                                                                                            if($checkGiven->delete_status == '0'){
                                                                                                                echo 'text-danger';
                                                                                                            }
                                                                                                        ?>">
                                                                                                        {{$checkGiven->date}}
                                                                                                    </td>
                                                                                                </tr>
                                                                                            @endforeach
                                                                                        </tbody>
                                                                                    </table>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        
                                                                    </div>
                                                                </div>
                                                            @endif
                                                        @endforeach --}}

                                                        @php
                                                            $checkgiveProduct = DB::table('give_table')->pluck('product_id');
                                                        @endphp

                                                        @foreach ($checkgiveProduct as $productId)
                                                            @php
                                                                $explodeProId = explode(',', $productId);
                                                                $givenCheck = [];

                                                                if (in_array($item->id, $explodeProId)) {
                                                                    $givenCheck = DB::table('give_table')
                                                                                    ->select('give_table.*', 'give_table.id as giveId', 'give_table.return_any_product', 'products.pro_img', 'products.pro_name_en', 
                                                                                            'products.pro_name_kh', 'products.pro_code', 'products.id as proId', 'products.model', 
                                                                                            'products.fix_asset_code', 'products.serial_number', 'users.*', 'staff_users.*', 
                                                                                            'positions.*', 'section.*', 'departments.*', 'categories.*')
                                                                                    ->where('give_table.return_status', 1)
                                                                                    ->whereIn('products.id', $explodeProId) // Use whereIn for multiple IDs
                                                                                    ->join('products', 'give_table.product_id', '=', 'products.id')
                                                                                    ->join('categories', 'products.cat_id', '=', 'categories.id')
                                                                                    ->join('users', 'give_table.staff_id', '=', 'users.id')
                                                                                    ->join('staff_users', 'users.card_id', '=', 'staff_users.card_id')
                                                                                    ->join('positions', 'positions.id', '=', 'staff_users.position')
                                                                                    ->join('section', 'positions.section_id', '=', 'section.id')
                                                                                    ->join('departments', 'departments.id', '=', 'section.department_id')
                                                                                    ->orderBy('give_table.id', 'desc')
                                                                                    ->get();
                                                                }
                                                            @endphp

                                                            @if (! empty($givenCheck) )
                                                                <div class="bg-light p-3 mt-3">
                                                                    <div class="row">
                                                                        <div class="col-12">
                                                                            <h3 class="text-primary">
                                                                                <span class="mdi mdi-hand-coin text-primary fs-4"></span> {{ __('nav.givenDescription') }}
                                                                            </h3>
                                                                            <div class="bg-white p-3">
                                                                                <p class="fw-bold">{{ __('nav.descriptionTitle') }}</p>
                                                                                <div class="table-responsive">
                                                                                    <table id="departmentTb" class="display table table-striped">
                                                                                        <thead>
                                                                                            <tr>
                                                                                                <th style="width: 10px;" class="text-start">{{ __('home.no') }}</th>
                                                                                                <th>{{ __('nav.profile') }}</th>
                                                                                                <th>{{ __('nav.staffId') }}</th>
                                                                                                <th>{{ __('nav.name') }}</th>
                                                                                                <th>{{ __('home.Gender') }}</th>
                                                                                                <th>{{ __('nav.department') }}</th>
                                                                                                <th>{{ __('nav.section') }}</th>
                                                                                                <th>{{ __('nav.position') }}</th>
                                                                                                <th>{{ __('home.qty') }}</th>
                                                                                                <th>{{ __('nav.givenDate') }}</th>
                                                                                            </tr>
                                                                                        </thead>
                                                                                        <tbody>
                                                                                            @php $auto = 1; @endphp
                                                                                            @foreach ($givenCheck as $checkGiven)
                                                                                                <tr>
                                                                                                    <td class="text-start {{ $checkGiven->delete_status == '0' ? 'text-danger' : '' }}">{{ $auto++ }}</td>
                                                                                                    <td>
                                                                                                        <img src="{{ $checkGiven->profile ? asset($checkGiven->profile) : asset('images/draft-user.jpg') }}" alt="">
                                                                                                    </td>
                                                                                                    <td class="{{ $checkGiven->delete_status == '0' ? 'text-danger' : '' }}">{{ $checkGiven->card_id }}</td>
                                                                                                    <td class="{{ $checkGiven->delete_status == '0' ? 'text-danger' : '' }}">
                                                                                                        {{ session('localization') == 'en' ? $checkGiven->name_en : $checkGiven->name_kh }}
                                                                                                    </td>
                                                                                                    <td class="{{ $checkGiven->delete_status == '0' ? 'text-danger' : '' }}">{{ $checkGiven->gender }}</td>
                                                                                                    <td class="{{ $checkGiven->delete_status == '0' ? 'text-danger' : '' }}">
                                                                                                        {{ session('localization') !== 'kh' ? $checkGiven->dep_name_en : $checkGiven->dep_name_kh }}
                                                                                                    </td>
                                                                                                    <td class="{{ $checkGiven->delete_status == '0' ? 'text-danger' : '' }}">
                                                                                                        {{ session('localization') == 'en' ? $checkGiven->section_en : $checkGiven->section_kh }}
                                                                                                    </td>
                                                                                                    <td class="{{ $checkGiven->delete_status == '0' ? 'text-danger' : '' }}">{{ $checkGiven->position_name }}</td>
                                                                                                    <td class="{{ $checkGiven->delete_status == '0' ? 'text-danger' : '' }}">
                                                                                                        <div class="ui mini red label">1</div>
                                                                                                    </td>
                                                                                                    <td class="{{ $checkGiven->delete_status == '0' ? 'text-danger' : '' }}">{{ $checkGiven->date }}</td>
                                                                                                </tr>
                                                                                            @endforeach
                                                                                        </tbody>
                                                                                    </table>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            @endif
                                             
                                                        @endforeach

                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                {{-- <button type="button" class="btn btn-secondary btn-sm"
                                                    data-bs-dismiss="modal">Close</button> --}}
                                                <button type="button" class="ui mini grey button" data-bs-dismiss="modal">
                                                    <i class="x icon"></i> {{ __('nav.close') }}
                                                </button>
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
                                            <th> {{__('nav.proCode')}} </th>
                                            <th> {{__('nav.proName')}}</th>

                                            <th>{{__('nav.model')}}</th>
                                            <th>{{__('nav.serial_number')}}</th>
                                            <th>{{__('nav.fix_asset_code')}}</th>

                                            <th> {{__('nav.category')}}</th>
                                            <th>{{__('home.qty')}}</th>
                                            <th> {{__('nav.createAt')}} </th>
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

                                                        {{$item->fix_qty}}
                                                    
                                                </td>

                                                {{--  --}}

                                                <td class="<?php
                                                        if($item->delete_status == '0'){
                                                            echo 'text-danger';
                                                        }
                                                    ?>">
                                                    {{$item->create_date}}
                                                    {{-- {{@if ($item -> delete_by)
                                                        $item->delete_by
                                                    @endif}} --}}
                                                    <?php
                                                        // if(($item -> delete_by) == ''){
                                                        //     echo '-';
                                                        // }else {
                                                        //     // echo $item -> delete_by;
                                                        //     echo '<span class="badge badge-secondary">'. $item -> delete_by . '</span>';
                                                        // }
                                                    ?>
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
                        title: "Data has saved."
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
                XLSX.writeFile(wb, "product-instock.xlsx");
            });
        });
    </script>
    <script>
        $(document).ready(function(){
            // $('#sidebar-menu li').remoeClass('active');
            // $('#sidebar-menu li ul li').remoeClass('active collapse');

            $('#inventory_list').addClass('nav-item active');
            // $('#form-elements').addClass('collapse show');

            
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