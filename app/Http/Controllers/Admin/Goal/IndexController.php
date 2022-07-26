<?php

namespace App\Http\Controllers\Admin\Goal;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Goal;
use Exception;
use Illuminate\Support\Facades\Validator;
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
        //$data['companies'] = Company::orderBy('id','desc')->paginate(5);
        return view('admin.goals.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        return view('admin.goals.create');
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
        if($request->hasFile('document')){
            $file = $request->file('document');
            $document_name=time().$file->getClientOriginalName();
            $filePath = 'goals/'.$request->subject.'/documents/' . $document_name;
            Storage::disk('s3')->put($filePath, file_get_contents($file));
        }else{
            $document_name = '';
        }
        
        $goal = new Goal;
        $goal->user_id = 1;
        $goal->subject = $request->subject;
        $goal->unit = $request->unit;
        $goal->topic = $request->topic;
        $goal->document = $filePath;
        $goal->video = $request->video;
        $goal->exam_document = $request->exam_document;
        $goal->creator_name = $request->creator_name;
        $goal->instructor_name = $request->instructor_name;
        $goal->save();
        return redirect()->route('goals.create')->with('success','Goal has been created successfully.');
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
