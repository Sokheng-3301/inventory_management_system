<h4>Export: {{ $title }}</h4>
<p>Export Date: {{ now()->format('d M Y h:i:s A') }}</p>
<table>
    <thead>
        <tr>
            <th>{{ __('home.no') }}</th>
            <th> {{ __('nav.staffId') }} </th>
            <th> {{ __('nav.name') }} </th>
            <th> {{ __('home.Gender') }} </th>
            <th> {{ __('nav.department') }} </th>
            <th> {{ __('nav.section') }} </th>
            <th> {{ __('nav.position') }} </th>
            <th> {{ __('nav.givenDate') }} </th>
            <th> {{ __('nav.returnDate') }} </th>
            <th> {{ __('nav.giveBy') }} </th>

            <th>{{ __('nav.aboutProduct') }}</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($products as $key => $item)
            <tr>
                <td>
                    {{ $key + 1 }}
                </td>

                <td>
                    {{ $item->card_id ?? __('nav.newStaff') }}
                </td>

                <td>
                    @if (session(['localization']) == 'en')
                        {{ $item->name_en }}
                    @else
                        {{ $item->name_kh }}
                    @endif
                </td>

                <td>
                    {{ __('nav.' . $item->gender) }}
                </td>

                <td>
                    @if (session(['localization']) !== 'kh')
                        <span class="badge badge-info">{{ $item->dep_name_en }}</span>
                    @else
                        <span class="badge badge-info">{{ $item->dep_name_kh }}</span>
                    @endif
                </td>


                <td>
                    @if (session(['localization']) == 'en')
                        {{ $item->section_en }}
                    @else
                        {{ $item->section_kh }}
                    @endif
                </td>


                <td>
                    {{ $item->position_name }}
                </td>

                <td>
                    {{ Carbon\Carbon::parse($item->date)->format('d M Y') }}
                </td>

                <td>
                    {{ Carbon\Carbon::parse($item->returned_date)->format('d M Y h:i:s A') }}
                </td>

                <td>
                    {{ $item->operator }}
                </td>


                <td>
                    @php
                        $product_id = explode(',', $item->product_id);
                        $productGivenAll = explode(',', $item->constant_proid);
                        $ProductIdHasReturn = array_diff($productGivenAll, $product_id);
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
                            @if ($item->return_status == 1)
                                @foreach ($ProductIdHasReturn as $proHasReturn)
                                    @php
                                        $productsQry = DB::table('products')
                                            ->select(
                                                'products.*',
                                                'item_codes.*',
                                                'categories.*',
                                            )
                                            ->join('item_codes', 'products.pro_code', 'item_codes.id')
                                            ->join('categories', 'item_codes.item_cat', 'categories.id')
                                            ->where('products.id', $proHasReturn)
                                            ->get()->first();
                                    @endphp
                                    {{-- <div style="border-bottom: 1px solid;">
                                        <p>Code: {{ $productsQry->pro_code == '' ? 'N/A' : $productsQry->pro_code }}</p>
                                        <p>Name: {{ $productsQry->pro_name_en }}</p>
                                        <p>Qty: 1</p>
                                        <p>Model: {{ $productsQry->model }}</p>
                                        <p>SN:{{ $productsQry->serial_number }}</p>
                                        <p>FAC: {{ $productsQry->fix_asset_code }}</p>
                                        <p>________________________________</p>
                                        <p>- Category: {{ $productsQry->cat_name }}</p>
                                    </div> --}}
                                    <tr>
                                        <td>
                                            <p>{{ $productsQry->item_code }}
                                                {{ session('localization') == 'kh' ? $productsQry->item_name_kh : $productsQry->item_name_en }}
                                                {{ $productsQry->pro_description ? ' - ' . $productsQry->pro_description : '' }}
                                            </p>
                                            <p>Model: {{ $productsQry->model }}</p>
                                        </td>
                                        <td>{{ $productsQry->fix_asset_code }}</td>
                                        <td>{{ $productsQry->serial_number }}</td>
                                    </tr>
                                @endforeach

                            @else
                                @foreach ($productGivenAll as $allReturnProduct)
                                    @php
                                        $productsQry = DB::table('products')
                                            ->select(
                                                'products.*',
                                                'item_codes.*',
                                                'categories.*',
                                            )
                                            ->join('item_codes', 'products.pro_code', 'item_codes.id')
                                            ->join('categories', 'item_codes.item_cat', 'categories.id')
                                            ->where('products.id', $allReturnProduct)
                                            ->get()
                                            ->first();
                                    @endphp
                                    {{-- <div style="border-bottom: 1px solid;">
                                        <p>Code: {{ $productsQry->pro_code == '' ? 'N/A' : $productsQry->pro_code }}</p>
                                        <p>Name: {{ $productsQry->pro_name_en }}</p>
                                        <p>Qty: 1</p>
                                        <p>Model: {{ $productsQry->model }}</p>
                                        <p>SN:{{ $productsQry->serial_number }}</p>
                                        <p>FAC: {{ $productsQry->fix_asset_code }}</p>
                                        <p>________________________________</p>
                                        <p>- Category: {{ $productsQry->cat_name }}</p>
                                    </div> --}}
                                    <tr>
                                        <td>
                                            <p>{{ $productsQry->item_code }}
                                                {{ session('localization') == 'kh' ? $productsQry->item_name_kh : $productsQry->item_name_en }}
                                                {{ $productsQry->pro_description ? ' - ' . $productsQry->pro_description : '' }}
                                            </p>
                                            <p>Model: {{ $productsQry->model }}</p>
                                        </td>
                                        <td>{{ $productsQry->fix_asset_code }}</td>
                                        <td>{{ $productsQry->serial_number }}</td>
                                    </tr>
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                </td>
            </tr>
        @endforeach

        <!-- Add more rows as needed -->
    </tbody>
</table>
