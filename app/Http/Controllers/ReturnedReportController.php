<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class ReturnedReportController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
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

        $data['product'] = DB::table('give_table')
            ->select(
                'give_table.*',
                'give_table.id as giveId',
                // 'products.pro_img',
                // 'products.pro_name_en',
                // 'products.pro_name_kh',
                // 'products.pro_code',
                'products.id as proId',
                // 'products.model',
                // 'products.fix_asset_code',
                // 'products.serial_number',
                'users.*',
                'positions.*',
                'section.*',
                'departments.*',
                // 'categories.*'
            )
            ->where('give_table.any_return_status', 0)
            ->join('products', 'give_table.product_id', '=', 'products.id')
            // ->join('categories', 'products.cat_id', 'categories.id')
            ->join('users', 'give_table.staff_id', '=', 'users.id')
            ->join('positions', 'positions.id', '=', 'users.position')
            ->join('section', 'positions.section_id', '=', 'section.id')
            ->join('departments', 'departments.id', 'section.department_id')
            ->orderBy('give_table.returned_date', 'desc')
            ->get();

        $data['action'] = DB::table('apply_funcion_for_role')
            ->where('role_id', @Auth::user()->role_id)
            ->get()->first();

        return view('all-report.returned', $data);

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
