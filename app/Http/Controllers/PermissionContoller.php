<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PermissionContoller extends Controller
{
    // Login Authentication
    public function __construct()
    {
        $this->middleware('auth');
    }


    public function index(){

        return view('permission.permission');
    }

    public function save(Request $r){
        $runscript = false;
        $roleName = $r->role;
        $collectMainFunction = collect($r->main_function);
        $collectSubFunction = collect($r->sub_function);

        $mainFunction = $collectMainFunction->implode(',');
        $subFunction = $collectSubFunction->implode(',');

        $greenAction = $r->greenAction;
        $redAction = $r->redAction;


        if($roleName == ''){
            $runscript = false;
        }else{
            if(($mainFunction || $subFunction) == ''){
                $runscript = false;
            }else{
                $runscript = true;
            }
        }

        if($redAction && $greenAction == ''){
            $redAction = '';
            $greenAction = '';
        }

        $checkRole = DB::table('apply_funcion_for_role')
                    ->where('role_id', $roleName)
                    ->exists();

        if($checkRole == true){
            if($runscript == true){
                $insert = DB::table('apply_funcion_for_role')
                            ->where('role_id', $roleName)
                            ->update([
                                'main_function_id' => $mainFunction	,
                                'sub_function_id' => $subFunction,
                                'action_edit' => $greenAction,
                                'action_delete' => $redAction
                            ]);
                if($insert == true){
                    return redirect()->back()->with('success', 'Apply role has successfully.');
                }else{
                    return redirect()->back()->with('error', 'Apply role has failed.');
                }

            }else{
                return redirect()->back()->with('error', 'Apply role has failed.');
            }
        }else{
            if($runscript == true){
                $insert = DB::table('apply_funcion_for_role')
                            ->insert([
                                'role_id' => $roleName,
                                'main_function_id' => $mainFunction	,
                                'sub_function_id' => $subFunction,
                                'action_edit' => $greenAction,
                                'action_delete' => $redAction
                            ]);
                if($insert == true){
                    return redirect()->back()->with('success', 'Apply role has successfully.');
                }else{
                    return redirect()->back()->with('error', 'Apply role has failed.');
                }

            }else{
                return redirect()->back()->with('error', 'Apply role has failed.');
            }
        }



    }

    public function switch(Request $r){
        // dd($r->except('_token'));

        $userId = $r->user;
        $userRole = $r->role;

        if(($userId && $userRole) != ''){
            $update = DB::table('users')
                        ->where('id', $userId)
                        ->update(['role_id' => $userRole]);

            if($update == true){
                return redirect()->back()->with('success', true);
            }else{
                return redirect()->back()->with('error', true);
            }
        }else{
            return redirect()->back()->with('error', true);
        }
    }
}
