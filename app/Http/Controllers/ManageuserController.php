<?php

namespace App\Http\Controllers;

use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;

// use Symfony\Component\Console\Input\Input;

// use function Laravel\Prompts\select;

class ManageuserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');

        // $checkRole = DB::table('user_roles')->where('id', Auth::user()->role_id)->get()->first();
        // if($checkRole->role_name != 'Super-Admin' || $checkRole->role_name != 'Admin'){
        //     return redirect()->back();
        // }

        // dd(Auth::user());

    }

    public function index($id, $name){
        $data['user'] = DB::table('users')
                        ->select('users.*', 'positions.position_name',
                        'departments.dep_name_kh',
                        'departments.dep_name_en',
                        'user_roles.role_name',
                        //  'staff_users.card_id',
                        //  'staff_users.gender',
                        //  'staff_users.position',
                        //  'staff_users.phone_number',
                        //  'staff_users.email_address',
                        'section.section_kh', 'section.section_en', 'section.department_id')

                        // ->join('staff_users', 'users.id', '=', 'staff_users.card_id')
                        ->join('user_roles', 'users.role_id', '=', 'user_roles.id')

                        // ->join('positions', 'staff_users.position', '=', 'positions.id')
                        // ->join('departments', 'positions.department_id', '=', 'departments.id')

                        ->join('positions', 'users.position', 'positions.id')
                        ->join('section', 'section.id', 'positions.section_id')
                        ->join('departments', 'section.department_id', 'departments.id')


                        ->where('users.role_id', $id)
                        ->orderBy('users.block_status', 'desc')
                        ->orderBy('users.id', 'desc')
                        ->get();

        $data['name'] = $name;
        $data['id'] = $id;

        $data['action'] = DB::table('apply_funcion_for_role')
                                ->where('role_id', @Auth::user()->role_id)
                                ->get()->first();

        return view('user.list', $data);
    }

    public function block(Request $r){
        $userId = $r->userId;
        // dd($userId);
        if($userId != ''){
            DB::table('users')
                ->where('id', $userId)
                ->update(['block_status' => 0, 'block_date' => now(), 'block_by'=> @Auth::user()->name_en]);
                return redirect()->back()->with('success', 'Block user has successfully.');
        }else{
            return redirect()->back()->with('error', 'Block user has failed.');
        }
    }

    public function unblock(Request $r){
        $userId = $r->userId;
        // dd($userId);
        if($userId != ''){
            DB::table('users')
                ->where('id', $userId)
                ->update(['block_status' => 1, 'block_date' => null, 'block_by'=> null]);
                return redirect()->back()->with('success', 'Unblock user has successfully.');
        }else{
            return redirect()->back()->with('error', 'Unblock user has failed.');
        }
    }

    public function resetPass(Request $r){
        $userId = $r->userId;
        $operatorPassword = $r->password;

        if(Hash::check($operatorPassword, Auth::user()->password)){
            // dd('password matched');

            try{
                DB::table('users')
                    ->where('id', $userId)
                    ->update(['password' => '$2y$12$u64b.lqXJsnl.tUcpxLsmOXRXsLHiEYvFQMchgCdl3GQwAck9VeRC']); #666666

                return redirect()->back()->with('success', 'Reset password has successfully.');
            }catch (QueryException $e){
                return redirect()->back()->with('error', 'Reset password has failed.');
            }
        }else{
            return redirect()->back()->with('error', 'Operator password has wrong.');
        }
    }

    public function add($id, $name){
        $data['position'] = DB::table('positions')
                            ->where('delete_status', 1)
                            ->orderBy('id', 'desc')
                            ->get();
        $data['name'] = $name;
        $data['id'] = $id;
        return view('user.add', $data);
    }

    public function save(Request $r){

        $scriptRun = false;
        $profile = '';
        $name_kh = $r->name_kh;
        $name_en = $r->name_en;


        $cardId = $r->cardId;
        $username = $r->username;
        $password = $r->password;
        $confirmPass = $r->confirmPassword;
        $roleId = $r->roleId;

        $gender = $r->gender;
        $position = $r->position;
        $roleId = $r->roleId;
        $phoneNum = $r->phoneNumber;
        $emailAddress = $r->email;



        if(($gender && $position &&
            $name_kh && $name_en &&  $roleId) == ''){
            return redirect()->back()->with('error', 'Fields are required.')->withInput();
        }else{
            $gender = $gender;
            $position = $position;
        }

        if($r->file('proImage') == ''){
            $profile = '';
        }else{
            $profile = $r->file('proImage')->store('uploads/users', 'custom');
        }

        if($password == $confirmPass){
            $password = bcrypt($password);
        }else{
            return redirect()->back()->with('error', 'Password and Confirm password not match.')->withInput();
        }



            $users = DB::table('users')
                    ->insert([
                        'profile' => $profile ,
                        'card_id' => $cardId ,
                        'name_kh' => $name_kh ,
                        'name_en' => $name_en,
                        'email'   => $username,
                        'password' => $password,
                        'role_id' => $roleId,
                        'created_at' => now(),
                        'create_by' => @Auth::user() -> name_en,
                        'gender' => $gender,
                        'position' => $position,
                        'phone_number' => $phoneNum,
                        'email_address' => $emailAddress,
            ]);


            return redirect()->back()->with('success', 'Create user has successfully.');
    }

    public function editForm($role,$id){
        $select['name'] = DB::table('user_roles')
                            ->where('id', $role)
                            ->get()->first();

        $select['query'] = DB::table('users')
                        ->select('users.*')
                        // ->join('staff_users', 'users.id', '=', 'staff_users.card_id')
                        ->where('users.id', '=', $id)
                        ->get() ->first();

        $select['positions'] = DB::table('positions')
                        ->where('delete_status', 1)
                        ->orderBy('id', 'desc')
                        ->get();

        // $select['name'] = $name;
        $select['id'] = $id;

        // dd($select['user']);
        // dd($data);
        if($select['query'] == true){
            return view('user.edit', $select);
        }else{
            return redirect()->back();
        }
    }

    public function doEdit(Request $r){
        $scriptRun = false;
        $id = $r->id;

        $oldProfile = $r->oldProfile;
        $name_kh = $r->name_kh;
        $name_en = $r->name_en;


        $cardId = $r->cardId;
        $username = $r->username;
        $roleId = $r->roleId;

        $gender = $r->gender;
        $position = $r->position;
        $roleId = $r->roleId;
        $phoneNum = $r->phoneNumber;
        $emailAddress = $r->email;

        // dd($cardId);

        if(($gender && $position &&
            $name_kh && $name_en && $roleId) == ''){
            return redirect()->back()->with('error', 'Fields are required.')->withInput();
        }else{
            $gender = $gender;
            $position = $position;
        }

        if($r->file('proImage') == ''){
            $profile = $oldProfile;
        }else{

            // $profile = $r->file('proImage')->store('uploads/users', 'custom');

            $destination = $oldProfile;

            if(File::exists($destination)){
                File::delete($destination);
            }
            $profile = $r->file('proImage')->store('uploads/users', 'custom');
        }

        $users = DB::table('users')
                ->where('id', $id)
                ->update([
                    'profile' => $profile ,
                    'card_id' => $cardId ,
                    'name_kh' => $name_kh ,
                    'name_en' => $name_en,
                    'email'   => $username,
                    'role_id' => $roleId,
                    'gender' => $gender,
                    'position' => $position,
                    'phone_number' => $phoneNum,
                    'email_address' => $emailAddress
                ]);


            $checkRole = DB::table('user_roles')
                        ->where('id', $roleId)
                        ->get()->first();

            // if($users == true){
            //     DB::table('staff_users')
            //         ->where('card_id', $cardId)
            //         ->update([
            //         'gender' => $gender,
            //         'position' => $position,
            //         'phone_number' => $phoneNum,
            //         'email_address' => $emailAddress]);

            // }
            return redirect()->route('user.role', ['role'=>$roleId, 'name'=>$checkRole->role_name])->with('success', 'Update user has successfully.');

            // dd($roleId);
            // return redirect()->back()->with('success', true)->withInput();

        // echo $profile;
        // exit;
        // $checkCard = DB::table('users')
        //             ->select('card_id')
        //             ->exists();


        // if($checkCard == true){
        //     echo 'hav in other';
        //     exit;
        //     return redirect()->back()->with('duplicate', true)->withInput();
        // }else{
        //     dd('run the same card');
        //     $scriptRun = true;
        // }
        // $checkEmail = DB::table('staff_users')
        //         ->select('email_address')
        //         ->where('email_address', $emailAddress)
        //         ->exists();

        // if($checkEmail == true){
        //     dd('mail');
        //     return redirect()->back()->with('duplicateEmail', true)->withInput();
        // }else{
        //     $scriptRun = true;
        // }


    }

    public function show(string $id, $userId){
        $data['profile'] = DB::table('users')
                    ->join('positions', 'users.position', '=', 'positions.id')
                    ->join('section', 'positions.section_id', '=', 'section.id')
                    ->join('departments', 'section.department_id', '=', 'departments.id')
                    ->join('user_roles', 'users.role_id', '=', 'user_roles.id')
                    ->where('users.id', $userId)
                    ->get()->first();
        if(!$data['profile']){
            return redirect()->back();
        }else{
            return view('user.user-detail', $data);
        }
        // dd($data);
    }
}
