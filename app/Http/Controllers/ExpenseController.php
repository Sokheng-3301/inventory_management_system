<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class ExpenseController extends Controller
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

        $data['action'] = DB::table('apply_funcion_for_role')
            ->where('role_id', @Auth::user()->role_id)
            ->get()->first();
        // $data['expenses'] = '';

        $query = DB::table('products')
            ->select('products.*', 'products.id as proId', 'products.add_by as operator', 'categories.*', 'item_codes.*')
            ->join('item_codes', 'products.pro_code', '=', 'item_codes.id')
            ->join('categories', 'item_codes.item_cat', '=', 'categories.id')
            ->where('products.price', '!=', null)
            ->orderBy('products.id', 'desc');

        $year = $request->year;
        // $equipment_type = $request->equipment_type;

        $start_date = $request->start_date;
        $end_date = $request->end_date;

        if ($start_date) {
            $start_date = date_create($start_date);
            // $start_date = Carbon::parse($start_date)->format('Y-m-d');
        }

        if ($end_date) {
            $end_date = date_create($end_date);
            // $end_date = Carbon::parse($end_date)->format('Y-m-d');
        }
        // $end_date = $request->end_date;

        if ($year != ''  && empty($start_date)  && empty($end_date)) {
            // year only
            $data['expenses'] = $query->where('products.year', now()->year)->get();
        } elseif ($year != ''  && $start_date  && empty($end_date)) {
            // echo 'equipment and start date to now';
            $data['expenses'] = $query->whereBetween('products.expense_date', [
                Carbon::parse($start_date)->format('Y-m-d'),
                now()->format('Y-m-d')
            ])->get();
        } elseif ($year != '' && !empty($start_date) && !empty($end_date)) {
            // Fetch expenses based on equipment type and date range
            $data['expenses'] = $query->whereBetween('products.expense_date', [
                $start_date,
                $end_date
            ])->get();
        } else {
            $data['expenses'] = $query->where('products.year', now()->year)->get();
        }


        // ******************************* SERViCE FEE *****************
        if ($request) {
            $year = $request->year;
            $start_date = $request->start_date;
            $end_date = $request->end_date;
        }

        $query = DB::table('service_fees')->orderBy('id', 'desc');

        if ($year != '' && empty($start_date) && empty($end_date)) {
            $data['service_fees'] = $query->where('year', $year)->get();
        } elseif ($year != '' && $start_date && empty($end_date)) {
            $data['service_fees'] = $query->whereBetween('date', [
                Carbon::parse($start_date)->format('Y-m-d'),
                now()->format('Y-m-d'),
            ])->get();
        } elseif ($year != '' && $start_date && $end_date) {
            $data['service_fees'] = $query->whereBetween('date', [
                Carbon::parse($start_date)->format('Y-m-d'),
                Carbon::parse($end_date)->format('Y-m-d'),
            ])->get();
        } else {
            $data['service_fees'] = $query->where('year', date('Y'))->get();
        }
        return view('all-report.expenses', $data);
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
