<?php

namespace App\Http\Controllers\Admin\Topic;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Topic;
use App\Models\Subject;
use App\Models\Unit;
use Exception;

class IndexController extends Controller
{
    /**
     * Display All Topics
     */
    public function index()
    {
        $data = [];
        $topics = Topic::latest()->get();
        if(count($topics)> 0){
            $data['topics'] = $topics;
        }
        return view('admin.topics.index',$data);
    }
    /**
     * Store  Topic
     */
    public function store(Request $request)
    {
        $request->validate([
            'subject' => 'required',
            'unit' => 'required',
            'name' => 'required'
        ]);
        try{
            $topic = new Topic;
            $topic->subject_id = $request->subject;
            $topic->unit_id = $request->unit;
            $topic->name = $request->name;
            $topic->status = 1;
            $topic->save();
            if(intval($topic->id) > 0){
                return redirect()->route('admin.topics.index')->with('success','Topic has been created successfully.');
            }
        }catch(Exception $e){
            return redirect()->route('admin.topics.index')->with('error',$e->getMessage());
        }
        
    }
    /**
     * Create  Topic
     */
    public function create()
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
        return view('admin.topics.create',$data);
    }

    /**
     * Edit Topic
     */
    public function edit($id)
    {
        try{
            $data = [];
            $topic = Topic::find($id);
            if($topic){
                $data['topic'] = $topic;
            }
            $units = Unit::where('subject_id',$topic->subject_id)->get();
            if($units){
                $data['units'] = $units;
            }
            $topics = Topic::latest()->get();
            if($topics){
                $data['topics'] = $topics;
            }
            $subjects = Subject::latest()->get();
            if(count($subjects)> 0){
                $data['subjects'] = $subjects;
            }
            return view('admin.topics.edit',$data);
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
            'name' => 'required',
        ]);
        try{
            $topic = Topic::find($id);
            $topic->subject_id = $request->subject;
            $topic->unit_id = $request->unit;
            $topic->name = $request->name;
            $topic->status = 1;
            $topic->save();
            if(intval($topic->id) > 0){
                return redirect()->route('admin.topics.index')->with('success','Topic has been updated successfully');
            }
            return redirect()->route('admin.topics.index')->with('error','Topic has not updated');
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
            $topic = Topic::find($id);
            $topic->delete();
            return redirect()->route('admin.topics.index')->with('success','Topic has been deleted successfully');
        }catch(Exception $e){
            return redirect()->route('admin.topics.index')->with('error',$e->getMessage());
        }
       
    }
}
