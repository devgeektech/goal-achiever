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
        $goals = Goal::all();
        if(count($goals)> 0){
            $data['goals'] = $goals->count();
        }
        $completed_goals = Goal::where('status',2)->get();
        if(count($completed_goals)> 0){
            $data['completed_goals'] = $completed_goals->count();
        }

        $data['cal_percentage'] = ($data['completed_goals']/$data['goals'])*100;
        
        $students = User::where('role','3')->get();
        if(count($students)> 0){
            $data['students'] = $students->count();
        }
        return view('admin.index',$data);
    }
}
