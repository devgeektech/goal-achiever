<?php

namespace App\Http\Controllers\Student\Goal;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Goal;
use Illuminate\Support\Facades\Auth;
use App\Models\GoalMedia;
use App\Models\Unit;
use App\Models\Topic;
use App\Models\Country;
use App\Models\Plan;
use App\Models\TakenGoal;
use Exception;
class IndexController extends Controller
{
    public function index()
    {   
        $data = [];
        $data = getMembershipDetails();
        $goals = Goal::latest()->get()->groupBy('unit_id');
        if(count($goals)> 0){
            $data['goals'] = $goals;
        }
        
        return view('student.goals.index',$data);
    }

    /**
     * Display Goal Info in page
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
       if(count($media_document) > 0){
           $data['media_document'] = $media_document;
       }
       $media_video = GoalMedia::where('goal_id',$id)->where('type','video')->get();
       if(count($media_video) > 0){
           $data['media_video'] = $media_video;
       }
       $exam_document = GoalMedia::where('goal_id',$id)->where('type','exam_document')->get();
       if(count($exam_document)> 0){
           $data['exam_document'] = $exam_document;
       }
      
        return view('student.goals.info',$data);
       
    }

    /**
     * Unit Info
     */
    public function details($id)
    {
        try{
            $data = [];
            $data = getMembershipDetails();
            $unit_detials = Goal::where('unit_id',$id)->get();
            if(count($unit_detials)> 0){
                $data['unit_detials'] = $unit_detials;
            }
            return view('student.goals.details',$data);
        }catch(Exception $e){
            return redirect()->route('student.goals.details',$data)->with('error',$e->getMessage());
        }
    }

    /**
     * When student select goal fron frontend
     */
    
    public function take_goal(Request $request)
    {
        $request->validate([
            'goal_id' => 'required',
        ]);
       
        try{
            $data = getMembershipDetails();
            $goals = Goal::latest()->get();
            if(count($goals)> 0){
                $data['goals'] = $goals;
            }
            
            $get_info = TakenGoal::where('unit_id',$request->unit_id)->where('student_id',Auth::user()->id)->first();
            if($get_info){
                if($request->taken_from == 'front'){
                    return response()->json([ 'status' => 'already']);
                }
                return redirect()->route('student.goals.index',$data)->with('error','Goal is already taken :(');
            }
            
            $goal_ids = Goal::select('id')->where('unit_id',$request->unit_id)->pluck('id')->toArray();      
            if(count($goal_ids)>0){
                $topics = Topic::where('unit_id',$request->unit_id)->get();
                $i = 0;
               
                foreach($topics as $topic){
                    $taken_goal = new TakenGoal;
                    $taken_goal->goal_id = $goal_ids[$i];
                    $taken_goal->student_id = Auth::user()->id;
                    $taken_goal->status = ($i == 0) ? '2' : '3';
                    $taken_goal->subject_id = $topic->subject_id;
                    $taken_goal->unit_id = $topic->unit_id;
                    $taken_goal->topic_id = $topic->id;
                    $taken_goal->end_date = $request->end_date;
                    $taken_goal->save();
                    $i++;
                }
              
                if(intval($taken_goal->id) > 0){
                    if($request->taken_from == 'front'){
                        return response()->json([ 'status' => 'Success']);
                    }
                    return redirect()->route('student.goals.index',$data)->with('success','Thanks for taking a goal to achieve :)');
                }else{
                    return redirect()->route('student.goals.index',$data)->with('error','Something went wrong :(');
                }
            } 
            
            return redirect()->route('student.goals.index',$data)->with('error','No goal found :(');
            
            
        }catch(Exception $e){
            return redirect()->route('student.goals.index',$data)->with('error',$e->getMessage());
        }
    }
}
