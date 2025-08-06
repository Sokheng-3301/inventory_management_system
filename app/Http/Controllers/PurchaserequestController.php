<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;
use trendClass;

class PurchaserequestController extends Controller
{
    public function index(){
        // $data['purchasings'] = DB::table('pr_table')
        //                         ->join('users', 'users.card_id', '=' ,'pr_table.requester')
        //                         ->join('staff_users', 'pr_table.requester', '=' , 'staff_user.card_id')
        //                         ->join('positions', 'positions.id' , '=' , 'staff_users.position')
        //                         ->join('section', 'positions.section_id', '=' , 'section.id')
        //                         ->join('departments', 'section.department_id', '=' , 'departments.id')
        //                         ->orderBy('pr_table.id', 'desc')->get();
        $data['action'] = DB::table('apply_funcion_for_role')
                                ->where('role_id', @Auth::user()->role_id)
                                ->get()->first();

        $data['purchasings'] = DB::table('pr_table')
                                ->select(
                                    'pr_table.*', 'pr_table.id as purchase_id', 'pr_table.add_by as purchaser',
                                    'pr_table.delete_status as pr_delete_status',
                                    'pr_table.delete_date as pr_delete_date',
                                    'pr_table.delete_by as pr_delete_by',
                                    'users.*',
                                    // 'staff_users.*',
                                    'departments.*',
                                    'categories.*',
                                    'positions.*',
                                    'section.*',
                                )
                                ->where('pr_table.purchase_status', 0)
                                ->join('categories', 'pr_table.category', '=', 'categories.id')
                                // ->join('users', 'users.card_id', '=', 'pr_table.requester')
                                // ->join('staff_users', 'users.card_id', '=', 'staff_users.card_id') // Fixed table name
                                ->join('users', 'users.id', '=', 'pr_table.requester')
                                // ->join('staff_users', 'users.id', '=', 'staff_users.card_id') // Fixed table name

                                ->join('positions', 'positions.id', '=', 'users.position')
                                ->join('section', 'positions.section_id', '=', 'section.id')
                                ->join('departments', 'section.department_id', '=', 'departments.id')
                                ->orderBy('pr_table.id', 'desc') // Specify table name for clarity
                                ->get();


        return view('pr.list', $data);
    }

    public function received(){
        // $data['purchasings'] = DB::table('pr_table')
        //                         ->join('users', 'users.card_id', '=' ,'pr_table.requester')
        //                         ->join('staff_users', 'pr_table.requester', '=' , 'staff_user.card_id')
        //                         ->join('positions', 'positions.id' , '=' , 'staff_users.position')
        //                         ->join('section', 'positions.section_id', '=' , 'section.id')
        //                         ->join('departments', 'section.department_id', '=' , 'departments.id')
        //                         ->orderBy('pr_table.id', 'desc')->get();
        $data['action'] = DB::table('apply_funcion_for_role')
                                ->where('role_id', @Auth::user()->role_id)
                                ->get()->first();
        $data['purchasings'] = DB::table('pr_table')
                                ->select(
                                    'pr_table.*', 'pr_table.id as purchase_id', 'pr_table.add_by as purchaser',
                                    'pr_table.delete_status as pr_delete_status',
                                    'pr_table.delete_date as pr_delete_date',
                                    'pr_table.delete_by as pr_delete_by',
                                    'users.*',
                                    // 'staff_users.*',
                                    'departments.*',
                                    'categories.*',
                                    'positions.*',
                                    'section.*',
                                )
                                ->where('pr_table.purchase_status', 1)
                                ->join('categories', 'pr_table.category', '=', 'categories.id')
                                // ->join('users', 'users.card_id', '=', 'pr_table.requester')
                                // ->join('staff_users', 'users.card_id', '=', 'staff_users.card_id') // Fixed table name
                                ->join('users', 'users.id', '=', 'pr_table.requester')
                                // ->join('staff_users', 'users.id', '=', 'staff_users.card_id') // Fixed table name
                                ->join('positions', 'positions.id', '=', 'users.position')
                                ->join('section', 'positions.section_id', '=', 'section.id')
                                ->join('departments', 'section.department_id', '=', 'departments.id')
                                ->orderBy('add_stock_status', 'desc')
                                ->orderBy('pr_table.id', 'desc') // Specify table name for clarity
                                ->get();


        return view('pr.received-list', $data);
    }


