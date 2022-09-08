<?php

namespace App\Http\Controllers\Student\Plans;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Plan;
use App\Models\Membership;
use App\Models\Payment;
use Exception;
use Illuminate\Support\Facades\Auth;

class IndexController extends Controller
{
    /**
     * Display All Plans
     */
    public function index()
    {  
        $data = [];
        $data = getMembershipDetails();
        $membership_plans = Membership::where('student_id', Auth::user()->id)->get();
        if(count($membership_plans)> 0){
            $data['membership_plans'] = $membership_plans;
        }
        $card_details = Payment::where('student_id', Auth::user()->id)->get();
        if(count($card_details)> 0){
            $data['card_details'] = $card_details;
        }
        return view('student.plans.index',$data);
    }

    /**
     * Display Plan Info in page
     */
    public function show($id)
    {
       
        $data = [];
        $data = getMembershipDetails();
        $plan = Plan::find($id);
        if($plan){
            $data['plan'] = $plan;
        }   
        $payment = Payment::where('plan_id',$id)->first();
        if($payment){
            $data['payment'] = $payment;
        }   
        return view('student.plans.info',$data);
       
    }

     /**
     * Store Purchase Plan into Database
     */
    public function store(Request $request)
    {
        try{
            switch ($request->plan) {
            case '1':
                $plan_days = countDays($request->plan_months);
                $expire_date = getExpiryDate($request->plan_months);
                $type = 'monthly';
                break;
            case '2':
                $plan_days = countDays($request->plan_months);
                $expire_date = getExpiryDate($request->plan_months);
                $type = 'monthly';
                break;
            case '3':
                $plan_days = countDays($request->plan_months);
                $expire_date = getExpiryDate($request->plan_months);
                $type = '3 monthly';
                break;
            case '4':
                $plan_days = countDays($request->plan_months);
                $expire_date = getExpiryDate($request->plan_months);
                $type = '6 monthly';
                break;
            default:
                $plan_days = countDays($request->plan_months);
                $expire_date = getExpiryDate($request->plan_months);
                $type = 'yearly';
            }
           
            $membership = new Membership;
            $membership->plan_id = $request->plan;
            $membership->student_id = Auth::user()->id;
            $membership->plan_days = $plan_days;
            $membership->type = $type;
            $membership->subscription = 'manual';
            $membership->expiry_date = $expire_date;
            $membership->transaction_id = $request->reference_no;
            
            $membership->save();
           
            if(intval($membership->id) > 0){
                return redirect()->route('student.dashboard')->with('success','Plan "'.$request->plan_name.'" has been purchased successfully.');
               
            }
        }catch(Exception $e){
            //dd($e->getMessage());
            return redirect()->route('student.dashboard')->with('error',$e->getMessage());
        }
    }
}
