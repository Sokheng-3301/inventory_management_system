<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PHPUnit\Event\Code\Throwable;
class AjaxController extends Controller
{

    // ------------------ newest ----------------
    public function getData($id)
    {
            $dataFunction = DB::table('apply_funcion_for_role')
                        ->where('role_id', $id)
                        ->get()->first();

            if($dataFunction == true){
                $mainFunction = explode(',', $dataFunction->main_function_id);
                $subFunctions = explode(',', $dataFunction->sub_function_id);

                $data = '';

                $data .= '<table class="table">
                                <thead>
                                    <tr>
                                        <th>'. __('nav.mainFunction') .'</th>
                                        <th> '. __('nav.subFunction') .' </th>
                                    </tr>
                                </thead>
                                <tbody>';

                $functions = DB::table('main_function')->get();

                foreach ($functions as $f) {
                    $data .= '<tr>
                                    <td>
                                        <input type="checkbox" ' . (in_array($f->id, $mainFunction) ? 'checked' : '') . ' name="main_function[]" id="mainFunction' . $f->id . '" value="' . $f->id . '">
                                        <label for="mainFunction' . $f->id . '" class="ms-1">
                                            <span class="mdi ' . $f->icon_name . ' text-secondary fs-5"></span> ';

                                            if(session('localization') == 'en'){
                                            $data .= $f->name;
                                            }else{
                                                $data .= $f->name_kh;
                                            }

                                        $data .= '</label>
                                    </td>';

                    $subFunctionsList = DB::table('sub_function')
                        ->where('main_function_id', $f->id)
                        ->get();

                    $data .= '<td>';
                    foreach ($subFunctionsList as $subF) {
                        $data .= '<div>
                                        <input type="checkbox" name="sub_function[]" ' . (in_array($subF->id, $subFunctions) ? 'checked' : '') . ' id="subFunction' . $subF->id . '" value="' . $subF->id . '">
                                        <label for="subFunction' . $subF->id . '" class="ms-1">';

                                        if($f->name == 'Manage Users'){
                                            $data .= $subF->name;
                                            // $data .= 'Hlloe';
                                        }else{
                                            if(session('localization') =='en'){
                                                $data .= $subF->name;
                                            }else{
                                                $data .= $subF->name_kh;
                                            }
                                        }

                                        // if(session('localization') =='en'){
                                        //     $data .= $subF->name;
                                        // }else{

                                        //     $data .= $subF->name_kh;
                                        // }

                                        $data .= '</label>
                                    </div>';
                    }
                    $data .= '</td>
                                </tr>';


                }

                $data .= '<tr>
                                <td class="fw-bold">'. __('nav.allFunctionAction') .'</td>
                                <td>
                                    <div>
                                        <input type="checkbox" ' . ($dataFunction->action_edit == 1 ? 'checked' : '') . ' name="greenAction" id="edit" value="1">
                                        <label for="edit" class="ms-1 text-success"> '. __('nav.greenAction') .' </label>
                                    </div>
                                    <div>
                                        <input type="checkbox" ' . ($dataFunction->action_delete == 1 ? 'checked' : '') . ' name="redAction" id="delete" value="1">
                                        <label for="delete" class="ms-1 text-danger">'. __('nav.redAction').'</label>
                                    </div>
                                </td>
                            </tr>';

                $data .= '</tbody></table>';
                // return response()->json($data);
                // return response()->json([$data]);
                // $html  .= 'have data';

            }

            else{
                $data = '';
                $Mainfunctions = DB::table('main_function')->get();

                $data .= '<table class="table">
                <thead>
                    <tr>
                        <th> '. __("nav.mainFunction") .' </th>
                        <th>'. __("nav.subFunction") .'</th>
                    </tr>
                </thead>
                <tbody>';

                    // ------------------------------------------------------------///

                foreach ($Mainfunctions as $f) {
                    if ($f->name == 'Dashboard') {
                        $data .= '<tr>
                            <td>
                                <input type="checkbox" name="main_function[]" id="mainFunction' . $f->id . '" value="' . $f->id . '">
                                <label for="mainFunction' . $f->id . '" class="ms-1">
                                    <span class="mdi ' . $f->icon_name . ' text-secondary fs-5"></span>';
                                    if(session('localization') =='en'){
                                        $data .= $f->name;
                                    }else{
                                        $data .= $f->name_kh;
                                    }
                                    $data .= '</label>
                                </label>
                            </td>
                            <td></td>
                        </tr>';
                    }

                    // ------------------------------------------------------------///

                    else {
                        $subFunctions = DB::table('sub_function')
                                        ->where('main_function_id', $f->id)
                                        ->get();


                        $data .= '<tr>
                            <td>
                                <input type="checkbox" name="main_function[]" id="mainFunction' . $f->id . '" value="' . $f->id . '">
                                <label for="mainFunction' . $f->id . '" class="ms-1">
                                    <span class="mdi ' . $f->icon_name . ' text-secondary fs-5"></span> ';

                                    if(session('localization') =='en'){
                                        $data .= $f->name;
                                    }else{

                                        $data .= $f->name_kh;
                                    }

                                    $data .= '</label>
                                </label>
                            </td>';



                        $data .= '<td>';


                        foreach ($subFunctions as $subF) {
                            $data .= '<div>
                                <input type="checkbox" name="sub_function[]" id="subFunction' . $subF->id . '" value="' . $subF->id . '">
                                <label for="subFunction' . $subF->id . '" class="ms-1">';
                                if($f->name == 'Manage Users'){
                                    $data .= $subF->name;
                                    // $data .= 'Hlloe';
                                }else{
                                    if(session('localization') =='en'){
                                        $data .= $subF->name;
                                    }else{
                                        $data .= $subF->name_kh;
                                    }
                                }


                                // $data .= ' </label>
                                $data .= '
                                </label>
                            </div>';
                        }


                        $data .= '</td>

                        </tr>';
                    }
                }

                $data .= '<tr>
                            <td class="fw-bold">'. __('nav.allFunctionAction') .' </td>
                            <td>
                                <div>
                                    <input type="checkbox" name="greenAction" id="edit" value="1">
                                    <label for="edit" class="ms-1 text-success">'. __('nav.greenAction') .'</label>
                                </div>
                                <div>
                                    <input type="checkbox" name="redAction" id="delete" value="1">
                                    <label for="delete" class="ms-1 text-danger">'. __('nav.redAction') .'</label>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>';
            }
        return response()->json($data);
    }



