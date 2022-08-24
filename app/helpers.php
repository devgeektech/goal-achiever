<?php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
//use Exception;
use App\Models\Unit;
use App\Models\Topic;
use App\Models\Plan;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Models\Subject;
use App\Models\Membership;
use App\Models\TakenGoal;
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

//Get unit name by unit id
function getUnitName($id){
    $getUnitName = Unit::find($id);
    
    if($getUnitName){
        return $getUnitName->name;
    }
}
//Get topic name by topic id
function getTopicName($id){
    $getTopicName = Topic::where('id',$id)->first();
    if($getTopicName){
        return $getTopicName->name;
    }
}

//Get Membership details
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

//Count total days for any chosen plan
function countDays($plan_id){
    $expire_date = date('Y-m-d', strtotime("+".$plan_id." months", strtotime(now())));
    $days = (strtotime($expire_date) - strtotime(now())) / (60 * 60 * 24);
    return round($days);
}

//Get Expiry Date for any chosen plan
function getExpiryDate($plan_id){
    $expiry_date = date('Y-m-d', strtotime("+".$plan_id." months", strtotime(now())));
    return $expiry_date;
}

//Update membership plan according to its type i.e manual or auto
function update_membership_plan($id,$expiry_date){
    $membership = Membership::find($id);
    $membership->expiry_date = $expiry_date;
    $membership->save();
}

//Get new expiry date of plan when it is goimg to expired
function getNewExpiryDate($plan_id,$expiry_date){
    $get_months = Plan::where('id',$plan_id)->first();
    $new_expiry_date = date('Y-m-d', strtotime("+".$get_months->months." months", strtotime($expiry_date)));
    return $new_expiry_date;
}

//Get total number of students participated in goal
function getTotalParticipants($goal_id){
    $get_total_participants = TakenGoal::where('goal_id', $goal_id)->groupBy('goal_id')->pluck('goal_id')->count();
    if(!empty($get_total_participants)){
        return $get_total_participants;
    }else{
        return "Not taken yet";
    }
}

//Get total number of goals taken by student
function getTotalGoalsTaken($id){
    $get_total_goals_taken = TakenGoal::where('student_id', $id)->get();
    if(!empty($get_total_goals_taken)){
        return $get_total_goals_taken->count();
    }else{
        return 0;
    }
}

/**
 * Get Total Goals Achieved
 */
function getTotalGoalsAchieved($id){
    $get_goals_achieved = TakenGoal::where('student_id',$id)->where('status','completed')->get();
    $get_count = $get_goals_achieved->count();
    if($get_count > 0){
        return $get_count;
    }else{
        return 0;
    }
}

/**
 * Get Pending Goals
 */
function getPendingGoals($id){
    $get_pending_goals = getTotalGoalsTaken($id) - getTotalGoalsAchieved($id);
    if(intval($get_pending_goals)){
        return $get_pending_goals;
    }else{
        return 0;
    }
}


function getAdminInfo(){
    $admin_info = User::where('role',1)->first();
    if($admin_info){
        return $admin_info;
    }
    return null;
}

function checkGoalAval($id){
    if(Auth::check()){
        $get_aval = TakenGoal::where('goal_id',$id)->where('student_id', Auth::user()->id)->first();
        if($get_aval){
            return 'yes';
        }else{
            return 'no';
        }
    }else{
        return 'no';
    }
    
}

/**
 * Get Percentage of Goals
 */
function get_percentage($unit_id,$student_id){
    $all_topics = TakenGoal::where('student_id',$student_id)->where('unit_id',$unit_id)->get()->count();
    if($all_topics){
        $completed_topics = TakenGoal::where('student_id',$student_id)->where('unit_id',$unit_id)->where('status','completed')->get()->count();
        if($completed_topics){
            $cal_percentage = ($completed_topics/$all_topics)*100;
            return $cal_percentage;
        }else{
            return 0;
        }
    }
}


/**
 * Check Goal Status From Goal Taken Table
 */
function checkGoalStatus($unit_id,$topic_id){
    $get_status = TakenGoal::where('unit_id',$unit_id)->where('topic_id',$topic_id)->where('status','completed')->where('student_id',Auth::user()->id)->first();
    if($get_status){
        return 'completed';
    }else{
        return 'inprogress';
    }
}
?>