    public function request(){
        // dd(@Auth::user()->role_id);
        $checkRole = DB::table('user_roles')->where('id', @Auth::user()->role_id)->get()->first();
        if(($checkRole->role_name == 'Admin') || ($checkRole->role_name == 'admin' )){
            // dd($checkRole);
        }else{
            // dd('Admin');
            $action = DB::table('apply_funcion_for_role')
                                ->where('role_id', @Auth::user()->role_id)
                                ->get()->first();
            if($action->action_edit == ''){
                return redirect()->back();
            }
        }


        $data['users'] = DB::table('users')
                        ->where('block_status', 1)
                        ->orderBy('id', 'desc')
                        ->get();

        $data['categories'] = DB::table('categories')
                        ->select('*')
                        ->where('delete_status', '=', '1')
                        ->orderBy('id', 'desc')
                        ->get();
        return view('pr.add-purchase', $data);
    }


    public function save(Request $r){

        // dd($r->file());

        $validate = Validator::make($r->all(),[
            'userAccount' => 'required',
            'pro_name_kh' => 'required',
            'pro_name' => 'required',
            'model' => 'required',
            'category' => 'required',
            'attachment' => 'required',
            'qty' => 'required',
        ]);

        if($validate->fails()){
            return redirect()->back()->with('error', 'Fields are required.')->withInput();
        }

        $requester = $r->userAccount;
        $pro_name_kh = $r->pro_name_kh;
        $pro_name = $r->pro_name;
        $model = $r->model;
        $category = $r->category;
        $qty = $r->qty;
        $price_unit = $r->price_unit;
        $description = $r->description;
        $purpose = $r->purpose;
        $year = date('Y');

        $att = null;

        if ($r->hasFile('attachment')) {
            $insertAtt = []; // Initialize an array to hold the file paths

            foreach ($r->attachment as $file) {
                // Store each file and get the path
                $att = $file->store('uploads/purchase-atts', 'custom');

                // Append the stored path to the array
                $insertAtt[] = $att;

                // echo $att . "<br>";
            }

            // Convert the array to a comma-separated string
            $insertAttString = implode(',', $insertAtt);
            // print_r($insertAttString);
            // exit;
            // dd($r->attachment);
        }


        $purchase = DB::table('pr_table')
                    ->insert(
                        [
                            'requester' => $requester,
                            'pro_name_kh' => $pro_name_kh,
                            'pro_name' => $pro_name,
                            'model' => $model,
                            'category' => $category,
                            'qty' => $qty,
                            'price_unit' => $price_unit,
                            'description' => $description,
                            'purpose' => $purpose,
                            'year' => $year,
                            'att' => $insertAttString,
                            'add_by'=> @Auth::user()->name_en,
                        ]
                    );

        if($purchase == true){
            return redirect()->back()->with('success', 'Purchase item has successfully.');
        }else{
            return redirect()->back()->with('error', 'Purchase item has failed.')->withInput();
        }

    }



    public function edit($id){
        $data['pr'] = DB::table('pr_table')->where('id', $id)->first();

        $data['users'] = DB::table('users')
                        ->where('block_status', 1)
                        ->orderBy('id', 'desc')
                        ->get();

        $data['categories'] = DB::table('categories')
                        ->select('*')
                        ->where('delete_status', '=', '1')
                        ->orderBy('id', 'desc')
                        ->get();
        $data['action'] = DB::table('apply_funcion_for_role')
                ->where('role_id', @Auth::user()->role_id)
                ->get()->first();
        // dd($data['pr']);
        if(!empty($data['pr'])){
            return view('pr.edit-purchase', $data);
        }else{
            return redirect()->back();
        }
    }

