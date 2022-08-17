<?php

namespace App\Http\Controllers\Web\Goals;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Goal;
use App\Models\Subject;
use App\Models\Country;
use App\Models\Plan;
use Exception;
class IndexController extends Controller
{
    public function goals()
    {   
        $data = [];
        $subjects = Subject::latest()->get();
        if($subjects){
            $data['subjects'] = $subjects;
        }
        $subjects = Subject::latest()->get();
        if($subjects){
            $data['subjects'] = $subjects;
        }
        $countries = Country::latest()->get();
        if(count($countries)> 0){
            $data['countries'] = $countries;
        }
        $plans = Plan::get();
        if($plans){
            $data['plans'] = $plans;
        }
        return view('web.goals.index',$data);
    }

    public function show($id)
    {
        try{
            $goal_detials = Goal::where('subject_id',$id)->get();
            if(count($goal_detials)> 0){
                $data['goal_detials'] = $goal_detials;
            }
            $countries = Country::latest()->get();
            if(count($countries)> 0){
                $data['countries'] = $countries;
            }
            $plans = Plan::get();
            if($plans){
                $data['plans'] = $plans;
            }
            return view('web.goals.info',$data);
        }catch(Exception $e){
            return redirect()->route('web.goals.info',$data)->with('error',$e->getMessage());
        }
    }

    public function description($id)
    {
        try{
            $goal_detials = Goal::where('id',$id)->get();
            if(count($goal_detials)> 0){
                $data['goal_detials'] = $goal_detials;
            }
            $countries = Country::latest()->get();
            if(count($countries)> 0){
                $data['countries'] = $countries;
            }
            $plans = Plan::get();
            if($plans){
                $data['plans'] = $plans;
            }
            return view('web.goals.description',$data);
        }catch(Exception $e){
            return redirect()->route('web.goals.description',$data)->with('error',$e->getMessage());
        }
    }
}

