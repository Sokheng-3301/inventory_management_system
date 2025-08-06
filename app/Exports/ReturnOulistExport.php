<?php

namespace App\Exports;

use Illuminate\Support\Facades\DB;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\FromCollection;

class ReturnOulistExport implements FromView
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function view(): View
    {
        $data = DB::table('return_outlists')
            ->select(
                'return_outlists.*',
                'return_outlists.id as returned_id',
                'users.*',
                'positions.*',
                'section.*',
                'departments.*',
                'categories.*',
                'item_codes.*'
            )
            ->join('users', 'return_outlists.staff_id', 'users.id')
            ->join('item_codes', 'return_outlists.pro_code', '=', 'item_codes.id')
            ->join('categories', 'item_codes.item_cat', 'categories.id')
            ->join('positions', 'positions.id', '=', 'users.position')
            ->join('section', 'positions.section_id', '=', 'section.id')
            ->join('departments', 'departments.id', 'section.department_id')
            ->orderBy('return_outlists.id', 'desc');

        return view('export.return-outlist', ['items' => $data->get(), 'title' => __("nav.returnOutList")]);
    }
}
