<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>{{ $title }} | IMS</title>
    <style>
        @font-face {
            font-family: 'KhmerOS';
            src: url('{{ public_path('fonts/Notosan/khmerOs.ttf') }}') format('truetype');
            font-weight: normal;
            font-style: normal;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'KhmerOS', sans-serif;
            font-size: 11px !important;
        }

        table {
            border-collapse: collapse;
            width: 100%;

        }

        th,
        td {
            border: 0.5px solid #575757;
            padding: 4px 5px;
        }

        .text-center {
            text-align: center;
        }

        h3 {
            line-height: 5px;
        }

        .w-x {
            width: 25px;
        }
        .main_head tr th{
            background: #fcb10ed2;
            padding: 10px;
        }
    </style>
</head>

<body>
    <h3>{{ $title }}</h3>
    <p>Export Date : {{ now()->format('d M Y h:i:s A') }}</p>
    <table>
        <thead class="main_head">
            <tr>
                <th class="text-center">{{ __('home.no') }}</th>
                <th class="text-center"> {{ __('nav.staffId') }} </th>
                <th> {{ __('nav.name') }} </th>
                <th class="w-x"> {{ __('home.Gender') }} </th>
                <th> {{ __('nav.position') }} </th>
                {{-- <th> {{ __('nav.section') }} </th>
                <th> {{ __('nav.position') }} </th> --}}
                <th class="text-center"> {{ __('nav.date') }} </th>
                <th>{{ __('nav.aboutProduct') }}</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($products as $key => $item)
                <tr>
                    <td class="text-center">
                        {{ $key + 1 }}
                    </td>

                    <td class="text-center">
                        {{ $item->card_id ?? __('nav.newStaff') }}
                    </td>

                    <td>
                        {{ session(['localization']) == 'kh' ? $item->name_kh : strtoupper($item->name_en) }}
                    </td>

                    <td class="w-x">
                        {{ __('nav.' . $item->gender) }}
                    </td>

                    <td>
                        <p>Dept: {{ session(['localization']) == 'kh' ? $item->dep_name_kh : $item->dep_name_en }}</p>
                        <p>Sect: {{ session(['localization']) == 'kh' ? $item->section_kh : $item->section_en }}</p>
                        <P>Post: {{ $item->position_name }}</P>
                    </td>

                    {{-- <td>
                        @if (session(['localization']) == 'en')
                            {{ $item->section_en }}
                        @else
                            {{ $item->section_kh }}
                        @endif
                    </td>

                    <td>
                        {{ $item->position_name }}
                    </td>
                    --}}

                    <td class="text-center">
                        {{ Carbon\Carbon::parse($item->date)->format('d M Y') }}
                    </td>

                    <td>
                        @php
                            $product_id = explode(',', $item->product_id);
                        @endphp
                        <table>
                            <thead>
                                <tr>
                                    {{-- <th>{{ __('nav.proCode') }}</th> --}}
                                    <th>{{ __('nav.item') }}</th>
                                    <th>FAC</th>
                                    <th>SN</th>
                                    {{-- <th>{{ __('nav.model') }}</th> --}}
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($product_id as $key => $pro_id)
                                    @php

                                        $productsQry = DB::table('products')
                                            ->select('products.*', 'item_codes.*', 'categories.*')
                                            ->join('item_codes', 'products.pro_code', '=', 'item_codes.id')
                                            ->join('categories', 'item_codes.item_cat', 'categories.id')
                                            ->where('products.id', $pro_id)
                                            ->orderBy('products.fix_asset_code', 'asc')
                                            ->get()
                                            ->first();
                                    @endphp
                                    <tr>
                                        <td>
                                            <p>{{ $productsQry->item_code }} {{ session('localization') == 'kh' ? $productsQry->item_name_kh : $productsQry->item_name_en }} {{ $productsQry->pro_description ? ' - '. $productsQry->pro_description : '' }}</p>
                                            <p>Model: {{ $productsQry->model }}</p>
                                        </td>
                                        <td>{{ $productsQry->fix_asset_code }}</td>
                                        <td>{{ $productsQry->serial_number }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{-- @foreach ($product_id as $key => $pro_id)
                            @php
                                $productsQry = DB::table('products')
                                    ->select('products.*', 'item_codes.*', 'categories.*')
                                    ->join('item_codes', 'products.pro_code', '=', 'item_codes.id')
                                    ->join('categories', 'item_codes.item_cat', 'categories.id')
                                    ->where('products.id', $pro_id)
                                    ->orderBy('products.fix_asset_code', 'desc')
                                    ->get()
                                    ->first();
                            @endphp
                            <div>
                                <p>{{ $key + 1 }}. Code: {{ $productsQry->item_code }}
                                    ({{ session('localization') == 'kh' ? $productsQry->item_name_kh : $productsQry->item_name_en }})
                                    {{ $productsQry->pro_description ? ' - '. $productsQry->pro_description : '' }}</p>


                                <p>Name: {{  }}</p>
                                 <p>{{$key+1}}. Name: {{ $productsQry->pro_name_kh . '-'. $productsQry->pro_name_en }}</p>
                                <p>Qty: 1</p>
                                <p>Model: {{ $productsQry->model }}</p>


                                <p>SN:{{ $productsQry->serial_number }}</p>
                                <p>FAC: {{ $productsQry->fix_asset_code }}</p>


                                <p>Note: {{ $productsQry->pro_description }}</p>
                                <p>- Category: {{ $productsQry->cat_name }}</p>
                            </div>
                        @endforeach --}}
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>
