<?php

namespace App\Exports;

use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\FromCollection;

class AllExpenseReportExport implements FromView
{
    /**
     * @return \Illuminate\Support\Collection
     */
    protected $year;
    protected $startDate;
    protected $endDate;

    public function __construct($year, $startDate, $endDate)
    {
        $this->year = $year;
        $this->startDate = $startDate;
        $this->endDate = $endDate;
    }

    public function view(): View
    {
        $query = DB::table('products')
            ->select('products.*', 'products.id as proId', 'products.add_by as operator', 'categories.*', 'item_codes.*')
            ->join('item_codes', 'products.pro_code', '=', 'item_codes.id')
            ->join('categories', 'item_codes.item_cat', '=', 'categories.id')
            ->where('products.price', '!=', null)
            ->orderBy('products.id', 'desc');

        // Use class properties instead of local variables
        $startDate = $this->startDate ? date_create($this->startDate) : null;
        $endDate = $this->endDate ? date_create($this->endDate) : null;
        $currentYear = now()->year;

        if ($this->year != '' && !$startDate && !$endDate) {
            // Year only
            $data['expenses'] = $query->where('products.year', $currentYear)->get();
        } elseif ($this->year != '' && $startDate && !$endDate) {
            // Equipment type and start date to now
            $data['expenses'] = $query->whereBetween('products.expense_date', [
                Carbon::parse($startDate)->format('Y-m-d'),
                now()->format('Y-m-d')
            ])->get();
        } elseif ($this->year != '' && $startDate && $endDate) {
            // Equipment type and date range
            $data['expenses'] = $query->whereBetween('products.expense_date', [
                $startDate,
                $endDate
            ])->get();
        } else {
            // Default case
            $data['expenses'] = $query->where('products.year', $currentYear)->get();
        }


        // SERVICE FEE
        $query = DB::table('service_fees')->orderBy('id', 'desc');

        if (!empty($this->year) && empty($this->startDate) && empty($this->endDate)) {
            $data['service_fees'] = $query->where('year', $this->year)->get();
        } elseif (!empty($this->year) && !empty($this->startDate) && empty($this->endDate)) {
            $data['service_fees'] = $query->where('year', $this->year)
                ->where('date', '>=', Carbon::parse($this->startDate)->format('Y-m-d'))
                ->get();
        } elseif (!empty($this->year) && !empty($this->startDate) && !empty($this->endDate)) {
            $data['service_fees'] = $query->where('year', $this->year)
                ->whereBetween('date', [
                    Carbon::parse($this->startDate)->format('Y-m-d'),
                    Carbon::parse($this->endDate)->format('Y-m-d'),
                ])->get();
        } else {
            $data['service_fees'] = $query->where('year', date('Y'))->get();
        }

        return view('export.all-expense', [
            'items' => $data['expenses'],
            'service_fees' => $data['service_fees'],
            'title' => __("nav.expenseReport")
        ]);
    }
}
