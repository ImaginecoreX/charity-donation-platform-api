<?php

namespace App\Http\Controllers;

use App\Models\admin;

use Illuminate\Http\Request;
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
            ]);
        }

        return response()->json(['newAdmin' => $adminData], 200);
    }

    public function addCode(Request $request)
    {
        $adminUpdateFind = admin::where('email', $request->input('email'))->first();
        $adminUpdateFind->verification_code = $request->input('verification_code');
        $adminUpdateFind::save();
        return response()->json(['sucess'], 200);
    }

    public function adminLogin(Request $request)
    {
        $adminAluth = admin::where('email', $request->input('email'))->where('verification_code', $request->input('verification_code'))->exists();

        if (!$adminAluth) {
            return response()->json(['invalid verification code'], 200);
        }

        return response()->json(['sucess'], 200);
    }
}
