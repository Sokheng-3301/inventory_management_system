<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromView;

class CategoryExport implements FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function view(): View
    {
        $category = DB::table('categories')
                ->where('delete_status', 1)
                -> orderBy('id', 'desc');
        return view('export.category', ['categories' => $category->get(), 'title'=> __("nav.category")]);
    }
}
