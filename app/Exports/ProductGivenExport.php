<?php

namespace App\Exports;

use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Request;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\FromCollection;

class ProductGivenExport implements FromView
{
    protected $year;
    protected $month;
    protected $week;
    protected $givenDateInput;
    protected $department;
    protected $section;
    protected $position;
    protected $staff_id;

    public function __construct($year, $month, $week, $givenDateInput, $department, $section, $position, $staff_id)
    {
        $this->year = $year;
        $this->month = $month;
        $this->week = $week;
        $this->givenDateInput = $givenDateInput;
        $this->department = $department;
        $this->section = $section;
        $this->position = $position;
        $this->staff_id = $staff_id;
    }

    public function view(): View
    {
        $query = DB::table('give_table')
            ->select(
                'give_table.*',
                'give_table.id as giveId',
                'give_table.add_by as operator',
                'give_table.return_any_product',
                'products.pro_img',
                'products.id as proId',
                'products.model',
                'products.fix_asset_code',
                'products.serial_number',
                'users.*',
                'positions.*',
                'section.*',
                'departments.*',
                'categories.*',
                'item_codes.*'
            )
            ->where('give_table.return_status', 1)
            ->join('products', 'give_table.product_id', '=', 'products.id')
            ->join('item_codes', 'products.pro_code', '=', 'item_codes.id')
            ->join('categories', 'item_codes.item_cat', '=', 'categories.id')
            ->join('users', 'give_table.staff_id', '=', 'users.id')
            ->join('positions', 'positions.id', '=', 'users.position')
            ->join('section', 'positions.section_id', '=', 'section.id')
            ->join('departments', 'departments.id', '=', 'section.department_id')
            ->orderBy('give_table.date', 'asc');


        // Build conditions
        if ($this->year) {
            $query->where('give_table.year', $this->year);
        }

        if ($this->month) {
            $query->whereMonth('give_table.date', $this->month);
        }

        if ($this->week) {
            $start_day = ($this->week - 1) * 7 + 1;
            $start_weekly = Carbon::createFromFormat('Y-m-d', "{$this->year}-{$this->month}-{$start_day}")->format('Y-m-d');
            $end_weekly = Carbon::createFromFormat('Y-m-d', $start_weekly)->addDays(7)->format('Y-m-d');
            $query->whereBetween('give_table.date', [$start_weekly, $end_weekly]);
        }

        if ($this->givenDateInput) {
            $query->whereDate('give_table.date', Carbon::parse($this->givenDateInput)->format('Y-m-d'));
        }

        if ($this->department) {
            $query->where('departments.id', $this->department);
        }

        if ($this->section) {
            $query->where('section.id', $this->section);
        }

        if ($this->position) {
            $query->where('positions.id', $this->position);
        }

        if ($this->staff_id) {
            $query->where('users.card_id', 'LIKE', "%{$this->staff_id}%");
        }

        // Execute the query
        $data['product'] = $query->get();

        // Return the view with the data
        return view('export.given-product', ['products' => $data['product'], 'title' => __("nav.proGiven")]);
    }
}
