<?php

namespace App\Exports;

use Illuminate\Support\Facades\DB;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\FromCollection;

class ProductHasReturnedExport implements FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function view(): View
    {
        $data['product'] = DB::table('give_table')
            ->select(
                'give_table.*',
                'give_table.add_by as operator',
                'give_table.id as giveId',
                'products.pro_img',
                'products.pro_name_en',
                'products.pro_name_kh',
                'products.pro_code',
                'products.id as proId',
                'products.model',
                'products.fix_asset_code',
                'products.serial_number',
                'users.*',
                'positions.*',
                'section.*',
                'departments.*',
                'categories.*'
            )
            ->where('give_table.any_return_status', 0)
            ->join('products', 'give_table.product_id', '=', 'products.id')
            ->join('categories', 'products.cat_id', 'categories.id')
            ->join('users', 'give_table.staff_id', '=', 'users.id')
            ->join('positions', 'positions.id', '=', 'users.position')
            ->join('section', 'positions.section_id', '=', 'section.id')
            ->join('departments', 'departments.id', 'section.department_id')
            ->orderBy('give_table.returned_date', 'desc');

        return view('export.returned-product', ['products'=>$data['product']->get(), 'title'=>__("nav.returnedList")]);
    }
}
