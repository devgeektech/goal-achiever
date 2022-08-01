<?php

namespace App\Http\Controllers\Admin\Goal;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Goal;
use App\Models\GoalMedia;
use App\Models\Subject;
use Exception;
use Illuminate\Support\Facades\Storage;
class IndexController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = [];
        $goals = Goal::latest()->get();
        if(count($goals)> 0){
            $data['goals'] = $goals;
        }
        return view('admin.goals.index',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $data = [];
        $subjects = Subject::latest()->get();
        if(count($subjects)> 0){
            $data['subjects'] = $subjects;
        }
        return view('admin.goals.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'subject' => 'required',
            'unit' => 'required',
            'topic' => 'required',
            'creator_name' => 'required',
            'instructor_name' => 'required'
        ]);
        try{
            $medias = array();
            if($request->hasFile('document')){ 

                foreach($request->file('document') as $k => $document)  {
                    $path = $document->store('public/files');
                    $name = $document->getClientOriginalName();
                    $medias['document'][$k]['path'] = $path;
                    $medias['document'][$k]['ext'] = $document->extension();
                    $medias['document'][$k]['type'] = 'document';
                }

            }
            if($request->hasFile('video')){

                foreach($request->file('video') as $k => $video)  {
                    $path = $video->store('public/files');
                    $name = $video->getClientOriginalName();
                    $medias['video'][$k]['path'] = $path;
                    $medias['video'][$k]['ext'] = $video->extension();
                    $medias['video'][$k]['type'] = 'video';
                } 
            }
            if($request->hasFile('exam_document')){
                foreach($request->file('exam_document') as $k => $exam_document)  {
                    $path = $exam_document->store('public/files');
                    $name = $exam_document->getClientOriginalName();
                    $medias['exam_document'][$k]['path'] = $path;
                    $medias['exam_document'][$k]['ext'] = $exam_document->extension();
                    $medias['exam_document'][$k]['type'] = 'exam_document';
                } 
            }
            $goal = new Goal;
            $goal->user_id = 1;
            $goal->subject_id = $request->subject;
            $goal->unit = $request->unit;
            $goal->topic = $request->topic;
            $goal->creator_name = $request->creator_name;
            $goal->instructor_name = $request->instructor_name;
            $goal->status = 1;
            $goal->save();
            if(intval($goal->id) > 0){

                if(count($medias) > 0){
                    // dd($medias);
                    foreach($medias as $media){
                        foreach($media as $doc){                            
                            $goal_media = new GoalMedia;
                            $goal_media->goal_id = $goal->id;
                            $goal_media->media = $doc['path'];
                            $goal_media->ext = $doc['ext'];
                            $goal_media->type = $doc['type']; 
                            $goal_media->save();
                        }
                    }
                }

            }
            return redirect()->route('admin.goals.index')->with('success','Goal has been created successfully.');
        }catch(Exception $e){
            return $e->getMessage();
        }
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        try{
            $data = [];
            $goal = Goal::find($id);
            if($goal){
                $data['goal'] = $goal;
            }
            $subjects = Subject::latest()->get();
            if(count($subjects)> 0){
                $data['subjects'] = $subjects;
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
            return view('admin.goals.edit',$data);
        }catch(Exception $e){
            return $e->getMessage();
        }
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'subject' => 'required',
            'unit' => 'required',
            'topic' => 'required',
            'creator_name' => 'required',
            'instructor_name' => 'required'
        ]);
        try{
            $goal = Goal::find($id);
            $medias = array();
            if($request->hasFile('document')){ 

                foreach($request->file('document') as $k => $document)  {
                    $path = $document->store('public/files');
                    $name = $document->getClientOriginalName();
                    $medias['document'][$k]['path'] = $path;
                    $medias['document'][$k]['ext'] = $document->extension();
                    $medias['document'][$k]['type'] = 'document';
                }

            }
            if($request->hasFile('video')){

                foreach($request->file('video') as $k => $video)  {
                    $path = $video->store('public/files');
                    $name = $video->getClientOriginalName();
                    $medias['video'][$k]['path'] = $path;
                    $medias['video'][$k]['ext'] = $video->extension();
                    $medias['video'][$k]['type'] = 'video';
                } 
            }
            if($request->hasFile('exam_document')){
                foreach($request->file('exam_document') as $k => $exam_document)  {
                    $path = $exam_document->store('public/files');
                    $name = $exam_document->getClientOriginalName();
                    $medias['exam_document'][$k]['path'] = $path;
                    $medias['exam_document'][$k]['ext'] = $exam_document->extension();
                    $medias['exam_document'][$k]['type'] = 'exam_document';
                } 
            }
            $goal->user_id = 1;
            $goal->subject_id = $request->subject;
            $goal->unit = $request->unit;
            $goal->topic = $request->topic;
            $goal->creator_name = $request->creator_name;
            $goal->instructor_name = $request->instructor_name;
            $goal->status = 1;
            $goal->save();
           
            if(intval($goal->id) > 0){

                if(count($medias) > 0){
                    // dd($medias);
                    foreach($medias as $media){
                        foreach($media as $doc){ 
                            $goal = Goal::find($id);
                            $goal->goal_media()->update([
                                'goal_id' => $goal->id,
                                'media' => $doc['path'],
                                'ext' => $doc['ext'],
                                'type' => $doc['type']
                            ]);                          
                            /* $goal_media = GoalMedia::where('goal_id',$goal->id)->get();
                            $goal_media->goal_id = $goal->id;
                            $goal_media->media = $doc['path'];
                            $goal_media->ext = $doc['ext'];
                            $goal_media->type = $doc['type']; 
                            $goal_media->save(); */
                        }
                    }
                }

            }
            return redirect()->route('admin.goals.index')->with('success','Goal has been updated successfully');
        }catch(Exception $e){
            return $e->getMessage();
        }
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try{
            $goal = Goal::find($id);
            deleteImageFromS3($goal->document);
            $goal->delete();
            return redirect()->route('admin.goals.index')
            ->with('success','Goal has been deleted successfully');
        }catch(Exception $e){
            return $e->getMessage();
        }
       
    }

    public function status(Request $request)
    {

    }
}
