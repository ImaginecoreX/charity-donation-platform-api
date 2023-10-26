<?php

namespace App\Http\Controllers;

use App\Models\admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class adminController extends Controller
{

    //add admin
    public function addAdmin(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'email' => 'required',
            'fname' => 'required',
            'lname' => 'required',
            'type_id' => 'required',
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['err' => $validator->errors()], 422);
        }

        $findAdmin = admin::where('email', $request->input('email'))->exists();

        if ($findAdmin) {
            return response()->json(['err' => 'admin already registered'], 422);
        } else {
            $adminData = admin::create([
                'email' => $request->input('email'),
                'fname' => $request->input('fname'),
                'lname' => $request->input('lname'),
                'type_id' => $request->input('type_id'),
                'password' => $request->input('password'),
            ]);
        }

        return response()->json(['newAdmin' => $adminData], 200);
    }



    public function adminLogin(Request $request)
    {
        $adminAluth = admin::where('email', $request->input('email'))->where('password', $request->input('password'))->exists();

        if (!$adminAluth) {
            return response()->json(['invalid verification code'], 200);
        }

        $adminData = admin::where('email', $request->input('email'))->get();

        return response()->json(['sucess'], 200);
    }

    //all  admin
    public function allAdmin()
    {
        $adminData = admin::all();

        return response()->json(['all' => $adminData], 200);
    }

    //update admin
    public function updateAdmin(Request $request, $email)
    {

        $admin = admin::where('email', $email)->first();

        $admin->update($request->all());

        return response()->json(['new' => $admin], 200);
    }

    //admin block 
    public function adminBlock($email,$status){

        $findAdmin = admin::where('email', $email)->first();


        if($status == "2"){
            $findAdmin->type_id = 3;
            $findAdmin->save();
            return response()->json(['msg'=>'block'], 200);
        }else if($status == "3"){
            $findAdmin->type_id = 2;
            $findAdmin->save();
            return response()->json(['msg'=>'unblock'], 200);
        }

    }
}
