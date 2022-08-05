<?php

namespace App\Http\Controllers\Admin\Unit;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Unit;
use App\Models\Subject;
use Exception;

class IndexController extends Controller
{
     /**
     * Display All Units
     */
    public function index()
    {
        $data = [];
        $units = Unit::latest()->get();
        if(count($units)> 0){
            $data['units'] = $units;
        }
        return view('admin.units.index',$data);
    }
    /**
     * Store  Unit
     */
    public function store(Request $request)
    {
        $request->validate([
            'subject' => 'required',
            'name' => 'required'
        ]);

       
        try{
            $unit = new Unit;
            $unit->subject_id = $request->subject;
            $unit->name = $request->name;
            $unit->status = 1;
            $unit->save();
            if(intval($unit->id) > 0){
                return redirect()->route('admin.units.index')->with('success','Unit has been created successfully.');
            }
        }catch(Exception $e){
            return redirect()->route('admin.units.index')->with('error',$e->getMessage());
        }
        
    }
    /**
     * Create  Unit
     */
    public function create()
    {
        $data = [];
        $subjects = Subject::latest()->get();
        if(count($subjects)> 0){
            $data['subjects'] = $subjects;
        }
        return view('admin.units.create',$data);
    }

    /**
     * Edit Unit
     */
    public function edit($id)
    {
        try{
            $data = [];
            $unit = Unit::find($id);
            if($unit){
                $data['unit'] = $unit;
            }
            $subjects = Subject::latest()->get();
            if(count($subjects)> 0){
                $data['subjects'] = $subjects;
            }
            $units = Unit::latest()->get();
            if(count($units)> 0){
                $data['units'] = $units;
            }
            return view('admin.units.edit',$data);
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
            'name' => 'required',
        ]);
        try{
            
            $unit = Unit::find($id);
            $unit->subject_id = $request->subject;
            $unit->name = $request->name;
            $unit->status = 1;
            $unit->save();
            if(intval($unit->id) > 0){
                return redirect()->route('admin.units.index')->with('success','Unit has been updated successfully');
            }
        }catch(Exception $e){
            return redirect()->route('admin.units.index')->with('error', $e->getMessage());
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
            $unit = Unit::find($id);
            $unit->delete();
            return redirect()->route('admin.units.index')->with('success','Unit has been deleted successfully');
        }catch(Exception $e){
            return redirect()->route('admin.units.index')->with('error',$e->getMessage());
        }
       
    }
}