    public function doedit(Request $r, $id){
        $validate = Validator::make($r->all(),[
            'userAccount' => 'required',
            'pro_name_kh' => 'required',
            'pro_name' => 'required',
            'model' => 'required',
            'category' => 'required',
            'qty' => 'required',
        ]);

        if($validate->fails()){
            return redirect()->back()->with('error', 'Fields are required.')->withInput();
        }


        $requester = $r->userAccount;
        $pro_name_kh = $r->pro_name_kh;
        $pro_name = $r->pro_name;
        $model = $r->model;
        $category = $r->category;
        $qty = $r->qty;
        $price_unit = $r->price_unit;
        $description = $r->description;
        $purpose = $r->purpose;

        $updateAtt = $r->old_att;

        if ($r->hasFile('attachment')) {
            // Initialize an array to hold the file paths
            $insertAtt = [];

            $explodeOldAtt = explode(',', $updateAtt);
            foreach($explodeOldAtt as $exAtt){
                if (File::exists($exAtt)) {
                    File::delete($exAtt);
                }
            }

            // Loop through each uploaded file
            foreach ($r->file('attachment') as $file) {
                // Check if file exists in the old attachments



                // Store the new file and add the path to the array
                $att = $file->store('uploads/purchase-atts', 'custom');
                $insertAtt[] = $att;
            }

            // Update the attachment string with the new file paths
            $updateAtt = implode(',', $insertAtt);
        }



        $update = DB::table('pr_table')
                        ->where('id', $id)
                        ->update([
                            'requester'      => $requester,
                            'pro_name_kh'    => $pro_name_kh,
                            'pro_name'       => $pro_name,
                            'model'          => $model,
                            'category'       => $category,
                            'qty'            => $qty,
                            'price_unit'     => $price_unit,
                            'description'    => $description,
                            'purpose'        => $purpose,
                            'att'            => $updateAtt,
                        ]);

            if ($update) {
                return redirect()->route('purchase.index')->with('success', 'Update purchase item has successfully.');
            } else {
                return redirect()->back()->with('error', 'Update purchase item has failed.');
            }
    }

    public function delete($id){
        // dd($id);

        $pr = DB::table('pr_table')->where('id', $id)->first();
        if(empty($pr)){
            return redirect()->back();
        }else{
            $delete = DB::table('pr_table')->where('id', $id)->update(['delete_status' => 0, 'delete_date' => now()->format('Y-m-d H:i:s'), 'delete_by' => @Auth::user()->name_en]);

            if ($delete == true) {
                return redirect()->back()->with('success', 'Delete purchase item has successfully.');
            } else {
                return redirect()->back()->with('error', 'Delete purchase item has failed.');
            }
        }

    }

    public function recovery($id){
        // dd($id);

        $pr = DB::table('pr_table')->where('id', $id)->first();

        if(empty($pr)){
            return redirect()->back();
        }else{
            $delete = DB::table('pr_table')->where('id', $id)->update(['delete_status' => 1]);

            if ($delete == true) {
                return redirect()->back()->with('success', 'Restore purchase item has successfully.');
            } else {
                return redirect()->back()->with('error', 'Restore purchase item has failed.');
            }
        }

    }

