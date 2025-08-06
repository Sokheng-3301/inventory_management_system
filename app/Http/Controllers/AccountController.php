<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AccountController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function profile()
    {
        $data['profile'] = DB::table('users')
            ->join('positions', 'users.position', '=', 'positions.id')
            ->join('section', 'positions.section_id', '=', 'section.id')
            ->join('departments', 'section.department_id', '=', 'departments.id')
            ->join('user_roles', 'users.role_id', '=', 'user_roles.id')
            ->where('users.id', @Auth::user()->id)
            ->get()->first();
        // dd($data);
        return view('account.profile', $data);
    }

    public function change(Request $r)
    {
        $userId = @Auth::user()->id;
        $oldImg = $r->oldImg;
        $imgPro = '';

        if ($r->file('pro_img') == '') {
            $imgPro = $oldImg;
        } else {

            if (File::exists($oldImg)) {
                File::delete($oldImg);
            }
            $imgPro = $r->file('pro_img')->store('uploads/users',  'custom');
        }
        DB::table('users')
            ->where('id', $userId)
            ->update(['profile' => $imgPro]);

        return redirect()->back()->with('success', 'Change your profile has successfully.');
    }

    public function changePassword()
    {
        return view('account.change-password');
    }

    public function save(Request $r)
    {
        $currentPass = $r->password;
        $newPass = $r->newPass;
        $confirmNewPass = $r->confimrNewPass;
        $oldUserPass = @Auth::user()->password;

        if (($currentPass && $newPass && $confirmNewPass) != '') {
            if (Hash::check($currentPass, $oldUserPass)) {
                if ($newPass == $confirmNewPass) {
                    DB::table('users')
                        ->where('id', @Auth::user()->id)
                        ->update(['password' => bcrypt($newPass)]);
                    return redirect()->route('account.profile')->with('success', 'Password has changed successfully.');
                } else {
                    return redirect()->back()->with('error', 'New password and Confirm password not match.');
                }
            } else {
                return redirect()->back()->with('error', 'Current passwrod not match.');
            }
        } else {
            return redirect()->back()->with('error', 'Fields are required.');
        }
    }
    public function setLocked()
    {
        session(['lock_screen' => true]);
        return redirect()->route('screen.locked');
    }

    public function locked()
    {
        return view('account.lock-screen');
    }

    public function unlock(Request $request)
    {
        $user = $request->only('password');
        $validator = Validator::make($user, [
            'password' => 'required'
        ]);

        // Check if validation fails
        if ($validator->fails()) {
            return redirect()->back()->withInput()->withErrors($validator);
        }

        // Attempt to authenticate the user
        if (Auth::check() && Hash::check($user['password'], Auth::user()->password)) {
            session(['lock_screen' => false]);
            return redirect()->route('/')->with('logedin', true); // Use a named route for redirection
        } else {
            return redirect()->back()->withInput()->with(['password' => 'Invalid your password.']);
        }
    }
}
