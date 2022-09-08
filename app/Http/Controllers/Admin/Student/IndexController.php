<?php

namespace App\Http\Controllers\Admin\Student;

use App\Http\Controllers\Controller;
use App\Mail\ActivateMail;
use App\Mail\RegisterMail;
use App\Models\Membership;
use App\Models\Plan;
use Illuminate\Http\Request;
use App\Models\User;
use Mail;
class IndexController extends Controller
{
    /**
     * Display all listing of students
     */
    public function index()
    {   
        $data = [];
        $data['students'] = User::where('role', 3)->get();
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


    /**
     * Activate student Account
     */
    public function activate($id)
    {
       $student = User::find($id);
       $student->status = 1;
       $student->save();
       if($student->id){
            $data = [];
            $data['students'] = User::where('role', 3)->get();
            if($data['students']){
                $get_plan_id = Membership::where('student_id',$id)->pluck('plan_id');
                if($get_plan_id){
                    $get_plan_months = Plan::where('id',$get_plan_id)->first();
                    if($get_plan_months){
                        $create_expiration_date = getExpiryDate($get_plan_months->months);
                        $membership = Membership::where('student_id',$id)->where('plan_id',$get_plan_id)->update(['expiry_date'=> $create_expiration_date]);
                        if($membership){
                            //Mail::to('nahu_ooo@hotmail.com')->send(new ActivateMail($student));
                            return view('admin.student.index',$data);
                        }
                    }
                   
                }  
            }    
       }
    }
}
