<?php

namespace App\Http\Controllers\Student\Goal;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Goal;
use Illuminate\Support\Facades\Auth;
use App\Models\GoalMedia;
use App\Models\TakenGoal;
use Exception;
class IndexController extends Controller
{
    public function index()
    {   
        $data = [];
        $data = getMembershipDetails();
        $goals = Goal::latest()->get();
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
      
        return view('student.goals.info',$data);
       
    }

    /**
     * Download Documents
     */
    public function doc_download($filename)
    {
       
        /* $file= public_path(). "/download/".$doc;
        
        $headers = array(
                'Content-Type: application/pdf',
                );
        return Response::download($file, $doc, $headers); */
    }

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
            $get_info = TakenGoal::where('goal_id',$request->goal_id)->first();
            if($get_info){
                if($request->taken_from == 'front'){
                    return response()->json([ 'status' => 'already']);
                }
                return redirect()->route('student.goals.index',$data)->with('error','Goal is already taken :(');
            }
            $taken_goal = new TakenGoal;
            $taken_goal->goal_id = $request->goal_id;
            $taken_goal->student_id = Auth::user()->id;
            $taken_goal->status = 'inprogress';
            $taken_goal->save();
            if(intval($taken_goal->id) > 0){
                if($request->taken_from == 'front'){
                    return response()->json([ 'status' => 'Success']);
                }
                return redirect()->route('student.goals.index',$data)->with('success','Thanks for taking a goal to achieve :)');
            }else{
                return redirect()->route('student.goals.index',$data)->with('error','Something wnet wrong :(');
            }
        }catch(Exception $e){
            return redirect()->route('student.goals.index',$data)->with('error',$e->getMessage());
        }
    }
}
