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
            
            Session::forget('set_plan');
            Session::forget('plan_expire');

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
            $get_free_plan_id = Auth::user()->memberships()->withTrashed()->count();                        
            if( intval($get_free_plan_id) > 0 ){
                $plans = DB::table('plans')->whereNotIn('id', [1])->get();
            }else{
                $plans = DB::table('plans')->get();
            }
            if(count($plans) > 0){
                $data['plans'] = $plans;
            }

           
            $all_goals = TakenGoal::where('student_id',Auth::user()->id)->get();
            if(count($all_goals) > 0){
                foreach($all_goals as $goal) {
                    $goals[] = getTopicName($goal->topic_id);
                }
                $data['all_goals'] = count($all_goals);
                
            }else{
                $data['all_goals'] = 0;
            }
            
            $comp_goals = TakenGoal::where('student_id',Auth::user()->id)->where('status','1')->with('goal')->get();
            if(count($comp_goals) > 0){
                $data['comp_goals'] =  $comp_goals->count();
            }else{
                $data['comp_goals'] = 0;
            }

            $get_units = DB::table('taken_goals')->where('student_id',Auth::user()->id)->distinct('unit_id')->pluck('student_id','unit_id')->toArray();
            $get_units_name = $get_units_percentage = [];
            if(count($get_units)>0){          
                foreach($get_units as $unit => $student_id){  
                    $get_units_name[] = getUnitName($unit);
                    $get_units_percentage[] = get_percentage($unit,$student_id);
                }
            } 
            $data['get_units'] = $get_units_name;
            $data['get_percentage'] = $get_units_percentage;

            // Get each unit percentage

          

            return view('student.index',$data);
        }catch(Exception $e){
            
            return view('student.index')->with('error',$e->getMessage());
         
        }
    }
    
}
