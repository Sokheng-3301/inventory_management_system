<?php

namespace App\Http\Controllers;

// use Illuminate\Http\Request;
// use Illuminate\Support\Facades\Auth;
// use Illuminate\Support\Facades\DB;
// use App\Events\NotificationSent;
// use Illuminate\Broadcasting\BroadcastException;

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Events\NotificationSent;
use App\Events\UserRequest;

class RequestController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
        $data['new'] = DB::table('borrows')
                                ->select('borrows.*', 'products.*', 'categories.*', 'users.*', 'staff_users.*', 'positions.*', 'departments.*', 'section.*')
                                ->where('borrows.borrow_status', 0)
                                ->where('borrows.payback_status', 1)
                                ->join('products', 'borrows.pro_id', 'products.id')
                                ->join('categories', 'products.cat_id', 'categories.id')
                                ->join('users', 'users.card_id', 'borrows.staff_id')
                                ->join('staff_users', 'users.card_id', 'staff_users.card_id')
                                ->join('positions', 'staff_users.position', 'positions.id')
                                ->join('section', 'section.id', 'positions.section_id')
                                ->join('departments', 'section.department_id', 'departments.id')
                                ->orderBy('borrows.borrow_id', 'desc')
                                ->get();
                                
        $data['action'] = DB::table('apply_funcion_for_role')
                                ->where('role_id', @Auth::user()->role_id)
                                ->get()->first();
                                
        return view('request.list', $data);
    }


    public function save (Request $r){
        $runScript = false;

        $productId = $r->proId;
        $cardId = $r->cardId;
        $reQty = $r->qty;
        $purpose = $r->purpose;
        $attch = '';

        $borrowDate = $r->borrowDate;
        $returnDate = $r->returnDate;

        $qtyCheck = DB::table('products')
                    ->select('qty', 'id')
                    ->where('id', $productId)
                    ->get()->first();

        $currentQty = ($qtyCheck->qty) - $reQty;


        if(($reQty <= $qtyCheck->qty) && $reQty != 0){
            $runScript = true;
        }else{
            $runScript = false;
        }



        if($currentQty == 0){
            DB::table('products')
                ->where('id', $productId)
                ->update(['stock_status' => 0]);
        }



        if($r->file('attachment') != ''){
            $attch = $r->file('attachment')->store('uploads/request-att', 'custom');
        }
        if(($productId && $cardId && 
            $reQty && $purpose && 
            $attch && $borrowDate && 
            $returnDate) == ''){
                // dd($reQty);
                if($reQty == 0){
                    return redirect()->back()->with('error', true);
                }else{
                    return redirect()->back()->with('empty', true);
                }
            }else{
                $runScript = true;   
            }
            // check card id matched 
            if((@Auth::user()->card_id) == $cardId){
                $runScript = true;
            }else{
                $runScript = false;
            }

        if($runScript == true){



            $insert = DB::table('borrows')
                        ->insert([ 
                            'pro_id' => $productId	,
                            'staff_id' => $cardId	,
                            'borrow_date' => $borrowDate	,
                            'borrow_purpose' => $purpose	,
                            'borrow_qty'	=> $reQty,
                            'payback_date' => $returnDate,
                            'attachment' => $attch,
                            'year'	=> date('Y')
                        ]);
            if($insert == true){

                // check stock 
       
                DB::table('products')
                    ->where('id', $productId)
                    ->update(['qty'=> $currentQty]);

                $data = '';
                    
                event(new UserRequest($data));

                return redirect()->back()->with('requested', true);
            }else{
                return redirect()->back()->with('error', true);
            }
        }else{
            return redirect()->back()->with('error', true);
        }
    }

    
    public function accept(Request $r){
        $runScript = false;
        $id = $r->borrowId;
        $proId = $r->proId;
        $approveDate = now();
        $approveBy = @Auth::user()->name_en;

        $borrowQty  = $r->borrowQty;



        if(($id && $borrowQty && $proId) != ''){
            $runScript = true;
        }else{
            $runScript = false;
        }
        


        if($runScript == true){
            // $qtyQry = DB::table('products')
            //                 ->select('id', 'qty')
            //                 ->where('id', $proId)  
            //                 ->get()->first();
            //     $proQty = $qtyQry->qty;
            //     $updateQty = $proQty-$borrowQty;

            //     if($updateQty == 0){
            //         DB::table('products')
            //             ->where('id', $proId)
            //             ->update(['stock_status' => 0]);
            //     }


                // dd($updateQty)            

            $return = DB::table('borrows')
                    ->where('borrow_id', $id)
                    ->update(['borrow_status' => 1 ,
                               'approve_by' => $approveBy,
                                'approve_date' => $approveDate]);

            if($return == true){
                // $qtyQry = DB::table('products')
                //             ->select('id', 'qty')
                //             ->where('id', $proId)  
                //             ->get()->first();
                // $proQty = $qtyQry->qty;
                // $updateQty = $proQty+$borrowQty;

                // DB::table('products')
                //     ->where('id', $proId)
                //     ->update(['qty' => $updateQty]);


                
                return redirect()->back()->with('accept', true);
            }else{
                // dd('no update');

                return redirect()->back()->with('error', true);
            }
        }else{
            return redirect()->back()->with('error', true);
        }
    }




    public function accepted(){
        $data['accepted'] = DB::table('borrows')
                                ->select('borrows.*', 'products.*', 'categories.*', 'users.*', 'staff_users.*', 'positions.*', 'departments.*', 'section.*')
                                ->where('borrows.borrow_status', 1)
                                ->where('payback_status', 1)
                                ->join('products', 'borrows.pro_id', 'products.id')
                                ->join('categories', 'products.cat_id', 'categories.id')
                                ->join('users', 'users.card_id', 'borrows.staff_id')
                                ->join('staff_users', 'users.card_id', 'staff_users.card_id')
                                ->join('positions', 'staff_users.position', 'positions.id')
                                ->join('section', 'section.id', 'positions.section_id')
                                ->join('departments', 'section.department_id', 'departments.id')
                                ->orderBy('borrows.borrow_id', 'desc')
                                ->get();
                                
    $data['action'] = DB::table('apply_funcion_for_role')
                                ->where('role_id', @Auth::user()->role_id)
                                ->get()->first();
                                
        return view('request.accepted', $data);
    }



    public function reject(Request $r){
        $runScript = false;
        $id = $r->borrowId;
        $proId = $r->proId;
        $rejectDate = now();
        $rejectBy = @Auth::user()->name_en;
        $borrowQty  = $r->borrowQty;


        if(($id && $borrowQty && $proId) != ''){
            $runScript = true;
        }else{
            $runScript = false;
        }
        

        if($runScript == true){
            $return = DB::table('borrows')
                    ->where('borrow_id', $id)
                    ->update(['borrow_status' => 2 ,
                               'approve_by' => $rejectBy,
                                'approve_date' => $rejectDate]);
            
            $productQty = DB::table('products')
                            ->where('id', $proId)
                            ->get()->first();
            
            $updateQty = ($productQty->qty) + $borrowQty;

            if($return == true){
                if($productQty->stock_status == 0){
                    $productQty = DB::table('products')
                                ->where('id', $proId)
                                ->update(['qty' => $updateQty, 'stock_status' => 1]);
                }else{
                $productQty = DB::table('products')
                            ->where('id', $proId)
                            ->update(['qty' => $updateQty]);
                }
                        
            
                return redirect()->back()->with('reject', true);
            }else{
                return redirect()->back()->with('error', true);
            }
        }else{
            return redirect()->back()->with('error', true);
        }
    }


    public function rejected(){
        $data['rejected'] = DB::table('borrows')
                                ->select('borrows.*', 'products.*', 'categories.*', 'users.*', 'staff_users.*', 'positions.*', 'departments.*', 'section.*')
                                ->where('borrows.borrow_status', 2)
                                // ->where('payback_status', 1)
                                ->join('products', 'borrows.pro_id', 'products.id')
                                ->join('categories', 'products.cat_id', 'categories.id')
                                ->join('users', 'users.card_id', 'borrows.staff_id')
                                ->join('staff_users', 'users.card_id', 'staff_users.card_id')
                                ->join('positions', 'staff_users.position', 'positions.id')
                                ->join('section', 'section.id', 'positions.section_id')
                                ->join('departments', 'section.department_id', 'departments.id')
                                ->orderBy('borrows.borrow_id', 'desc')
                                ->get();
        return view('request.rejected', $data);
    }
       
    public function history(){
        // if(@Auth::user()->)
        $checkRole = DB::table('users')
                        ->select('users.role_id', 'user_roles.role_name')
                        ->join('user_roles', 'users.role_id', '=', 'user_roles.id')
                        ->where('users.role_id', @Auth::user()->role_id)
                        ->get()->first();

        if(strtolower($checkRole->role_name) != 'admin' || strtolower($checkRole->role_name) != 'super-admin'){

            // dd('admin all');
            $data['history'] = DB::table('borrows')
                                ->select('borrows.*', 'products.*', 'categories.*', 'users.*', 'staff_users.*', 'positions.*', 'departments.*', 'section.id', 'section.section_kh', 'section.section_en')
                                // ->where('borrows.borrow_status', 0)
                                // ->where('payback_status', 1)
                                ->where('borrows.staff_id', @Auth::user()->card_id)
                                ->join('products', 'borrows.pro_id', 'products.id')
                                ->join('categories', 'products.cat_id', 'categories.id')
                                ->join('users', 'users.card_id', 'borrows.staff_id')
                                ->join('staff_users', 'users.card_id', 'staff_users.card_id')
                                ->join('positions', 'staff_users.position', 'positions.id')
                                ->join('section', 'section.id', 'positions.section_id')
                                ->join('departments', 'section.department_id', 'departments.id')
                                ->orderBy('borrows.borrow_id', 'desc')
                                ->orderBy('borrows.borrow_status', 'desc')
                                ->get();
            
        }else{
            $data['history'] = DB::table('borrows')
                                ->select('borrows.*', 'products.*', 'categories.*', 'users.*', 'staff_users.*', 'positions.*', 'departments.*', 'section.id', 'section.section_kh', 'section.section_en')
                                // ->where('borrows.borrow_status', 0)
                                // ->where('payback_status', 1)
                                // ->where('staff_id', @Auth::user()->card_id)
                                ->join('products', 'borrows.pro_id', 'products.id')
                                ->join('categories', 'products.cat_id', 'categories.id')
                                ->join('users', 'users.card_id', 'borrows.staff_id')
                                ->join('staff_users', 'users.card_id', 'staff_users.card_id')
                                ->join('positions', 'staff_users.position', 'positions.id')
                                ->join('section', 'section.id', 'positions.section_id')
                                ->join('departments', 'section.department_id', 'departments.id')
                                ->orderBy('borrows.borrow_id', 'desc')
                                ->orderBy('borrows.borrow_status', 'desc')
                                ->get();
        }

        
        return view('request.history', $data);
    }

}
