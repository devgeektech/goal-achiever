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

}
