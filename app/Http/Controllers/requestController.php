<?php

namespace App\Http\Controllers;

use App\Models\requst;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class requestController extends Controller
{
    //send Request
    public function sendRequest(Request $request){

        $validetor = Validator::make($request->all(), [
            'title' => 'required',
            'description' => 'required',
            'target_amount' => 'required',
            'file_path' => 'required',
            'd_type_id' => 'required',
            'r_type_id' => 'required',
            'deadline' => 'required',
            
        ]);

        if ($validetor->fails()) {
            return response()->json(['err' => $validetor->errors()], 422);
        }

        $requestData = requst::create([
            'title' => $request->input('title'),
            'description' =>  $request->input('description'),
            'target_amount' =>  $request->input('target_amount'),
            'file_path' =>  $request->input('file_path'),
            'd_type_id' =>  $request->input('d_type_id'),
            'r_type_id' =>  $request->input('r_type_id'),
            'deadline' =>  $request->input('deadline'),
            
        ]);

        return response()->json(['request'=>$requestData],200);

    }


    //Request status update
    public function requestStatusUpdate($id,$current_status_id){
        $reqData = requst::where('id',$id)->first();

        if($current_status_id == '1'){
            $reqData->r_type_id = '2';
            $reqData::save();
            return response()->json(['sucess'], 200);
        }else if($current_status_id == '2'){
            $reqData->r_type_id = '3';
            $reqData::save();
            return response()->json(['sucess'], 200);
        }
    }


    //Update Request
    public function updateRequest(Request $request,$reqId){
        $reqUpdate =requst::where('id',$reqId)->first();
        $reqUpdate->update($request->all());
    } 

    //all Request
    public function allRequest(){
        $allRequest = DB::table('requsts')->join('donation_types','requsts.d_type_id','=','donation_types.donation_type_id')->join('requst_types','requsts.r_type_id','=','requst_types.requst_type_id')->get();
        return response()->json(['allRequest'=>$allRequest],200);
    }


}
