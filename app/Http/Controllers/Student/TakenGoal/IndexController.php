<?php

namespace App\Http\Controllers\Student\TakenGoal;

use App\Http\Controllers\Controller;
use App\Models\TakenGoal;
use Illuminate\Http\Request;
use App\Models\Goal;
use App\Models\Unit;
use App\Models\Topic;
use App\Models\GoalAssignment;
use App\Models\GoalAssignmentsMedia;
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
        $goal_detials = TakenGoal::where('student_id', Auth::user()->id)
                                    ->with('goal')
                                    ->get()
                                    ->groupBy('unit_id');
        if(count($goal_detials)> 0){
            $data['goal_detials'] = $goal_detials;
        }
        return view('student.taken_goals.index',$data);
    }

    public function upload_assignments(Request $request)
    {
        $request->validate([
            'goal_assignment' => 'required'
        ]);
        
        try{
            $medias = array();
            if($request->hasFile('goal_assignment')){ 
                foreach($request->file('goal_assignment') as $k => $goal_assignment)  {
                    $path = $goal_assignment->store('public/files');
                    $name = $goal_assignment->getClientOriginalName();
                    $medias['goal_assignment'][$k]['path'] = $path;
                    $medias['goal_assignment'][$k]['ext'] = $goal_assignment->extension();
                    $medias['goal_assignment'][$k]['type'] = 'document';
                }
            }
            $goalAssignment = new GoalAssignment();
            $goalAssignment->goal_id = $request->assign_goal_id;
            $goalAssignment->student_id = Auth::user()->id;
            $goalAssignment->save();
            if(intval($goalAssignment->id) > 0){
                if(count($medias) > 0){
                    foreach($medias as $media){
                        foreach($media as $doc){                            
                            $goal_media = new GoalAssignmentsMedia();
                            $goal_media->goal_id = $request->assign_goal_id;
                            $goal_media->goal_assignment_id = $goalAssignment->id;
                            $goal_media->media = $doc['path'];
                            $goal_media->ext = $doc['ext'];
                            $goal_media->type = $doc['type']; 
                            $goal_media->save();
                        }
                    }
                }
            }
            
            if($request->mark_goal_completed == 'on'){
                $goal = Goal::find($request->assign_goal_id);
                if($goal->id){
                    $goal_taken = TakenGoal::where('student_id',Auth::user()->id)
                                            ->where('subject_id',$goal->subject_id)
                                            ->where('unit_id',$goal->unit_id)
                                            ->where('topic_id',$goal->topic_id)
                                            ->firstOrFail();
                    $goal_taken->status = 1;
                    $goal_taken->save();
                    if(intval($goal_taken->id) > 0){
                        $goal_next_id = $goal_taken->id+1;
                        $next_id = TakenGoal::find($goal_next_id);
                        if(($next_id->student_id == $goal_taken->student_id) && ($next_id->subject_id == $goal_taken->subject_id) && ($next_id->unit_id == $goal_taken->unit_id)){
                           $next_id->status = 2;
                           $next_id->save(); 
                        }
                    }
                }
            }
            return redirect()->route('student.taken_goals.index')->with('success','Assignment submitted successfully.');
        }catch(Exception $e){
            return redirect()->route('student.taken_goals.index')->with('error',$e->getMessage());
        }
    }


    /**
     * Unit Details
     */

     public function unit_details($id)
     {
        $data = [];
        $data = getMembershipDetails();
        $goal_detials = TakenGoal::where('unit_id',$id)->where('student_id',Auth::user()->id)->get();
        if(count($goal_detials)> 0){
            $data['goal_detials'] = $goal_detials;
            $data['unit_name'] = getUnitName($goal_detials[0]->unit_id);
        }
        return view('student.taken_goals.unit-details',$data);
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
            $data['unit_name'] = getUnitName($goal->unit_id);
            $data['topic_name'] = getTopicName($goal->topic_id);
            $data['goal_unit_id'] = $goal->unit_id;
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
