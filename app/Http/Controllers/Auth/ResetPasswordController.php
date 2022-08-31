<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
class ResetPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

    use ResetsPasswords;

    /**
     * Where to redirect users after resetting their password.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    public function index()
    {  
        $data = [];
        $data = getMembershipDetails();
        if(Auth::user()->role == 1){
            return view('admin.profile.update');
        }else{
            return view('student.profile.update',$data);
        }
        
    }

    public function update_password(Request $request)
    {
        $request->validate([
            'password' => 'required|confirmed|min:6'
        ]);

        $user = User::where('email', Auth::user()->email)->first();
        if($user){
            $user->password = Hash::make($request->password);
            $user->save();
            if(intval($user->id) > 0){
                if(Auth::user()->role == 1){
                    return redirect()->route('admin.change-password')->with('password_success','Password Changed successfully.');
                }else{
                    return redirect()->route('student.change-password')->with('password_success','Password Changed successfully.');
                }
               
            }
        }
    }

    public function update_username(Request $request)
    {
        $user = User::where('email', Auth::user()->email)->first();

        if($request->profile_image){ 
            $path = $request->profile_image->store('public/profile_images');
            $profile_image = $path;
        }else{
            $profile_image = $user->profile_image;
        }
       
        if($user){
            $user->name = isset($request->name) ? $request->name : $user->name;
            $user->profile_image = $profile_image;
            $user->save();
            if(intval($user->id) > 0){
                if(Auth::user()->role == 1){
                    return redirect()->route('admin.change-password')->with('username_success','Profile Updated successfully.');
                }else{
                    return redirect()->route('student.change-password')->with('username_success','Profile Updated successfully.');
                }
               
            }
        }
    }
}
