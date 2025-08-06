<h4>Export: {{ $title }}</h4>
<p>Export Date: {{ now()->format('d M Y h:i:s A') }}</p>
<table>
    <thead>
        <tr>
            <th>{{ __('home.no') }}</th>
            <th> {{ __('nav.proCode') }} </th>
            <th> {{ __('nav.proNameKh') }}</th>
            <th> {{ __('nav.proNameEn') }}</th>
            <th> {{ __('nav.noted') }}</th>
            <th>{{ __('nav.model') }}</th>
            <th>{{ __('nav.serial_number') }}</th>
            <th>{{ __('nav.fix_asset_code') }}</th>
            <th> {{ __('nav.category') }}</th>
            <th> {{ __('nav.equipment_type') }}</th>
            <th> {{ __('nav.status') }}</th>
            <th>{{ __('home.qty') }}</th>
            <th>{{ __('nav.createBy') }}</th>
            <th> {{ __('nav.createAt') }} </th>

            @if (@$delete_status)
                <th>{{ __('nav.deleteBy') }}</th>
                <th> {{ __('nav.deleteAt') }} </th>
            @endif
        </tr>
    </thead>
    <tbody>
        @foreach ($products as $key => $item)
            <tr>
                <td>{{ $key + 1 }}</td>
                <td>{{ $item->item_code }}</td>
                <td>{{ $item->item_name_kh }}</td>
                <td>{{ $item->item_name_en }}</td>
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

                <td>
                    @if ($item->qty == '0')
                        {{ __('nav.Outstock') }}
                    @else
                        {{ __('nav.Instock') }}
                    @endif
                </td>

                <td>{{ $item->qty }}</td>
                <td>{{ $item->add_by }}</td>
                <td>
                    {{ Carbon\Carbon::parse($item->create_date)->format('d M Y') }}
                </td>

                @if (@$delete_status)
                    <td>{{ $item->delete_by }}</td>
                    <td>
                        {{ Carbon\Carbon::parse($item->delete_date)->format('d M Y') }}
                    </td>
                @endif
            </tr>
        @endforeach

        <!-- Add more rows as needed -->
    </tbody>
</table>
