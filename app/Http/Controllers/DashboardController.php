<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $currentYear = now()->year;
        if($request->year){
            $currentYear = $request->year;
        }else{
            $currentYear = now()->year;
        }

        // instock count
        $items = 0;
        $coutn_items = DB::table('products')->where('delete_status', 1)->where('stock_status', 1)->get();
        foreach ($coutn_items as $c_item) {
            $items += $c_item->fix_qty;
        }
        $data['instock'] = $items;

        // outstock count
        $data['outstock'] = DB::table('products')
            ->where('stock_status', 0)
            ->where('delete_status', 1)
            ->sum('fix_qty');
        // ->get();

        // $data['overdraft']  = DB::table('borrows')
        //     ->join('users', 'users.card_id', 'borrows.staff_id')
        //     ->join('products', 'products.id', 'borrows.pro_id')

        //     ->where('borrows.borrow_status', 1)
        //     ->where('borrows.payback_status', 2)
        //     ->orderBy('borrows.borrow_id', 'desc')
        //     ->limit(6)
        //     ->get();

        // $data['notification'] = DB::table('borrows')
        //     ->join('users', 'users.card_id', 'borrows.staff_id')
        //     ->join('products', 'products.id', 'borrows.pro_id')
        //     ->where('borrows.borrow_status', 0)
        //     ->orWhere('borrows.notification', 1)
        //     ->orderBy('borrows.borrow_id', 'desc')
        //     ->limit(6)
        //     ->get();

        $data['blocked_account'] = DB::table('users')
            ->join('positions', 'users.position', 'positions.id')
            ->where('users.block_status', 0)
            ->get();

        $given_item = 0;
        $query = DB::table('give_table')->where('return_status', 1)->where('year', $currentYear)->get();

        foreach ($query as $q) {
            $product_alls = $q->product_id;
            $exp_pro_alls = explode(',', $product_alls);
            $length = count($exp_pro_alls);
            $given_item += $length;
        }
        $data['given_item'] = $given_item;

        // expense report
        $expenseITE = 0;
        $ite_expense = DB::table('products')->where('delete_status', 1)->where('price', '!=', null)->where('year', $currentYear)->get();
        foreach ($ite_expense as $ite_ex) {
            $expenseITE += $ite_ex->qty * $ite_ex->price;
        }
        $data['expenseITE'] = $expenseITE;

        $expenseServiceFee = 0;
        $service_expense = DB::table('service_fees')->whereYear('date', $currentYear)->get();
        foreach ($service_expense as $service) {
            $expenseServiceFee += $service->price;
        }
        $data['expenseServiceFee'] = $expenseServiceFee;

        $data['expenseTotal'] = $expenseITE + $expenseServiceFee;

        if ($expenseServiceFee > $expenseITE) {
            $data['max_value'] = $expenseServiceFee;
        } else {
            $data['max_value'] = $expenseITE;
        }

        $queryExpenseITEMonth1 = DB::table('products')->where('delete_status', 1)->where('price', '!=', null)->where('year', $currentYear)->whereMonth('expense_date', 1)->sum(DB::raw('qty * price'));
        $queryExpenseITEMonth2 = DB::table('products')->where('delete_status', 1)->where('price', '!=', null)->where('year', $currentYear)->whereMonth('expense_date', 2)->sum(DB::raw('qty * price'));
        $queryExpenseITEMonth3 = DB::table('products')->where('delete_status', 1)->where('price', '!=', null)->where('year', $currentYear)->whereMonth('expense_date', 3)->sum(DB::raw('qty * price'));
        $queryExpenseITEMonth4 = DB::table('products')->where('delete_status', 1)->where('price', '!=', null)->where('year', $currentYear)->whereMonth('expense_date', 4)->sum(DB::raw('qty * price'));
        $queryExpenseITEMonth5 = DB::table('products')->where('delete_status', 1)->where('price', '!=', null)->where('year', $currentYear)->whereMonth('expense_date', 5)->sum(DB::raw('qty * price'));
        $queryExpenseITEMonth6 = DB::table('products')->where('delete_status', 1)->where('price', '!=', null)->where('year', $currentYear)->whereMonth('expense_date', 6)->sum(DB::raw('qty * price'));
        $queryExpenseITEMonth7 = DB::table('products')->where('delete_status', 1)->where('price', '!=', null)->where('year', $currentYear)->whereMonth('expense_date', 7)->sum(DB::raw('qty * price'));
        $queryExpenseITEMonth8 = DB::table('products')->where('delete_status', 1)->where('price', '!=', null)->where('year', $currentYear)->whereMonth('expense_date', 8)->sum(DB::raw('qty * price'));
        $queryExpenseITEMonth9 = DB::table('products')->where('delete_status', 1)->where('price', '!=', null)->where('year', $currentYear)->whereMonth('expense_date', 9)->sum(DB::raw('qty * price'));
        $queryExpenseITEMonth10 = DB::table('products')->where('delete_status', 1)->where('price', '!=', null)->where('year', $currentYear)->whereMonth('expense_date', 10)->sum(DB::raw('qty * price'));
        $queryExpenseITEMonth11 = DB::table('products')->where('delete_status', 1)->where('price', '!=', null)->where('year', $currentYear)->whereMonth('expense_date', 11)->sum(DB::raw('qty * price'));
        $queryExpenseITEMonth12 = DB::table('products')->where('delete_status', 1)->where('price', '!=', null)->where('year', $currentYear)->whereMonth('expense_date', 12)->sum(DB::raw('qty * price'));

        $data['monthsITEPurchase'] = [
            $queryExpenseITEMonth1,
            $queryExpenseITEMonth2,
            $queryExpenseITEMonth3,
            $queryExpenseITEMonth4,
            $queryExpenseITEMonth5,
            $queryExpenseITEMonth6,
            $queryExpenseITEMonth7,
            $queryExpenseITEMonth8,
            $queryExpenseITEMonth9,
            $queryExpenseITEMonth10,
            $queryExpenseITEMonth11,
            $queryExpenseITEMonth12
        ];


        $queryExpenseServiceFeeforMonth1 = DB::table('service_fees')->where('year', $currentYear)->whereMonth('date', 1)->sum('price');
        $queryExpenseServiceFeeforMonth2 = DB::table('service_fees')->where('year', $currentYear)->whereMonth('date', 2)->sum('price');
        $queryExpenseServiceFeeforMonth3 = DB::table('service_fees')->where('year', $currentYear)->whereMonth('date', 3)->sum('price');
        $queryExpenseServiceFeeforMonth4 = DB::table('service_fees')->where('year', $currentYear)->whereMonth('date', 4)->sum('price');
        $queryExpenseServiceFeeforMonth5 = DB::table('service_fees')->where('year', $currentYear)->whereMonth('date', 5)->sum('price');
        $queryExpenseServiceFeeforMonth6 = DB::table('service_fees')->where('year', $currentYear)->whereMonth('date', 6)->sum('price');
        $queryExpenseServiceFeeforMonth7 = DB::table('service_fees')->where('year', $currentYear)->whereMonth('date', 7)->sum('price');
        $queryExpenseServiceFeeforMonth8 = DB::table('service_fees')->where('year', $currentYear)->whereMonth('date', 8)->sum('price');
        $queryExpenseServiceFeeforMonth9 = DB::table('service_fees')->where('year', $currentYear)->whereMonth('date', 9)->sum('price');
        $queryExpenseServiceFeeforMonth10 = DB::table('service_fees')->where('year', $currentYear)->whereMonth('date', 10)->sum('price');
        $queryExpenseServiceFeeforMonth11 = DB::table('service_fees')->where('year', $currentYear)->whereMonth('date', 11)->sum('price');
        $queryExpenseServiceFeeforMonth12 = DB::table('service_fees')->where('year', $currentYear)->whereMonth('date', 12)->sum('price');

        $data['monthsService'] = [
            $queryExpenseServiceFeeforMonth1,
            $queryExpenseServiceFeeforMonth2,
            $queryExpenseServiceFeeforMonth3,
            $queryExpenseServiceFeeforMonth4,
            $queryExpenseServiceFeeforMonth5,
            $queryExpenseServiceFeeforMonth6,
            $queryExpenseServiceFeeforMonth7,
            $queryExpenseServiceFeeforMonth8,
            $queryExpenseServiceFeeforMonth9,
            $queryExpenseServiceFeeforMonth10,
            $queryExpenseServiceFeeforMonth11,
            $queryExpenseServiceFeeforMonth12
        ];

        // COUNT ITEM
        /// inventory report
        $items = 0;
        $coutn_items = DB::table('products')->where('delete_status', 1)->where('year', $currentYear)->get();
        foreach ($coutn_items as $c_item) {
            $items += $c_item->fix_qty;
        }
        $data['count_item'] = $items;


        // Count by ITEM CODE
        $item_codes = DB::table('item_codes')
            ->where('delete_status', 1)
            ->orderBy('id', 'asc')
            ->get()
            ->map(function ($item_code) use ($currentYear) {
                $item_code->total_qty = DB::table('products')
                    ->where('pro_code', $item_code->id)
                    ->where('delete_status', 1)
                    ->where('year', $currentYear)
                    ->sum('fix_qty');
                return $item_code;
            });
        $data['item_code_counts'] = $item_codes;


        // old item count
        $data['old_item_count'] = DB::table('return_outlists')->whereYear('returned_date', $currentYear)->get()->count();

        // count by code
        $countReturnOulistByItemCode = DB::table('item_codes')
            ->where('item_codes.delete_status', 1)
            ->orderBy('id', 'asc')
            ->get()
            ->map(function ($item_code) use ($currentYear) {
                $item_code->total_qty = DB::table('return_outlists')
                    ->whereYear('returned_date', $currentYear)
                    ->where('pro_code', $item_code->id)->count();
                return $item_code;
            });
        $data['countReturnOulistByItemCode'] = $countReturnOulistByItemCode;


        // Count given item by Item Code
        // Count by ITEM CODE
        // $item_codes_given = DB::table('item_codes')
        //     ->where('item_codes.delete_status', 1)
        //     ->orderBy('id', 'asc')
        //     ->get()
        //     ->map(function ($item_code) {
        //         $item_code->total_qty = DB::table('give_table')
        //             ->where('pro_code', $item_code->id)
        //             ->where('products.delete_status', 1)
        //             ->where('year', $currentYear)
        //             ->sum('fix_qty');
        //         return $item_code;
        //     });

        $given_items = DB::table('give_table')
            ->where('return_status', 1)
            ->where('year', $currentYear)
            ->get();

        $item_counts = []; // Array to hold item counts

        foreach ($given_items as $item) {
            $product_ids = explode(',', $item->product_id);

            foreach ($product_ids as $product_id) {
                $item_code = DB::table('item_codes')
                    ->join('products', 'item_codes.id', '=', 'products.pro_code')
                    ->where('products.id', $product_id)
                    ->first(); // Get the first matching item code

                if ($item_code) {
                    $code = $item_code->item_code;

                    // Initialize or increment the count for the item code
                    if (!isset($item_counts[$code])) {
                        $item_counts[$code] = [
                            'name_en' => $item_code->item_name_en,
                            'name_kh' => $item_code->item_name_kh,
                            'count' => 0
                        ];
                    }
                    $item_counts[$code]['count']++;
                }
            }
        }
        $data['item_given_counts_byCode'] = $item_counts;
        // Output the results
        // echo "<pre>";
        // foreach ($item_counts as $code => $data) {
        //     echo "Item Code: $code, Item Name: {$data['name_kh']}, Total: {$data['count']}<br>";
        // }
        // echo "</pre>";
        // exit;
        return view('welcome', $data);
    }

    public function getClickSidebar(){
        session(['click_sidebar' => !session('click_sidebar', false)]);
        return response()->json(['status' => 'success', 'message' => 'Sidebar click recorded']);
    }
}
