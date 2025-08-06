<h4>Export: {{ $title }}</h4>
<p>Export Date: {{ now()->format('d M Y h:i:s A') }}</p>
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
                <td>{{ $key + 1 }}</td>
                <td>{{ $item->item_code }}</td>
                <td>{{ $item->item_name_kh }}</td>
                <td>{{ $item->item_name_en }}</td>
                <td>{{ $item->cat_name }} </td>
                <td>{{ $item->equipment_type == 1 ? __('nav.equipment') : __('nav.accessories') }} </td>
            </tr>
        @endforeach
    </tbody>
</table>
