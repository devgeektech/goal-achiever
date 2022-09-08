<?php

namespace App\Http\Controllers;
use App\Models\Subject;
use App\Models\Country;
use App\Models\Plan;
use App\Models\User;
use Illuminate\Http\Request;
use Mail;
use Exception;
use Illuminate\Support\Facades\DB;
use App\Mail\ContactUsMail;
use App\Models\TakenGoal;

class IndexController extends Controller
{
    public function index()
    {
        $data = [];
        $subjects = Subject::latest()->get();
        if($subjects){
            $data['subjects'] = $subjects;
        }

        $countries = Country::get();
        if($countries){
            $data['countries'] = $countries;
        }

        $plans = Plan::get();
        if($plans){
            $data['plans'] = $plans;
        }

       /*  $get_students = $get_comp_goals = []; */

        return view('index', $data);

    }

    public function contact(Request $request)
    {
        $data = [];
        $subjects = Subject::latest()->get();
        if($subjects){
            $data['subjects'] = $subjects;
        }
        $countries = Country::get();
        if($countries){
            $data['countries'] = $countries;
        }
        $plans = Plan::get();
        if($plans){
            $data['plans'] = $plans;
        }
        $contact = [];
        $contact['name'] = $request->firstname;
        $contact['email'] = $request->email;
        $contact['country'] = $request->country;
        $contact['comment'] = $request->comment;
       try{
            Mail::to('nahu_ooo@hotmail.com')->send(new ContactUsMail($contact));
            if (Mail::failures()) {
                return view('index',$data)->with('error','Sorry email not sent');
            }else{
                return view('index',$data)->with('success','Great! Successfully send in your mail');
            }
       }catch(Exception $e){
            return view('index',$data)->with('error',$e->getMessage());
        }
    }

    // Get graph bar data/stats

    public function getBarGraphData(){
        $subject_ids = array('9','10','11','14','15');
        $get_students = [];
        foreach($subject_ids as $subject_id){
            $get_students = TakenGoal::select('student_id')->where('subject_id',$subject_id)->distinct('subject_id')->pluck('student_id')->toArray();
            foreach($get_students as $student){
                $studentInfo = getStudentName($student);
                $get_all_units = $studentInfo->taken_goals->where('subject_id',$subject_id);
                $get_completed_units = $studentInfo->taken_goals->where('subject_id',$subject_id)->where('status', '1');
                $cal_percentage[$studentInfo->name][] = round(count($get_completed_units)/count($get_all_units)*100);
            }
        }
        $graphArrData = [];
        foreach($cal_percentage as $k => $per){
            $graphArrData[] = [$k,...$per];
        }
        return response()->json(['status' => 'true', 'data' => $graphArrData]);
    }

}
