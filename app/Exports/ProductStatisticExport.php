<?php

namespace App\Exports;

use Illuminate\Support\Facades\DB;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\FromCollection;

class ProductStatisticExport implements FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function view(): View
    {
        // $categories = DB::table('categories')->where('delete_status', 1)->orderBy('delete_status', 'desc')->orderBy('id', 'desc')->get();
        $item_codes = DB::table('item_codes')
            ->where('delete_status', 1)
            ->orderBy('id', 'asc')
            ->get()
            ->map(function ($item_code) {
                $item_code->total_qty = DB::table('products')
                    ->where('pro_code', $item_code->id)
                    ->where('delete_status', 1)
                    // ->where('year', $currentYear)
                    ->sum('fix_qty');
                return $item_code;
            });

        return view('export.statistic', ['item_code_counts' => $item_codes, 'title'=> __("nav.statistic")]);
    }
}
