<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Plan;
use App\Models\Goal;
use App\Models\User;
class IndexController extends Controller
{
    public function index()
    {
        $data = [];
        $plans = Plan::latest()->get();
        if(count($plans)> 0){
            $data['plans'] = $plans;
        }
        $goals = Goal::latest()->get();
        if(count($goals)> 0){
            $data['goals'] = $goals;
        }

        $students = User::where('role','3')->get();
        if(count($students)> 0){
            $data['students'] = $students;
        }
        return view('admin.index',$data);
    }
}
