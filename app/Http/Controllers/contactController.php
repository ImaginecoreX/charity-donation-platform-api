<?php

namespace App\Http\Controllers;

use App\Http\Middleware\FormValidator;
use App\Models\contact;
use Illuminate\Http\Request;
use Validator;

class contactController extends Controller
{
    //submit form
    public function addForm(Request $request){

        $validator = Validator::make($request->all(),[
            'id'=>'required',
            'name'=>'required',
            'email'=>'required',
            'msg'=>'required',
        ]);

        if($validator->fails()){
            return response()->json(['err'=>$validator->errors()], 422);
        }

        $Validate = new FormValidator($request->input('email'),$request->input('msg'));

        $findValidateStatus = $Validate->validate();

        if($findValidateStatus!=='success'){

            return $findValidateStatus;

        }else{

            $contactData = contact::create([
                'id'=>$request->input('id'),
                'name'=>$request->input('name'),
                'email'=>$request->input('email'),
                'msg'=>$request->input('msg'),
            ]);
            return response()->json(['newForm'=>$contactData],200);

        }

       

    }

}
