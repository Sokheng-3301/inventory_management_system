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
                <th>{{ __('nav.proCode') }}</th>
                <th>{{ __('nav.proName') }}</th>
                <th> {{ __('home.qty') }} </th>
            </tr>
        </thead>
        <tbody>
            @foreach ($item_code_counts as $key => $item)
                <tr>
                    <td>
                        {{ $key + 1 }}
                    </td>
                    <td>
                        {{ $item->item_code }}
                    </td>
                    <td>
                        {{ session('localization') == 'kh' ? $item->item_name_kh : $item->item_name_en }}
                    </td>
                    <td>
                        {{ $item->total_qty }}
                    </td>
                </tr>
            @endforeach
            <tr>
                <td colspan="3">
                    <strong>{{__('nav.total')}}</strong>
                </td>
                <td>
                    <strong>{{ $item_code_counts->sum('total_qty') }}</strong>
                </td>
            </tr>
        </tbody>
    </table>
</body>

</html>
