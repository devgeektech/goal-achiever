<?php

namespace App\Http\Controllers\Admin\Goal;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Goal;
use App\Models\GoalMedia;
use App\Models\Subject;
use App\Models\Unit;
use App\Models\Topic;
use Exception;
use Illuminate\Support\Facades\Auth;
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
        $goals = Goal::latest()->with('taken_goals')->get();
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
        $units = Unit::latest()->get();
        if(count($units)> 0){
            $data['units'] = $units;
        } 
        $topics = Topic::latest()->get();
        if(count($topics)> 0){
            $data['topics'] = $topics;
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
            'end_date' => 'required',
            'creator_name' => 'required',
            'instructor_name' => 'required',
            'description' => 'required'
        ]);
        try{
            if($request->hasFile('goal_image')){ 
                $image_name = $request->file('goal_image')->getClientOriginalName();
                $image_path = $request->file('goal_image')->store('public/images');
            }

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
            $goal->user_id = Auth::user()->id;
            $goal->subject_id = $request->subject;
            $goal->unit_id = $request->unit;
            $goal->topic_id = $request->topic;
            $goal->end_date = $request->end_date;
            $goal->creator_name = $request->creator_name;
            $goal->instructor_name = $request->instructor_name;
            $goal->status = 1;
            $goal->image = $image_path;
            $goal->description = $request->description;
            $goal->save();
            if(intval($goal->id) > 0){
                if(count($medias) > 0){
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
            return redirect()->route('admin.goals.index')->with('error',$e->getMessage());
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
            $units = Unit::where('subject_id', $goal->subject_id)->get();
            if(count($units)> 0){
                $data['units'] = $units;
            }
            $topics = Topic::where('unit_id', $goal->unit_id)->get();
            if(count($topics)> 0){
                $data['topics'] = $topics;
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
            'end_date' => 'required',
            'creator_name' => 'required',
            'instructor_name' => 'required',
            'description' => 'required'
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
            $goal->user_id = Auth::user()->id;
            $goal->subject_id = $request->subject;
            $goal->unit_id = $request->unit;
            $goal->topic_id = $request->topic;
            $goal->end_date = $request->end_date;
            $goal->creator_name = $request->creator_name;
            $goal->instructor_name = $request->instructor_name;
            $goal->status = 1;
            $goal->description = $request->description;
            $goal->save();

            if(intval($goal->id) > 0){
                if(count($medias) > 0){
                    foreach($medias as $media){
                        foreach($media as $doc){
                            $goal = Goal::findOrCreate($id);
                            $goal->goal_media()->where('type',$doc['type'])->updateOrCreate([
                                'goal_id' => $goal->id,
                                'media' => $doc['path'],
                                'ext' => $doc['ext'],
                                'type' => $doc['type']
                            ]);  
                        }
                    }
                }

            }
            return redirect()->route('admin.goals.index')->with('success','Goal has been updated successfully');
        }catch(Exception $e){
            return redirect()->route('admin.goals.index')->with('error',$e->getMessage());
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
            $goal->delete();
            return redirect()->route('admin.goals.index')
            ->with('success','Goal has been deleted successfully');
        }catch(Exception $e){
            return $e->getMessage();
        }
       
    }

    public function update_doc(Request $request)
    {
        try{
            $request->validate([
                'document' => 'required',
            ]);
            if($request->hasFile('document')){ 
                    $path = $request->file('document')->store('public/files');
                    $name = $request->file('document')->getClientOriginalName();
            }

            $goal_media = GoalMedia::find($request->doc_id);
            $goal_media->media = $path;
            $goal_media->ext = $request->file('document')->extension();
            $goal_media->type = $request->doc_type; 
            $goal_media->save();
            return redirect()->route('admin.goals.index')->with('success','Document has been updated successfully');
        }catch(Exception $e){
            return redirect()->route('admin.goals.index')->with('error',$e->getMessage());
        }
    }

    /**
     * Update Goal Image
     */

     public function update_image(Request $request){
        try{
            $request->validate([
                'goal_image' => 'required',
            ]);
            if($request->hasFile('goal_image')){ 
                    $path = $request->file('goal_image')->store('public/images');
                    $name = $request->file('goal_image')->getClientOriginalName();
            }

            $goal = Goal::find($request->goal_id);
            $goal->image =$path; 
            $goal->save();
            return redirect()->route('admin.goals.index')->with('success','Document has been updated successfully');
        }catch(Exception $e){
            return redirect()->route('admin.goals.index')->with('error',$e->getMessage());
        }
     }
    /**
     * Delete Goal Document By ID
     */
    public function doc_destroy(Request $request)
    {
        
       /* 
        try{
            $goal_media = GoalMedia::find($id);
            $goal_media->delete();
            return redirect()->route('admin.goals.index')
            ->with('success','Goal Media has been deleted successfully');
        }catch(Exception $e){
            return $e->getMessage();
        } */
       
    }


    /**
     * Get Units according to selected subject
     */
    public function get_units(Request $request)
    {
        try{
            $units = Unit::where('subject_id', $request->subject_id)->get();
           return $units;
        }catch(Exception $e){
            return $e->getMessage();
        } 
        
    }
    /**
     * Get Topics according to selected unit
     */
    public function get_topics(Request $request)
    {
        try{
            $topics = Topic::where('subject_id', $request->subject_id)->where('unit_id', $request->unit_id)->get();
           return $topics;
        }catch(Exception $e){
            return $e->getMessage();
        } 
        
    }
}
