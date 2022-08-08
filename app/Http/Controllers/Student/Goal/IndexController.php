<?php

namespace App\Http\Controllers\Student\Goal;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use App\Models\Goal;
use App\Models\GoalMedia;
class IndexController extends Controller
{
    public function index()
    {   
        $data = [];
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
}
