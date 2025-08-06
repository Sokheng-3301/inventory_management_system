<?php

namespace App\Exports;

use Illuminate\Support\Facades\DB;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\FromCollection;

class InventoryLisetExport implements FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function view(): View
    {

        // return view('exports.invoices', [
        //     'invoices' =>
        // ]);

        $data = DB::table('products')
            ->select('products.*', 'categories.cat_name', 'categories.id as cat_id', 'item_codes.*')
            ->join('item_codes', 'item_codes.id', '=', 'products.pro_code')
            ->join('categories', 'item_codes.item_cat', '=', 'categories.id')
            ->orderBy('products.stock_status', 'desc')
            ->orderBy('products.id', 'desc');
        return view('export.product', ['products'=>$data->get(), 'title' => __("nav.inventory_list")]);
    }
}
