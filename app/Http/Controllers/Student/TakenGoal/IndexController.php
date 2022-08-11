<?php

namespace App\Http\Controllers\Student\TakenGoal;

use App\Http\Controllers\Controller;
use App\Models\TakenGoal;
use Illuminate\Http\Request;
use App\Models\Goal;
use Illuminate\Support\Facades\Auth;
use Exception;

class IndexController extends Controller
{
    /**
     * Display All Taken Goals
     */
    public function index()
    {  
        $data = [];
        $data = getMembershipDetails();
        $taken_goals = TakenGoal::where('student_id', Auth::user()->id)->with('goal')->get();
        if(count($taken_goals)> 0){
            $data['taken_goals'] = $taken_goals;
        }
        return view('student.taken_goals.index',$data);
    }

    public function submit_papers(Request $request)
    {

    }
}
