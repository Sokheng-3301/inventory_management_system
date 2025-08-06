<?php

namespace App\Http\Middleware;

use Closure;
// use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

// use Symfony\Component\Routing\Route;
class CheckPermission
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // check user status
        $checkUserStatus = DB::table('users')
            ->where('users.id', @Auth::user()->id)
            ->join('user_roles', 'users.role_id', '=', 'user_roles.id')
            ->get()->first();


        if (($checkUserStatus->block_status == 0) || ($checkUserStatus->delete_status == 0)) {
            // dd('exit');
            Auth::logout();
            return redirect(route('login'));
        }


        // check borrow overdraft
        // DB::table('borrows')
        //     ->where('payback_status', 1)
        //     ->where('borrow_status', '1')
        //     ->where('payback_date', '<', now())
        //     ->update(['payback_status' => 2]);



        // check product stock
        DB::table('products')
            ->where('qty', '>', 0)
            ->update(['stock_status' => 1]);



        // year increment
        $checkYear = DB::table('year')
            ->where('year', date('Y'))
            ->get()->first();
        if ($checkYear != true) {
            DB::table('year')
                ->insert(['year' => date('Y')]);
        }


        // $routes = Route::getRoutes();
        // $middleeareGroup = 'isAuthenticated';


        // $routeDetails = [];


        /*
            foreach($routes as $route){
                $middleeares = $route->gatherMiddleware();
                if(in_array($middleeareGroup, $middleeares)){
                    $routeName = $route->getName();

                    if($routeName != 'logout'){
                        $checkRole = DB::table('user_roles')
                                        ->where('id', @Auth::user()->role_id)
                                        ->get()->first();

                        if($checkRole->role_name != 'admin' || $checkRole->role_name != 'Admin'){
                            $checkPermission = DB::table('apply_funcion_for_role')
                                            ->where('role_id', @Auth::user()->role_id)
                                            ->get()->first();
                            $subFunction_id = explode(',', $checkPermission->sub_function_id);

                            foreach ($subFunction_id as $sub){

                                    $checkWithSubFunction = DB::table('sub_function')
                                                            ->select('sub_function.*', 'main_function.name as main_name')
                                                            ->join('main_function', 'sub_function.main_function_id', '=' ,'main_function.id')
                                                            ->where('sub_function.id', $sub)
                                                            ->get();
                                    foreach ($checkWithSubFunction as $subFucntion){
                                        if($subFucntion->main_name == 'Manage users'){

                                            // $checkWithRoute = DB::table('sub_function')
                                            //                     ->where('route_name', 'like', $route->uri())
                                            //                     ->exists();

                                        }else{
                                            // $checkWithRoute = DB::table('sub_function')
                                            //                     ->where('route_name', 'like', $route->getName())
                                            //                     ->exists();
                                            if($subFucntion->route_name == $route->getName()){
                                                echo 'Have';
                                            }else{
                                                echo 'NO';
                                            }

                                        }

                                    }

                            }
                        }
                    }

                    // echo $route->uri();


                    // print_r($route->uri());

                }
            }
        */

        $currentUrl = Route::current()->uri();
        $checkTrue = false;
        $checkTrueAcception = false;


        $checkRole = DB::table('user_roles')
            ->where('id', @Auth::user()->role_id)
            ->get()->first();
        // dd($checkRole->role_name);

        // dd($checkRole->role_name);
        if ($checkRole->role_name == 'admin' || $checkRole->role_name == 'Admin') {
            $checkTrue = true;
        } else {
            $checkPermission = DB::table('apply_funcion_for_role')
                ->where('role_id', @Auth::user()->role_id)
                ->get()->first();

            if ($checkPermission == '') {
                return abort(403, 'User does not have the right permissions.');
            }else{
                if($checkPermission->action_edit == 1){
                    $checkTrue = true;
                }
            }
            $mainFucntion_id = explode(',', $checkPermission->main_function_id);

            $subFunction_id = explode(',', $checkPermission->sub_function_id);
            foreach ($subFunction_id as $sub) {
                $checkWithSubFunction = DB::table('sub_function')
                    ->select('sub_function.*', 'main_function.id', 'main_function.name as main_name')
                    ->join('main_function', 'sub_function.main_function_id', '=', 'main_function.id')
                    ->where('sub_function.id', $sub)
                    ->get();

                foreach ($checkWithSubFunction as $subFucntion) {
                    if (($currentUrl == '/') || ($currentUrl == 'account/profile') || ($currentUrl == 'account/change-password') || ($currentUrl == 'request/save') || ($currentUrl == 'account/change') || ($currentUrl == 'account/save-change')) {
                        $checkTrue = true;
                    } elseif ($currentUrl == $subFucntion->url_name) {
                        $checkTrue = true;
                    }
                }
            }



            // foreach ($mainFucntion_id as $main) {
            //     if ($main == '9') {
            //         $checkTrue = true;
            //     } else {
            //         $checkTrue = true;
            //     }
            // }




            if ($checkTrue == false) {
                return abort(403, 'Hello world');
            } else {
                return $next($request);
            }
        }
        return $next($request);
    }
}
