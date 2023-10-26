<?php

namespace App\Http\Controllers;

use App\Models\event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class eventController extends Controller
{
    //add event
    public function addEvent(request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => 'required',
            'admin_email' => 'required',
            'title' => 'required',
            'description' => 'required',
            'time' => 'required',
            'location_link' => 'required',
            'district_id' => 'required',
            'status_id' => 'required',
            'event_statuses_id' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['err' => $validator->errors()], 422);
        }


        $eventData = event::create([
            'id' => $request->input('id'),
            'admin_email' => $request->input('admin_email'),
            'title' => $request->input('title'),
            'description' => $request->input('description'),
            'time' => $request->input('time'),
            'location_link' => $request->input('location_link'),
            'district_id' => $request->input('district_id'),
            'status_id' => $request->input('status_id'),
            'event_statuses_id' => $request->input('status_id'),

        ]);
        return response()->json(['newEvent' => $eventData], 200);
    }

    //update event
    public function updateEvent(request $request, $id)
    {
        $event = event::where('id', $id)->first();
        $event->update($request->all());

        return response()->json(['message' => 'Sucess'], 200);

    }

    //all events search
    public function allEvent()
    {
        $allEvent = DB::table('events')->join('event_statuses', 'events.event_statuses_id', '=', 'event_statuses.id')->join('districts', 'events.district_id', '=', 'districts.id')->get();
        return response()->json(['allEvent' => $allEvent], 200);
    }

    //individual event search
    public function eventSearch(request $request, $id)
    {
        $searchEvent = event::where('id', $id)->get();
        return response()->json(['searchEvent' => $searchEvent], 200);
    }
}
