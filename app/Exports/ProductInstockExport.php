<?php

namespace App\Exports;

use Illuminate\Support\Facades\DB;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class ProductInstockExport implements FromView
{
    /**
     * @return \Illuminate\Support\Collection
     */

    public function view(): View
    {

        // return view('exports.invoices', [
        //     'invoices' =>
        // ]);

        // $products = DB::table('products')
        //                 ->select('products.*', 'categories.cat_name', 'categories.id as cat_id')
        //                 ->where('products.stock_status', 1)
        //                 ->where('products.delete_status', 1)
        //                 ->join('categories', 'products.cat_id', '=', 'categories.id')
        //                 ->orderBy('products.id', 'desc');
        $products = DB::table('products')
            ->select('products.*', 'categories.cat_name', 'item_codes.item_code', 'item_codes.item_name_kh', 'item_codes.item_name_en')
            ->where('products.stock_status', 1)
            ->where('products.qty', '>=', '1')
            ->where('products.delete_status', 1)
            ->join('item_codes', 'products.pro_code', '=', 'item_codes.id')
            ->join('categories', 'item_codes.item_cat', '=', 'categories.id')
            ->orderBy('products.id', 'desc');
        return view('export.product', ['products'=>$products->get(), 'title' => __("nav.productInStock")]);
    }
}
