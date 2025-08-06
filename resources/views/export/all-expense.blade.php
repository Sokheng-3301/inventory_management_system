<h3>{{ $title }}</h3>
<p>Export Date : {{ now()->format('d M Y h:i:s A') }}</p>

<h4>{{__('nav.ItePurchase')}}</h4>
<table>
    <thead>
        <tr>
            <th>{{ __('home.no') }}</th>
            <th> {{ __('nav.proCode') }} </th>
            <th> {{ __('nav.aboutItem') }}</th>

            {{-- <th>{{ __('nav.model') }}</th>
            <th>{{ __('nav.serial_number') }}</th>
            <th>{{ __('nav.fix_asset_code') }}</th>
            <th> {{ __('nav.category') }}</th>
            <th> {{ __('nav.equipment_type') }}</th>

            <th>{{ __('nav.expenseDate') }}</th>
            <th> {{ __('nav.createBy') }} </th> --}}

            <th>{{ __('home.qty') }}</th>
            <th>{{ __('nav.price') }}</th>
        </tr>
    </thead>
    <tbody>
        @php
            $total = 0;
        @endphp
        @foreach ($items as $key => $item)
            @php
                $total += $item->qty * $item->price;
            @endphp
            <tr>
                <td>{{ $key + 1 }}</td>
                <td>{{ $item->item_code }}</td>
                <td>
                    <p>{{ session('localization') == 'kh' ? $item->item_name_kh : $item->item_name_en }}</p>
                    <p>Model: {{ $item->model }}</p>
                    <p>SN: {{ $item->serial_number }}</p>
                    <p>FAC: {{ $item->fix_asset_code }}</p>
                    <p>CAT: {{ $item->cat_name }}</p>
                </td>


                {{-- <td>
                    {{ Carbon\Carbon::parse($item->expense_date)->format('d M Y h:i:s A') }}
                </td>
                <td>{{ $item->operator }}</td> --}}

                <td>{{ $item->qty }}</td>
                <td>$ {{ $item->price }}</td>
            </tr>
        @endforeach

        <!-- Add more rows as needed -->
    </tbody>
    <tbody>
        <tr>
            <td class="text-danger fw-bold fs-6 text-end" colspan="4"> {{ __('nav.total') }} </td>
            <td class="text-end fw-bold fs-5 text-end">$ {{ $total }} </td>
        </tr>
    </tbody>
</table>


{{-- ////// SERVICE FEE  --}}
<h4>{{__('nav.serviceFee')}}</h4>

<table>
    <thead>
        <tr>
            <th>{{ __('home.no') }}</th>
            <th> {{ __('nav.aboutService') }} </th>
            <th> {{ __('nav.expenseDate') }} </th>
            <th> {{ __('nav.createBy') }} </th>
            <th> {{ __('nav.price') }}</th>
        </tr>
    </thead>
    <tbody>
        @php
            $total = 0;
        @endphp
        @foreach ($service_fees as $key => $item)
            @php
                $total += $item->price;
            @endphp
            <tr>
                <td>
                    {{ $key + 1 }}
                </td>

                <td class="text">
                    <p class="text-break">{{ $item->note }}</p>
                </td>

                <td>
                    {{ Carbon\Carbon::parse($item->date)->format('d M Y') }}
                </td>

                <td class="text-muted">
                    {{ strtoupper($item->add_by) }}
                </td>

                <td class="text-end fw-bold">
                    $ {{ $item->price }}
                </td>

            </tr>
        @endforeach

        <!-- Add more rows as needed -->
    </tbody>
    <tbody>
        <tr>
            <td class="text-danger fw-bold fs-6 text-end" colspan="4"> {{ __('nav.total') }} </td>
            <td class="text-end fw-bold fs-5 text-end">$ {{ $total }} </td>
        </tr>
    </tbody>
</table>
