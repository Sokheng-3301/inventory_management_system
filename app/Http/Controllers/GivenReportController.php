<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class GivenReportController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        ////////////////
            /// inventory report
            $items = 0;
            $coutn_items = DB::table('products')->where('delete_status', 1)->where('year', date('Y'))->get();
            foreach ($coutn_items as $c_item) {
                $items += $c_item->fix_qty;
            }
            $data['count_item'] = $items;


            // expense report
            $expense = 0;
            $ite_expense = DB::table('products')->where('delete_status', 1)->where('price', '!=', null)->where('year', date('Y'))->get();
            foreach ($ite_expense as $ite_ex) {
                $expense += $ite_ex->qty * $ite_ex->price;
            }

            $service_expense = DB::table('service_fees')->get();
            foreach ($service_expense as $service) {
                $expense += $service->price;
            }
            $data['expense'] = $expense;


            //given item
            $given_item = 0;
            $query = DB::table('give_table')->where('return_status', 1)->where('year', date('Y'))->get();

            foreach ($query as $q) {
                $product_alls = $q->product_id;
                $exp_pro_alls = explode(',', $product_alls);
                $length = count($exp_pro_alls);
                $given_item += $length;
            }
            $data['given_item'] = $given_item;


            // returned item
            $return_item = 0;
            $query = DB::table('give_table')
                ->where('any_return_status', 0)
                ->where('year', date('Y'))
                ->get();

            foreach ($query as $q) {
                $exp_pro_handle = explode(',', $q->product_id);
                $ex_constant_proid = explode(',', $q->constant_proid);
                $productReturnedIds = array_diff($ex_constant_proid, $exp_pro_handle);
                // Calculate the number of items to return based on return_status
                if ($q->return_status == 1) {
                    $lengthReturnAlls = count($productReturnedIds);
                } else {
                    $lengthReturnAlls = count($ex_constant_proid);
                }
                // Accumulate total return items
                $return_item += $lengthReturnAlls;
            }

            $data['returned_item'] = $return_item;





        ////////////////


        $giveDate = '';
        if($request){
            $year = $request->year;
            $month = $request->month;
            $week = $request->week;
            $giveDateInput = $request->giveDate;

            $department = $request->department;
            $section = $request->section;
            $position = $request->position;
            $staff_id = $request->staff_id;

            $data['year'] = $year;
            $data['month'] = $month;
            $data['week'] = $week;
            $data['giveDate'] = $giveDateInput;
            $data['department'] = $department;
            $data['section'] = $section;
            $data['position'] = $position;
            $data['staff_id'] = $staff_id;

            if ($giveDateInput != '') {
                $giveDate = date_create($giveDateInput);
                $giveDate = date_format($giveDate, 'Y-m-d');
            } else {
                $giveDate = '';
            }
        }

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
            // ->where('give_table.year', date('Y'))
            ->join('products', 'give_table.product_id', '=', 'products.id')
            ->join('item_codes', 'products.pro_code', '=', 'item_codes.id')
            ->join('categories', 'item_codes.item_cat', 'categories.id')
            ->join('users', 'give_table.staff_id', '=', 'users.id')
            ->join('positions', 'positions.id', '=', 'users.position')
            ->join('section', 'positions.section_id', '=', 'section.id')
            ->join('departments', 'departments.id', 'section.department_id')
            ->orderBy('give_table.id', 'desc');


        if (($year != '') && empty($month) && empty($week) && empty($giveDate) && empty($department) && empty($section) && empty($position) && empty($staff_id)) {
            $data['product'] = $query->where('give_table.year', $year)->get();
        } elseif (($month != '') && empty($week) && empty($giveDate) && empty($department) && empty($section) && empty($position) && empty($staff_id)) {
            $data['product'] = $query->where('give_table.year', $year)
                ->whereMonth('give_table.date', $month)->get();
        } elseif (($week != '') && empty($month) && empty($week) && empty($giveDate) && empty($department) && empty($section) && empty($position) && empty($staff_id)) {
            $start_day = ($week - 1) * 7 + 1; // Start day of the week
            $start_weekly = Carbon::createFromFormat('Y-m-d', date($year . '-m-' . sprintf('%02d', $start_day)));
            $end_weekly = $start_weekly->copy()->addDays(7); // Use copy to avoid modifying $start_weekly
            $start_weekly = substr($start_weekly, '0', '10');
            $end_weekly = substr($end_weekly, '0', '10');

            $data['product'] = $query->where('give_table.year', $year)
                ->whereBetween('give_table.date', [$start_weekly, $end_weekly])->get();
        } elseif ((($giveDate != '') && empty($month) && empty($week) && empty($department) && empty($section) && empty($position) && empty($staff_id)) || $giveDate != '') {
            $data['product'] = $query
                ->where('give_table.year', $year)
                ->whereDate('give_table.date', $giveDate)->get();
        } elseif(($department != '')) {
            $data['product'] = $query->where('give_table.year', $year)
                ->where('departments.id', $department)->get();
        } elseif(($section != '')) {
            $data['product'] = $query->where('give_table.year', $year)
                ->where('section.id', $section)->get();
        }elseif(($position != '')) {
            $data['product'] = $query->where('give_table.year', $year)
                ->where('positions.id', $position)->get();
        }elseif(($staff_id != '') && empty($month) && empty($week) && empty($giveDate) && empty($department) && empty($section) && empty($position) || $staff_id != '') {
            $data['product'] = $query->where('give_table.year', $year)
                ->where('users.card_id', 'LIKE', "%{$staff_id}%")->get();
        }elseif(($year && $month && $week && $department && $section && $position) != '') {

            $start_day = ($week - 1) * 7 + 1; // Start day of the week
            $start_weekly = Carbon::createFromFormat('Y-m-d', date($year . '-' . $month . '-' . sprintf('%02d', $start_day)));
            $end_weekly = $start_weekly->copy()->addDays(7); // Use copy to avoid modifying $start_weekly


            $start_weekly = substr($start_weekly, '0', '10');
            $end_weekly = substr($end_weekly, '0', '10');

            $data['product'] = $query
                ->where('give_table.year', $year)
                // ->whereMonth('give_table.date', $month)
                ->where('positions.id', $position)
                ->whereBetween('give_table.date', [$start_weekly, $end_weekly])
                ->where('users.card_id', 'LIKE', "%{$staff_id}%")->get();
        }elseif((!empty($year) && !empty($month) && !empty($week)) && (empty($giveDate) && empty($department) && empty($section) && empty($position) && empty($staff_id))) {

            $start_day = ($week - 1) * 7 + 1; // Start day of the week
            $start_weekly = Carbon::createFromFormat('Y-m-d', date($year . '-' . $month . '-' . sprintf('%02d', $start_day)));
            $end_weekly = $start_weekly->copy()->addDays(7); // Use copy to avoid modifying $start_weekly


            $start_weekly = substr($start_weekly, '0', '10');
            $end_weekly = substr($end_weekly, '0', '10');

            // echo $start_weekly . "<br>";
            // echo $end_weekly;
            // exit;

            $data['product'] = $query->where('give_table.year', $year)
                // ->whereMonth('give_table.date', $month)
                // ->where('positions.id', $position)
                ->whereBetween('give_table.date', [$start_weekly, $end_weekly])->get();
        }elseif(($year && $month) != '' && (empty($week) && empty($giveDate) && empty($department) && empty($section) && empty($position) && empty($staff_id))) {
            // $start_day = ($week - 1) * 7 + 1; // Start day of the week
            // $start_weekly = Carbon::createFromFormat('Y-m-d', date($year . '-'. $month .'-' . sprintf('%02d', $start_day)));
            // $end_weekly = $start_weekly->copy()->addDays(7); // Use copy to avoid modifying $start_weekly


            // $start_weekly = substr($start_weekly, '0', '10');
            // $end_weekly = substr($end_weekly, '0', '10');

            $data['product'] = $query->where('give_table.return_status', 1)
                ->where('give_table.year', $year)
                ->whereMonth('give_table.date', $month)->get();
        }else{
            $data['product'] = $query->where('give_table.year', date('Y'))->get();
        }

        $data['action'] = DB::table('apply_funcion_for_role')
            ->where('role_id', @Auth::user()->role_id)
            ->get()->first();
        // $data['product'] = '';
        // foreach ($data['product'] as $p) {
        //     // print_r($p);
        //     echo $p->item_name_kh;
        // }
        return view('all-report.given', $data);

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
