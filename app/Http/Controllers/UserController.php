<?php

namespace App\Http\Controllers;

use Dotenv\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator as FacadesValidator;

class UserController extends Controller
{
    // Login Authentication
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    public function login(Request $request){

        $user = $request->only('email', 'password');
        $validator = FacadesValidator::make($user, [
            'email' => 'required|email',
            'password' => 'required'
        ]);
        // $validator = Validator::make($user, [
        //     'email' => 'required|email',
        //     'password' => 'required'
        // ]);
        // $user = $request->only('email', 'password');
        // $username = $request->get('username');
        // $password = $request->get('password');

        // $user = DB::table('operators')
        //         ->where('block_status', 1);

        $checkUser = DB::table('users')
                    ->where('email','=', $request->email)
                    ->where('role_id', '!=', 'staff')
                    ->where('block_status', 1)
                    ->exists();
        if($checkUser == true){
            if(Auth::attempt($user)){
                // session('welcome', true);
                session(['lock_screen' => false]);
                return redirect(route('/'))->with('logedin', true);
            }else{
                return redirect()->back()->withInput()->withErrors($validator);
                        // ->session()->flash('error', true);
            }
        }else{
            return redirect()->back()->withInput()->withErrors($validator);
        }
    }
    public function logout(){
        // session()->forget('localization');
        Auth::logout();
        return redirect(route('login'));
    }
}
