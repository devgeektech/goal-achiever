<?php

namespace App\Http\Controllers\Student\TakenGoal;

use App\Http\Controllers\Controller;
use App\Models\TakenGoal;
use Illuminate\Http\Request;
use App\Models\Goal;
use App\Models\GoalMedia;
use Illuminate\Support\Facades\Auth;
use Exception;

class IndexController extends Controller
{
    /**
     * Display All Taken Goals
     */
    public function index()
    {  
        $data = [];
        $data = getMembershipDetails();
        $goal_detials = TakenGoal::where('student_id', Auth::user()->id)->with('goal')->get();
        if(count($goal_detials)> 0){
            $data['goal_detials'] = $goal_detials;
        }
        return view('student.taken_goals.index',$data);
    }

    public function submit_papers(Request $request)
    {

    }

    /**
     * Goal Details
     */
    public function show($id)
    {
        $data = [];
       $data = getMembershipDetails();
       $goal = Goal::find($id);
       if($goal){
            $data['goal'] = $goal;
       }   
       $media_document = GoalMedia::where('goal_id',$id)->where('type','document')->get();
       if(count($media_document)> 0){
           $data['media_document'] = $media_document;
       }
       $media_video = GoalMedia::where('goal_id',$id)->where('type','video')->get();
       if(count($media_video)> 0){
           $data['media_video'] = $media_video;
       }
       $exam_document = GoalMedia::where('goal_id',$id)->where('type','exam_document')->get();
       if(count($exam_document)> 0){
           $data['exam_document'] = $exam_document;
       }
      
        return view('student.taken_goals.info',$data);
    }
}
