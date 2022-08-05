<?php

namespace App\Http\Controllers;
use App\Models\Subject;
use App\Models\Country;
use App\Models\Plan;
use Illuminate\Http\Request;
use Mail;
use Exception;
use App\Mail\ContactUsMail;
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
            Mail::to('harvinder@geekinformatic.com')->send(new ContactUsMail($contact));
            if (Mail::failures()) {
                return view('index',$data)->with('error','Sorry email not sent');
            }else{
                return view('index',$data)->with('success','Great! Successfully send in your mail');
            }
       }catch(Exception $e){
            return $e->getMessage();
        }
       
    }

}