    public function receive($id){
        $checkRole = DB::table('user_roles')->where('id', @Auth::user()->role_id)->get()->first();
        if(($checkRole->role_name == 'Admin') || ($checkRole->role_name == 'admin' )){
            // dd($checkRole);
        }else{
            // dd('Admin');
            $action = DB::table('apply_funcion_for_role')
                                ->where('role_id', @Auth::user()->role_id)
                                ->get()->first();
            if($action->action_edit == ''){
                return redirect()->back();
            }
        }

        $pr = DB::table('pr_table')
                                ->select(
                                    'pr_table.*', 'pr_table.id as purchase_id', 'pr_table.add_by as purchaser',
                                    'pr_table.delete_status as pr_delete_status',
                                    'pr_table.delete_date as pr_delete_date',
                                    'pr_table.delete_by as pr_delete_by',
                                    'users.*',
                                    // 'staff_users.*',
                                    'departments.*',
                                    'categories.*',
                                    'positions.*',
                                    'section.*',
                                )
                                ->where('pr_table.id', $id)
                                ->join('categories', 'pr_table.category', '=', 'categories.id')
                                // ->join('users', 'users.card_id', '=', 'pr_table.requester')
                                // ->join('staff_users', 'users.card_id', '=', 'staff_users.card_id') // Fixed table name
                                ->join('users', 'users.id', '=', 'pr_table.requester')
                                // ->join('staff_users', 'users.id', '=', 'staff_users.card_id') // Fixed table name
                                ->join('positions', 'positions.id', '=', 'users.position')
                                ->join('section', 'positions.section_id', '=', 'section.id')
                                ->join('departments', 'section.department_id', '=', 'departments.id')
                                ->orderBy('pr_table.id', 'desc') // Specify table name for clarity
                                ->get()->first();

        if( ! empty($pr) ){
            // if($pr->purchase_status == 1){
            //     // if receive done Change redirect to received list
            //     echo 'Receive done and redirect to received list';
            // }else{
            // }
            return view('pr.purchase-receive', compact('pr'));
        }else{
            return redirect()->back();
        }
    }

    public function saveReceive(Request $r, $id){
        // dd($id);
        // dd($r->input());
        $validate = Validator::make($r->all(), [
            'price_unit' => 'required',
        ]);

        if($validate->fails()){
            return redirect()->back()->with('error', 'Fields are required.')->withInput();
        }
        $check = DB::table('pr_table')->where('id', $id)->get()->first();

        if(! empty($check)){
            $price_unit = $r->price_unit;
            $received = DB::table('pr_table')
                        ->where('id', $id)
                        ->update([
                            'purchase_status' => 1,
                            'price_unit' => $price_unit,
                            'receive_by' => @Auth::user()->name_en,
                            'receive_date' => now()->format('Y-m-d H:i:s'),
                        ]);

        }else{
            return redirect()->back();
        }

        if($received == true){
            return redirect()->back()->with('success', 'Recieve item has successfully.');
        }else{
            return redirect()->back()->with('error', 'Recieve item has failed.');
        }
    }

    public function addStock($id){
        $data['pr'] = DB::table('pr_table')
                                ->select(
                                    'pr_table.*', 'pr_table.id as purchase_id', 'pr_table.add_by as purchaser',
                                    'pr_table.delete_status as pr_delete_status',
                                    'pr_table.delete_date as pr_delete_date',
                                    'pr_table.delete_by as pr_delete_by',
                                    'users.*',
                                    // 'staff_users.*',
                                    'departments.*',
                                    'categories.*',
                                    'positions.*',
                                    'section.*',
                                )
                                ->where('pr_table.id', $id)
                                ->join('categories', 'pr_table.category', '=', 'categories.id')
                                // ->join('users', 'users.card_id', '=', 'pr_table.requester')
                                // ->join('staff_users', 'users.card_id', '=', 'staff_users.card_id') // Fixed table name
                                ->join('users', 'users.id', '=', 'pr_table.requester')
                                // ->join('staff_users', 'users.id', '=', 'staff_users.card_id') // Fixed table name
                                ->join('positions', 'positions.id', '=', 'users.position')
                                ->join('section', 'positions.section_id', '=', 'section.id')
                                ->join('departments', 'section.department_id', '=', 'departments.id')
                                ->orderBy('pr_table.id', 'desc') // Specify table name for clarity
                                ->get()->first();
        if(empty( $data['pr'] ) ){
            return redirect()->back();
        }

        $data['category'] = DB::table('categories')
                    ->select('*')
                    ->where('delete_status', '=', '1')
                    ->orderBy('id', 'desc')
                    ->get();
        return view('product.add', $data);
    }
}
