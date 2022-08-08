<?php

namespace App\Http\Controllers\Student\Plans;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Plan;
use App\Models\Membership;
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
        $plans = Plan::latest()->get();
        if(count($plans)> 0){
            $data['plans'] = $plans;
        }
        return view('student.plans.index',$data);
    }

    /**
     * Display Plan Info in page
     */
    public function show($id)
    {
       
       $data = [];
       $plan = Plan::find($id);
       if($plan){
            $data['plan'] = $plan;
       }   
        return view('student.plans.info',$data);
       
    }

     /**
     * Store Purchase Plan into Database
     */
    public function store(Request $request)
    {
        $request->validate([
            'plan' => 'required',
            'plan_subject' => 'required'
        ]);
        try{
            switch ($request->plan) {
            case '1':
                $plan_days = date('t');
                $type = 'monthly';
                break;
            case '2':
                $plan_days = date('t');
                $type = 'monthly';
                break;
            case '3':
                $plan_days = date('t')*3;
                $type = '3 monthly';
                break;
            case '4':
                $plan_days = date('t')*6;
                $type = '6 monthly';
                break;
            default:
                $plan_days = 365;
                $type = 'yearly';
            }
            $membership = new Membership;
            $membership->plan_id = $request->plan;
            $membership->student_id = Auth::user()->id;
            $membership->subject_id = $request->plan_subject;
            $membership->plan_days = $plan_days;
            $membership->type = $type;
            $membership->save();
            if(intval($membership->id) > 0){
                return redirect()->route('student.dashboard')->with('success',''.$request->name.' Plan has been purchased successfully.');
            }
        }catch(Exception $e){
            return redirect()->route('student.dashboard')->with('error',$e->getMessage());
        }
    }
}
