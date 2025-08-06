<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class RoleController extends Controller
{
    // Login Authentication
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
        $data['role'] = DB::table('user_roles')
                        ->orderBy('delete_status', 'desc')
                        ->orderBy('id', 'desc')
                        ->get();
        return view('role.list', $data);
    }
    public function save(Request $r){

        $roleName = $r->get('roleName');
        $addBy = @Auth::user()->name_en;
        // dd($addBy);

        if(($roleName && $addBy) != ''){
            $checkInDb = DB::table('user_roles')
                        ->where('role_name' , '=', $roleName)
                        ->exists();
            if($checkInDb == true){
                return redirect()->back()->with('error', 'Role name has existed.');

            }else{
                    $insert = DB::table('user_roles')
                            ->insert(['role_name' => $roleName, 'add_by' => $addBy]);
                    if($insert == true){

                    $roleNameRecall = DB::table('user_roles')
                                        ->where('role_name', $roleName)
                                        ->get()->first();

                    // dd($roleNameRecall);

                    $subFunction = $roleNameRecall->role_name;
                    $routeName = 'user/'. $roleNameRecall->id. '/'. $roleNameRecall->role_name;
                    $urlName = 'user/{role}/{name}';

                    DB::table('sub_function')
                        ->insert(['main_function_id' => '7', 'name' => $subFunction, 'route_name' => $routeName, 'url_name' => $urlName]);


                    return redirect()->back()->with('success', 'Create role has successfully.');

                }else{
                    return redirect()->back()->with('error', 'Create role has failed.');
                }
            }

        }else{
            return redirect()->back()->with('empty', 'Fields are required.');
        }
    }
    public function edit(Request $r){
        $id = $r->roleId;
        $roleName = $r->roleName;
        $oldRoleName = $r->OldroleName;

        if(($id && $roleName) != ''){
            $update = DB::table('user_roles')
                        ->where('id', $id)
                        ->update(['role_name' => $roleName]);
            if($update == true){
                $roleNameRecall = DB::table('user_roles')
                                ->where('id', $id)
                                ->get()->first();
                    $roleName = $roleNameRecall->role_name;

                    $routeName = 'user/'. $roleNameRecall->id. '/'. $roleNameRecall->role_name;
                    $oldRouteName = 'user/'. $roleNameRecall->id . '/'.$oldRoleName;

                DB::table('sub_function')
                    ->where('main_function_id', 7)
                    ->where('route_name', $oldRouteName)
                    ->update(['name' => $roleName, 'route_name' => $routeName]);

                return redirect()->back()->with('success', 'Update role has successfully.');
            }else{
                return redirect()->back()->with('error', 'Update role has failed.');
            }
        }else{
            return redirect()->back()->with('error', 'Fields are requried.');
        }
    }

    public function delete(Request $r){
        $roleId = $r->roleId;
        // dd($roleId);

        $deleteBy = @Auth::user()->name_en;
        $deleteDate = now();
        // $year = date('Y');

        DB::table('user_roles')
            ->where('id', '=', $roleId)
            ->update(['delete_status' => '0', 'delete_by' => $deleteBy, 'delete_date' => $deleteDate]);
        // DB::table('sub_function')


        return redirect() -> back() -> with('success', 'Deleted role has successfully.');

    }

    public function recovery(Request $r){
        $roleId = $r->roleId;
        DB::table('user_roles')
            ->where('id', '=', $roleId)
            ->update(['delete_status' => '1', 'delete_by' => NULL, 'delete_date' => NULL]);

        return redirect() -> back() -> with('success', 'Restore role has successfully.');
    }

}
