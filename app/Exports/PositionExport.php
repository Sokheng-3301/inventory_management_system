<?php

namespace App\Exports;

use Illuminate\Support\Facades\DB;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\FromCollection;

class PositionExport implements FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function view(): View
    {
        $data = DB::table('positions')
                ->select('positions.id',
                'positions.position_name',
                'positions.department_id',
                'positions.add_by',
                'positions.create_date',
                'positions.delete_status',
                'positions.delete_by',
                'positions.delete_date',
                'departments.dep_name_kh',
                'departments.dep_name_en',
                'section.section_en', 'section.section_kh', 'section.id as sectionId')
                ->join('section', 'positions.section_id', '=', 'section.id')
                ->join('departments', 'section.department_id', '=' ,'departments.id')
                ->where('positions.delete_status', 1)
                ->orderBy('positions.id', 'desc');

        return view('export.position', ['positions'=>$data->get(), 'title'=>__("nav.position")]);

    }
}
