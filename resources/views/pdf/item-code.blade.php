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
                <th> {{ __('home.no') }}</th>
                <th> {{ __('nav.itemCode') }} </th>
                <th> {{ __('nav.proNameKh') }} </th>
                <th> {{ __('nav.proNameEn') }} </th>
                <th> {{ __('nav.category') }}</th>
                <th> {{ __('nav.equipment_type') }}</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($item_codes as $key => $item)
                <tr>
                    <td>{{ $key+1 }}</td>
                    <td>{{ $item->item_code }}</td>
                    <td>{{ $item->item_name_kh }}</td>
                    <td>{{ $item->item_name_en }}</td>
                    <td>{{ $item->cat_name }} </td>
                    <td>{{ $item->equipment_type == 1 ? __('nav.equipment') : __('nav.accessories') }} </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>