    public function role($id){
        $data = '';
        $roleQry = DB::table('users')
                    ->where('id', $id)
                    ->get()->first();


        if($roleQry == true){
            $role_id = $roleQry->role_id;

            $data .= '<option disabled selected>Select user</option>';

                $roleQry = DB::table('user_roles')
                            ->get();
                $auto = 1;
                foreach ($roleQry as $role){
                    // $data .= '<option '. if($role->id == $role_id) {echo 'selected'} .'  value="'. $role->id . '" >'. $auto++.'. '.$role->role_name.'</option>';
                    $data .= '<option ' . ($role->id == $role_id ? 'selected' : '') . ' value="' . $role->id . '">' . $role->role_name . '</option>';
                }

        }else{
            $data .= '<option disabled selected>Select user</option>';

                $roleQry = DB::table('user_roles')
                            ->get();
                $auto = 1;
                foreach ($roleQry as $role){
                    $data.= '<option value="'. $role->id . '">'. $role->role_name.'</option>';
                }
        }

        return response()->json($data);
    }


    public function getAuto(){
        // $data = session(['notification' => true]);
        $data = '';
        $borrow = DB::table('borrows')
                    ->where('notificatino', 1)
                    ->get();
        if($borrow == true){

            $data['nitification'] = session('nitification', true);
            // foreach($borrow as $borrows){
            //     $data .= '<p>Notificatinos</p>
            //             <table id="tableNotification" class="table w-100">
            //                 <thead>
            //                     <tr>
            //                         <td><img src="'. asset('images/draft-user.jpg'). '" alt=""> Sokheng Voeurn <span class="ps-3">25-02-2025</span></td>
            //                     </tr>
            //                     <tr>
            //                         <td><img src="'. asset('images/draft-user.jpg'). '" alt=""> Sokheng Voeurn <span class="ps-3">25-02-2025</span></td>
            //                     </tr>
            //                 </thead>
            //             </table>';
            // }
        }

        // return response()->json($data);
        return view('layout.master', $data);

    }

    public function getsection($id) {
        $data = '';
        $sections = DB::table('section')
            ->where('department_id', $id)
            ->where('delete_status', 1)
            ->orderBy('id', 'desc')
            ->get();

        $data .= '<option value=""> ' . __('nav.section') . ' </option>';

        foreach ($sections as $sec) {
            $sectionName = session()->has('localization') && session('localization') == 'en'
                ? $sec->section_en
                : $sec->section_kh;

            $data .= '<option value="' . $sec->id . '">' . $sectionName . '</option>';
        }

        return response()->json($data);
    }

    public function getposition($id){
        $data = '';
        $positions = DB::table('positions')
                    ->where('section_id', $id)
                    ->where('delete_status', 1)
                    ->orderBy('id', 'desc')
                    ->get();

        $data .= '<option value=""> ' . __('nav.position') . ' </option>';
        // $data .= '<option value=""> Hello </option>';

        foreach ($positions as $pos) {
            $data .= '<option value="' . $pos->id . '">' . $pos->position_name . '</option>';
            // $data .= '<option value="' . $pos->id . '"> Hi </option>';
        }

        return response()->json($data);
    }
}


