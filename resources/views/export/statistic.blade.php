<h4>Export: {{ $title }}</h4>
<p>Export Date: {{ now()->format('d M Y h:i:s A') }}</p>
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
                <strong>{{ __('nav.total') }}</strong>
            </td>
            <td>
                <strong>{{ $item_code_counts->sum('total_qty') }}</strong>
            </td>
        </tr>
    </tbody>
</table>
