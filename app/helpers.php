<?php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
//use Exception;
use App\Models\Unit;
use App\Models\Topic;
use App\Models\Plan;
use Illuminate\Support\Facades\Auth;
use App\Models\Subject;
use App\Models\Membership;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
function uploadImageS3($request_file, $filename){     
    
    //Upload File to s3
    Storage::disk('s3')->put($filename, file_get_contents($request_file));
    $url = Storage::disk('s3')->url($filename);
    return $url;
   
        
}

// Check if image exists on aws s3 bucket
function isImageExistsOnAws($image){
    $exists = Storage::disk('s3')->has($image);
    return $exists;
}

// Delete image form s3 bucket
function deleteImageFromS3($file){
    Storage::disk('s3')->delete($file);
} 

function getUnitName($id){
    $getUnitName = Unit::where('id',$id)->first();
    if($getUnitName){
        return $getUnitName->name;
    }
}

function getTopicName($id){
    $getTopicName = Topic::where('id',$id)->first();
    if($getTopicName){
        return $getTopicName->name;
    }
}

function getMembershipDetails(){
        //Get plan details
        $plan_details = Membership::where('student_id',Auth::user()->id)->get();
        if(count($plan_details) > 0){
            $set_plan = 1;
        }else{
            $set_plan = 2;
        }
        Session::put('set_plan', $set_plan);
        foreach($plan_details as $key => $val){
            if((strtotime(now()) > strtotime($val->expiry_date)) && ($val->subscription == 'manual')){
                Session::put('plan_expire', 1);
            }else{
                if((strtotime(now()) > strtotime($val->expiry_date)) && ($val->subscription == 'auto')){
                    $new_expiry_date = getNewExpiryDate($val->plan_id,$val->expiry_date);
                    update_membership_plan($val->id,$new_expiry_date);
                    Session::put('plan_expire', 2);
                }
            }
        }
        //Get subjects
        $subjects = Subject::latest()->get();
        if($subjects){
            $data['subjects'] = $subjects;
        }
        //Get all Plans
        $get_free_plan_id = Membership::where('student_id',Auth::user()->id)->first();
        if(!empty($get_free_plan_id)){
            $plans = DB::table('plans')->whereNotIn('id', [1])->get();
        }else{
            $plans = DB::table('plans')->get();
        }

        if(count($plans) > 0){
            $data['plans'] = $plans;
        }

    return $data;
}

function countDays($plan_id){
    $expire_date = date('Y-m-d', strtotime("+".$plan_id." months", strtotime(now())));
    $days = (strtotime($expire_date) - strtotime(now())) / (60 * 60 * 24);
    return round($days);
}
function getExpiryDate($plan_id){
    $expiry_date = date('Y-m-d', strtotime("+".$plan_id." months", strtotime(now())));
    return $expiry_date;
}

function update_membership_plan($id,$expiry_date){
    $membership = Membership::find($id);
    $membership->expiry_date = $expiry_date;
    $membership->save();
}

function getNewExpiryDate($plan_id,$expiry_date){
    $get_months = Plan::where('id',$plan_id)->first();
    $new_expiry_date = date('Y-m-d', strtotime("+".$get_months->months." months", strtotime($expiry_date)));
    return $new_expiry_date;
}

?>