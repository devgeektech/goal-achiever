<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;

use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Mail;
use Exception;
use App\Mail\RegisterMail;
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
        ]);
           
        $data = $request->all();
        $user = $this->create($data);
        Auth::login($user);
        if(Auth::check()){
          try{
            Mail::to('harvinder@geekinformatic.com')->send(new RegisterMail($user));
              if (Mail::failures()) {
                return back()->with("errors", "Alert! Failed to register");
              }else{
                if($user->role == 3){
                  return redirect()->route("student.dashboard");
                }
                return redirect()->route("admin.dashboard");
              }
          }catch(Exception $e){
                return view('index',$data)->with('error',$e->getMessage());
          }
          
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
        'role' => 3
      ]);
    }    
}
