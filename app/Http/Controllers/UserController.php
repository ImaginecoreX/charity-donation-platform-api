<?php

namespace App\Http\Controllers;

use App\Http\Middleware\ValidatorManage;
use App\Models\user;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    //register user
    public function registerUser(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required',
            'fname' => 'required',
            'lname' => 'required',
            'mobile' => 'required',
            'password' => 'required',
            'status_id' => 'required',
            'gender_id' => 'required',
        ]);

       

        if ($validator->fails()) {
            return response()->json(['err' => $validator->errors()], 422);
        }


        $Validate = new ValidatorManage($request->input("email"),$request->input("mobile"),$request->input("password"));

        $findValidateStatus = $Validate->validate();

        if($findValidateStatus !== "sucess"){

          return  $findValidateStatus;
          
        }else{

            $findUser = user::where('email', $request->input('email'))->exists();

            if ($findUser) {
                return response()->json(['err' => 'user alredy registered'], 422);
            }
    
            $user = user::create([
                'email' => $request->input('email'),
                'fname' => $request->input('fname'),
                'lname' => $request->input('lname'),
                'mobile' => $request->input('mobile'),
                'password' => $request->input('password'),
                'status_id' => $request->input('status_id'),
                'gender_id' => $request->input('gender_id'),
            ]);
    
            return response()->json(['new' => $user], 200);
        }


    }
    //login user
    public function loginUser(Request $request)
    {
        $findLoginUserData = user::where('email', $request->input('email'))->where('password', $request->input('password'))->exists();

        if (!$findLoginUserData) {
            return response()->json(['err' => 'login faild'], 422);
        }



        $user_data = user::where('email', $request->input('email'))->get();

        return response()->json(['user' => $user_data], 200);
    }

    //update user
    public function updateUser(Request $request, $email)
    {

        $user = user::where('email', $email)->first();

        $user->update($request->all());

        return response()->json(['new' => $user], 200);
    }

    //all user
    public function allUser()
    {
        $allUsers = user::all();
        return response()->json(['allUser' => $allUsers], 200);
    }

    //user block
    public function blockUser(Request $request, $email, $status)
    {

        $find_user = user::where('email', $email)->first();

        if ($status == "1") {
            $find_user->status_id = '2';
            $find_user->save();
            return response()->json(['unblock'], 200);
        } else if ($status == "2") {
            $find_user->status_id = "1";
            $find_user->save();
            return response()->json(['block'], 200);
        }
    }

    //block users 
    public function getBlockUsers(Request $request)
    {

        $blockUser = user::where('status_id', '2')->get();

        return response()->json(['blockUsers' => $blockUser], 200);
    }

    
    //unblock users 
    public function getUnblockUsers(Request $request)
    {

        $unblockUser = user::where('status_id', '1')->get();

        return response()->json(['unblockUsers' => $unblockUser], 200);
    }
}
