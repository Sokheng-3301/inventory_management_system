<?php

namespace App\Http\Controllers;

use App\Exports\InventoryLisetExport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use KhmerPdf\LaravelKhPdf\Facades\PdfKh;

class InventorylistController extends Controller
{
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
        $data['product'] = DB::table('products')
            ->select('products.*', 'products.id as proId', 'categories.cat_name', 'categories.id as cat_id', 'item_codes.*')
            ->join('item_codes', 'products.pro_code', '=', 'item_codes.id')
            ->join('categories', 'item_codes.item_cat', '=', 'categories.id')
            ->where('products.delete_status', 1)
            ->orderBy('products.stock_status', 'desc')
            ->orderBy('products.id', 'desc')
            ->get();

        $data['action'] = DB::table('apply_funcion_for_role')
            ->where('role_id', @Auth::user()->role_id)
            ->get()->first();


        $data['users'] = DB::table('users')
            ->where('block_status', 1)
            ->orderBy('id', 'desc')
            ->get();

        return view('product.inventory-list', $data);
    }

    public function show(string $id)
    {
        $data['item'] =  DB::table('products')
            ->select('products.*', 'categories.cat_name', 'categories.id as cat_id')
            // ->where('products.stock_status', 1)
            ->join('categories', 'products.cat_id', '=', 'categories.id')
            // ->orderBy('categories.id', 'asc')
            // ->orderBy('products.delete_status', 'desc')
            ->where('products.id', $id)
            ->orderBy('products.stock_status', 'desc')
            ->orderBy('products.id', 'desc')

            ->get()->first();
        if (!$data['item']) {
            return redirect()->back();
        } else {
            return view('product.product-detail', $data);
        }
    }


    // export product instock lists
    public function exportExcel()
    {
        return Excel::download(new InventoryLisetExport, 'inventory-list-' . now()->format("d-m-Y__h-i-s") . '.xlsx');
    }

    public function exportPdf()
    {
        $data = DB::table('products')
            ->select('products.*', 'categories.cat_name', 'categories.id as cat_id', 'item_codes.*')
            ->join('item_codes', 'item_codes.id', '=', 'products.pro_code')
            ->join('categories', 'item_codes.item_cat', '=', 'categories.id')
            ->orderBy('products.stock_status', 'desc')
            ->orderBy('products.id', 'desc')
            ->get();

        $html = view('pdf.item-instock', ['items' => $data, 'title' => __("nav.inventory_list")])->render();
        return PdfKh::loadHtml($html)
            ->addMPdfConfig([
                'mode' => 'utf-8',
                'format' => 'A4-L',
            ])
            ->download('inventory-list-' . now()->format('d-m-Y__h-i-s') . '.pdf');
    }
}
