<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Membership;
use App\Models\Subject;
use Exception;
use Illuminate\Support\Facades\Session;
class IndexController extends Controller
{
    public function index()
    {
        try{
            $data = [];
            //Get plan details
            $plan_details = Membership::where('student_id',Auth::user()->id)->get();
            if(count($plan_details) > 0){
                $set_plan = 1;
            }else{
                $set_plan = 2;
            }
            Session::put('set_plan', $set_plan);
            foreach($plan_details as $key => $val){
                if(strtotime(now()) > strtotime($val->expiry_date)){
                    Session::put('plan_expire', 1);
                }else{
                    Session::put('plan_expire', 2);
                }
            }
            //Get subjects
            $subjects = Subject::latest()->get();
            if($subjects){
                $data['subjects'] = $subjects;
            }
            //Get all Plans
            $plans = DB::table('plans')->whereNotIn('id', function($q){
                            $q->select('plan_id')->from('memberships');
                        })->get();
            if(count($plans) > 0){
                $data['plans'] = $plans;
            }
            return view('student.index',$data);
        }catch(Exception $e){
            return view('student.index')->with('error',$e->getMessage());
         
        }
    }
    
}
