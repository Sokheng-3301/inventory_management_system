<?php

namespace App\Exports;

use Illuminate\Support\Facades\DB;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class ItemTrashbinExport implements FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function view(): View
    {
        $products = DB::table('products')
            ->select('products.*', 'categories.cat_name', 'item_codes.item_code', 'item_codes.item_name_kh', 'item_codes.item_name_en')
            ->join('item_codes', 'products.pro_code', '=', 'item_codes.id')
            ->join('categories', 'item_codes.item_cat', '=', 'categories.id')
            ->where('products.delete_status', 0)
            ->orderBy('products.delete_status', 'desc');
        return view('export.product', ['products'=>$products->get(), 'title' => __("nav.trashbin"), 'delete_status' => true]);
    }
}
