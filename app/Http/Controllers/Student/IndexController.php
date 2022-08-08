<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Membership;
use App\Models\Subject;
use App\Models\Plan;
use Exception;
class IndexController extends Controller
{
    public function index()
    {
        try{
            $data = [];
            $get_plan = Membership::where('student_id',Auth::user()->id)->first();
            if(!$get_plan){
                $set_plan = 1;
            }
            $set_plan = 2;
            
            $subjects = Subject::latest()->get();
            if($subjects){
                $data['subjects'] = $subjects;
            }
            $plans = Plan::get();
            if($plans){
                $data['plans'] = $plans;
            }
            return view('student.index',$data)->with('get_plan',compact('set_plan'));
        }catch(Exception $e){
            return view('student.index')->with('error',$e->getMessage());
         
        }
    }
    
}
