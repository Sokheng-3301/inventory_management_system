<?php

namespace App\Http\Controllers;

use App\Models\Borrow;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;



class BorrwController extends Controller
{
    
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
        $data['borrowing'] = DB::table('borrows')
                                ->select('borrows.*', 'products.*', 'categories.*', 'users.*', 'positions.*', 'departments.*', 'section.*')
                                ->where('borrows.borrow_status', 1)
                                ->where('payback_status', 1)
                                ->join('products', 'borrows.pro_id', 'products.id')
                                ->join('categories', 'products.cat_id', 'categories.id')
                                // ->join('users', 'users.card_id', 'borrows.staff_id')
                                // ->join('staff_users', 'users.card_id', 'staff_users.card_id')
                                ->join('users', 'users.id', 'borrows.staff_id')
                                // ->join('staff_users', 'users.id', 'staff_users.card_id')

                                ->join('positions', 'users.position', 'positions.id')
                                ->join('section', 'section.id', 'positions.section_id')
                                ->join('departments', 'section.department_id', 'departments.id')

                                ->orderBy('borrows.borrow_id', 'desc')
                                ->get();


        $data['action'] = DB::table('apply_funcion_for_role')
                                ->where('role_id', @Auth::user()->role_id)
                                ->get()->first();
                                
        return view('borrow.borrow-list', $data);
    }

    public function return(Request $r){

        $runScript = false;
        $id = $r->borrowId;
        $proId = $r->proId;
        $retrunDate = now();
        $borrowQty  = $r->borrowQty;

        if(($id && $borrowQty && $proId) != ''){
            $runScript = true;
        }else{
            $runScript = false;
        }
            
        if($runScript == true){
            $return = DB::table('borrows')
                    ->where('borrow_id', $id)
                    ->update(['payback_status' => 0, 
                                'payback_date' => $retrunDate]);

            if($return == true){
                $qtyQry = DB::table('products')
                            ->select('id', 'qty')
                            ->where('id', $proId)  
                            ->get()->first();
                $proQty = $qtyQry->qty;
                $updateQty = $proQty+$borrowQty;

                DB::table('products')
                    ->where('id', $proId)
                    ->update(['qty' => $updateQty, 'stock_status' => 1]);
                
                return redirect()->back()->with('return', true);
            }else{
                // dd('no update');
                return redirect()->back()->with('error', true);
            }
        }else{
            return redirect()->back()->with('error', true);
        }
    }

    public function viewReturn(){
        $data['return'] = DB::table('borrows')
                        ->select('borrows.*', 'products.*', 'categories.*', 'users.*', 'positions.*', 'departments.*', 'section.*')
                        ->where('borrows.borrow_status', 1)
                        ->where('borrows.payback_status', 0)
                        ->join('products', 'borrows.pro_id', 'products.id')
                        ->join('categories', 'products.cat_id', 'categories.id')
                        // ->join('users', 'users.card_id', 'borrows.staff_id')
                        // ->join('staff_users', 'users.card_id', 'staff_users.card_id')
                        ->join('users', 'users.id', 'borrows.staff_id')
                        // ->join('staff_users', 'users.id', 'staff_users.card_id')
                        ->join('positions', 'users.position', 'positions.id')
                        ->join('section', 'section.id', 'positions.section_id')
                        ->join('departments', 'section.department_id', 'departments.id')
                        ->orderBy('borrows.borrow_id', 'desc')
                        ->get();
        $data['action'] = DB::table('apply_funcion_for_role')
                        ->where('role_id', @Auth::user()->role_id)
                        ->get()->first();
        return view('borrow.return', $data);
    }


    public function overdraft(){
        $data['overdraft'] = DB::table('borrows')
                                ->select('borrows.*', 'products.*', 'categories.*', 'users.*', 'positions.*', 'departments.*', 'section.*')
                                // ->where('borrows.borrow_status', 2)
                                ->where('payback_status', 2)
                                ->join('products', 'borrows.pro_id', 'products.id')
                                ->join('categories', 'products.cat_id', 'categories.id')
                                // ->join('users', 'users.card_id', 'borrows.staff_id')
                                // ->join('staff_users', 'users.card_id', 'staff_users.card_id')
                                ->join('users', 'users.id', 'borrows.staff_id')
                                // ->join('staff_users', 'users.id', 'staff_users.card_id')
                                ->join('positions', 'users.position', 'positions.id')
                                ->join('section', 'section.id', 'positions.section_id')
                                ->join('departments', 'section.department_id', 'departments.id')
                                ->orderBy('borrows.borrow_id', 'desc')
                                ->get();

                                
        $data['action'] = DB::table('apply_funcion_for_role')
                                ->where('role_id', @Auth::user()->role_id)
                                ->get()->first();
        return view('borrow.overdraft', $data);
    }

    
}
 