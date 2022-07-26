<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use App\Models\Goal;
use App\Models\Topic;
use App\Models\Payment;
use App\Models\Membership;
use App\Models\TakenGoal;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Mail;
use Exception;
use App\Mail\RegisterMail;
use App\Mail\RegisterMailToAdmin;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:users',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed|min:6',
            'country' => 'required',
            'age' => 'required'
        ]);
       
        $data = $request->all();
        $user = $this->create($data);
        if($request->register_from == 'plan'){
          return response()->json([ 'status' => 'Success', 'user_id' => $user->id]);
        }
        Mail::to('nahu_ooo@hotmail.com')->send(new RegisterMailToAdmin($user));
        Auth::login($user);
        if(Auth::check()){
            Mail::to('nahu_ooo@hotmail.com')->send(new RegisterMail($user));
                if($user->role == 3){
                  return redirect()->route("student.dashboard");
                }
                 return redirect()->route("admin.dashboard");
              
        }else{
          return back()->with("errors", "Alert! Failed to register");
        }
        
        
    }

    public function create(array $data)
    {
      return User::create([
        'name' => $data['name'],
        'email' => $data['email'],
        'password' => Hash::make($data['password']),
        'role' => 3,
        'country' => $data['country'],
        'age' => $data['age'],
        'status' => 2
      ]);
    }  
    
     /**
     * Store Purchase Plan into Database
     */
    public function paymentStore(Request $request)
    {
       
        try{
            switch ($request->plan_id) {
            case '1':
                $plan_days = countDays($request->plan_months);
                $expire_date = getExpiryDate($request->plan_months);
                $type = 'monthly';
                break;
            case '2':
                $plan_days = countDays($request->plan_months);
                $expire_date = getExpiryDate($request->plan_months);
                $type = 'monthly';
                break;
            case '3':
                $plan_days = countDays($request->plan_months);
                $expire_date = getExpiryDate($request->plan_months);
                $type = '3 monthly';
                break;
            case '4':
                $plan_days = countDays($request->plan_months);
                $expire_date = getExpiryDate($request->plan_months);
                $type = '6 monthly';
                break;
            default:
                $plan_days = countDays($request->plan_months);
                $expire_date = getExpiryDate($request->plan_months);
                $type = 'yearly';
            }
           
            $membership = new Membership;
            $membership->plan_id = $request->plan_id;
            $membership->student_id = $request->user_id;
            $membership->plan_days = $plan_days;
            $membership->type = $type;
            $membership->subscription = 'manual';
            $membership->expiry_date = $expire_date;
            $membership->transaction_id = $request->reference_no;
            $membership->save();
            if(intval($membership->id) > 0){
                $payment = new Payment;
                $payment->plan_id = $request->plan_id;
                $payment->student_id = $request->user_id;
                $payment->subject_id = $request->subject_id;
                $payment->name_on_card = base64_encode($request->name_on_card);
                $payment->card_number = substr_replace($request->card_number, str_repeat("X", 8), 4, 8);
                $payment->cvc = substr_replace($request->cvc_number, str_repeat("X", 2), 0, 2);
                $payment->expiration_date = base64_encode($request->expiration_month.'/'.$request->expiration_year);
                $payment->save();
                if(intval($membership->id) > 0){
                    $user = User::find($request->user_id);
                    //Auth::login($user);
                    if(isset($request->goal_id)){
                        $get_info = TakenGoal::where('goal_id',$request->goal_id)->where('unit_id',$request->unit_id)->where('student_id',$request->user_id)->first();
                        if($get_info){
                            return response()->json([ 'status' => 'already']);
                        }
                        $goal_ids = Goal::select('id')->where('unit_id',$request->unit_id)->pluck('id')->toArray();      
                        if(count($goal_ids)>0){
                            $topics = Topic::where('unit_id',$request->unit_id)->get();
                            $i = 0;
                            foreach($topics as $topic){
                                $taken_goal = new TakenGoal;
                                $taken_goal->goal_id = $goal_ids[$i];
                                $taken_goal->student_id = $request->user_id;
                                $taken_goal->status = ($i == 0) ? '2' : '3';
                                $taken_goal->subject_id = $topic->subject_id;
                                $taken_goal->unit_id = $topic->unit_id;
                                $taken_goal->topic_id = $topic->id;
                                $taken_goal->end_date = $request->end_date;
                                $taken_goal->save();
                                $i++;
                            }
                            if(intval($taken_goal->id) > 0){
                                return response()->json([ 'status' => 'Success']);
                            }else{
                                return response()->json([ 'status' => 'failed']);
                            }
                        }
                    }
                    return response()->json([ 'status' => 'Success', 'message' => 'true','user_id' => $request->user_id]);
                }
            }
        }catch(Exception $e){
            return response()->json([ 'status' => 'false', 'message' => $e->getMessage()]);
        }
    }

    public function check_auth()
    {
        if(!Auth::check()){
            return response()->json([ 'status' => 'unauthenticated']);
        }else{
            return response()->json([ 'status' => 'authenticated']);
        }
    }
}
