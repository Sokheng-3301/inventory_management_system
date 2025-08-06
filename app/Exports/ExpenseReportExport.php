<?php

namespace App\Exports;

use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;

class ExpenseReportExport implements FromView
{
    /**
     * @return \Illuminate\Support\Collection
     */
    protected $year;
    protected $equipmentType;
    protected $startDate;
    protected $endDate;

    public function __construct($year, $equipmentType, $startDate, $endDate)
    {
        $this->year = $year;
        $this->equipmentType = $equipmentType;
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

        if ($this->year != '' && empty($this->equipmentType) && !$startDate && !$endDate) {
            // Year only
            $data['expenses'] = $query->where('products.year', $currentYear)->get();
        } elseif ($this->year != '' && $this->equipmentType != '' && !$startDate && !$endDate) {
            // Year and equipment type
            $data['expenses'] = $query->where('products.year', $currentYear)
                ->where('item_codes.equipment_type', $this->equipmentType)
                ->get();
        } elseif ($this->year != '' && $this->equipmentType != '' && $startDate && !$endDate) {
            // Equipment type and start date to now
            $data['expenses'] = $query->whereBetween('products.expense_date', [
                Carbon::parse($startDate)->format('Y-m-d'),
                now()->format('Y-m-d')
            ])->where('item_codes.equipment_type', $this->equipmentType)->get();
        } elseif ($this->year != '' && $this->equipmentType != '' && $startDate && $endDate) {
            // Equipment type and date range
            $data['expenses'] = $query->whereBetween('products.expense_date', [
                $startDate,
                $endDate
            ])->where('item_codes.equipment_type', $this->equipmentType)->get();
        } elseif ($this->year != '' && empty($this->equipmentType) && $startDate && $endDate) {
            // Start date and end date
            $data['expenses'] = $query->whereBetween('products.expense_date', [
                $startDate,
                $endDate
            ])->get();
        } elseif ($this->year != '' && empty($this->equipmentType) && $startDate && !$endDate) {
            // Start date to now
            $data['expenses'] = $query->whereBetween('products.expense_date', [
                $startDate,
                now()->format('Y-m-d')
            ])->get();
        } else {
            // Default case
            $data['expenses'] = $query->where('products.year', $currentYear)->get();
        }

        return view('export.expense-report', [
            'items' => $data['expenses'],
            'title' => __("nav.expenseReport")
        ]);
    }
}
