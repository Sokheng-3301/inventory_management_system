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
            border: 0.1px solid #868686;
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
    </style>
</head>

<body>
    <h3>{{ $title }}</h3>
    <p>Export Date : {{ now()->format('d M Y h:i:s A') }}</p>
    <table>
        <thead>
            <tr>
                <th>{{ __('home.no') }}</th>
                <th> {{ __('nav.proCode') }} </th>
                <th> {{ __('nav.proName') }}</th>
                <th> {{ __('nav.noted') }}</th>
                <th>{{ __('nav.model') }}</th>
                <th>{{ __('nav.serial_number') }}</th>
                <th>{{ __('nav.fix_asset_code') }}</th>
                <th> {{ __('nav.category') }}</th>
                <th> {{ __('nav.equipment_type') }}</th>
                <th>{{ __('home.qty') }}</th>
                {{-- <th> {{ __('nav.createBy') }} </th>
                <th> {{ __('nav.createAt') }} </th> --}}
            </tr>
        </thead>
        <tbody>

            @foreach ($items as $key => $item)
                <tr>
                    <td>{{ $key+1 }}</td>
                    <td>{{ $item->item_code }}</td>
                    <td>
                        {{ $item->item_name_kh . '-'. $item->item_name_en}}
                    </td>
                    <td>{{ $item->pro_description }}</td>

                    <td>{{ $item->model }}</td>

                    <td>{{ $item->serial_number }}</td>
                    <td>{{ $item->fix_asset_code }}</td>

                    <td>{{ $item->cat_name }}</td>
                    <td>
                        @if ($item->equipment_type == 1)
                            {{ __('nav.equipment') }}
                        @elseif($item->equipment_type == 2)
                            {{ __('nav.accessories') }}
                        @else
                        @endif
                    </td>

                    <td>{{ $item->qty }}</td>
                    {{-- <td>{{ $item->add_by }}</td>
                    <td>
                        {{ Carbon\Carbon::parse($item->create_date)->format('d M Y') }}
                    </td> --}}
                </tr>
            @endforeach

            <!-- Add more rows as needed -->
        </tbody>
    </table>
</body>

</html>
