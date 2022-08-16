<?php

namespace App\Http\Controllers\Admin\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
class IndexController extends Controller
{
    /**
     * Display all listing of students
     */
    public function index()
    {   
        $data = [];
        $data['students'] = User::where('role', 3)->with('taken_goals')->get();
        if($data['students']){
            return view('admin.student.index',$data);
        }
    }

    /**
     * Display student Info in page
     */
    public function show($id)
    {
       $student = User::find($id);
       if($student){
            return view('admin.student.info',compact('student'));
       }
    }
}
