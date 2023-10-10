<?php

namespace App\Http\Controllers;

use App\Models\events;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class eventController extends Controller
{
    //add event
    public function addEvent(request $request){
        $validator = Validator::make($request->all(),[
            'id'=>'required',
            'admin_email'=>'required',
            'title'=>'required',
            'description'=>'required',
            'time'=>'required',
            'location_link'=>'required',
            'district_id'=>'required',
        ]); 

        if($validator->fails()){
            return response()->json(['err'=> $validator->errors()],422);
        }

      
            $eventData = events::create([
                'id'=>$request->input('id'),
                'admin_email'=>$request->input('admin_email'),
                'title'=>$request->input('title'),
                'description'=>$request->input('description'),
                'time'=>$request->input('time'),
                'location_link'=>$request->input('location_link'),
                'district_id'=>$request->input('district_id'),
                
            ]);
        return response()->json(['newEvent'=>$eventData],200);
    }

    //update event
    public function updateEvent(request $request, $id){
        $event = events::where('id',$id)->first();
        $event->update($request->all());

        return response()->json(['message'=>'Sucess'],200);

    }

    //all events search
    public function allEvent(){
        $allEvent = DB::table('events')->join('event_statuses','events.status_id','=','event_status.id')->join('district','events.district_id','=','district.id')->get();
        return response()->json(['allEvent'=>$allEvent],200);
    }

    //individual event search
    public function eventSearch(request $request,$id){
        $searchEvent = events::where('id',$id)->get();
        return response()->json(['searchEvent'=>$searchEvent],200);
    }
}
