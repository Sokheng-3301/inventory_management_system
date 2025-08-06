<?php

namespace App\Exports;

use Illuminate\Support\Facades\DB;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class ItemCodeExport implements FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function view(): View
    {
        $item_codes = DB::table('item_codes')
            ->select('item_codes.*', 'item_codes.id as item_code_id', 'item_codes.delete_status as deleteStatus', 'categories.id', 'categories.cat_name')
            ->join('categories', 'item_codes.item_cat', '=', 'categories.id')
            ->where('item_codes.delete_status', 1)
            ->orderBy('item_codes.item_code', 'asc');
        return view('export.item-code', ['title' => __('nav.itemCode'), 'item_codes' => $item_codes->get()]);
    }
}
