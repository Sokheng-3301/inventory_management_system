<?php

namespace App\Exports;

use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\FromCollection;

class ServiceFeeExport implements FromView
{
    protected $year;
    protected $startDate;
    protected $endDate;

    public function __construct($year, $startDate = null, $endDate = null)
    {
        $this->year = $year;
        $this->startDate = $startDate;
        $this->endDate = $endDate;
    }

    public function view(): View
    {
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

        return view('export.service-fee', [
            'items' => $data['service_fees'],
            'title' => __("nav.serviceFee"),
        ]);
    }
}
