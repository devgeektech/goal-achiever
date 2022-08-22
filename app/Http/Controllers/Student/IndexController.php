<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Membership;
use App\Models\Subject;
use App\Models\Plan;
use App\Models\TakenGoal;
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
                if((strtotime(now()) > strtotime($val->expiry_date)) && ($val->subscription == 'manual')){
                    Session::put('plan_expire', 1);
                }else{
                    if((strtotime(now()) > strtotime($val->expiry_date)) && ($val->subscription == 'auto')){
                        $new_expiry_date = getNewExpiryDate($val->plan_id,$val->expiry_date);
                        update_membership_plan($val->id,$new_expiry_date);
                        Session::put('plan_expire', 2);
                    }
                }
            }
            //Get subjects
            $subjects = Subject::latest()->get();
            if($subjects){
                $data['subjects'] = $subjects;
            }
            //Get all Plans
            $get_free_plan_id = Membership::where('student_id',Auth::user()->id)->first();
            if(!empty($get_free_plan_id)){
                $plans = DB::table('plans')->whereNotIn('id', [1])->get();
            }else{
                $plans = DB::table('plans')->get();
            }
            
            if(count($plans) > 0){
                $data['plans'] = $plans;
            }

            $my_goals = TakenGoal::where('student_id',Auth::user()->id)->with('goal')->get();
            if(count($my_goals) > 0){
                $goals = array();
                foreach($my_goals as $goal) {
                    $goals[] = $goal->goal->unit->name;
                }
                $data['my_goals'] = count($my_goals);
                $data['goals'] = implode(', ', $goals);
            }else{
                $data['my_goals'] = '0';
            }
            return view('student.index',$data);
        }catch(Exception $e){
            return view('student.index')->with('error',$e->getMessage());
         
        }
    }
    
}
