<?php

namespace App\Http\Controllers;

use App\Models\donation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class donationController extends Controller
{
    //Donate
    public function donate(Request $request)
    {

        $validetor = Validator::make($request->all(), [
            'donation_id' => 'required',
            'user_email' => 'required',
            'requst_id' => 'required',
            'amount' => 'required',
        ]);

        if ($validetor->fails()) {
            return response()->json(['err' => $validetor->errors()], 422);
        }


        $donetion = donation::create([
            'donation_id' => $request->input('donation_id'),
            'user_email' => $request->input('user_email'),
            'requst_id' => $request->input('requst_id'),
            'amount' => $request->input('amount'),
        ]);

        return response()->json(['sucesss'], 200);
    }

    // all donation
    public function allDonation()
    {
        $donationData = DB::table('donations')->join('users', 'donations.user_email', '=', 'users.email')->join('requsts', 'donations.requst_id', '=', 'requsts.id')->get();
        return response()->json(['donationData' => $donationData], 200);
    }
}
