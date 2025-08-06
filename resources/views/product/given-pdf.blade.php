<!DOCTYPE html>
<html lang="km">

<head>
    @include('layout.meta')
    <meta charset="UTF-8">
    <title>Export data to pdf</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Noto+Sans+Khmer:wght@100..900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap');
        @font-face {
            font-family: 'KhmerOS';
            src: url("{{ storage_path('fonts/KhmerOS.ttf') }}") format('truetype');
        }
        body {
            font-family: 'KhmerOS' !important;
        }
        table{
            width: 100%;
        }
        table, th, td, span{
            font-size: 10px !important;
            /* font-family: "Poppins", "Noto Sans KhmerOS", serif !important; */
            font-family: 'KhmerOS' !important;
            border-collapse: collapse;
        }
        th{
            font-weight: bold !important;
        }
        th,td{
            border: 1px solid grey;
            padding: 0 5px;
        }
        td.desc{
            width: 300px;
            line-height: 7px;
        }
        .text-center{
            text-align: center !important;
        }

    </style>
</head>
<body>
    

{{-- <div class="content-wrapper"> --}}
    <div class="row">
        <div class="col-md-12">
            {{-- <img src="{{ asset('images/draft-user.jpg') }}" alt=""> --}}
            <h4>Export Given list to PDF</h4>         
            <table id="exportTB" class="table">
                <thead>
                    <tr>
                        {{-- <th style="width: 10px;" class="text-start">{{__('home.no')}}</th>
                        <th> {{__('nav.staffId')}} </th>
                        <th> {{__('nav.name')}} </th>
                        <th> {{__('home.Gender')}} </th>
                        <th> {{__('nav.department')}} </th>
                        <th> {{__('nav.section')}} </th>
                        <th> {{__('nav.position')}} </th>
                        <th> {{__('nav.givenDate')}} </th> --}}
                        
                        <th style="width: 10px;" class="text-center">No.</th>
                        <th class="text-center"> Staff ID </th>
                        <th> Fullname </th>
                        <th> Gender </th>
                        <th> Department </th>
                        <th> Section </th>
                        <th> Position </th>
                        <th class="text-center"> Given date </th>
                        <th >Product description</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $auto = 1;
                        // $increment = 1;

                    @endphp
                     @foreach ($product as $item)
                        
                     <tr>
                         <td style="width: 10px" class="text-center <?php
                                 if($item->delete_status == '0'){
                                     echo 'text-danger';
                                 }
                             ?>">{{$auto++}}
                         </td>

                         <td class="text-center <?php
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
                            {{$item->name_en}}
                         </td>
                         
                         <td class="<?php
                                 if($item->delete_status == '0'){
                                     echo 'text-danger';
                                 }
                             ?>">
                             {{$item->gender}}
                         </td>

                         <td class="<?php
                                 if($item->delete_status == '0'){
                                     echo 'text-danger';
                                 }
                             ?>">
                                {{$item->dep_name_en}}
                             
                         </td>


                         <td class="<?php
                                 if($item->delete_status == '0'){
                                     echo 'text-danger';
                                 }
                             ?>">

                                {{$item->section_en}}
                            
                         </td>
                         

                         <td class="<?php
                                 if($item->delete_status == '0'){
                                     echo 'text-danger';
                                 }
                             ?>">
                             {{$item->position_name}}
                         </td>

                          <td class="text-center <?php
                                 if($item->delete_status == '0'){
                                     echo 'text-danger';
                                 }
                             ?>">
                             {{$item->date}}
                         </td>

                         <td class="desc">
                           @php
                                $product_id = explode(',', $item->product_id);
                           @endphp
                            @foreach ($product_id as $pro_id)
                                @php

                                    $productsQry = DB::table('products')
                                                    ->select('products.pro_img', 'products.pro_name_en', 'products.pro_name_kh',
                                                    'products.pro_code', 'products.id as proId',
                                                    'products.model', 'products.fix_asset_code', 'products.serial_number',
                                                    'categories.*')
                                                    // ->join('products', 'give_table.product_id', '=', 'products.id')
                                                    ->join('categories', 'products.cat_id', 'categories.id')
                                                    // ->join('give_table', 'products.id', 'give_table.product_id')
                                                    ->where('products.id', $pro_id)
                                                    ->get()->first();
                                @endphp

                                    <div>
                                        Product code: {{($productsQry->pro_code == '') ? 'N/A' : $productsQry->pro_code}}
                                        - Product name: {{$productsQry->pro_name_en}}
                                        - Product qty : x 1
                                        - Product model: {{$productsQry->model}}
                                        - Serial number:{{$productsQry->serial_number}}
                                        - Fix asset code: {{$productsQry->fix_asset_code}}
                                        - Category: {{$productsQry->cat_name}}
                                    </div>
                            @endforeach
                         </td>

                     </tr>

                 @endforeach
             
                    <!-- Add more rows as needed -->
                </tbody>
            </table>
        </div>
    </div>
{{-- </div> --}}

@include('layout.script')

</body>
</html>
